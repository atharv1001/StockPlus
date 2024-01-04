<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stockplus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Check if the action is set
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Call the appropriate function based on the action
    switch ($action) {
        case 'buy':
            buyStock($_POST['stockName'], $_POST['quantity'], $_POST['term'], $_POST['currentDate'], $_POST['stockPrice'], $conn);
            break;

        case 'sell':
            sellStock($_POST['stockName'], $_POST['quantity'], $_POST['term'], $_POST['currentDate'], $_POST['stockPrice'], $conn);
            break;

        default:
            echo "Invalid action";
            break;
    }
} else {
    echo "No action specified";
}


// Handle different actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        // ... existing cases ...
        case 'getPortfolioData':
            echo getPortfolioData($conn);
            break;
        default:
            echo "Invalid action";
    }
}


// Function to get portfolio data
function getPortfolioData($conn) {
    $sql = "SELECT stock_name, SUM(quantity) AS total_quantity FROM portfolio GROUP BY stock_name";
    $result = $conn->query($sql);
    
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[$row['stock_name']] = $row['total_quantity'];
    }
    return json_encode($data);
}


// Buy stock function
function buyStock($stockName, $quantity, $term, $currentDate, $stockPrice, $conn) {
    // Format the date as YYYY-MM-DD
    $formattedDate = date("Y-m-d", strtotime($currentDate));

    // Insert data into the portfolio table
    $sql = "INSERT INTO portfolio (stock_name, quantity, term, date_purchased, stock_price) VALUES ('$stockName', $quantity, '$term', '$formattedDate', $stockPrice)";

    if ($conn->query($sql) === TRUE) {
        echo "Stock bought successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Sell stock function
// Sell stock function
function sellStock($stockName, $quantity, $term, $currentDate, $stockPrice, $conn) {
    // Format the date as YYYY-MM-DD
    $formattedDate = date("Y-m-d", strtotime($currentDate));

    // Update data in the portfolio table
    $sql = "UPDATE portfolio SET quantity = quantity - $quantity, stock_price = $stockPrice WHERE stock_name = '$stockName' AND term = '$term' AND quantity >= $quantity";

    $result = $conn->query($sql);

    if ($conn->affected_rows > 0) {
        echo "Stock sold successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>
