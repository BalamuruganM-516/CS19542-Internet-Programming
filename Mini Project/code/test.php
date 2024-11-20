<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydata";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS signup (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE,
    phno INT(15),
    pass VARCHAR(20)
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Check if the signup form was submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Check if email already exists
    $check_email_sql = "SELECT * FROM signup WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_sql);

    if ($check_email_result->num_rows > 0) {
        echo "Email already exists. Please try with another email.";
    } else {
        // Insert user data into the database
        $insert_sql = "INSERT INTO signup (fname, email, phno, pass) VALUES ('$username', '$email', '$phone', '$password')";
        if ($conn->query($insert_sql) === TRUE) {
            header("Location: login.html");
            exit();
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
}

// Close connection
$conn->close();
?>
