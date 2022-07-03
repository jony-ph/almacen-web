<?php 

    class DB{

        // Atributos
        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;

        // Constructor
        public function __construct(){
            $this->host = 'localhost';
            $this->db = 'u212992802_stock';
            $this->user = 'u212992802_jony_ph';
            $this->password = 'vW7KvHJ>VZl';
            $this->charset = 'utf8mb4';
        }

        function connect(){
            
            try {

                $connection = 'mysql:host='.$this->host . ';dbname='.$this->db . ';charset='.$this->charset; // Driver para MySQL
                $options = [ 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]; // Son opciones que nos ayudan a obtener errores de una forma mas sitactica

                $pdo = new PDO($connection, $this->user, $this->password, $options);
                return $pdo;

            } catch(PDOException $e) {
                die("Error connection: ". $e->getMessage() );
            } 

        }
        
    }
