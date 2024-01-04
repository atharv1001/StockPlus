<?php
// Assuming you have a database connection, replace the placeholders with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stockplus";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the values from the form
$email = $_POST['username']; // assuming the form field is named 'username' for email
$password = $_POST['password'];

// SQL query to check if the user and password are correct
$sql = "SELECT * FROM demat_account WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User and password are correct, redirect to Home.html
    header("Location: ../Home.html");
    exit();
} else {
    // User or password is incorrect, show an alert
    echo '<script>alert("Incorrect email or password. Please try again."); window.location.href = "../sign-in.html";</script>';
}

// Close the database connection
$conn->close();
?>
