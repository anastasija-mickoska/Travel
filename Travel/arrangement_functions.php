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
     function search_destinations_homepage($conn) {      
      $destination = isset($_GET['destination']) ? trim($_GET['destination']) : '';
      $when = isset($_GET['when']) ? trim($_GET['when']) : '';
      $duration = isset($_GET['duration']) ? trim($_GET['duration']) : '';
      
      $query = "SELECT * FROM destinations WHERE 1=1";
      
      if (!empty($destination)) {
          $query .= " AND destinationName LIKE :destination";
      }
      if (!empty($when)) {
         $query .= " AND MONTH(fromDate) = :month";
     }
      if (!empty($duration)) {
          if ($duration === '1-3') {
              $query .= " AND DATEDIFF(toDate, fromDate) BETWEEN 1 AND 3";
          } elseif ($duration === '3-5') {
              $query .= " AND DATEDIFF(toDate, fromDate) BETWEEN 3 AND 5"; 
          } elseif ($duration === 'week') {
              $query .= " AND DATEDIFF(toDate, fromDate) = 7"; 
          } elseif ($duration === '1-2weeks') {
              $query .= " AND DATEDIFF(toDate, fromDate) BETWEEN 7 AND 14";
          } elseif ($duration === '2+') {
              $query .= " AND DATEDIFF(toDate, fromDate) > 14"; 
          }
      }
      
      $stmt = $conn->prepare($query);

      if (!empty($destination)) {
          $stmt->bindValue(':destination', '%' . $destination . '%');
      }
      if (!empty($when)) {
          $stmt->bindValue(':month', $when);
      }
      
      $stmt->execute();
      
         if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
         }else {
            $results = 0;
         }
   
      return $results;
     }
     function search_destinations_by_category($conn) {
         if ($_SERVER["REQUEST_METHOD"] == "GET") {
             $priceRange = $_GET['priceRange'] ?? '';
             $date = $_GET['date'] ?? '';
             $location = $_GET['location'] ?? '';
             $id=$_GET['id'] ?? '';
             $results = search_destinations($conn, $id, $priceRange, $date, $location);
             
             return $results;
         }
     }
     function search_destinations($conn, $id, $priceRange, $date, $location) {
         $query = "SELECT * FROM destinations WHERE categoryID=:id";
     
         if (!empty($priceRange)) {
             switch ($priceRange) {
                 case '0-100':
                     $query .= " AND price BETWEEN 0 AND 100";
                     break;
                 case '101-200':
                     $query .= " AND price BETWEEN 101 AND 200";
                     break;
                 case '201-300':
                     $query .= " AND price BETWEEN 201 AND 300";
                     break;
                 case '301-400':
                     $query .= " AND price BETWEEN 301 AND 400";
                     break;
                 case '401-500':
                     $query .= " AND price BETWEEN 401 AND 500";
                     break;
                 case '500+':
                     $query .= " AND price > 500";
                     break;
             }
         }
     
         if (!empty($date)) {
             $query .= " AND fromDate <= :date AND toDate >= :date";
         }
     
         if (!empty($location)) {
             $query .= " AND location LIKE :location";
         }
     
         $stmt = $conn->prepare($query);
         $stmt->bindParam(':id',$id);
     
         if (!empty($date)) {
             $stmt->bindParam(':date', $date);
         }
     
         if (!empty($location)) {
             $stmt->bindValue(':location', '%' . $location . '%');
         }
     
         $stmt->execute();
     
         $results = $stmt->fetchAll();
     
         return $results;
     }
     
