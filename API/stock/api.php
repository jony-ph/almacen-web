<?php 

include_once 'products.php';
include_once '../message.php';

class API extends Message{

    function showAll(){

        $producto = new Product();
        $result = $producto->getAll();

        if( $result->rowCount() < 1 ) {
            $this->warning(204, "No hay registros");
            die();
        }

        $productos = array();
        while(  $row = $result->fetch(PDO::FETCH_ASSOC) ){

            $object = array(
                'product_code' => $row['product_code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'category_code' => $row['category_code'],
                'amount' => $row['amount'],
                'qr' => $row['qr']
            );

            array_push($productos, $object);
        }

        $this->printJSON($productos);

    }

    function getByCategory($id){

        $producto = new Product();
        $result = $producto->getCategory($id);

        if( $result->rowCount() < 1 ) {
            $this->warning(204, "No hay registros");
            die();
        }
        
        $productos = array();
        while(  $row = $result->fetch(PDO::FETCH_ASSOC) ){

            $object = array(
                'product_code' => $row['product_code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'amount' => $row['amount'],
            );

            array_push($productos, $object);
        }

        $this->printJSON($productos);

    }

    function getProduct($product){

        $producto = new Product();
        $result = $producto->getProduct($product);

        if( $result->rowCount() < 1 ) {
            $this->warning(204, "No hay registros");
            die();
        }

        $productos = array();
        while(  $row = $result->fetch(PDO::FETCH_ASSOC) ){

            $object = array(
                'product_code' => $row['product_code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'amount' => $row['amount'],
            );

            array_push($productos, $object);
        }

        $this->printJSON($productos);

    }


    function add($object){

        $stmt = new Product();

        $exist = false;
        $response = $stmt->getAll();

        while(  $row = $response->fetch(PDO::FETCH_ASSOC) ){

            if( $row['product_code'] == $object['product_code'] ){
                $this->error(204, "Producto existente");
                $exist = true;
                break;
            }
            
        }

        if(!$exist){
            $stmt->add($object);
            $this->success(200, "Producto registrado") ;
        }

    }

    function delete($id){
        $stmt = new Product();
        $stmt->delete($id);

        $this->success(200, "Producto eliminado") ;
    }

    function update($product) {
        $stmt = new Product();
        $stmt->update($product);

        $this->success(200, "Producto editado") ;
    }

    function getOneProduct($productCode){
        $stmt = new Product();
        $result = $stmt->getOneProduct($productCode);
        
        if( $result->rowCount() < 1 ) {
            $this->warning(204, "No hay registros");
            die();
        }

        $product = array();
        while(  $row = $result->fetch(PDO::FETCH_ASSOC) ){

            $object = array(
                'product_code' => $row['product_code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'amount' => $row['amount']
            );

            array_push($product, $object);
        }

        $this->printJSON($product);

    }
    
}
