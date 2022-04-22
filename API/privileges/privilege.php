<?php

    include_once '../db/db.php';

    class Privilege extends DB{

        function getAll() {
            $sql = "SELECT * FROM privileges";
            $query = $this->connect()->query($sql);

            return $query;
        }

        function add($privilege){
            $sql = "INSERT INTO privileges(privilege, description) VALUES (:privilege, :description)";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'privilege' => $privilege['privilege'],
                'description' => $privilege['description']
            ]);

            return $query;
        }

        function update($privilege){
            $sql = "UPDATE privileges SET privilege= :privilege, description= :description 
                    WHERE privilege_code= :privilege_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'privilege' => $privilege['privilege'],
                'description' => $privilege['description'],
                'privilege_code' => $privilege['privilege_code']
            ]);

            return $query;
        }

        function delete($privilegeData){
            $sql = "DELETE FROM privileges WHERE privilege_code= :privilege_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([ 'privilege_code' => $privilegeData['privilege_code'] ]);
        }


    }
