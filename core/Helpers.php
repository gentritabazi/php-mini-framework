<?php

// Response JSON
function responseJson($status = 200, $data = [], $messages = [])
{
    http_response_code($status);
    return json_encode([
        'status' => $status,
        'messages' => $messages,
        'data' => $data
    ]);
}
