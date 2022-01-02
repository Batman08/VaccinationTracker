<?php

function OpenConnection()
{
    $server = "localhost";
    $username = "root";
    $password = "Hoisaejfr^&o2";
    $database = "Vaccinations";

    $conn = new mysqli($server,$username, $password, $database);

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
        $conn -> close();
    } catch (Exception $e) {
        echo "Error!" . $e->getMessage();
    }

    return $rows;
}

function GetUsernames()
{
    return GetData("call spGetUsernames()");
}

function GetMedicalPerson($medicalPersonId)
{
    return GetData("call spGetMedicalPerson('$medicalPersonId')");
}

function GetVaccinationCentres()
{
    return GetData("call spGetVaccinationCentres()");
}

function GetVaccinationTypes()
{
    return GetData("call spGetVaccinationTypes()");
}

function GetVaccinationHistory($medicalPersonId)
{
    return GetData("call spGetVaccinationHistory('$medicalPersonId')");
}