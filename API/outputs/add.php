<?php

    include_once 'api_outputs.php';

    $api = new OutputAPI();

    $product = $_POST['product-output'];
    $amount = $_POST['amount-output'];
    $received = $_POST['recived-output'];

    session_start();
    $delivered = $_SESSION['user_code'];
    date_default_timezone_set('America/Mexico_City');
    $date = date('Y-m-d');
    $time = date('H:i:s');

    if( !isset($product, $amount, $received) ){
        $api->error(404, "Error al llamar a la API");
        die();
    } 

    $output = array(
        'product' => $product,
        'amount' => $amount,
        'delivered' => $delivered,
        'recived' => $received,
        'date' => $date,
        'time' => $time
    );

    $api->addOutput($output);
