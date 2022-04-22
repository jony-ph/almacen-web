<?php

    include_once '../db/db.php';

    class Output extends DB{

        function getAll(){
            $sql = "SELECT outputs.output_code, outputs.product,stock.name, outputs.amount, users.fullname, outputs.recived, outputs.date, outputs.time
                    FROM outputs
                    LEFT JOIN users ON outputs.delivered = users.user_code
                    LEFT JOIN stock ON outputs.product = stock.product_code;";
            $query = $this->connect() -> query($sql);

            return $query;
        }

        function add($output){
            $sql = "INSERT INTO outputs(product, amount, delivered, recived, date, time) 
                    VALUES (:product, :amount, :delivered, :recived, :date, :time)";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'product' => $output['product'],
                'amount' => $output['amount'],
                'delivered' => $output['delivered'],
                'recived' => $output['recived'],
                'date' => $output['date'],
                'time' => $output['time']
            ]);

            return $query;
        }

        function update($output) {
            $sql = "UPDATE outputs SET product= :product, amount= :amount, recived= :received
                    WHERE output_code= :output_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'product' => $output['product'],
                'amount' => $output['amount'],
                'received' => $output['received'],
                'output_code' => $output['output_code']
            ]);
        }

        function delete($output) {
            $sql = "DELETE FROM outputs WHERE output_code= :output_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([ 'output_code' => $output['output_code'] ]);
        } 


    }
