
<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stockplus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display all stocks or search based on stock name and date purchased
if (isset($_GET['stockName']) && isset($_GET['datePurchased'])) {
    $stockName = $_GET['stockName'];
    $datePurchased = $_GET['datePurchased'];
    $datePurchasedFormatted = date("Y-m-d", strtotime($datePurchased));

    $sql = "SELECT * FROM portfolio WHERE stock_name = '{$stockName}' AND date_purchased = '{$datePurchasedFormatted}'";
} else {
    $sql = "SELECT * FROM portfolio";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Stock Name</th><th>Quantity</th><th>Term</th><th>Date Purchased</th><th>Stock Price</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['stock_name']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['term']}</td>";
        echo "<td>{$row['date_purchased']}</td>";
        echo "<td>{$row['stock_price']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No stocks found for the specified criteria.</p>";
}

// Close the database connection
$conn->close();
?>
