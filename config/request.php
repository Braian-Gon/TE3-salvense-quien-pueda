<?php
function request($status, $info){
    header('Content-Type: application/json');
    $body = [
        'status' => $status,
        'detail' => $info,
    ];
    echo json_encode($body);
    
}