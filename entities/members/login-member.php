<?php

function loginMember($email, $password)
{
  require_once __DIR__ . "/../../database/connection.php";

  $databaseConnection = getDatabaseConnection();

  // Requête pour récupérer l'utilisateur correspondant à l'e-mail fourni
  $getMemberQuery = $databaseConnection->prepare("SELECT * FROM members WHERE email = :email");
  $getMemberQuery->execute([ "email" => $email ]);
  $member = $getMemberQuery->fetch(PDO::FETCH_ASSOC);

  // Vérifier si l'utilisateur existe
  if (!$member) {
    return "email_not_found";
  }

  // Récupérer le mot de passe haché de l'utilisateur
  $hashedPassword = $member["password"];

  // Vérifier si le mot de passe fourni correspond au mot de passe haché
  if (!password_verify($password, $hashedPassword)) {
    return "password_not_found";
  }

  // Générer un nouveau token d'authentification
  $authenticationToken = bin2hex(random_bytes(30));

  // Mettre à jour le token d'authentification dans la base de données
  $updateMemberTokenQuery = $databaseConnection->prepare("UPDATE members SET authentification_token = :authentification_token WHERE email = :email");
  $updateMemberTokenQuery->execute([
    "authentification_token" => $authenticationToken, 
    "email" => $email
  ]);

  return $authenticationToken;
}

