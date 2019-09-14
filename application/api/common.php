<?php

function show($status, $message='', $data=[])
{
    return json([
        'status' => intval($status),
        'message' => $message,
        'data' => $data,
    ]);
}

