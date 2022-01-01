<?php 
    session_start();
    $_SESSION["medicalPersonId"] = $_POST["txtUsername"];
    header("Location: ../PatientVaccinations/VaccinatePatient.php");
    die();
?>