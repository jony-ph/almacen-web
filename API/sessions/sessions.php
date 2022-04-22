<?php 

    include_once '../db/db.php';

    class Session extends DB {

        function getAll(){
            $sql = "SELECT users.user_code, users.fullname, users.username, users.email, privileges.privilege
                    FROM users INNER JOIN privileges 
                    ON users.privilege = privileges.privilege_code;";
            $query = $this->connect() -> query($sql);
            
            return $query;
        }

        function checkUserExist($session){
            $sql = "SELECT * FROM users WHERE username= :username OR email= :email";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([ 'username' => $session['username'], 'email' => $session['email'] ]);

            return $query;
        }

        function add($userData){
            $sql = "INSERT INTO users(fullname, username, email, password, image, privilege) VALUES (:fullname, :username, :email, :pswd, :image, :privilege);";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([ 
                'fullname' => $userData['fullname'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'pswd' => $userData['pswd'],
                'image' => $userData['image'],
                'privilege' => $userData['privilege']
            ]);

            return $query; 
        }

        function delete($user_code) {
            $sql = "DELETE FROM users WHERE user_code= :user_code;";
            $query = $this->connect()->prepare($sql);
            $query -> execute([ 'user_code' => $user_code ]);
        }

        function update($userData){
            $sql = "UPDATE users SET fullname= :fullname, username= :username, email= :email, image= :image
                    WHERE user_code= :user_code;";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([
                'user_code' => $userData['user_code'],
                'fullname' => $userData['fullname'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'image' => $userData['image']
            ]);
        }

        function getPassword($user_code) {
            $sql = "SELECT password FROM users WHERE user_code= :user_code";
            $query = $this->connect() ->prepare($sql);
            $query->execute([ 'user_code' => $user_code ]);

            return $query;
        }

        function setPassword($userData){
            $sql = "UPDATE users SET password= :new_password WHERE user_code= :user_code;";
            $query = $query = $this->connect()->prepare($sql);
            $query-> execute([
                'new_password' => $userData['new_password'],
                'user_code' => $userData['user_code']
            ]);
        }

    }
