<?php
include "db.php";
// Define the path to the image folder
$imageFolder = 'images/';

// Check if the image folder exists, and if not, create it
if (!is_dir($imageFolder)) {
    mkdir($imageFolder, 0755, true); // Create the folder with appropriate permissions
}

// Retrieve data from the form and sanitize it (e.g., using mysqli_real_escape_string)
$title = $_POST['title'];
$title = mysqli_real_escape_string($conn, $title); // Sanitize input


$details = $_POST['details'];
$details = mysqli_real_escape_string($conn, $details); // Sanitize input


// Handle the uploaded image
$image = $_FILES['image']['tmp_name']; // Temporary file path

// Generate a unique filename for the image
$imageName = uniqid() . '_' . $_FILES['image']['name'];
$imagePath = $imageFolder . $imageName;

// Move the uploaded image to the specified folder
if (move_uploaded_file($image, $imagePath)) {
    // Image upload successful
    // Connect to the database
    // $conn = new mysqli('localhost', 'username', 'password', 'database_name');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Construct the SQL query (without prepared statements)
    $sql = "INSERT INTO news (title, details, images) VALUES ('$title', '$details', '$imageName')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully.";
        // header('Location: success.php'); // Change 'success.php' to your desired URL
        // exit(); // Terminate the script
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Image upload failed
    echo "Error uploading image.";
}
?>
