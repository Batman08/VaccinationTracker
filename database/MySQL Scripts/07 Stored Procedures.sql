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


-- [spGetMedicalPersonName]
-- This will get the selected medical persons name after login
-- -----------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetMedicalPerson`(IN medicalPersonId int)
BEGIN
SELECT * FROM MedicalPersons where MedicalPersonId = medicalPersonId;
END$$
DELIMITER ;


-- [spGetVaccinationCentres]
-- This will get a list of vaccination centres after login
-- -------------------------------------------------------

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetVaccinationCentres`()
BEGIN
SELECT VaccinationCentreId, Name AS VaccinationCentreName, CONCAT(Address, ', ' , Postcode) AS VaccinationCentreAddress, Telephone AS VaccinationCentreTelephone FROM VaccinationCentres ORDER BY VaccinationCentreId;
END$$
DELIMITER ;