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

// Assuming you're passing in an 'id' parameter to identify the record to update
$id = $_GET["id"];

$sql = "UPDATE reservation SET 
  first_name = '".$_GET["first_name"]."', 
  last_name = '".$_GET["last_name"]."', 
  phone_number = '".$_GET["phone_number"]."', 
  email = '".$_GET["email"]."', 
  num_persons = '".$_GET["num_persons"]."', 
  dining_area = '".$_GET["dining_area"]."', 
  booking_date = '".$_GET["booking_date"]."' 
WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>