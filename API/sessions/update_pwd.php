<?php 

    include_once 'api.php';
    
    $api = new SessionsAPI();

    $user_code = $_GET['id'];
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
 
    if( !isset($current_password, $new_password, $confirm_password) ) {
        $api->error(400, "Error al llamar a la API");
        die();
    } 

    if ( $new_password !== $confirm_password ) {
        $api->error(300, "Las contraseñas no coinciden");
        die();
    }

    $userData = array(
        'current_password' => $current_password,
        'new_password' => $new_password,
        'user_code' => $user_code
    );

    $api->updatePassword($userData);