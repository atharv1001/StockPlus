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

// Display the specific SIP report based on the entered row number
if (isset($_GET['rowNumber'])) {
    $rowNumber = $_GET['rowNumber'];
    $sql = "SELECT * FROM sip WHERE id = {$rowNumber}";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th>";

        // Fetch column names dynamically
        $firstRow = $result->fetch_assoc();
        foreach ($firstRow as $columnName => $value) {
            echo "<th>{$columnName}</th>";
        }

        echo "</tr>";

        // Rewind the result set back to the beginning
        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";

            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No SIP reports found for the specified row number.</p>";
    }
} else {
    // Display all SIP reports
    $sql = "SELECT * FROM sip";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th>";

        // Fetch column names dynamically
        $firstRow = $result->fetch_assoc();
        foreach ($firstRow as $columnName => $value) {
            echo "<th>{$columnName}</th>";
        }

        echo "</tr>";

        // Rewind the result set back to the beginning
        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";

            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No SIP reports found.</p>";
    }
}

// Close the database connection
$conn->close();
?>
