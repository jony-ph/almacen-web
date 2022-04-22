<?php

    include_once 'output.php';
    include_once '../message.php';
    include_once '../stock/products.php';

    class OutputAPI extends Message{

        function showOutputs(){

            $stmt = new Output();
            $response = $stmt->getAll();

            if( $response->rowCount() < 1 ){
                $this->error(400, "No hay elementos registrados");
                die();
            } 

            $outputs = array();
            while ( $row = $response->fetch(PDO::FETCH_ASSOC) ) {
                    
                $object = array(
                    'output_code' => $row['output_code'],
                    'product' => $row['product'],
                    'product_name' => $row['name'],
                    'amount' => $row['amount'],
                    'delivered' => $row['fullname'],
                    'recived' => $row['recived'],
                    'time' => $row['time'],
                    'date' => $row['date']
                );

                array_push($outputs, $object);

            }

            $this->printJSON($outputs);

        }

        function addOutput($output) {

            $product = new Product();

            $product_code = $output['product'];
            $response = $product->getAmount($product_code);

            if( $response->rowCount() < 1 ) {
                $this->error(400, "Registro inexistente");
                die();
            }

            $row =  $response->fetch(PDO::FETCH_ASSOC);

            $current_amount = (int) $row['amount'];
            $amount_sub = (int) $output['amount'];

            if ( $current_amount < $amount_sub ) {
                $this->error(300, "Producto insuficiente");
                die();
            } 

            $stmt = new Output();
            $stmt->add($output);

            $new_amount = $current_amount - $amount_sub;

            $product_update = array(
                'new_amount' => $new_amount,
                'product_code' => $product_code
            );  

            $product->setAmount($product_update);
            $this->success(200, "Registro exitoso");

        }


        function updateOutput($outputData) {
            $stmt = new Output();
            $stmt->update($outputData);

            $this->success(200, "Salida actualizada");
        }

        function removeOutput($outputData) {
            $stmt = new Output();
            $stmt->delete($outputData);

            $this->success(200, "Salida eliminada");
        }

    }