SELECT *  FROM [Vaccinations].[dbo].[PatientsSample]

-- Male Names
declare @i int  = 0
while @i < 5000
begin
	declare @firstName nvarchar(256) = (select text from Patients_male_first_names where pos = ceiling(rand()*5400))
	declare @lastName nvarchar(256) = (select text from Patients_last_names where pos = 1 + ceiling(rand()*88580))

	update top (1) PatientsSample set FirstName = @firstName, LastName = @lastName where FirstName is null and LastName is null

	set @i = @i + 1
end
GO

-- Female Names
declare @i int  = 0
while @i < 5500
begin
	declare @firstName nvarchar(256) = (select text from Patients_female_first_names where pos = ceiling(rand()*9640))
	declare @lastName nvarchar(256) = (select text from Patients_last_names where pos = 1 + ceiling(rand()*88580))

	update top (1) PatientsSample set FirstName = @firstName, LastName = @lastName where FirstName is null and LastName is null

	set @i = @i + 1
end
GO

-- Age
while (select count(*) from PatientsSample where age is null) > 0
begin
	update top(1) PatientsSample set Age = 12 + ceiling(rand()*90) where age is null
end

-- Patient Unique Id
while (select count(*) from PatientsSample where PatientUniqueId is null) > 0
begin
	update top(1) PatientsSample set PatientUniqueId = substring(CAST(NEWID() as nvarchar(36)),0, 9) where PatientUniqueId is null
end

-- Insert data from PatientsSample table into Patients table
insert into Patients (PatientUniqueId, FirstName, LastName, Age, [Address], Postcode, Telephone)
select PatientUniqueId, FirstName, LastName, Age, [Address], Postcode, Phone_number
from PatientsSample


-- insert data from VaxSample table into VaccinationTypes table
---------------------------------------------------------------

insert into VaccinationTypes (Name)
select distinct column1 from VaxSample where column5 = 'Current' order by column1


-- create the list of medical professions
-----------------------------------------

CREATE TABLE #Professions
(
    Id INT IDENTITY(1, 1),
    Name NVARCHAR(100)
);

INSERT INTO #Professions (Name)
VALUES ('Nurse'),
       ('Licensed Practical Nurse'),
       ('Nurse Anaesthetist'),
       ('Pediatrician'),
       ('Medical Assistant'),
       ('Physician'),
       ('Surgeon'),
       ('General Practitioner'),
       ('Midwife');


-- insert data into MedicalPersons taking random existing data from Patients table
----------------------------------------------------------------------------------

DECLARE @i INT = 0;

