<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/parameters.php";
require_once __DIR__ . "/../../entities/members/delete-member.php";

try {
    $parameters = getParametersForRoute("/wicookin.fr_api_php/members/:member");
    $id = $parameters["member"];
    deleteMember($id);

    echo jsonResponse(200, [], [
        "success" => true,
        "message" => "deleted"
    ]);
} catch (Exception $exception) {
    $statusCode = 500;
    $errorMessage = $exception->getMessage();

    // Check if the exception is due to a member not found
    if ($errorMessage === 'Member ID not found') {
        $statusCode = 404;
    }

    echo jsonResponse($statusCode, [], [
        "success" => false,
        "error" => $errorMessage
    ]);
}
