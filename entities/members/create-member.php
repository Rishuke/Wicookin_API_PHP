<?php

function createMember(string $lastname, 
                    string $firstname,
                    string $email,
                    string $phonenumber, 
                    string $gender,
                    string $dateofbirth, 
                    string $password, 
                    string $membertype,  
                    string $profilepicture): void
{
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    $createMemberQuery = $databaseConnection->prepare("
        INSERT INTO members(
            last_name,
            first_name,
            email,
            phone_number,
            gender,
            date_of_birth,
            password,
            member_type,
            profile_picture
        ) VALUES (
            :last_name,
            :first_name,
            :email,
            :phone_number,
            :gender,
            :date_of_birth,
            :password,
            :member_type,
            :profile_picture
        );   
    ");

    $createMemberQuery->execute([
        "last_name" => htmlspecialchars($lastname),
        "first_name" => htmlspecialchars($firstname),
        "email" => htmlspecialchars($email),
        "phone_number" => htmlspecialchars($phonenumber),
        "gender" => htmlspecialchars($gender),
        "date_of_birth" => htmlspecialchars($dateofbirth),
        "password" => password_hash(htmlspecialchars($password), PASSWORD_BCRYPT),
        "member_type" => htmlspecialchars($membertype),
        "profile_picture" => htmlspecialchars($profilepicture),
    ]);

}
