<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/members/register-member.php";

try {
    $body = getBody();
    $lastname = isset($body["lastname"]) ? $body["lastname"] : null;
    $firstname = isset($body["firstname"]) ? $body["firstname"] : null;
    $email = isset($body["email"]) ? $body["email"] : null;
    $phonenumber = isset($body["phonenumber"]) ? $body["phonenumber"] : null;
    $gender = isset($body["gender"]) ? $body["gender"] : null;
    $dateofbirth = isset($body["dateofbirth"]) ? $body["dateofbirth"] : null;
    $password = isset($body["password"]) ? $body["password"] : null;
    $type = isset($body["type"]) ? $body["type"] : null;
    $profilepicture = isset($body["profilepicture"]) ? $body["profilepicture"] : null;


    if (!$email) {
      echo jsonResponse(400, [], [
        "success" => false,
        "message" => "Email not found"
      ]);
  
      return;
    }
  
    if(!$password) {
      echo jsonResponse(400, [], [
        "success" => false,
        "message" => "Password not found"
      ]);
  
      return;
    }

    // Vérifier si l'e-mail est un e-mail valide

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo jsonResponse(400, [], [
        "success" => false,
        "message" => "Invalid email"
      ]);
      return;
    }

     // Vérifier si le mot de passe contient au moins 8 caractères
    if (strlen($password) < 8) {
      echo jsonResponse(400, [], [
        "success" => false,
        "message" => "Password not strong enough"
      ]);
      return;
    }

      $user = registerMember($lastname, $firstname, $email, $phonenumber, $gender, $dateofbirth, $password, $type, $profilepicture);

    if (!$user) {
      throw new Exception("User could not be created.");
    }
  
    if ($user === "member_exists") {
      echo jsonResponse(409, [], [
        "success" => false,
        "message" => "User already exists"
      ]);
  
      return;
    }

    if($user === "member_created"){
      echo jsonResponse(200, [], [
        "success" => true,
        "message" => "User created successfully."
      ]);
    }
  

    
  } catch (Exception $exception) {
    echo jsonResponse(500, [], [
      "success" => false,
      "message" => $exception->getMessage()
    ]);
  }
  

