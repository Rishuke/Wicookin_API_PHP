<?php

function registerMember(string $lastname, 
string $firstname,
string $email,
?string $phonenumber, 
?string $gender,
?string $dateofbirth, 
string $password, 
string $type,  
?string $profilepicture)
{
  require_once __DIR__ . "/../../database/connection.php";

  $databaseConnection = getDatabaseConnection();



  // Requête pour vérifier si l'utilisateur existe déjà avec l'e-mail fourni
$checkMemberQuery = $databaseConnection->prepare("SELECT * FROM members WHERE email = :email");
$checkMemberQuery->execute([ "email" => $email ]);
$Member = $checkMemberQuery->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe déjà
if ($Member) {
  return "member_exists";
}

  // Requête d'insertion pour créer un nouvel utilisateur
$insertMemberQuery = $databaseConnection->prepare("
  INSERT INTO members(
    lastname,
    firstname,
    email,
    phonenumber,
    gender,
    date_of_birth,
    password,
    type,
    profile_picture
  ) VALUES (
    :lastname,
    :firstname,
    :email,
    :phonenumber,
    :gender,
    :date_of_birth,
    :password,
    :type,
    :profile_picture
  );  

");

// Hacher le mot de passe avant l'insertion dans la base de données
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Exécuter la requête d'insertion avec les valeurs fournies
$insertMemberQuery->execute([
        "lastname" => htmlspecialchars($lastname),
        "firstname" => htmlspecialchars($firstname),
        "email" => htmlspecialchars($email),
        "phonenumber" => isset($phonenumber) ? htmlspecialchars($phonenumber) : null,
        "gender" =>  isset($gender) ? htmlspecialchars($gender) : null,
        "date_of_birth" => isset($dateofbirth) ? htmlspecialchars($dateofbirth) : null,
        "password" => $hashedPassword,
        "type" => htmlspecialchars($type),
        "profile_picture" => isset($profilepicture) ? htmlspecialchars($profilepicture) : null,
  
]);

// Retourner une valeur pour indiquer la réussite de l'opération
return "member_created";

  
  
}

