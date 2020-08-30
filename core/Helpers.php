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

// Array key prefix
function arrayKeyPrefix($keyprefix, array $array)
{
    foreach ($array as $k=> $v) {
        $array[$keyprefix. $k] = $v;
        unset($array[$k]);
    }

    return $array;
}
