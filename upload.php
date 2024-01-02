<?php
$targetDirectory = "projects/"; // Change this to your desired directory
$uploadOk = 1;

// Check if the file was sent without errors
if ($_FILES["fileToUpload"]["error"] == 0) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadedFileName = basename($_FILES["fileToUpload"]["name"]);

    // Check if file already exists
    if (file_exists($targetFile)) {
        $errorMsg = "Sorry, file already exists.";
        echo "<script>openModal('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errorMsg = "Sorry, your file is too large.";
        echo "<script>openModal('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can customize this)
    $allowedExtensions = ["html", "htm"];
    $uploadedFileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($uploadedFileExtension, $allowedExtensions)) {
        $errorMsg = "Sorry, only HTML files are allowed.";
        echo "<script>openModal('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errorMsg = "Sorry, your file was not uploaded.";
        echo "<script>openModal('$errorMsg');</script>";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $successMsg = "The file $uploadedFileName has been uploaded.";
            $websiteLink = "https://protec-web-services.42web.io/$uploadedFileName";
            echo "<script>openModal('$successMsg'); window.location.replace('$websiteLink');</script>";
        } else {
            $errorMsg = "Sorry, there was an error uploading your file.";
            echo "<script>openModal('$errorMsg');</script>";
        }
    }
} else {
    $errorMsg = "Error during file upload.";
    echo "<script>openModal('$errorMsg');</script>";
}
?>
