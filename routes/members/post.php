<?php

// Récupérer des données depuis le corps de la requête
// Faire une requête SQL pour créer un utilisateur
// Renvoyer une réponse (succès, echec) à l'utilisateur de l'API

require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/members/create-member.php";

try {
    $body = getBody();

    createMember($body["last_name"], $body["first_name"], $body["email"], $body["phone_number"], $body["gender"], $body["date_of_birth"], $body["password"], $body["member_type"], $body["profile_picture"]);


    echo jsonResponse(200, [], [
        "success" => true,
        "message" => "Utlisateur créé"
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
