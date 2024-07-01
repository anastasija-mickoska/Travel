<?php
function upload_file() {
    if (isset($_FILES['imgUrl']) && $_FILES['imgUrl']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imgUrl']['tmp_name'];
        $fileName = $_FILES['imgUrl']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'avif' , 'webp');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../Images/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                return $dest_path; 
            } else {
                echo "There was an error moving the file to the upload directory.";
                return false;
            }
        } else {
            echo "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
            return false;
        }
    }
    return false;
}