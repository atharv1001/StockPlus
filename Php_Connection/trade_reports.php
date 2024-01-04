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

// Display the specific trade report based on the entered tradeId
if (isset($_GET['tradeId'])) {
    $tradeId = $_GET['tradeId'];
    $sql = "SELECT * FROM trade WHERE id = {$tradeId}";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Date</th><th>Amount</th><th>Quantity</th><th>PNL</th><th>Funds</th><th>Order Type</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['amount']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['pnl']}</td>";
            echo "<td>{$row['funds']}</td>";
            echo "<td>{$row['order_type']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No trade reports found for the specified Trade ID.</p>";
    }
} elseif (isset($_GET['showAll'])) {
    // Display all trade reports
    $sql = "SELECT * FROM trade";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Date</th><th>Amount</th><th>Quantity</th><th>PNL</th><th>Funds</th><th>Order Type</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['amount']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['pnl']}</td>";
            echo "<td>{$row['funds']}</td>";
            echo "<td>{$row['order_type']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No trade reports found.</p>";
    }
} else {
    echo "<p>Invalid request. Please provide a Trade ID or use the 'Show All Trades' button.</p>";
}

// Close the database connection
$conn->close();
?>
