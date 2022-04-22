<?php 

    include 'api.php';

    $api = new SessionsAPI();

    $username = $_POST['user'];
    $email = $_POST['user'];
    $pswd = $_POST['pswd'];

    if( !isset($username, $email, $pswd) ){
        $api->error(400, "Error al llamar a la API");
        die();
    }

    $dataUser = array(
        'username' => $username,
        'email' => $email,
        'pswd' => $pswd
    );
    
    $api->login($dataUser);

