<?php
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

$sql = "INSERT INTO reservation (first_name, last_name, phone_number, email, num_persons, dining_area, booking_date)
VALUES ('".$_GET["first_name"]."', '".$_GET["last_name"]."', '".$_GET["phone_number"]."', '".$_GET["email"]."', '".$_GET["num_persons"]."', '".$_GET["dining_area"]."', '".$_GET["booking_date"]."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header("Location: booking_list.php"); // Redirect to booking_list.php
  exit(); // Stop further execution
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>