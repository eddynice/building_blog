<?php
include 'db.php'; // Include your database connection script

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Fetch the item's details based on the 'id' query parameter
    $id = $_GET['id'];


    // Construct the DELETE query
    $query = "DELETE FROM news WHERE id = $id";

    // Execute the DELETE query
    if (mysqli_query($conn, $query)) {
        // Redirect back to the original page
        header("Location: view.php"); // Replace 'project.php' with your actual page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
