<?php 

    include_once 'api_outputs.php';

    $api = new OutputAPI();

    $code = $_GET['id'];
    
    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $outputData = array( 'output_code' => $code );
    $api->removeOutput($outputData);
