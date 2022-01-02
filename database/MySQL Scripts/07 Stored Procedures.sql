USE `Vaccinations`;

-- [spGetUsernames]
-- This will get the list if medical persons that can login
-- --------------------------------------------------------

DELIMITER $$
DROP procedure IF EXISTS `spGetUsernames`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUsernames`()
BEGIN
    SELECT MedicalPersonId, CONCAT(FirstName , ' ' , LastName , ' (' , Profession , ')') AS Username FROM MedicalPersons ORDER BY FirstName, LastName;
END$$
DELIMITER ;


-- [spGetMedicalPerson]
-- This will get the selected medical persons after login
-- ------------------------------------------------------

DELIMITER $$
DROP procedure IF EXISTS `spGetMedicalPerson`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetMedicalPerson`(IN medicalPersonId INT)
BEGIN
SELECT * FROM MedicalPersons mp WHERE mp.MedicalPersonId = medicalPersonId;
END$$
DELIMITER ;


-- [spGetVaccinationCentres]
-- This will get a list of vaccination centres after login
-- -------------------------------------------------------

DELIMITER $$
DROP procedure IF EXISTS `spGetVaccinationCentres`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationCentres`()
BEGIN
SELECT VaccinationCentreId, Name FROM VaccinationCentres ORDER BY Name;
END$$
DELIMITER ;


-- [spGetVaccinationTypes]
-- This will get a list of vaccination types after login
-- -------------------------------------------------------

DELIMITER $$
DROP procedure IF EXISTS `spGetVaccinationTypes`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationTypes`()
BEGIN
SELECT VaccinationTypeId, Name FROM VaccinationTypes ORDER BY Name;
END$$
DELIMITER ;


-- [spGetVaccinationHistory]
-- This will get a list of vaccinators history
-- -------------------------------------------

DELIMITER $$
DROP procedure IF EXISTS `spGetVaccinationHistory`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationHistory`(IN medicalPersonId INT)
BEGIN
SET @row_number = 0;
SELECT (@row_number:=@row_number + 1) AS RowNum, DATE_FORMAT(pv.DateTime, "%d %b %Y at %h:%i %p") AS DateTime, vc.Name AS VaccinationCentre, CONCAT(p.FirstName , ' ' , p.LastName) AS PatientName, vt.Name AS VaccinationType
FROM medicalpersons mp 
	INNER JOIN patientvaccinations pv ON mp.MedicalPersonId = pv.MedicalPersonId
	INNER JOIN vaccinationcentres vc ON pv.VaccinationCentreId = vc.VaccinationCentreId
	INNER JOIN patients p ON pv.PatientId = p.PatientId
	INNER JOIN vaccinationtypes vt ON pv.VaccinationTypeId = vt.VaccinationTypeId
WHERE mp.MedicalPersonId = medicalPersonId
ORDER BY pv.DateTime DESC;
END$$
DELIMITER ;