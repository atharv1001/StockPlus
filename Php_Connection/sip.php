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

// Get data from the POST request
$investmentAmount = $_POST['investmentAmount'];
$investmentType = $_POST['investmentType'];
$expectedReturns = $_POST['expectedReturns'];
$investmentPeriod = $_POST['investmentPeriod'];
$inflation = $_POST['inflation'];

// Insert data into the sip table
$sql = "INSERT INTO sip (investmentAmount, investmentType, expectedReturns, investmentPeriod, inflation) 
        VALUES ('$investmentAmount', '$investmentType', '$expectedReturns', '$investmentPeriod', '$inflation')";

if ($conn->query($sql) === TRUE) {
    echo "SIP data saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
