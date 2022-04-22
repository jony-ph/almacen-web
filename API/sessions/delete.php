<?php

    include_once 'api.php';

    $api = new SessionsAPI();

    $code = $_GET['id'];

    if( !isset($code) ) {
        $api->error(400, "Error al llamar con la API");
        die();
    }

    $api->deleteUser($code);
