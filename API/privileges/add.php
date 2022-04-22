<?php 

    include_once 'api_privileges.php';

    $api = new PrivilegeAPI();

    $privilege = $_POST['privilege-add'];
    $description = $_POST['description-privilege-add'];
    
    if ( !isset($privilege, $description) ) {
        $api->error(400, "Error al conectar con la API");
        die();
    }

    $privilegeData = array(
        'privilege' => $privilege,
        'description' => $description,
    );

    $api->addPrivilege($privilegeData);

