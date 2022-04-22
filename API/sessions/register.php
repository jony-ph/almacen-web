<?php 

    include 'api.php';

    $api = new SessionsAPI();

    session_start();
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $privilege = $_POST['privilege'];
    $pswd = password_hash($_POST['pswd'], PASSWORD_DEFAULT);
    $image = $_FILES['file'];

    $images_folder= "src/assets/images/users/";

    $random_name = (string) rand(10000, 99999). '-';
    $image_name = $images_folder. $random_name. basename($image['name']);

    if( !isset($fullname, $username, $email, $privilege, $pswd) ){
        $api->error(400, "Error al llamar a la API");
        die();
    }

    $response = $api->imageValidation($image, $image_name);

    if( $response['status'] == 'error' ){
        $api->error(400, $response['message']);
        die();
    } 
    
    if( $response['message'] == 'Éxito' ){

        $dataUser = array(
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'pswd' => $pswd,
            'image' => $image_name,
            'privilege' => $privilege,
        );

    } else {
        
        $dataUser = array(
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'pswd' => $pswd,
            'image' => $images_folder. 'default.png',
            'privilege' => $privilege,
        );

    }
    
    $api->createUser($dataUser);
    $api->success(200, "Usuario agregado");
