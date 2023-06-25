<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/members/get-members.php";

try {
    $members = getMembers();

    echo jsonResponse(200, ["X-Server" => "Wicookin"], [
        "success" => true,
        "members" => $members
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
