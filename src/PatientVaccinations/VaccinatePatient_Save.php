<?php 
    session_start();
    $p_MedicalPersonId = $_SESSION["medicalPersonId"];
    $p_VaccinationCentreId = $_POST["ddlVaccinationCentre"];
    $p_DateTime = $_POST["txtDateTime"];
    $p_VaccinationTypeId = $_POST["ddlVaccinationType"];

    $p_PatientUniqueId = $_POST["txtPatientUniqueId"];
    $p_PatientFirstName = $_POST["txtPatientFirstName"];
    $p_PatientLastName = $_POST["txtPatientLastName"];
    $p_PatientDOB = $_POST["txtPatientDOB"];
    $p_PatientAddress = $_POST["txtPatientAddress"];
    $p_PatientPostcode = $_POST["txtPatientPostcode"];
    $p_PatientTelephone = $_POST["txtPatientTelephone"];

    include("../MasterPages/DatabaseHelpers.php");
    
    SavePatientVaccination($p_MedicalPersonId, $p_VaccinationCentreId, $p_DateTime, $p_VaccinationTypeId, 
    $p_PatientUniqueId, $p_PatientFirstName, $p_PatientLastName, $p_PatientDOB, $p_PatientAddress, $p_PatientPostcode, $p_PatientTelephone);

    header("Location: VaccinatePatient.php?SavedPatient=" . $_SESSION["savedPatientVax"]);
