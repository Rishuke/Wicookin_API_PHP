<?php

require_once __DIR__ . "/../../libraries/response.php";

echo jsonResponse(404, [], [
    "success" => false,
    "message" => "Route not found"
]);