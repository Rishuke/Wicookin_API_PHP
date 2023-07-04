<?php

// Récupérer des données depuis le corps de la requête
// Faire une requête SQL pour créer un utilisateur
// Renvoyer une réponse (succès, echec) à l'utilisateur de l'API

require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/members/create-member.php";

try {
  $lastname = isset($body["lastname"]) ? $body["lastname"] : null;
  $firstname = isset($body["firstname"]) ? $body["firstname"] : null;
  $email = isset($body["email"]) ? $body["email"] : null;
  $phonenumber = isset($body["phonenumber"]) ? $body["phonenumber"] : null;
  $gender = isset($body["gender"]) ? $body["gender"] : null;
  $dateofbirth = isset($body["dateofbirth"]) ? $body["dateofbirth"] : null;
  $password = isset($body["password"]) ? $body["password"] : null;
  $type = isset($body["type"]) ? $body["type"] : null;
  $profilepicture = isset($body["profilepicture"]) ? $body["profilepicture"] : null;
  
    if (!createMember($lastname, $firstname, $email, $phonenumber, $gender, $dateofbirth, $password, $type, $profilepicture)) {
      throw new Exception("User could not be created.");
    }
  
    echo jsonResponse(200, [], [
      "success" => true,
      "message" => "User created successfully."
    ]);
  } catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
}
