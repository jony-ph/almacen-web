<?php 

    include_once '../db/db.php';

    class Product extends DB {

        function getAll(){
            $sql = "SELECT * FROM stock 
                    INNER JOIN categories ON stock.category = categories.category_code;";
            $query = $this->connect() -> query($sql);

            return $query;
        }

        function getCategory($id){
            $sql = "SELECT stock.product_code, stock.name, stock.description, categories.category, stock.amount
                    FROM stock INNER JOIN categories ON stock.category = categories.category_code
                    WHERE categories.category_code = :id";
            $query = $this->connect() -> prepare($sql);
            $query->execute([ 'id' => $id ]);


            return $query;
        }

        function getProduct($product) {
            $sql = "SELECT stock.product_code, stock.name, stock.description, categories.category, stock.amount
                    FROM stock INNER JOIN categories ON stock.category = categories.category_code 
                    WHERE stock.name = :product";
            $query = $this->connect() -> prepare($sql);
            $query->execute([ 'product' => $product ]);


            return $query;
        }


        function add($product){
            $sql = "INSERT INTO stock(product_code, name, description, category, amount)
                    VALUES (:product_code, :name, :description, :category, :amount)";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([ 
                'product_code' => $product['product_code'],
                'name' => $product['name'],
                'description' => $product['description'], 
                'category' => $product['category'], 
                'amount' => $product['amount']
            ]);

            return $query; 
        }

        function delete($product){
            $sql = "DELETE FROM stock WHERE product_code= :product_code";
            $query = $this->connect() -> prepare($sql);
            $query -> execute( [ 'product_code' => $product ]);

            return $query; 
        }

        function update($product){
            $sql = "UPDATE stock SET product_code= :code, name= :name, description= :description, category= :category, amount= :amount
                    WHERE product_code= :product_code";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([
                'product_code' => $product['product_code'],
                'code' => $product['code'],
                'name' => $product['name'],
                'description' => $product['description'],
                'category' => $product['category'],
                'amount' => $product['amount']
            ]);

            return $query; 
        }

        function getAmount($product_code){
            $sql = "SELECT amount FROM stock WHERE product_code= :product_code";
            $query = $this->connect() -> prepare($sql);
            $query-> execute([ 'product_code' => $product_code ]);

            return $query;
        }

        function setAmount($product){
            $sql = "UPDATE stock SET amount= :new_amount WHERE product_code= :product_code";
            $query = $this->connect() -> prepare($sql);
            $query -> execute([ 
                'new_amount' =>  $product['new_amount'], 
                'product_code' => $product['product_code'] 
            ]);
            
            return $query; 
        }

    }
