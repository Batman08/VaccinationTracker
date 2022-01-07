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
                $_SESSION["savedPatient"] = "failed"; // set submission status to failed
                header("Location: VaccinatePatient.php?SavedPatient=" . $_SESSION["savedPatient"]); // redirect to vaccinations page with failed warning
                die('Invalid query: ' . mysqli_error($conn));
            }

            // we have data so store in variable then return

            while ($row = mysqli_fetch_array($result)) {
                $rows[] = $row;
            }

            mysqli_free_result($result); // free memory associated with result
            $_SESSION["savedPatient"] = "success"; // set submission status to success
            $conn->close();
            return $rows;
        } else {
            $result = mysqli_query($conn, $sql);
            if ($result == false)
            {
                $_SESSION["savedPatient"] = "failed"; // set submission status to failed
                header("Location: VaccinatePatient.php?SavedPatient=" . $_SESSION["savedPatient"]); // redirect to vaccinations page with failed warning
                die('Invalid query: ' . mysqli_error($conn));
            }

            $_SESSION["savedPatient"] = "success"; // set submission status to success
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

function GetReportVaccinationsByCentre()
{
    return CallDatabase("call spGetReportVaccinationsByCentre()", true);
}

function GetReportPatientsByVaccinationType()
{
    return CallDatabase("call spGetReportPatientsByVaccinationType()", true);
}

function GetReportCovidVaccinationsByArea()
{
    return CallDatabase("call spGetReportCovidVaccinationsByArea()", true);
}

function GetTotalPatients()
{
    $total = CallDatabase("call spGetTotalPatients()", true);
    return $total[0]['TotalPatients'];
}

function GetTotalVaccinations()
{
    $total = CallDatabase("call spGetTotalVaccinations()", true);
    return $total[0]['TotalVaccinations'];
}

function GetTotalCovidVaccinations()
{
    $total = CallDatabase("call spGetTotalCovidVaccinations()", true);
    return $total[0]['TotalCovidVaccinations'];
}

function GetTotalMedicalPersonVaccinations($p_MedicalPersonId)
{
    $total = CallDatabase("call spGetTotalMedicalPersonVaccinations('$p_MedicalPersonId')", true);
    return $total[0]['TotalMedicalPersonVaccinations'];
}