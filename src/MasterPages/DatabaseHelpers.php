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

function CallDatabase($sql, $isDataReturned)
{
    try {
        $conn = OpenConnection();

        if ($isDataReturned) {
            $result = mysqli_query($conn, $sql);

            if ($result == false) {
                die('Invalid query: ' . mysqli_error($conn));
            }

            // we have data so store in variable then return

            while ($row = mysqli_fetch_array($result)) {
                $rows[] = $row;
            }

            mysqli_free_result($result); // free memory associated with result
            $conn->close();
            return $rows;
        } else {
            $result = mysqli_query($conn, $sql);
            if ($result == false)
            {
                die('Invalid query: ' . mysqli_error($conn));
            }

            $conn->close();
        }
    } catch (Exception $e) {
        $conn->close();
        echo "Error!" . $e->getMessage();
    }
}

function GetUsernames()
{
    return CallDatabase("call spGetUsernames()", true);
}

function GetMedicalPerson($p_MedicalPersonId)
{
    return CallDatabase("call spGetMedicalPerson('$p_MedicalPersonId')", true);
}

function GetVaccinationCentres()
{
    return CallDatabase("call spGetVaccinationCentres()", true);
}

function GetVaccinationTypes()
{
    return CallDatabase("call spGetVaccinationTypes()", true);
}

function GetVaccinationHistory($p_MedicalPersonId)
{
    return CallDatabase("call spGetVaccinationHistory('$p_MedicalPersonId')", true);
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
    return CallDatabase("call spSavePatientVaccination('$p_MedicalPersonId', '$p_VaccinationCentreId', '$p_DateTime', '$p_VaccinationTypeId', 
                                                       '$p_PatientUniqueId', '$p_PatientFirstName', '$p_PatientLastName', '$p_PatientDOB', '$p_PatientAddress', 
                                                       '$p_PatientPostcode', '$p_PatientTelephone')", false);
}