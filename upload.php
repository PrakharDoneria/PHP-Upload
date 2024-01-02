<?php
$targetDirectory = "projects/"; // Change this to your desired directory
$uploadOk = 1;
$maxFileSize = 2 * 1024 * 1024; // 2MB

// Check if the file was sent without errors
if ($_FILES["fileToUpload"]["error"] == 0) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadedFileName = basename($_FILES["fileToUpload"]["name"]);

    // Check if file already exists
    if (file_exists($targetFile)) {
        $errorMsg = "Sorry, file already exists.";
        echo "<script>alert('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
        $errorMsg = "Sorry, your file is too large (max size is 2MB).";
        echo "<script>alert('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can customize this)
    $allowedExtensions = ["html", "htm"];
    $uploadedFileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($uploadedFileExtension, $allowedExtensions)) {
        $errorMsg = "Sorry, only HTML files are allowed.";
        echo "<script>alert('$errorMsg');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errorMsg = "Sorry, your file was not uploaded.";
        echo "<script>alert('$errorMsg');</script>";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // Add the footer note to the HTML file
            $footerContent = '<footer><p>Made in <a href="https://html-editor-pro.neocities.org" target="_blank">HTML Editor PRO</a></p></footer>';
            $fileContent = file_get_contents($targetFile);
            $fileContent .= $footerContent;
            file_put_contents($targetFile, $fileContent);

            $successMsg = "The file $uploadedFileName has been uploaded.";
            $websiteLink = "https://ProTec.in/projects/$uploadedFileName";
            echo "<script>alert('$successMsg'); window.location.replace('$websiteLink');</script>";
        } else {
            $errorMsg = "Sorry, there was an error uploading your file.";
            echo "<script>alert('$errorMsg');</script>";
        }
    }
} else {
    $errorMsg = "Error during file upload.";
    echo "<script>alert('$errorMsg');</script>";
}
?>
