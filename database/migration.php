<?php

require_once __DIR__ . "/connection.php";

try {
    $databaseConnection = getDatabaseConnection();
    $databaseConnection->query("DROP TABLE IF EXISTS members;");
    $databaseConnection->query("CREATE TABLE members (  `member_id` int NOT NULL AUTO_INCREMENT,
    `last_name` varchar(255)   NOT NULL,
    `first_name` varchar(255)   NOT NULL,
    `email` varchar(190)   NOT NULL,
    `phone_number` varchar(15)   DEFAULT NULL,
    `gender` varchar(255)   DEFAULT NULL,
    `date_of_birth` date DEFAULT NULL,
    `account_creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `password` varchar(255)   NOT NULL,
    `member_type` varchar(255)   NOT NULL,
    `profile_picture` varchar(255),
    PRIMARY KEY (`member_id`),
    UNIQUE KEY `email` (`email`))");

    echo "Migration réussie" . PHP_EOL;
} catch (Exception $exception) {
    echo "Une erreur est survenue durant la migration des données" . PHP_EOL;
    echo $exception->getMessage();
}

