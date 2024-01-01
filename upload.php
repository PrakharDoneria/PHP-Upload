<?php
$targetDirectory = "projects/"; // Change this to your desired directory
$uploadOk = 1;

// Check if the file was sent without errors
if ($_FILES["fileToUpload"]["error"] == 0) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can customize this)
    $allowedExtensions = ["html", "htm"];
    $uploadedFileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($uploadedFileExtension, $allowedExtensions)) {
        echo "Sorry, only HTML files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "Error during file upload.";
}
?>
