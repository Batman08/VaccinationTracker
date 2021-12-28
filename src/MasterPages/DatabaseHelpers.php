<?php

function OpenConnection()
{
    $serverName = ".\SQL2016";
    $connectionOptions = array(
        "Database" => "Vaccinations",
        "UID" => "VaxDbUser", "PWD" => "VaxDbUser"
    );
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn == false)
        die('Invalid connection: ' . sqlsrv_errors());

    return $conn;
}

function GetData($sql)
{
    try {
        $conn = OpenConnection();
        $result = sqlsrv_query($conn, $sql);
        if ($result == FALSE)
            die('Invalid query: ' . sqlsrv_errors());

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }

        sqlsrv_free_stmt($result);
        sqlsrv_close($conn);
    } catch (Exception $e) {
        echo ("Error!");
    }

    return $rows;
}

function GetUsernames(){
    return GetData("EXEC spGetMedicalPersons");
}

?>