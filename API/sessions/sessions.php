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
            $sql = "UPDATE users SET password= :new_password WHERE user_code= :user_code OR email= :email";
            $query = $query = $this->connect()->prepare($sql);
            $query-> execute([
                'new_password' => $userData['new_password'],
                'user_code' => $userData['user_code'],
                'email' => $userData['email']
            ]);
        }

        function addResetData($resetPassData) {
            $sql = "INSERT INTO reset_passwords(email, token, code) VALUES (:email, :token, :code);";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([ 
                'email' => $resetPassData['email'],
                'token' => $resetPassData['token'],
                'code' => $resetPassData['code'],
            ]);
        }

        function getToken($verifyData) {
            $sql = "SELECT * FROM reset_passwords WHERE email= :email AND token= :token AND code= :code";
            $query = $query = $this->connect()->prepare($sql);
            $query-> execute([
                'email' => $verifyData['email'],
                'token' => $verifyData['token'],
                'code' => $verifyData['code'],
            ]);

            return $query;
        }

    }
