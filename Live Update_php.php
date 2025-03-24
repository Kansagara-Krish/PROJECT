<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "beat audio"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the description from the form
$description = $_POST['description'];

// Get the current date and time in [dd/mm/yy] format
$date = date("d/m/y H:i:s");

// Insert the data into the live_update table
$sql = "INSERT INTO live_update (time, description) VALUES ('$date', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "<script>window.location.href='./Thanks.html'</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();

// Redirect to the thanks page
?>
