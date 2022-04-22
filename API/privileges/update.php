<?php 

    include_once 'api_privileges.php';

    $api = new PrivilegeAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $data['privilege_code'] = $code;
    $api->updatePrivilege($data);
