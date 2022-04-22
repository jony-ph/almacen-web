<?php

    session_start();
    $user = $_SESSION['privilege'];

    if( !isset($user) ){
        header("Location: login.php");
        die('No se pudo iniciar sesion');
    }