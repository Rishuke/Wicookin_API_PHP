<?php

function getDatabaseConnection(): PDO
{
    require_once __DIR__ . "/settings.php";

    

    return  $databaseConnection = new PDO(
            "$databaseDialect:host=$databaseHostname:$databasePort;dbname=$databaseName",
            $databaseUsername,
            $databasePassword);


}
