<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "beat audio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $length_ft = htmlspecialchars($_POST['length-ft'] ?? null);
    $length_inch = htmlspecialchars($_POST['length-inch'] ?? null);
    $width_ft = htmlspecialchars($_POST['width-ft'] ?? null);
    $width_inch = htmlspecialchars($_POST['width-inch'] ?? null);
    $height_ft = htmlspecialchars($_POST['height-ft'] ?? null);
    $height_inch = htmlspecialchars($_POST['height-inch'] ?? null);
    $client_id = htmlspecialchars($_POST['client_id'] ?? null);
    $seating_length = htmlspecialchars($_POST['Seating_length'] ?? null);
    $seating_width = htmlspecialchars($_POST['Seating_width'] ?? null);
    $seating_height = htmlspecialchars($_POST['Seating_height'] ?? null);
    $room_type = htmlspecialchars($_POST['room_type'] ?? null);
    $no_seats = htmlspecialchars($_POST['no_seats'] ?? null);
    $avr_or_pre_amplifier = htmlspecialchars($_POST['avr_or_pre_amplifier'] ?? null);
    $speaker_config = htmlspecialchars($_POST['speak-config'] ?? null);
    $make_avr_pre_pro = htmlspecialchars($_POST['avr/pre/pro'] ?? null);
    $model = htmlspecialchars($_POST['model'] ?? null);

    $checkClientStmt = $conn->prepare("SELECT client_id FROM client_data WHERE client_id = ?");
    $checkClientStmt->bind_param("s", $client_id);
    $checkClientStmt->execute();
    $clientResult = $checkClientStmt->get_result();

    if ($clientResult->num_rows == 0) {
        echo "<script>alert('Invalid client ID. This client Id not exists');window.history.back();</script>";
        exit();
    }

    $checkRoomStmt = $conn->prepare("SELECT client_id FROM room_data WHERE client_id = ?");
    $checkRoomStmt->bind_param("s", $client_id);
    $checkRoomStmt->execute();
    $roomResult = $checkRoomStmt->get_result();

    if ($roomResult->num_rows > 0) {
        echo "<script>alert('This client ID already exists in the room_data table. Please check and try again.');window.history.back();</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO room_data (
        client_id, length_ft, length_inch, width_ft, width_inch, height_ft, height_inch, 
        seating_length, seating_width, seating_height, room_type, no_seats, 
        avr_or_pre_amplifier, speaker_config, make_avr_pre_pro, model
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param(
            "siiiiiiiiissssss",
            $client_id, $length_ft, $length_inch, $width_ft, $width_inch, $height_ft, $height_inch,
            $seating_length, $seating_width, $seating_height, $room_type, $no_seats,
            $avr_or_pre_amplifier, $speaker_config, $make_avr_pre_pro, $model
        );

        if ($stmt->execute()) {
            echo "<script>window.location.href='./Thanks.html';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the statement: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
