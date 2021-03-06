USE `Vaccinations`;

-- [spGetUsernames]
-- This will get the list if medical persons that can login
-- --------------------------------------------------------

DROP procedure IF EXISTS `spGetUsernames`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUsernames`()
BEGIN
    SELECT MedicalPersonId, CONCAT(FirstName , ' ' , LastName , ' (' , Profession , ')') AS Username FROM MedicalPersons ORDER BY FirstName, LastName;
END$$
DELIMITER ;


-- [spGetMedicalPerson]
-- This will get the selected medical persons after login
-- ------------------------------------------------------

DROP procedure IF EXISTS `spGetMedicalPerson`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetMedicalPerson`(IN p_MedicalPersonId INT)
BEGIN
	SELECT * FROM MedicalPersons mp WHERE mp.MedicalPersonId = p_MedicalPersonId;
END$$
DELIMITER ;


-- [spGetVaccinationCentres]
-- This will get a list of vaccination centres after login
-- -------------------------------------------------------

DROP procedure IF EXISTS `spGetVaccinationCentres`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationCentres`()
BEGIN
	SELECT VaccinationCentreId, Name FROM VaccinationCentres ORDER BY Name;
END$$
DELIMITER ;


-- [spGetVaccinationTypes]
-- This will get a list of vaccination types after login
-- -------------------------------------------------------

DROP procedure IF EXISTS `spGetVaccinationTypes`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationTypes`()
BEGIN
	SELECT VaccinationTypeId, Name FROM VaccinationTypes ORDER BY Name;
END$$
DELIMITER ;


-- [spGetVaccinationHistory]
-- This will get a list of vaccinators history
-- -------------------------------------------

DROP procedure IF EXISTS `spGetVaccinationHistory`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationHistory`(IN p_MedicalPersonId INT)
BEGIN
	CREATE TEMPORARY TABLE Temp_VaxHistory
	SELECT DATE_FORMAT(pv.DateTime, "%d %b %Y at %h:%i %p") AS DateTime, vc.Name AS VaccinationCentre, CONCAT(p.FirstName , ' ' , p.LastName) AS PatientName, vt.Name AS VaccinationType
	FROM medicalpersons mp 
		INNER JOIN patientvaccinations pv ON mp.MedicalPersonId = pv.MedicalPersonId
		INNER JOIN vaccinationcentres vc ON pv.VaccinationCentreId = vc.VaccinationCentreId
		INNER JOIN patients p ON pv.PatientId = p.PatientId
		INNER JOIN vaccinationtypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
	WHERE mp.MedicalPersonId = p_MedicalPersonId
	ORDER BY pv.DateTime DESC;

	SET @row_number = 0;
	SELECT *, (@row_number:=@row_number + 1) AS RowNum
	FROM Temp_VaxHistory;
END$$
DELIMITER ;


-- [spSavePatientVaccination]
-- This will insert or update a patient and record the vaccination
-- ---------------------------------------------------------------

DROP procedure IF EXISTS `spSavePatientVaccination`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSavePatientVaccination`(
	IN p_MedicalPersonId INT,
    IN p_VaccinationCentreId INT,
    IN p_DateTime DATETIME, 
    IN p_VaccinationTypeId INT,
    IN p_PatientUniqueId VARCHAR(256), 
    IN p_PatientFirstName VARCHAR(256),
    IN p_PatientLastName VARCHAR(256),
    IN p_PatientDOB DATETIME,
    IN p_PatientAddress VARCHAR(256),
    IN p_PatientPostcode VARCHAR(10),
    IN p_PatientTelephone VARCHAR(15)
    )
BEGIN

    -- get patient from unique id
    SELECT PatientId INTO @PatientId FROM Patients WHERE PatientUniqueId = p_PatientUniqueId;

    IF @PatientId IS NULL THEN
        -- patient does not exist so we'll insert
        INSERT INTO Patients(PatientUniqueId, FirstName, LastName, DateofBirth, Address, Postcode, Telephone)
        VALUES(p_PatientUniqueId, p_PatientFirstName, p_PatientLastName, p_PatientDOB, p_PatientAddress, p_PatientPostcode, p_PatientTelephone);

        SET @PatientId := LAST_INSERT_ID();
    ELSE
        -- patient exists so we'll update
        UPDATE Patients 
        SET FirstName = p_PatientFirstName, LastName = p_PatientLastName, DateofBirth = p_PatientDOB, Address = p_PatientAddress, Postcode = p_PatientPostcode, Telephone = p_PatientTelephone
        WHERE PatientId = @PatientId;
    END IF;


    -- insert patient vaccination
	INSERT INTO PatientVaccinations(DateTime, VaccinationCentreId, MedicalPersonId, PatientId, VaccinationTypeId)
	VALUES (p_DateTime, p_VaccinationCentreId, p_MedicalPersonId, @PatientId, p_VaccinationTypeId);
END$$
DELIMITER ;


-- [spGetReportVaccinationsByCentre]
-- This will get a list of vaccinations carried out by each centre
-- ---------------------------------------------------------------

