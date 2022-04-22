<?php 

    include_once 'api_entries.php';

    $api = new EntryAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $data['entry_code'] = $code;
    $api->updateEntry($data);
