<?php

    include_once 'entry.php';
    include_once '../message.php';
    include_once '../stock/products.php';

    class EntryAPI extends Message{

        function showEntries(){

            $stmt = new Entry();
            $response = $stmt->getAll();

            if( $response->rowCount() < 1 ){
                $this->error(400, "No hay elementos registrados");
                die();
            }

            $entries = array();
            while ( $row = $response->fetch(PDO::FETCH_ASSOC) ) {
                    
                $object = array(
                    'entry_code' => $row['entry_code'],
                    'product' => $row['product'],
                    'product_name' => $row['name'],
                    'amount' => $row['amount'],
                    'delivered' => $row['delivered'],
                    'recived' => $row['fullname'],
                    'time' => $row['time'],
                    'date' => $row['date']
                );

                array_push($entries, $object);

            }

            $this->printJSON($entries);

        }

        function addEntry($entry) {

            $stmt = new Entry();
            $stmt->add($entry);

            $product = new Product();
            $product_code = $entry['product'];
            $response = $product->getAmount($product_code);

            if( $response->rowCount() < 1 ) {
                $this->error(400, "Registro inexistente");
                die();
            } 

            $row =  $response -> fetch(PDO::FETCH_ASSOC);

            $current_amount = (int) $row['amount'];
            $amount_sum = (int) $entry['amount'];
            $new_amount = $current_amount + $amount_sum;

            $product_update = array(
                'new_amount' => $new_amount,
                'product_code' => $product_code
            );  

            $product->setAmount($product_update);
            $this->success(200, "Entrada registrada");

        }

        function updateEntry($entryData) {
            $stmt = new Entry();
            $stmt->update($entryData);

            $this->success(200, "Entrada actualizada");
        }

        function removeEntry($entryData) {
            $stmt = new Entry();
            $stmt->delete($entryData);

            $this->success(200, "Entrada eliminada");
        }

    }