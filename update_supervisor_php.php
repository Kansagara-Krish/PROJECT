<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "beat audio";

try {
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    // Fetch data from POST request
    $clientId = $_POST['client_id'] ?? '';
    if (empty($clientId)) {
        throw new Exception("Client ID is required to update the record.");
    }

    // Room data
    $length_ft = $_POST['length_ft'] ?? null;
    $length_inch = $_POST['length_inch'] ?? null;
    $width_ft = $_POST['width_ft'] ?? null;
    $width_inch = $_POST['width_inch'] ?? null;
    $height_ft = $_POST['height_ft'] ?? null;
    $height_inch = $_POST['height_inch'] ?? null;

    // Worker data
    $carpenter_name = $_POST['carpenter_name'] ?? null;
    $carpenter_contact = $_POST['carpenter_contact'] ?? null;
    $carpenter_alternate_contact = $_POST['carpenter_alternate_contact'] ?? null;
    $carpenter_email = $_POST['carpenter_email'] ?? null;
    $electrician_name = $_POST['electrician_name'] ?? null;
    $electrician_contact = $_POST['electrician_contact'] ?? null;
    $electrician_alternate_contact = $_POST['electrician_alternate_contact'] ?? null;
    $electrician_email = $_POST['electrician_email'] ?? null;
    $plumber_name = $_POST['plumber_name'] ?? null;
    $plumber_contact = $_POST['plumber_contact'] ?? null;
    $plumber_alternate_contact = $_POST['plumber_alternate_contact'] ?? null;
    $plumber_email = $_POST['plumber_email'] ?? null;
    $painter_name = $_POST['painter_name'] ?? null;
    $painter_contact = $_POST['painter_contact'] ?? null;
    $painter_alternate_contact = $_POST['painter_alternate_contact'] ?? null;
    $painter_email = $_POST['painter_email'] ?? null;

    // Update room details
    $updateRoomSql = "UPDATE room_data 
                      SET length_ft = ?, length_inch = ?, width_ft = ?, width_inch = ?, height_ft = ?, height_inch = ? 
                      WHERE client_id = ?";
    $stmtRoom = $conn->prepare($updateRoomSql);
    if (!$stmtRoom) {
        throw new Exception("Failed to prepare the room details SQL statement: " . $conn->error);
    }
    $stmtRoom->bind_param("sssssss", $length_ft, $length_inch, $width_ft, $width_inch, $height_ft, $height_inch, $clientId);
    if (!$stmtRoom->execute()) {
        throw new Exception("Failed to update room details: " . $stmtRoom->error);
    }

    // Update worker details
    $updateWorkerSql = "UPDATE worker_data 
                        SET carpenter_name = ?, carpenter_contact = ?, carpenter_alternate_contact = ?, carpenter_email = ?, 
                            electrician_name = ?, electrician_contact = ?, electrician_alternate_contact = ?, electrician_email = ?, 
                            plumber_name = ?, plumber_contact = ?, plumber_alternate_contact = ?, plumber_email = ?, 
                            painter_name = ?, painter_contact = ?, painter_alternate_contact = ?, painter_email = ?
                        WHERE client_id = ?";
    $stmtWorker = $conn->prepare($updateWorkerSql);
    if (!$stmtWorker) {
        throw new Exception("Failed to prepare the worker details SQL statement: " . $conn->error);
    }
    $stmtWorker->bind_param(
        "sssssssssssssssss",
        $carpenter_name, $carpenter_contact, $carpenter_alternate_contact, $carpenter_email,
        $electrician_name, $electrician_contact, $electrician_alternate_contact, $electrician_email,
        $plumber_name, $plumber_contact, $plumber_alternate_contact, $plumber_email,
        $painter_name, $painter_contact, $painter_alternate_contact, $painter_email,
        $clientId
    );
    if (!$stmtWorker->execute()) {
        throw new Exception("Failed to update worker details: " . $stmtWorker->error);
    }

    // Check if any rows were updated
    if ($stmtRoom->affected_rows === 0 && $stmtWorker->affected_rows === 0) {
        echo "<script>alert('No rows were updated. The Client ID might not exist, or the data remains unchanged.');window.history.back();</script>";
    } else {
        echo "<script>alert('Record updated successfully for Client ID: " . addslashes($clientId) . "');window.location.href='./Thanks.html';</script>";
    }

    // Close statements and connection
    $stmtRoom->close();
    $stmtWorker->close();
    $conn->close();
} catch (Exception $e) {
    // Display error message in alert box
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    exit;
}
?>
