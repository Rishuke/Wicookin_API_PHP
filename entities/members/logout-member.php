<?php

function logoutMember($token)
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

  $deleteMemberTokenQuery = $databaseConnection->prepare("UPDATE members SET authentification_token = NULL WHERE id = :id");

  return $deleteMemberTokenQuery->execute([
    "id" => $member["id"]
  ]);
}
