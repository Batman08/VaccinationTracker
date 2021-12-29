<?php
session_start();
$medicalPersonName = GetMedicalPersonName($_SESSION['MedicalPersonId']);

foreach ($medicalPersonName as $name) {
    echo $name['MedicalPersonName'];
}
?>