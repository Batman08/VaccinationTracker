USE `Vaccinations`;

-- [spGetUsernames]
-- This will get the list if medical persons that can login
-- --------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUsernames`()
BEGIN
    SELECT MedicalPersonId, CONCAT(FirstName , ' ' , LastName , ' (' , Profession , ')') AS Username FROM MedicalPersons ORDER BY FirstName, LastName;
END$$
DELIMITER ;


-- [spGetMedicalPerson]
-- This will get the selected medical persons after login
-- ------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetMedicalPerson`(IN medicalPersonId INT)
BEGIN
SELECT * FROM MedicalPersons mp WHERE mp.MedicalPersonId = medicalPersonId;
END$$
DELIMITER ;


-- [spGetVaccinationCentres]
-- This will get a list of vaccination centres after login
-- -------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationCentres`()
BEGIN
SELECT VaccinationCentreId, Name AS VaccinationCentreName FROM VaccinationCentres ORDER BY Name;
END$$
DELIMITER ;


-- [spGetVaccinationTypes]
-- This will get a list of vaccination types after login
-- -------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationTypes`()
BEGIN
SELECT * FROM VaccinationTypes;
END$$
DELIMITER ;


-- [spGetVaccinationHistory]
-- This will get a list of vaccinators history
-- -------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationHistory`(IN medicalPersonId INT)
BEGIN
SELECT pv.DateTime, vc.Name AS VaccinationCentre, CONCAT(p.FirstName , ' ' , p.LastName) AS PatientName, vt.Name AS VaccinationType
FROM medicalpersons mp 
	INNER JOIN patientvaccinations pv ON mp.MedicalPersonId = pv.MedicalPersonId
	INNER JOIN vaccinationcentres vc ON pv.VaccinationCentreId = vc.VaccinationCentreId
	INNER JOIN patients p ON pv.PatientId = p.PatientId
	INNER JOIN vaccinationtypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
WHERE mp.MedicalPersonId = medicalPersonId
ORDER BY pv.DateTime DESC;
END$$
DELIMITER ;