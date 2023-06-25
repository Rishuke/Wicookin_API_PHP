<?php

function deleteMember(string $id): void
{
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    // Ajoutez ce bloc de code pour vérifier l'existence de l'ID du membre
    $checkMemberQuery = $databaseConnection->prepare("SELECT * FROM members WHERE member_id = :id;");
    $checkMemberQuery->execute(["id" => $id]);

    if($checkMemberQuery->rowCount() === 0){
        throw new Exception("Member ID not found");
    }
    // Fin du bloc de vérification

    $deleteMemberQuery = $databaseConnection->prepare("DELETE FROM members WHERE member_id = :id");

    $deleteMemberQuery->execute([
        "id" => $id
    ]);
}
