<?php

// function getMembers(): array
// {
//     require_once __DIR__ . "/../../database/connection.php";

//     $databaseConnection = getDatabaseConnection();

//     $getMembersQuery = $databaseConnection->query("SELECT * FROM members;");
    
//     $members = $getMembersQuery->fetchAll(PDO::FETCH_ASSOC);

//     return $members;
// }


function getMembers(): array
{
    require_once __DIR__ . "/../../database/connection.php";

    $authorizedColumns = ["lastname", "firstname", "email", "phonenumber", "gender", "type"];

    $selectedColumns = [];

    foreach ($authorizedColumns as $column) {
        $selectedColumns[] = "`$column`";
    }

    $columns = implode(", ", $selectedColumns);

    $databaseConnection = getDatabaseConnection();

    $getMembersQuery = $databaseConnection->query("SELECT $columns FROM members;");
    
    $members = $getMembersQuery->fetchAll(PDO::FETCH_ASSOC);

    return $members;
}
