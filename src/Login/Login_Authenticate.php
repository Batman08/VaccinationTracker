<?php 
    session_start();
    $_SESSION["MedicalPersonId"] = $_POST["txtUsername"];
    header("Location: ../PatientVaccinations/VaccinatePatient.php");
    die();
?>