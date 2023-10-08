<!-- edit.php -->

<?php
// Database connection details
include "db.php";

if (isset($_GET['id'])) {
    // Fetch the item's details based on the 'id' query parameter
    $id = $_GET['id'];

    // Prepare and execute a SQL query to fetch the item's data
    $stmt = $conn->prepare("SELECT id, title, details, images, created_date FROM news WHERE id = ?");
    $stmt->bind_param('i', $id); // 'i' represents an integer placeholder

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if ($item) {
            // Display the edit form for the specific item
            echo '<h1>Edit Item</h1>';
            echo '<form action="update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="' . $item["id"] . '">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="' . $item["title"] . '">
                    <label for="details">Details:</label>
                    <input type="text" id="details" name="details" value="' . $item["details"] . '">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="new_image"> <!-- Use a new_image field for uploading a new image -->
                  
                    <input type="submit" value="Update">
                  </form>';
        } else {
            echo 'Item not found.';
        }
    } else {
        echo 'Error fetching data from the database.';
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo 'Invalid request.';
}

// Close the database connection
$conn->close();
?>

