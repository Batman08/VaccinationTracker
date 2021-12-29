USE `Vaccinations`;


-- [MedicalPersons]
-------------------

CREATE TABLE `medicalpersons` (
   `MedicalPersonId` int NOT NULL AUTO_INCREMENT,
   `FirstName` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `LastName` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Postcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Telephone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Profession` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   PRIMARY KEY (`MedicalPersonId`)
 ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- [Patients]
-------------

CREATE TABLE `patients` (
   `PatientId` int NOT NULL AUTO_INCREMENT,
   `PatientUniqueId` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `FirstName` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `LastName` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Age` int NOT NULL,
   `Address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Postcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Telephone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   PRIMARY KEY (`PatientId`)
 ) ENGINE=InnoDB AUTO_INCREMENT=10501 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 

-- [VaccinationCentres]
-----------------------

CREATE TABLE `vaccinationcentres` (
   `VaccinationCentreId` int NOT NULL AUTO_INCREMENT,
   `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Postcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   `Telephone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   PRIMARY KEY (`VaccinationCentreId`)
 ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- [VaccinationTypes]
---------------------

CREATE TABLE `vaccinationtypes` (
   `VaccinationTypeId` int NOT NULL AUTO_INCREMENT,
   `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
   PRIMARY KEY (`VaccinationTypeId`)
 ) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
 
-- [PatientVaccinations]
------------------------

CREATE TABLE `patientvaccinations` (
   `PatientVaccinationId` int NOT NULL AUTO_INCREMENT,
   `DateTime` datetime(3) NOT NULL,
   `VaccinationCentreId` int NOT NULL,
   `MedicalPersonId` int NOT NULL,
   `PatientId` int NOT NULL,
   `VaccinationTypeId` int NOT NULL,
   PRIMARY KEY (`PatientVaccinationId`),
   KEY `FK_PatientVaccinations_MedicalPersons` (`MedicalPersonId`),
   KEY `FK_PatientVaccinations_VaccinationCentres_idx` (`VaccinationCentreId`),
   KEY `FK_PatientVaccinations_Patients_idx` (`PatientId`),
   KEY `FK_PatientVaccinations_VaccinationTypes_idx` (`VaccinationTypeId`),
   CONSTRAINT `FK_PatientVaccinations_MedicalPersons` FOREIGN KEY (`MedicalPersonId`) REFERENCES `medicalpersons` (`MedicalPersonId`),
   CONSTRAINT `FK_PatientVaccinations_Patients` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`PatientId`),
   CONSTRAINT `FK_PatientVaccinations_VaccinationCentres` FOREIGN KEY (`VaccinationCentreId`) REFERENCES `vaccinationcentres` (`VaccinationCentreId`),
   CONSTRAINT `FK_PatientVaccinations_VaccinationTypes` FOREIGN KEY (`VaccinationTypeId`) REFERENCES `vaccinationtypes` (`VaccinationTypeId`)
 ) ENGINE=InnoDB AUTO_INCREMENT=55756 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;