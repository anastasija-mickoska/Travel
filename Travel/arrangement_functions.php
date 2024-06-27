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