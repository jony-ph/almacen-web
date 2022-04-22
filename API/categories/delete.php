<?php 

    include_once 'api.php';

    $api = new APICategories();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $categoryData = array( 'category_code' => $code );
    $api->removeCategory($categoryData);
