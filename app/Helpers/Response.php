<?php
function resolveResponse($message, $data) {
    return response()->json(
        [
            "message" => $message,
            "data" => $data
        ],
    200);
}

function rejectResponse($message, $data) {
    return response()->json(
        [
            "message" => $message,
            "data" => $data
        ],
    500);
}

function notAuthorizedResponse($message) {
    return response()->json(
        [
            "message" => $message,
        ],
    401);
}
