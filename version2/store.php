<?php
include "db_config.php";

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$upload_dir = "uploads/";
$target_file = $upload_dir . basename($image);

if (move_uploaded_file($tmp, $target_file)) {
    $stmt = $conn->prepare("INSERT INTO images (image, name, price, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $image, $name, $price, $description);
    $stmt->execute();
    echo "Image and data uploaded successfully. <a href='display.php'>View Images</a>";
    $stmt->close();
} else {
    echo "Failed to upload image.";
}

$conn->close();
?>
