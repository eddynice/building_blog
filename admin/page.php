<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $lastname = $email = $password = "";

    if (empty($_POST['firstname'])) {
        echo "Firstname is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["firstname"]))) {
        echo "Firstname can only contain letters, numbers, and underscores.";
    } else {
        $firstname =  $_POST['firstname'];
    }

    if (empty($_POST['lastname'])) {
        echo "Lastname is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["lastname"]))) {
        echo "Lastname can only contain letters, numbers, and underscores.";
    } else {
        $lastname =  $_POST['lastname'];
    }

    if (empty($_POST['email'])) {
        echo "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Email must be a valid email address";
    } else {
        $check_email = trim($_POST['email']);
        $check_user_email_sql = "SELECT id from users Where email = ?";
        $stmt = $conn->prepare($check_user_email_sql);
        $stmt->bind_param("s", $check_email);
        $stmt->execute();
        $check_email_result = $stmt->get_result();
        
        if ($check_email_result->num_rows == 1) {
            echo "User already taken";
            exit; // Exit script if email is already taken
        } else {
            $email = $check_email;
        }
    }

    if (empty($_POST['password'])) {
        echo "Password is required";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        echo "Password must be at least 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($_POST['cpassword'])) {
        echo "Confirm Password is required";
    } else {
        $confirm_password = trim($_POST['cpassword']);
        if ($password != $confirm_password) {
            echo "Passwords did not match";
        }
    }

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo "Please fill in all required fields.";
    } else {
        $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);
        
        if ($stmt->execute()) {
            header("location: login.php");
            exit; // Exit after successful insertion
        } else {
            echo "Something went wrong";
        }
    }
}

$conn->close();
?>