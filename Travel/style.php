<?php
// Include necessary files and start session if needed
include "db_connect.php";
include "arrangement_functions.php";
header("Content-type: text/css");
$arrangements = get_arrangements($conn); // Replace with your function to get arrangements
$classCounter = 1;

foreach ($arrangements as $arrangement) {
    $imageURL = $arrangement['imgUrl']; 
    if (!empty($imageURL)) {
        $encodedImageURL = urlencode($imageURL);
        echo ".arr1:nth-of-type($classCounter) {
            background-image: url('$encodedImageURL');
        }\n";

        $classCounter++;
    }
}
?>
