-- [spGetUsernames]
-- This will get the list if medical persons that can login
-----------------------------------------------------------

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUsernames`()
BEGIN
    SELECT MedicalPersonId, CONCAT(FirstName , ' ' , LastName , ' (' , Profession , ')') AS Username FROM MedicalPersons ORDER BY FirstName, LastName;
END


-- [spGetMedicalPersonName]
-- This will get the selected medical persons name after login
--------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetMedicalPersonName`(IN Id int)
BEGIN
SELECT CONCAT(FirstName , ' ' , LastName) AS MedicalPersonName FROM MedicalPersons where MedicalPersonId = Id;
END