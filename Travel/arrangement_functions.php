<?php
    function get_arrangements($conn){
        $query  = "SELECT * FROM destinations";
        $queryExecute = $conn->prepare($query);
        $queryExecute->execute();
     
        if ($queryExecute->rowCount() > 0) {
              $destinations = $queryExecute->fetchAll();
        }else {
           $destinations = 0;
        }
     
        return $destinations;
     }
     function get_featured_destinations($conn) {
         $query  = "SELECT * FROM destinations ORDER BY destinationID DESC LIMIT 3";
         $queryExecute = $conn->prepare($query);
         $queryExecute->execute();
      
         if ($queryExecute->rowCount() > 0) {
               $featured = $queryExecute->fetchAll();
         }else {
            $featured = 0;
         }
      
         return $featured;
     }
     function get_destinations_by_category($conn,$id) {
         $query  = "SELECT * FROM destinations WHERE categoryID=?";
         $queryExecute = $conn->prepare($query);
         $queryExecute->execute([$id]);
      
         if ($queryExecute->rowCount() > 0) {
               $destinations = $queryExecute->fetchAll();
         }else {
            $destinations = 0;
         }
      
         return $destinations;
     }