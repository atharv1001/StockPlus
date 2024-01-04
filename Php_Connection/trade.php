<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");



// Php_Connection/trade.php

$servername = "localhost";  // Replace with your MySQL server address
$username = "root";          // Replace with your MySQL username
$password = "";              // Replace with your MySQL password
$dbname = "stockplus";    // Replace with your MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$amount = $_POST['amount'];
$quantity = $_POST['quantity'];
$pnl = $_POST['pnl'];
$funds = $_POST['funds'];
$orderType = $_POST['orderType'];

$sql = "INSERT INTO trade (amount, quantity, pnl, funds, order_type) VALUES ('$amount', '$quantity', '$pnl', '$funds', '$orderType')";

if ($conn->query($sql) === TRUE) {
    echo "Transaction recorded successfully";
} else {
    echo "Error recording transaction: " . $conn->error;
}

$conn->close();
?>
