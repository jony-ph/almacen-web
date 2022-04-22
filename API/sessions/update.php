<?php

    include_once 'api.php';

    $api = new SessionsAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al llamar a la API");
        die();
    } 

    $fullname = $_POST['user-name'];
    $username = $_POST['user-user'];
    $email = $_POST['user-email'];
    $image = $_FILES['user-image'];

    $images_folder= "src/assets/images/users/";
    $random_name = (string) rand(10000, 99999). '-';
    $new_image_name = $images_folder. $random_name. basename($image['name']);

    $userData = array(
        'user_code' => $code,
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
    );

    $img = $api->imageValidation($image, $new_image_name);

    if( $img['status'] == 'error' ){
        $api->error(400, $img['message']);
        die();
    } 

    session_start();
    $current_image = $_SESSION['image'];
    $current_image_name = basename($current_image);
    
    if( $img['message'] == 'Éxito' ){
        
        $userData['image'] = $new_image_name;
        if( file_exists('../../' .$current_image) && $current_image_name != 'default.png' ){
            unlink('../../' .$current_image);
        }
    
    } else {      
        $userData['image'] = $current_image;
    }
    
    $api->updateUser($userData);
    
    $_SESSION['fullname'] = $fullname;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['image'] = $new_image_name;