<?php

    include_once 'api.php';
        
    $api = new SessionsAPI();

    $email = $_POST['email'];
    $newPassword = $_POST['f-new-password'];
    $confirmPassword = $_POST['f-confirm-password'];

    if ( !isset($newPassword, $confirmPassword, $email) ) {
        $api->error(400, "Error al llamar a la API");
        die();
    }

    if ( $newPassword !== $confirmPassword ) {
        $api->error(300, "Las contraseñas no coinciden");
        die();
    }

    $userData = array(
        'new_password' => $newPassword,
        'email' => $email
    );

    $api->resetPassword($userData);
