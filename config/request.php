<?php
function request($status, $info){
    # Envia en la cabecera que el contenido es JSON
    header('Content-Type: application/json');
    $body = [
        'status' => $status,
        'detail' => $info,
    ];
    echo json_encode($body);
    # Detiene la ejecución del script después de enviar la respuesta evitando que el programa siga ejecutándose
    # y potencialmente envíe más datos o realice acciones no deseadas después de la respuesta.
    exit;
}