<?php

function OpenConnection()
{
    // $serverName = ".\SQL2016";
    // $connectionOptions = array(
    //     "Database" => "Vaccinations",
    //     "UID" => "VaxDbUser", "PWD" => "VaxDbUser"
    // );
    // $conn = sqlsrv_connect($serverName, $connectionOptions);

    $server = "localhost";
    $username = "root";
    $password = "Hoisaejfr^&o2";
    $database = "TestDatabase";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        echo "Failed to connect to MySQL: " . $conn;
        exit();
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
        mysqli_close($conn);
    } catch (Exception $e) {
        echo ("Error!");
    }

    return $rows;
}

function GetUsernames()
{
    // return GetData("EXEC spGetMedicalPersons");
     return GetData("select * from test");
}
