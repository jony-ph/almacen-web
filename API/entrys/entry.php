<?php

    include_once '../db/db.php';

    class Entry extends DB{

        function getAll(){
            $sql = "SELECT entrys.entry_code, entrys.product, stock.name, entrys.amount, entrys.delivered, users.fullname, entrys.date, entrys.time
                    FROM entrys
                    LEFT JOIN users ON entrys.recived = users.user_code
                    LEFT JOIN stock ON entrys.product = stock.product_code;";
            $query = $this->connect() -> query($sql);

            return $query;
        }

        function add($entry){
            $sql = "INSERT INTO entrys(product, amount, delivered, recived, date, time) 
                    VALUES (:product, :amount, :delivered, :recived, :date, :time)";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'product' => $entry['product'],
                'amount' => $entry['amount'],
                'delivered' => $entry['delivered'],
                'recived' => $entry['recived'],
                'date' => $entry['date'],
                'time' => $entry['time']
            ]);

            return $query;
        }

        function update($entry) {
            $sql = "UPDATE entrys SET product= :product, amount= :amount, delivered= :delivered
                    WHERE entry_code= :entry_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([
                'product' => $entry['product'],
                'amount' => $entry['amount'],
                'delivered' => $entry['delivered'],
                'entry_code' => $entry['entry_code']
            ]);
        }

        function delete($entry) {
            $sql = "DELETE FROM entrys WHERE entry_code= :entry_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([ 'entry_code' => $entry['entry_code'] ]);
        } 


    }
