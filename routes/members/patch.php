<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../libraries/parameters.php";
require_once __DIR__ . "/../../entities/members/update-member.php";

try {
    $body = getBody();
    $parameters = getParametersForRoute("/wicookin.fr_api_php/members/:member");
    $id = $parameters["member"];

    updateMember($id, $body);

    echo jsonResponse(200, [], [
        "success" => true,
        "message" => "Member updated successfully"
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