DROP procedure IF EXISTS `spGetReportVaccinationsByCentre`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetReportVaccinationsByCentre`()
BEGIN
	SELECT vc.Name, vc.Address, vc.Postcode, vc.Telephone, COUNT(pv.VaccinationCentreId) AS NumberOfVaccinations
	FROM PatientVaccinations pv
		INNER JOIN VaccinationCentres vc ON pv.VaccinationCentreId = vc.VaccinationCentreId
	GROUP BY vc.VaccinationCentreId
	ORDER BY NumberOfVaccinations DESC;
END$$
DELIMITER ;


-- [spGetReportPatientsByVaccinationType]
-- This will get a list of vaccinations carried out by each centre
-- ---------------------------------------------------------------

DROP procedure IF EXISTS `spGetReportPatientsByVaccinationType`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetReportPatientsByVaccinationType`()
BEGIN
	SELECT COUNT(*) INTO @TotalPatients FROM Patients;

	SELECT vt.Name, COUNT(pv.VaccinationTypeId) AS NumberOfPatients, COUNT(pv.VaccinationTypeId) / @TotalPatients * 100 AS PercentOfPatients
	FROM PatientVaccinations pv
		INNER JOIN VaccinationTypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
	GROUP BY vt.VaccinationTypeId
	ORDER BY NumberOfPatients DESC;
END$$
DELIMITER ;


-- [spGetReportCovidVaccinationsByArea]
-- This will get the total number of covid vaccinations then will brake down the 4 different types of covid vaccines and number of those given
-- -------------------------------------------------------------------------------------------------------------------------------------------

DROP procedure IF EXISTS `spGetReportCovidVaccinationsByArea`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetReportCovidVaccinationsByArea`()
BEGIN
	-- creates a temporary table that gets the area, vaccine type, total for each vaccicne type for each area 
    -- and adds a column for the total number of covid vaccinations
	CREATE TEMPORARY TABLE Temp_AreaVaxDetails
	SELECT 
		SUBSTRING_INDEX(p.Address, ', ', -1) AS Area, 
		vt.name AS Vaccine, 
		COUNT(*) AS NumVaxByArea,
		0 AS TotalVax
	FROM Patients p
		INNER JOIN PatientVaccinations pv ON p.PatientId = pv.PatientId
		INNER JOIN vaccinationtypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
	WHERE vt.name LIKE "COVID-19%"
	GROUP BY Area, vt.VaccinationTypeId;
	
    
    -- created Temp_AreaVaxQty temporary table to hold the total number of covid vaccinations for each area
    -- added an index to this table to make the query run faster from 9 seconds to 0 seconds
	CREATE TEMPORARY TABLE Temp_AreaVaxQty
	(INDEX area_index (Area), Qty INT)
	SELECT Area, SUM(NumVaxByArea) AS Qty FROM Temp_AreaVaxDetails GROUP BY Area;
	
    -- updates values in Temp_AreaVaxDetails table using the values from Temp_AreaVaxQty table making it fast 
    -- as it doesn't need to query to get the values it needs beacuse of the Temp_AreaVaxQty table having the data already
	UPDATE Temp_AreaVaxDetails t1
		INNER JOIN Temp_AreaVaxQty t2 ON t1.Area = t2.Area
	SET t1.TotalVax = t2.Qty;
	
	SELECT * FROM Temp_AreaVaxDetails ORDER BY TotalVax DESC, Area, NumVaxByArea DESC, Vaccine;
	
    -- delete temporary tables as they are no longer required
	DROP TEMPORARY TABLE Temp_AreaVaxDetails;
	DROP TEMPORARY TABLE Temp_AreaVaxQty;
END$$
DELIMITER ;


-- [spGetTotalPatients]
-- This will get total number of patients
-- --------------------------------------

DROP procedure IF EXISTS `spGetTotalPatients`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetTotalPatients`()
BEGIN
	SELECT COUNT(*) AS TotalPatients FROM Patients;
END$$
DELIMITER ;


-- [spGetTotalVaccinations]
-- This will get total number of vaccinations
-- ------------------------------------------

DROP procedure IF EXISTS `spGetTotalVaccinations`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetTotalVaccinations`()
BEGIN
	SELECT COUNT(*) AS TotalVaccinations FROM PatientVaccinations;
END$$
DELIMITER ;


-- [spGetTotalCovidVaccinations]
-- This will get total number of covid vaccinations
-- ------------------------------------------------

DROP procedure IF EXISTS `spGetTotalCovidVaccinations`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetTotalCovidVaccinations`()
BEGIN
	SELECT COUNT(*) AS TotalCovidVaccinations
	FROM PatientVaccinations pv
		INNER JOIN VaccinationTypes vt on pv.VaccinationTypeId = vt.VaccinationTypeId
	WHERE vt.name LIKE "COVID-19%";
END$$
DELIMITER ;


-- [spGetTotalMedicalPersonVaccinations]
-- This will get total number of vaccinations for each medical person
-- ------------------------------------------------------------------

DROP procedure IF EXISTS `spGetTotalMedicalPersonVaccinations`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetTotalMedicalPersonVaccinations`(IN p_MedicalPersonId INT)
BEGIN
	SELECT COUNT(*) AS TotalMedicalPersonVaccinations
	FROM medicalpersons mp 
		INNER JOIN patientvaccinations pv ON mp.MedicalPersonId = pv.MedicalPersonId		
	WHERE mp.MedicalPersonId = p_MedicalPersonId;
END$$
DELIMITER ;