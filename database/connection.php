<?php

function getDatabaseConnection(): PDO
{
    require __DIR__ . "/settings.php";

    $databaseConnection = new PDO(
        "$databaseDialect:host=$databaseHost:$databasePort;dbname=$databaseName;charset=utf8mb4",
        $databaseUser,
        $databasePassword);

    return  $databaseConnection;


}
