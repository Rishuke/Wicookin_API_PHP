<?php

function getMembers(): array
{
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();
    $getMembersQuery = $databaseConnection->query("SELECT * FROM members;");
    return $getMembersQuery->fetchAll(PDO::FETCH_ASSOC);
}
