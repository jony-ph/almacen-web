<?php

  include_once 'api.php';
        
  $api = new SessionsAPI();

  $email =$_POST['email'];
  $token =$_POST['token'];
  $code = $_POST['code-confirm'];

  if( !isset($email, $token, $code) ){
    $api->error(400, "Error al llamar a la API");
    die();
  }

  $verifyData = array(
    'email' => $email,
    'token' => $token,
    'code' => $code
  );

  $api->verifyDataReset($verifyData);