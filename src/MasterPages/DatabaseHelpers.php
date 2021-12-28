<?php

function OpenConnection()
{
    $server = "localhost";
    $username = "root";
    $password = "Hoisaejfr^&o2";
    $database = "TestDatabase";

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
    // return GetData("EXEC spGetMedicalPersons");
    return GetData("select * from test");
}
?>