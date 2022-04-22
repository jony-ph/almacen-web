<?php 

    include_once '../db/db.php';

    class Category extends DB {

        function getAll(){
            $sql = "SELECT * FROM categories";
            $query = $this->connect() -> query($sql);

            return $query;
        }

        function add($category){
            $sql = "INSERT INTO categories(category) VALUES (:category)";
            $query = $this->connect() -> prepare($sql);
            $query->execute(['category' => $category]);

            return $query;
        }

        function update($categoryData) {
            $sql = "UPDATE categories SET category= :category WHERE category_code= :category_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([ 
                'category_code' => $categoryData['category_code'],
                'category' => $categoryData['category']
            ]);
        }

        function delete($categoryData) {
            $sql = "DELETE FROM categories WHERE category_code= :category_code";
            $query = $this->connect()->prepare($sql);
            $query->execute([ 'category_code' => $categoryData['category_code'] ]);
        }

    }

