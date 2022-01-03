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

function GetData($sql)
{
    try {
        $conn = OpenConnection();
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE)
            die('Invalid query: ' . mysqli_error($conn));

        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }
        mysqli_free_result($result);
        $conn->close();
    } catch (Exception $e) {
        echo "Error!" . $e->getMessage();
    }

    return $rows;
}

function ExecuteSproc($sql)
{
    try {
        $conn = OpenConnection();
        mysqli_query($conn, $sql);
        // if ($result == FALSE)
        //     die('Invalid query: ' . mysqli_error($conn));
        
        // mysqli_free_result($result);
        $conn->close();
    } catch (Exception $e) {
        echo "Error!" . $e->getMessage();
    }
}

function GetUsernames()
{
    return GetData("call spGetUsernames()");
}

function GetMedicalPerson($p_MedicalPersonId)
{
    return GetData("call spGetMedicalPerson('$p_MedicalPersonId')");
}

function GetVaccinationCentres()
{
    return GetData("call spGetVaccinationCentres()");
}

function GetVaccinationTypes()
{
    return GetData("call spGetVaccinationTypes()");
}

function GetVaccinationHistory($p_MedicalPersonId)
{
    return GetData("call spGetVaccinationHistory('$p_MedicalPersonId')");
}

function SavePatientVaccination($p_MedicalPersonId, $p_VaccinationCentreId, $p_DateTime, $p_VaccinationTypeId, 
                                $p_PatientUniqueId, $p_PatientFirstName, $p_PatientLastName, $p_PatientDOB, $p_PatientAddress, $p_PatientPostcode, $p_PatientTelephone)
{
    return ExecuteSproc("call spSavePatientVaccination('$p_MedicalPersonId', '$p_VaccinationCentreId', '$p_DateTime', '$p_VaccinationTypeId', 
                                                       '$p_PatientUniqueId', '$p_PatientFirstName', '$p_PatientLastName', '$p_PatientDOB', '$p_PatientAddress', '$p_PatientPostcode', '$p_PatientTelephone')");
}