<?php
    
    function get_bookings($conn) {
        $query  = "SELECT * FROM bookings";
        $queryExecute = $conn->prepare($query);
        $queryExecute->execute();
     
        if ($queryExecute->rowCount() > 0) {
              $bookings = $queryExecute->fetchAll();
        }else {
           $bookings = 0;
        }
        return $bookings;
    }

    function get_bookings_by_user($conn, $userID) {
        $sqlQuery = "SELECT * FROM bookings WHERE userID = ?";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute([$userID]);
        if ($stmt->rowCount() > 0) {
            $bookings = $stmt->fetchAll();
        }else {
            $bookings = 0;
        }
        return $bookings;    
    }
?>