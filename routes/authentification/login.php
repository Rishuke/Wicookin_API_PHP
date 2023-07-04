<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/members/login-member.php";

try {
  $body = getBody();
  $email = $body["email"];
  $password = $body["password"];

  $user = loginMember($email, $password);

  if (!$email) {
    echo jsonResponse(400, [], [
      "success" => false,
      "message" => "Bad email or password"
    ]);

    return;
  }

  if(!$password) {
    echo jsonResponse(400, [], [
      "success" => false,
      "message" => "Bad email or password"
    ]);

    return;
  }

  // Vérifier si l'e-mail est un e-mail valide

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo jsonResponse(400, [], [
      "success" => false,
      "message" => "Bad email or password"
    ]);
    return;
  }

  if ($user === "email_not_found") {
    echo jsonResponse(400, [], [
      "success" => false,
      "message" => "Bad email or password"
    ]);

    return;
  }

  if ($user === "password_not_found") {
    echo jsonResponse(400, [], [
      "success" => false,
      "message" => "Bad email or password"
    ]);

    return;
  }

  echo jsonResponse(200, [], [
    "success" => true,
    "token" => $user
  ]);
} catch (Exception $exception) {
  echo jsonResponse(500, [], [
    "success" => false,
    "message" => $exception->getMessage()
  ]);
}

