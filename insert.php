<?php
include 'config.php';

$name = $_POST['name'];
$age = $_POST['age'];
$grade = $_POST['grade'];

$image = $_FILES['image'];

// Ensure the images directory exists
if (!is_dir('images')) {
    mkdir('images', 0755);
}

$target_dir = "images/";
$target_file = $target_dir . basename($image["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a valid image
$check = getimagesize($image["tmp_name"]);
if ($check !== false) {
    // Check file size (5MB maximum)
    if ($image["size"] <= 5000000) {
        // Allow certain file formats
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                // Prepare and execute the SQL query
                $sql = "INSERT INTO students (name, age, grade, image) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$name, $age, $grade, basename($image["name"])])) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        echo "Sorry, your file is too large.";
    }
} else {
    echo "File is not an image.";
}

header('Location: view.php');
?>
