<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/parameters.php";
require_once __DIR__ . "/../../entities/members/delete-member.php";
require_once __DIR__ . "/../../entities/users/is-member-logged-in.php";
require_once __DIR__ . "/../../libraries/header.php";

try {
    $parameters = getParametersForRoute("wicookin_api_php/members/:member");
    $token = getAuthorizationBearerToken();

    if (!$token) {
      echo jsonResponse(401, [], [
        "success" => false,
        "message" => "Provide an Authorization: Bearer token"
      ]);
  
      return;
    }
  
    if (!isMemberLoggedIn($token)) {
      echo jsonResponse(401, [], [
        "success" => false,
        "message" => "You are not logged in."
      ]);
  
      return;
    }

  $id = $parameters["id"];

  if (!deleteMember($id)) {
    throw new Exception("User not found");
  }

  echo jsonResponse(200, [], [
    "success" => true,
    "message" => "User deleted"
  ]);
} catch (Exception $exception) {
  echo jsonResponse(500, [], [
    "success" => false,
    "message" => $exception->getMessage()
  ]);

}
