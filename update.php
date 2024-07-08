<?php

// Define target directory
$target_dir = "uploads/";

// Get uploaded file information
$uploadOk = 1;
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is selected
if(isset($_FILES["photo"])) {

  // Check if a file was uploaded
  if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) {

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size (optional, adjust limit as needed)
    if ($_FILES["photo"]["size"] > 500000) { // Limit to 500kb
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

  } else {
    echo "Sorry, your file was not uploaded.";
    $uploadOk = 0;
  }
} else {
  echo "No file selected.";
}

// If everything is OK, try to upload file
if ($uploadOk === 1) {
  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

?>
