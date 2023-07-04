<?php

function createMember(string $lastname, 
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

    $createMemberQuery = $databaseConnection->prepare("
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

    $createMemberQuery->execute([
        "lastname" => htmlspecialchars($lastname),
        "firstname" => htmlspecialchars($firstname),
        "email" => htmlspecialchars($email),
        "phonenumber" => isset($phonenumber) ? htmlspecialchars($phonenumber) : null,
        "gender" =>  isset($gender) ? htmlspecialchars($gender) : null,
        "date_of_birth" => isset($dateofbirth) ? htmlspecialchars($dateofbirth) : null,
        "password" => password_hash(htmlspecialchars($password), PASSWORD_BCRYPT),
        "type" => htmlspecialchars($type),
        "profile_picture" => isset($profilepicture) ? htmlspecialchars($profilepicture) : null
        
    ]);

}
