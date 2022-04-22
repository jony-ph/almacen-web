<?php 

    include_once 'api_entries.php';

    $api = new EntryAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $entryData = array( 'entry_code' => $code );
    $api->removeEntry($entryData);

