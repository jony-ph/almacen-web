<?php 

    include_once 'api_outputs.php';

    $api = new OutputAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $data['output_code'] = $code;
    $api->updateOutput($data);
