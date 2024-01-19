<?php
include 'dbconfig.php';

// Start or resume a session
session_start();

// Function to sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Function to hash the password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to handle user registration
if (isset($_POST['register'])) {
    $name = sanitizeInput($_POST['name']);
    $number = sanitizeInput($_POST['number']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    $hashedPassword = hashPassword($password);

    // SQL to insert user data into the database
    $sql = "INSERT INTO users (name, number, email, password) VALUES ('$name', '$number', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['user_email'] = $email;
        $_SESSION['registrationAlert'] = true;
        header("Location: interest.php");
        exit();
    } else {
        // Registration failed
        $_SESSION['registrationAlert'] = false;
    }

    // Close the connection
    $conn->close();
}


// Function to handle user login
if (isset($_POST['login'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Login successful, create a session variable for the user's email
            $_SESSION['user_email'] = $email;
            $_SESSION['loginAlert'] = true;
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['loginAlert'] = false;
            header("Location: login.php?loginAlert=false");
            exit();
        }
    } else {
        // User not found
        $_SESSION['loginAlert'] = false;
    }

    // Close the connection
    $conn->close();
}

// Redirect to another page after processing
exit();
?>
