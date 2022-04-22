<?php 

    include_once 'api.php';

    $api = new APICategories();
    
    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $data['category_code'] = $code;
    $api->updateCategory($data);
