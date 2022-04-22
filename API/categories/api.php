<?php

    include_once 'categories.php';
    include_once '../message.php';

    class APICategories extends Message{
        
        function showCategories(){

            $category = new Category();
            $result = $category->getAll();
    
            $categories = array();
            if( $result->rowCount() < 1 ) {
                $this->error(400, "Sin registros");
                die();
            }

            while(  $row = $result->fetch(PDO::FETCH_ASSOC) ){
    
                $object = array(
                    'category_code' => $row['category_code'],
                    'category' => $row['category'],
                );

                array_push($categories, $object);
            }

            $this->printJSON($categories);

        }

        function addCategory($record){
            $category = new Category();
            $category->add($record);

            $this->success(200, "Categoria agregada");
        }

        function updateCategory($categoryData){
            $category = new Category();
            $category->update($categoryData);

            $this->success(200, "Categoria actualizada");
        }

        function removeCategory($categoryData) {
            $category = new Category();
            $category->delete($categoryData);

            $this->success(200, "Categoria eliminada");
        }
        
    }
