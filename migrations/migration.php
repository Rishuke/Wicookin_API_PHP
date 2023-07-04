<?php

require_once __DIR__ . "/../database/connection.php";

try {
    $databaseConnection = getDatabaseConnection();
    
    $databaseConnection->query("
    
    CREATE TABLE members (  
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        lastname varchar(255)   NOT NULL,
        firstname varchar(255)   NOT NULL,
        email varchar(190)   NOT NULL,
        phonenumber varchar(15)   DEFAULT NULL,
        gender varchar(255)   DEFAULT NULL,
        date_of_birth date DEFAULT NULL,
        account_creation_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        password varchar(255)   NOT NULL,
        type varchar(255)   NOT NULL,
        profile_picture varchar(255) DEFAULT NULL,
        authentification_token CHAR(60) 
        );

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
            'KOTIN',
            'Spéro',
            'spero@wicookin.fr',
            '0751380075',
            'Masculin',
            '1998-11-04',
            '\$2y\$10\$ZKSGFF9m6kBAUtSVlPuVkurwSzlyZW1clF4d2hjn6foBzLGsDlfx6',
            'Customer',
            'karoshi.jpg'
        );   

            
    ");

    echo "Migration réussie" . PHP_EOL;
} catch (Exception $exception) {
    echo "Une erreur est survenue durant la migration des données" . PHP_EOL;
    echo $exception->getMessage();
}

