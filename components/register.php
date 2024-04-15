<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data (you can add more validation if needed)

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Hash the email
    $hashedEmail = hash('sha256', $email);

    // Connect to the MySQL database
    $conn = new mysqli('localhost', 'root', '', 'was');

    // Check the connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert the user details
    $sql = "INSERT INTO auth (username, email, password) VALUES ('$username', '$hashedEmail', '$hashedPassword')";
    if ($conn->query($sql) === true) {
        echo 'User registered successfully.';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>