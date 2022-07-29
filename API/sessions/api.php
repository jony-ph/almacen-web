<?php 

include 'sessions.php';
include '../message.php';

class SessionsAPI extends Message{

    function showUsers(){
        
        $stmt = new Session();
        $result = $stmt->getAll();

        if( $result->rowCount() < 1 ){
            $this->warning(204, "No hay registros");
            return;
        }

        $users = array();
        while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
            
            $object = array(
                'user_code' => $row['user_code'],
                'fullname' => $row['fullname'],
                'username' => $row['username'],
                'email' => $row['email'],
                'privilege' => $row['privilege']
            );

            array_push($users, $object);

        }

        $this -> printJSON($users);

    }

    function login($userData){

        $session = new Session();
        $result = $session->checkUserExist($userData);

        if( $result->rowCount() < 1 ) {
            $this->error(401, "Usuario incorrecto");
            die();
        } 

        $record = $result->fetch(PDO::FETCH_ASSOC);

        if( !password_verify($userData['pswd'], $record['password']) ){
            $this->error(401, "Contraseña incorrecta");
            die();
        }

        session_start();

        $_SESSION['user_code'] = $record['user_code'];
        $_SESSION['fullname'] = $record['fullname'];
        $_SESSION['username'] = $record['username'];
        $_SESSION['email'] = $record['email'];
        $_SESSION['image'] = $record['image'];
        $_SESSION['privilege'] = $record['privilege'];

        $this->success(200, "Sesión iniciada");

    }

    function createUser($userData){
        $session = new Session();
        $session->add($userData);
    }

    function deleteUser($user_code){
        $session = new Session();
        $session->delete($user_code);

        $this->success(200, "Usuario eliminado");
    }

    function updateUser($userData){
        $sesion = new Session();
        $sesion->update($userData);

        $this->success(201, "Usuario actualizado");
    }

    function updatePassword($userData){
        
        $session = new Session();
        $response = $session->getPassword($userData['user_code']);

        if( $response->rowCount() < 1 ){
            $this->error(401, "El usuario no existe");
            die();
        }

        $row = $response->fetch(PDO::FETCH_ASSOC);

        if( !password_verify($userData['current_password'], $row['password']) ){
            $this->error(401, "Contraseña actual incorrecta");
            die();
        }

        $userData['new_password'] = password_hash($userData['new_password'], PASSWORD_DEFAULT);
        $session->setPassword($userData);

        $this->success(201, "Contraseña actualizada");
        
    }

    function createResetData($resetPassData) {
        $session = new Session();
        $result = $session->checkUserExist($resetPassData);

        if( $result->rowCount() < 1 ) {
            $this->error(401, "Usuario incorrecto");
            die();
        } 

        $session->addResetData($resetPassData);
        $this->success(200, "Correo enviado con éxito");

    }

    function verifyDataReset($verifyData) {
        $session = new Session();
        $response = $session->getToken($verifyData);

        if( $response->rowCount() < 1 ){
            $this->error(401, "Los datos no coinciden");
            die();
        }

        $this->success(200, "Verificación válida");
    }

    function resetPassword($userData) {
        
        $session = new Session();

        $userData['new_password'] = password_hash($userData['new_password'], PASSWORD_DEFAULT);
        $session->setPassword($userData);

        $this->success(201, "Contraseña actualizada");

    }

    function imageValidation($image, $image_name){

        $images_folder= "src/assets/images/users/";
        $validation = array();

        if( $image['name'] != '' ){

            if( $image['type'] == "image/jpg" || $image['type'] == "image/jpeg" || $image['type'] == "image/png"){

                $origin = $image['tmp_name'];
                $destination = "../../". $image_name;
    
                if( file_exists("../../". $images_folder) || mkdir("../../". $images_folder) ){
    
                    if(move_uploaded_file($origin, $destination) ) {
                        $validation['status'] = 'ok';
                        $validation['message'] = "Éxito";
                    } else {
                        $validation['status'] = 'error';
                        $validation['message'] = "No se pudo guardar el archivo";
                    }
    
                } else {
                    $validation['status'] = 'error';
                    $validation['message'] = "No existe la carpeta y/o no se pudo crear";
                }
    
            } else {
                $validation['status'] = 'error';
                $validation['message'] = "Formato de archivo inválido";
            }

        } else {
            $validation['status'] = 'ok';
            $validation['message'] = "Default";
        }   
        
        return $validation;

    }

}
