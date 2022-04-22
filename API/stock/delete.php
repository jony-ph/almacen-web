<?php 

    include_once 'api.php';

    $api = new API();

    $code = $_GET['id'];

    if ( isset($code) ){
        $api->error(400, "Error al llamar a la API");
        die();
    } 

    $api->delete($code);
