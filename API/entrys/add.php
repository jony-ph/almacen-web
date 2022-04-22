<?php

    include_once 'api_entries.php';

    $api = new EntryAPI();

    $product = $_POST['product-entry'];
    $amount = $_POST['amount-entry'];
    $delivered = $_POST['delivered-entry'];

    session_start();
    $recived = $_SESSION['user_code'];
    date_default_timezone_set('America/Mexico_City');
    $date = date('Y-m-d');
    $time = date('H:i:s');

    if( !isset($product, $amount, $delivered) ){
        $api->error(404, "Error al llamar a la API");
        die();
    }

    $entry = array(
        'product' => $product,
        'amount' => $amount,
        'delivered' => $delivered,
        'recived' => $recived,
        'date' => $date,
        'time' => $time
    );

    $api->addEntry($entry);
