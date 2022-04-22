<?php 

    include_once 'api.php';
    
    $api = new APICategories();

    $category = $_POST['category'];
    
    if( !isset($category) ) {
        $api->error(400, "Error al conectar con la API");
        die();
    } 

    $api->addCategory($category);