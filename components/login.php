<?php
session_set_cookie_params(['secure' => true, 'httponly' => true, 'samesite' => 'Strict']);
session_start(); // Start the session at the beginning of the script

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "was";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username and password from the POST data
$post_username = $_POST["username"];
$post_password = $_POST["password"];

// Create a prepared statement
$stmt = $conn->prepare("SELECT id, username, password FROM auth WHERE username = ?");
$stmt->bind_param("s", $post_username);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if we found a match
if ($result->num_rows > 0) {
    // Fetch the row from the result
    $row = $result->fetch_assoc();

    // Verify the password
    if (password_verify($post_password, $row['password'])) {
        // Regenerate the session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Set session variables
        $_SESSION['user_id'] = $row['id']; // Assuming there's an 'id' field in your auth table
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged_in'] = true;

        // Redirect to booking_list.php
        header("Location: booking_list.php");
        exit;
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
