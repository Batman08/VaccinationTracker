<?php 
    session_start();
    $p_MedicalPersonId = $_SESSION["medicalPersonId"];
    $p_VaccinationCentre = $_POST["ddlVaccinationCentre"];
    $p_DateTime = $_POST["txtDateTime"];
    $p_VaccinationType = $_POST["ddlVaccinationType"];

    $p_PatientUniqueId = $_POST["txtPatientUniqueId"];
    $p_PatientFirstName = $_POST["txtPatientFirstName"];
    $p_PatientLastName = $_POST["txtPatientLastName"];
    $p_PatientDOB = $_POST["txtPatientDOB"];
    $p_PatientAddress = $_POST["txtPatientAddress"];
    $p_PatientPostcode = $_POST["txtPatientPostcode"];
    $p_PatientTelephone = $_POST["txtPatientTelephone"];
?>