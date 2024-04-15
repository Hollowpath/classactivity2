<!DOCTYPE html>
<html>
<head>
    <title>Booking List</title>
</head>
<body>
    <?php
    session_start(); // Start or resume a session

    // Redirect to login page if the user is not logged in
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo "User must login to view this page.";
        exit; // Stop further execution of the script
    }

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

    echo "<p>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</p>"; // Display the username

    // Logout button
    echo "<a href='logout.php'>Logout</a>";

    $sql = "SELECT * FROM reservation";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Number of Persons</th><th>Dining Area</th><th>Booking Date</th><th>Actions</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["phone_number"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["num_persons"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["dining_area"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["booking_date"]) . "</td>";
            echo "<td>";
            echo "<button onclick='updateRecord(" . $row["id"] . ")'>Update</button>";
            echo "<button onclick='deleteRecord(" . $row["id"] . ")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    $conn->close();
    ?>
</body>
</html>