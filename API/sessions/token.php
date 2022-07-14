<?php

    include_once 'api.php';
      
    $api = new SessionsAPI();

    $email = $_POST['email-reset'];
    $bytes = random_bytes(5);
    $token = bin2hex($bytes);

    include_once '../../mail_reset.php';

    if ( !$issend ) {
        $api->error(400, "Error al llamar a la API");
        die();
    }

    $resetPassData = array(
        'email' => $to,
        'token' => $token,
        'code' => $code
    );

    $api->createResetData($resetPassData);