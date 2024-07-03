<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "s3 index"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO contactform (first_name, last_name, phone_number, email, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $phone_number, $email, $message);

    // Set parameters and execute
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Execute the statement
    if ($stmt->execute()) {
        // Form submitted successfully, redirect to another HTML file
        header("Location: submit.html");
        exit(); // Make sure to exit after the redirect
    } else {
        // Error occurred, display error message
        echo "Error: " . $stmt->error;
    }


    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
