<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stockplus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$city = $_POST['city'];
$address = $_POST['address'];
$panNumber = $_POST['panNumber'];
$mobileNumber = $_POST['mobileNumber'];
$age = $_POST['age'];
$funds = $_POST['funds'];
$occupation = $_POST['occupation'];
$email = $_POST['email'];
$password = $_POST['password']; // Retrieve password in plain text

// File upload handling (photo)
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

// SQL to insert data into the database (password stored in plain text)
$sql = "INSERT INTO demat_account (first_name, last_name, city, address, pan_number, mobile_number, age, funds, occupation, photo, email, password)
        VALUES ('$firstName', '$lastName', '$city', '$address', '$panNumber', '$mobileNumber', '$age', '$funds', '$occupation', '$target_file', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Data stored successfully
    echo "<script>
            alert('Data stored successfully');
            window.location.href = '../sign-in.html';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
