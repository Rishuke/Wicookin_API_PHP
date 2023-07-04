<?php

function isMemberLoggedIn($token)
{
  require_once __DIR__ . "/../../database/connection.php";

  $databaseConnection = getDatabaseConnection();

  $getMemberQuery = $databaseConnection->prepare("SELECT * FROM members WHERE authentification_token = :token");

  $getMemberQuery->execute([
    "token" => $token
  ]);

  $member = $getMemberQuery->fetch(PDO::FETCH_ASSOC);

  if (!$member) {
    return false;
  }

  return true;
}
