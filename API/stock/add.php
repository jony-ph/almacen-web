<?php 

    include_once 'api.php';

    $api = new API();

    $product_code =  $_POST['new-product-code'];
    $name = $_POST['new-product-name'];
    $description = $_POST['new-product-description'];
    $category = $_POST['new-product-category'];
    const AMOUNT = 0;

    if ( !isset($product_code, $name, $description, $category) ){
        $api->error(400, "Error al llamar a la API");
        die();
    } 

    $item = array(
        'product_code' => (int) $product_code,
        'name' => $name,
        'description' => $description,
        'category' => (int) $category,
        'amount' =>  AMOUNT,
    ); 

    $api->add($item);
