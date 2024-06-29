<?php  

function get_categories($conn){
   $query  = "SELECT * FROM categories";
   $queryExecute = $conn->prepare($query);
   $queryExecute->execute();

   if ($queryExecute->rowCount() > 0) {
   	  $categories = $queryExecute->fetchAll();
   }else {
      $categories = 0;
   }

   return $categories;
}

function get_category_by_id($conn, $id){
   $query  = "SELECT * FROM categories WHERE categoryID=?";
   $queryExecute = $conn->prepare($query);
   $queryExecute->execute([$id]);

   if ($queryExecute->rowCount() > 0) {
   	  $category = $queryExecute->fetch();
   }else {
      $category = 0;
   }
   return $category;
}