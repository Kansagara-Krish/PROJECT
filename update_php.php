<?php
// Enable error reporting
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

    // Fetch data from the POST request
    $clientId = $_POST['client_id'] ?? '';
    $client_name = $_POST['client_name'] ?? '';
    $contactNumber = $_POST['contact_number'] ?? '';
    $alternate_contact = $_POST['alternate_contact'] ?? '';
    $clientEmail = $_POST['client_email'] ?? '';
    $street = $_POST['street'] ?? '';
    $houseNumber = $_POST['house_number'] ?? '';
    $landmark = $_POST['landmark'] ?? '';
    $village = $_POST['village'] ?? '';
    $district = $_POST['district'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $pin_code = $_POST['pin_code'];
    $interior_designer_name = $_POST['interior_designer_name'];
    $interior_contact = $_POST['interior_contact'];
    $interior_alternate_contact = $_POST['interior_alternate_contact'];
    $interior_email = $_POST['interior_email'];

    $length_ft = $_POST['length_ft'] ?? '';
    $length_inch = $_POST['length_inch'] ?? '';
    $width_ft = $_POST['width_ft'] ?? '';
    $width_inch = $_POST['width_inch'] ?? '';
    $height_ft = $_POST['height_ft'] ?? '';
    $height_inch = $_POST['height_inch'] ?? '';
    $seating_length = $_POST['seating_length'] ?? '';
    $seating_height = $_POST['seating_height'] ?? '';
    $seating_width = $_POST['seating_width'] ?? '';
    $room_type = $_POST['room_type'] ?? '';
    $no_seats = $_POST['no_seats'] ?? '';
    $avr_or_pre_amplifier = $_POST['avr_or_pre_amplifier'] ?? '';
    $speaker_config = $_POST['speaker_config'] ?? '';
    $make_avr_pre_pro = $_POST['make_avr_pre_pro'] ?? '';
    $model = $_POST['model'] ?? '';

    $carpenter_name = $_POST['carpenter_name'] ?? '';
    $carpenter_contact = $_POST['carpenter_contact'] ?? '';
    $carpenter_alternate_contact = $_POST['carpenter_alternate_contact'] ?? '';
    $carpenter_email = $_POST['carpenter_email'] ?? '';
    $electrician_name = $_POST['electrician_name'] ?? '';
    $electrician_contact = $_POST['electrician_contact'] ?? '';
    $electrician_alternate_contact = $_POST['electrician_alternate_contact'] ?? '';
    $electrician_email = $_POST['electrician_email'] ?? '';
    $plumber_name = $_POST['plumber_name'] ?? '';
    $plumber_contact = $_POST['plumber_contact'] ?? '';
    $plumber_alternate_contact = $_POST['plumber_alternate_contact'] ?? '';
    $plumber_email = $_POST['plumber_email'] ?? '';
    $painter_name = $_POST['painter_name'] ?? '';
    $painter_contact = $_POST['painter_contact'] ?? '';
    $painter_alternate_contact = $_POST['painter_alternate_contact'] ?? '';
    $painter_email = $_POST['painter_email'] ?? '';

    // Check if Client ID is provided
    if (empty($clientId)) {
        throw new Exception("Client ID is required for updating the record.");
    }

    // Update client data query
    $updateClientSql = "UPDATE client_data SET 
        client_name = ?, contact_number = ?, alternate_contact = ?,client_email = ?, 
        street = ?, house_number = ?, landmark = ?, village = ?, 
        district = ?, city = ?, state = ? , pin_code = ? , interior_designer_name = ?,
        interior_contact = ?, interior_alternate_contact = ?,interior_email = ?
        WHERE client_id = ?";
    $stmtClient = $conn->prepare($updateClientSql);

    if (!$stmtClient) {
        throw new Exception("Failed to prepare the client data SQL statement: " . $conn->error);
    }

    // Bind client data parameters
    $stmtClient->bind_param(
        "sssssssssssssssss",
        $client_name, $contactNumber,$alternate_contact, $clientEmail, $street, $houseNumber,
        $landmark, $village, $district, $city, $state,$pin_code,$interior_designer_name,$interior_contact,$interior_alternate_contact,$interior_email, $clientId
    );

    // Execute client data update
    if (!$stmtClient->execute()) {
        throw new Exception("Failed to execute the client data SQL statement: " . $stmtClient->error);
    }

    // Update room data query
    $updateRoomSql = "UPDATE room_data SET 
        length_ft = ?, length_inch = ?, width_ft = ?, width_inch = ?, 
        height_ft = ?, height_inch = ?, seating_length = ?, seating_height = ?, 
        seating_width = ?, room_type = ?, no_seats = ?, avr_or_pre_amplifier = ?, 
        speaker_config = ?, make_avr_pre_pro = ?, model = ? 
        WHERE client_id = ?";
    $stmtRoom = $conn->prepare($updateRoomSql);

    if (!$stmtRoom) {
        throw new Exception("Failed to prepare the room data SQL statement: " . $conn->error);
    }

    // Bind room data parameters
    $stmtRoom->bind_param(
        "ssssssssssssssss",
        $length_ft, $length_inch, $width_ft, $width_inch,
        $height_ft, $height_inch, $seating_length, $seating_height,
        $seating_width, $room_type, $no_seats, $avr_or_pre_amplifier,
        $speaker_config, $make_avr_pre_pro, $model, $clientId
    );

    // Execute room data update
    if (!$stmtRoom->execute()) {
        throw new Exception("Failed to execute the room data SQL statement: " . $stmtRoom->error);
    }

    $updateWorkerSql= "UPDATE worker_data SET 
        carpenter_name = ?, carpenter_contact = ?, carpenter_alternate_contact = ?, carpenter_email = ?, 
        electrician_name = ?, electrician_contact = ?, electrician_alternate_contact = ?, electrician_email = ?, 
        plumber_name = ?, plumber_contact = ?, plumber_alternate_contact = ?, plumber_email = ?, 
        painter_name = ?, painter_contact = ?, painter_alternate_contact = ?, painter_email = ? 
        WHERE client_id = ?";
    $stmtWorker = $conn->prepare($updateWorkerSql);

    if (!$stmtWorker) {
        throw new Exception("Failed to prepare the worker data SQL statement: " . $conn->error);
    }
    $stmtWorker->bind_param(
        "sssssssssssssssss",
        $carpenter_name, $carpenter_contact, $carpenter_alternate_contact, $carpenter_email,
        $electrician_name, $electrician_contact, $electrician_alternate_contact, $electrician_email,
        $plumber_name, $plumber_contact, $plumber_alternate_contact, $plumber_email,
        $painter_name, $painter_contact, $painter_alternate_contact, $painter_email, $clientId
    );
    if (!$stmtWorker->execute()) {
        throw new Exception("Failed to execute the worker data SQL statement: " . $stmtWorker->error);
    }

    // Check if any rows were updated
    if ($stmtClient->affected_rows === 0 && $stmtRoom->affected_rows === 0 && $stmtWorker->affected_rows === 0) {
        echo "<script>alert('No rows were updated. Either the Client ID does not exist or the data is the same.');window.history.back();</script>";
    } else {
        echo "<script>alert('Record updated successfully for Client ID: " . addslashes($clientId) . "');window.location.href='./Thanks_Admin.html';</script>";
    }

    // Close the statements and connection
    $stmtClient->close();
    $stmtRoom->close();
    $conn->close();
} catch (Exception $e) {
    // Display error message in alert box
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    exit;
}
?>
