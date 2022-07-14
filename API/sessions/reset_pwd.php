<?php

    include_once 'api.php';
        
    $api = new SessionsAPI();

    $email = $_POST['email'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ( !isset($newPassword, $confirmPassword, $email) ) {
        $api->error(400, "Error al llamar a la API");
        die();
    }

    if ( $new_password !== $confirm_password ) {
        $api->error(300, "Las contraseñas no coinciden");
        die();
    }

    $userData = array(
        'new_password' => $new_password,
        'email' => $email
    );

    $api->resetPassword($userData);
