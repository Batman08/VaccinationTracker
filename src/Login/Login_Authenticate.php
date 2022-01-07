<?php 
    session_start();
    $username =  $_POST["txtUsername"];
    $_SESSION["medicalPersonId"] = $username;

    if ($username == "DemoAdministrator"){
        header("Location: ../AdminReports/AdminReports.php");
    }elseif($username =="") {
        header("Location: ../Login/Login.php");
    }else {
        header("Location: ../PatientVaccinations/VaccinatePatient.php");
    }
    
    die();
?>