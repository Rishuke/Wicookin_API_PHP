<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/members/get-members.php";
require_once __DIR__ . "/../../entities/members/is-member-logged-in.php";
require_once __DIR__ . "/../../libraries/header.php";

try {
    
    $token = getAuthorizationBearerToken(); 

    if (!isMemberLoggedIn($token)) {
      echo jsonResponse(401, [], [
        "success" => false,
        "message" => "You are not logged in."
      ]);
  
      return;
    }
  
    echo jsonResponse(200, [], [
      "success" => true,
      "users" => getMembers()
    ]);
  } catch (Exception $exception) {
    echo jsonResponse(500, [], [
      "success" => false,
      "message" => $exception->getMessage()
    ]);
}
