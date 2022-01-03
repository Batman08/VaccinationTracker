<?php

function OpenConnection()
{
    $server = "localhost";
    $username = "root";
    $password = "Hoisaejfr^&o2";
    $database = "Vaccinations";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn === false) {
        die("ERROR: Could not connect. " . $conn->connect_error);
    }

    return $conn;
}

function GetDatabase($sql, $isDataReturned)
{
    try {
        $conn = OpenConnection();

        if ($isDataReturned) {
            $result = mysqli_query($conn, $sql);
            if ($result == FALSE)
                die('Invalid query: ' . mysqli_error($conn));

            while ($row = mysqli_fetch_array($result)) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
            $conn->close();
            return $rows;
        } else {
            mysqli_query($conn, $sql);
            $conn->close();
        }
    } catch (Exception $e) {
        echo "Error!" . $e->getMessage();
    }
}

function GetUsernames()
{
    return GetDatabase("call spGetUsernames()", true);
}

function GetMedicalPerson($p_MedicalPersonId)
{
    return GetDatabase("call spGetMedicalPerson('$p_MedicalPersonId')", true);
}

function GetVaccinationCentres()
{
    return GetDatabase("call spGetVaccinationCentres()", true);
}

function GetVaccinationTypes()
{
    return GetDatabase("call spGetVaccinationTypes()", true);
}

function GetVaccinationHistory($p_MedicalPersonId)
{
    return GetDatabase("call spGetVaccinationHistory('$p_MedicalPersonId')", true);
}

function SavePatientVaccination(
    $p_MedicalPersonId,
    $p_VaccinationCentreId,
    $p_DateTime,
    $p_VaccinationTypeId,
    $p_PatientUniqueId,
    $p_PatientFirstName,
    $p_PatientLastName,
    $p_PatientDOB,
    $p_PatientAddress,
    $p_PatientPostcode,
    $p_PatientTelephone
) {
    return GetDatabase("call spSavePatientVaccination('$p_MedicalPersonId', '$p_VaccinationCentreId', '$p_DateTime', '$p_VaccinationTypeId', 
                                                       '$p_PatientUniqueId', '$p_PatientFirstName', '$p_PatientLastName', '$p_PatientDOB', '$p_PatientAddress', 
                                                       '$p_PatientPostcode', '$p_PatientTelephone')", false);
}