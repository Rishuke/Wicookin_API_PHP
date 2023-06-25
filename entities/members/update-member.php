<?php

function updateMember(string $id, $columns): void
{
    if (count($columns) === 0) {
        return;
    }

    require_once __DIR__ . "/../../database/connection.php";

    $authorizedColumns = ["last_name", "first_name", "email", "phone_number", "gender", "date_of_birth", "password", "member_type", "profile_picture"];

    // Ajoutez ce bloc de code pour vérifier l'existence de l'ID du membre
    $databaseConnection = getDatabaseConnection();
    $checkMemberQuery = $databaseConnection->prepare("SELECT * FROM members WHERE member_id = :id;");
    $checkMemberQuery->execute(["id" => $id]);

    if($checkMemberQuery->rowCount() === 0){
        throw new Exception("Member ID not found");
    }
    // Fin du bloc de vérification

    $set = [];

    $sanitizedColumns = [
        "id" => htmlspecialchars($id)
    ];

    foreach ($columns as $columnName => $columnValue) {
        if (!in_array($columnName, $authorizedColumns)) {
            continue;
        }

        $set[] = "$columnName = :$columnName";

        $sanitizedColumns[$columnName] = htmlspecialchars($columnValue);
    }

    $set = implode(", ", $set);

    $updateMemberQuery = $databaseConnection->prepare("UPDATE members SET $set WHERE member_id = :id;");
    $updateMemberQuery->execute($sanitizedColumns);
}
