<?php 

    include_once 'api_privileges.php';

    $api = new PrivilegeAPI();

    $code = $_GET['id'];

    if ( !isset($code) ){
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $privilegeData = array( 'privilege_code' => $code );
    $api->deletePrivilege($privilegeData);
