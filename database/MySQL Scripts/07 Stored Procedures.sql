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
	SET @row_number = 0;
	SELECT (@row_number:=@row_number + 1) AS RowNum, DATE_FORMAT(pv.DateTime, "%d %b %Y at %h:%i %p") AS DateTime, vc.Name AS VaccinationCentre, CONCAT(p.FirstName , ' ' , p.LastName) AS PatientName, vt.Name AS VaccinationType
	FROM medicalpersons mp 
		INNER JOIN patientvaccinations pv ON mp.MedicalPersonId = pv.MedicalPersonId
		INNER JOIN vaccinationcentres vc ON pv.VaccinationCentreId = vc.VaccinationCentreId
		INNER JOIN patients p ON pv.PatientId = p.PatientId
		INNER JOIN vaccinationtypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
	WHERE mp.MedicalPersonId = p_MedicalPersonId
	ORDER BY pv.DateTime DESC;
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