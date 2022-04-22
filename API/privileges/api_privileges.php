<?php

    include_once 'privilege.php';
    include_once '../message.php';

    class PrivilegeAPI extends Message{

        function showAllPrivileges() {

            $pvg = new Privilege();
            $response = $pvg->getAll();

            if( $response->rowCount() < 1 ) {
                $this->warning(204, "No hay registros");
                return;
            } 

            $privileges = array();
            while ( $row = $response -> fetch(PDO::FETCH_ASSOC) ) {

                $object = array(
                    'privilege_code' => $row['privilege_code'],
                    'privilege' => $row['privilege'],
                    'description' => $row['description']
                );

                array_push($privileges, $object);
                
            }

            $this->printJSON($privileges);

        }

        function addPrivilege($privilegeData) {
            $pvg = new Privilege();
            $pvg->add($privilegeData);

            $this->success(200, "Privilegio registrado");
        }

        function updatePrivilege($privilegeData) {
            $pvg = new Privilege();
            $pvg->update($privilegeData);

            $this->success(200, "Privilegio actualizado");
        }

        function deletePrivilege($privilegeData) {
            $pvg = new Privilege();
            $pvg->delete($privilegeData);

            $this->success(200, "Privilegio eliminado");
        }



    }
