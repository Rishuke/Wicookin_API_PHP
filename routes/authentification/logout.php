<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/members/logout-member.php";
require_once __DIR__ . "/../../libraries/header.php";

try {
  $token = getAuthorizationBearerToken(); 

  if (!logoutMember($token)) {
    echo jsonResponse(404, [], [
      "success" => false,
      "message" => "User not found"
    ]);

    return;
  }

  echo jsonResponse(200, [], [
    "success" => true,
    "message" => "User logged out"
  ]);
} catch (Exception $exception) {
  echo jsonResponse(500, [], [
    "success" => false,
    "message" => $exception->getMessage()
  ]);
}
