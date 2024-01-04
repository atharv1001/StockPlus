<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stockplus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM user_dashboard ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([
        'funds' => 0,
        'pnl' => 0,
        'brokerage' => 0,
        'accountOpeningDate' => 'N/A',
        'name' => 'N/A',
        'noOfAffiliates' => 0,
        'accountType' => 'N/A',
    ]);
}

$conn->close();
?>
