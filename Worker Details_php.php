<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beat audio"; // Ensure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Failed to connect to the database. Please contact support.");
}

// Check if the necessary tables exist
$tableCheckClient = "SHOW TABLES LIKE 'client_data'";
$tableCheckWorker = "SHOW TABLES LIKE 'worker_data'";
if ($conn->query($tableCheckClient)->num_rows == 0 || $conn->query($tableCheckWorker)->num_rows == 0) {
    die("One or more required tables do not exist. Please contact support.");
}

try {
    // Collect data from the form
    $client_id = $_POST['client_id'];
    $carpenter_name = $_POST['carpenter_name'];
    $carpenter_contact = $_POST['carpenter_contact'];
    $carpenter_alternate_contact = $_POST['carpenter_alternate_contact'];
    $carpenter_email = $_POST['carpenter_email'];
    $electrician_name = $_POST['electrician_name'];
    $electrician_contact = $_POST['electrician_contact'];
    $electrician_alternate_contact = $_POST['electrician_alternate_contact'];
    $electrician_email = $_POST['electrician_email'];
    $plumber_name = $_POST['plumber_name'];
    $plumber_contact = $_POST['plumber_contact'];
    $plumber_alternate_contact = $_POST['plumber_alternate_contact'];
    $plumber_email = $_POST['plumber_email'];
    $painter_name = $_POST['painter_name'];
    $painter_contact = $_POST['painter_contact'];
    $painter_alternate_contact = $_POST['painter_alternate_contact'];
    $painter_email = $_POST['painter_email'];

    // Step 1: Check if client_id exists in client_data table
    $checkClientStmt = $conn->prepare("SELECT client_id FROM client_data WHERE client_id = ?");
    $checkClientStmt->bind_param("s", $client_id);
    $checkClientStmt->execute();
    $clientResult = $checkClientStmt->get_result();

    if ($clientResult->num_rows == 0) {
        // If client_id does not exist in client_data table
        echo "<script>alert('Invalid client ID. This client Id does not exists');window.history.back();</script>";
        exit();
    }

    // Step 2: Check if client_id already exists in worker_data table
    $checkWorkerStmt = $conn->prepare("SELECT client_id FROM worker_data WHERE client_id = ?");
    $checkWorkerStmt->bind_param("s", $client_id);
    $checkWorkerStmt->execute();
    $workerResult = $checkWorkerStmt->get_result();

    if ($workerResult->num_rows > 0) {
        // If client_id already exists in worker_data table
        echo "<script>alert('This client ID Worker Data already insert. Please check and try again.');window.history.back();</script>";
        exit();
    }

    // Step 3: Insert data into worker_data table if validations pass
    $insertStmt = $conn->prepare("INSERT INTO worker_data (client_id, carpenter_name, carpenter_contact, carpenter_alternate_contact, carpenter_email, electrician_name, electrician_contact, electrician_alternate_contact, electrician_email, plumber_name, plumber_contact, plumber_alternate_contact, plumber_email, painter_name, painter_contact, painter_alternate_contact, painter_email) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertStmt->bind_param("sssssssssssssssss", $client_id, $carpenter_name, $carpenter_contact, $carpenter_alternate_contact, $carpenter_email, $electrician_name, $electrician_contact, $electrician_alternate_contact, $electrician_email, $plumber_name, $plumber_contact, $plumber_alternate_contact, $plumber_email, $painter_name, $painter_contact, $painter_alternate_contact, $painter_email);

    if ($insertStmt->execute()) {
        echo "<script>window.location.href='./Thanks.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

} catch (Exception $e) {
    echo "An unexpected error occurred. Please try again.";
}

// Close the database connection
$conn->close();
?>