WHILE @i < 25 -- we'll create 25 medical persons
BEGIN
    INSERT INTO MedicalPersons (FirstName, LastName, Address, Postcode, Telephone, Profession)
    SELECT (SELECT FirstName FROM Patients WHERE PatientId = CEILING(RAND() * 10000)),
           (SELECT LastName FROM Patients WHERE PatientId = CEILING(RAND() * 10000)),
           (SELECT Address FROM Patients WHERE PatientId = CEILING(RAND() * 10000)),
           (SELECT Postcode FROM Patients WHERE PatientId = CEILING(RAND() * 10000)),
           (SELECT Telephone FROM Patients WHERE PatientId = CEILING(RAND() * 10000)),
           (SELECT Name FROM #Professions WHERE Id = CEILING(RAND() * 9));

    SET @i = @i + 1;
END;

select * from MedicalPersons


-- create the list of vaccination centres
-----------------------------------------

select * from VaccinationCentres

insert into VaccinationCentres(Name, Address, Postcode, Telephone)
values('A R K Healthcare - Sparkhill', '566-568 Stratford Road, Sparkhill, Birmingham', 'B11 4AN', '0121 772 7381'),
('Lytham Road Pharmacy - Blackpool','South Shore Primary Care Centre, Lytham Road, Blackpool','FY4 1TJ','01253 403038'), 
('Boots - Boots Colchester Lion Walk','5-6 Lion Walk Colchester, Essex','CO1 1LX','01206 577303'),
('Rowlands Pharmacy - Shipley','Windhill Green Med Centre, 2 Thackley Old Road, Shipley, West Yorkshire','BD18 1QB','01274 531214'),
('Avonmouth Pharmacy','205 Avonmouth Road, Avonmouth, Bristol','BS11 9EG','0117 982 3158');


-- get the list of vaccination types and the percent they will be given
-----------------------------------------------------------------------

SELECT VaccinationTypeId, Name, 0 AS PercentGiven INTO #TempVaccinationTypes FROM VaccinationTypes ORDER BY Name;

UPDATE #TempVaccinationTypes SET PercentGiven = 10 WHERE Name = 'Adenovirus Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 15 WHERE Name = 'Anthrax Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 5 WHERE Name = 'Cholera Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 10 WHERE Name = 'COVID-19 Janssen Vaccine';
UPDATE #TempVaccinationTypes SET PercentGiven = 30 WHERE Name = 'COVID-19 Moderna Vaccine';
UPDATE #TempVaccinationTypes SET PercentGiven = 70 WHERE Name = 'COVID-19 Pfizer BioNTech Vaccine';
UPDATE #TempVaccinationTypes SET PercentGiven = 80 WHERE Name = 'COVID-19 AstraZeneca Vaccine';
UPDATE #TempVaccinationTypes SET PercentGiven = 20 WHERE Name = 'DTaP (Diphtheria, Tetanus, Pertussis) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 7 WHERE Name = 'Haemophilus Influenzae type b (Hib) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 3 WHERE Name = 'Hepatitis A Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 2 WHERE Name = 'Hepatitis B Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 4 WHERE Name = 'HPV (Human Papillomavirus) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 40 WHERE  Name = 'Influenza (Flu) Vaccine (Inactivated or Recombinant) VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 40 WHERE Name = 'Influenza (Flu) Vaccine (Live, Intranasal) VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 11 WHERE Name = 'Japanese Encephalitis Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 1 WHERE Name = 'Live Zoster Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 2 WHERE Name = 'Meningococcal ACWY Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 2 WHERE Name = 'Meningococcal B Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 20 WHERE Name = 'MMR Vaccine (Measles, Mumps, and Rubella) VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 25 WHERE  Name = 'MMRV Vaccine (Measles, Mumps, Rubella, and Varicella) VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 2 WHERE Name = 'Multi Pediatric Vaccines VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 4 WHERE Name = 'Pneumococcal Conjugate Vaccine (PCV13) VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 15 WHERE Name = 'Polio Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 5 WHERE Name = 'PPSV23 VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 10 WHERE Name = 'Rabies Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 2 WHERE Name = 'Recombinant Zoster Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 13 WHERE Name = 'Rotavirus Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 15 WHERE Name = 'Td (Tetanus, Diphtheria) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 5 WHERE Name = 'Tdap (Tetanus, Diphtheria, Pertussis) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 17 WHERE Name = 'Typhoid VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 45 WHERE Name = 'Varicella (Chickenpox) Vaccine VIS';
UPDATE #TempVaccinationTypes SET PercentGiven = 1 WHERE Name = 'Yellow Fever VIS';


-- iterate over each vaccine type and assign to patients
--------------------------------------------------------

WHILE (SELECT COUNT(*)FROM #TempVaccinationTypes) > 0
BEGIN
    -- get a vaccine to process
    DECLARE @VaccinationTypeId INT;
    DECLARE @VaccineName NVARCHAR(256);
    DECLARE @PercentGiven INT;

    SELECT TOP 1 @VaccinationTypeId = VaccinationTypeId, @VaccineName = Name, @PercentGiven = PercentGiven
    FROM   #TempVaccinationTypes;

    -- give vaccine to patients
    DECLARE @NumPatients INT = (10500 * @PercentGiven) / 100;

    INSERT INTO PatientVaccinations (DateTime, VaccinationCentreId, MedicalPersonId, PatientId, VaccinationTypeId)
    SELECT DATEADD(SECOND, CAST(FLOOR(RAND(CAST(NEWID() AS VARBINARY)) * 63072000) AS INT), '20200101'),
           1 + ABS(CHECKSUM(NEWID())) % 5,
           1 + ABS(CHECKSUM(NEWID())) % 25,
           PatientId,
           @VaccinationTypeId
    FROM   Patients
    WHERE  PatientId BETWEEN 1 AND @NumPatients;


    -- we're done processing this vaccine so delete it
    DELETE FROM #TempVaccinationTypes WHERE VaccinationTypeId = @VaccinationTypeId;
END;