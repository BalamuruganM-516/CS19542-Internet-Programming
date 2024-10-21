<?php
// Database connection parameters
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "mydata";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute a query to check the user's credentials
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password using password_verify (assuming passwords are hashed)
        if ($password === $user["pass"]) {
            // Password is correct, redirect to dashboard or home page
            header("Location: index.html");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password. Please try again.";
        }
    } else {
        // User with the given username doesn't exist
        echo "Invalid username or password. Please try again.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
