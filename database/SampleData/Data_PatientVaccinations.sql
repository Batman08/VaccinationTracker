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