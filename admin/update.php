<!-- update.php -->

<?php
// Database connection details
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $id = $_POST["id"];
    $title = $_POST["title"];
    $details = $_POST["details"];
    
    // Check if a new image file was uploaded
    if (isset($_FILES["new_image"]) && $_FILES["new_image"]["error"] === UPLOAD_ERR_OK) {
        $new_image = $_FILES["new_image"];
        $image_path = "images/"; // Set the path where you want to store uploaded images
        $image_name = uniqid() . "_" . $new_image["name"];
        $image_target = $image_path . $image_name;
        
        // Move the uploaded image to the target directory
        if (move_uploaded_file($new_image["tmp_name"], $image_target)) {
            // Update the database with the new image path
            $stmt = $conn->prepare("UPDATE news SET title = ?, details = ?, images = ? WHERE id = ?");
            $stmt->bind_param('sssi', $title, $details, $image_target, $id); // 'sssi' represents two strings and an integer
        } else {
            echo 'Image upload failed.';
            exit();
        }
    } else {
        // No new image uploaded, update only text fields
        $stmt = $conn->prepare("UPDATE news SET title = ?, details = ? WHERE id = ?");
        $stmt->bind_param('ssi', $title, $details, $id); // 'ssi' represents two strings and an integer
    }
    
    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect back to the main page or a confirmation page
        exit();
    } else {
        echo 'Update failed: ' . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
} else {
    echo 'Invalid request.';
}

// Close the database connection
$conn->close();
?>
