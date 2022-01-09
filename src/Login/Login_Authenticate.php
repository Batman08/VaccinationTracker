<?php 
    session_start();
    $username =  $_POST["txtUsername"];
    $_SESSION["medicalPersonId"] = $username;

    if ($username == "DemoAdministrator"){
        header("Location: ../AdminReports/AdminReports.php");
    }elseif($username != null) {
        header("Location: ../PatientVaccinations/VaccinatePatient.php");
    }else {
        header("Location: ../Login/Login.php");
    }
    
    die();
?>