
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "beat audio";

$conn = new mysqli($servername, $username, $password, $database);

// Check for database connection errors
if ($conn->connect_error) {
    echo "<script>alert('Database connection failed: {$conn->connect_error}');</script>";
    die();
}

$clientId = $_POST['client_id'] ?? '';
$clientName = $_POST['client_name'] ?? '';
$record = [];
$roomRecord = [];

if (!empty($clientId)) {
    // Search by client_id
    //worker data
    $workerSql = "SELECT * FROM worker_data WHERE client_id = ?";
    $workerStmt = $conn->prepare($workerSql);
    if ($workerStmt) {
        $workerStmt->bind_param("s", $clientId);
        $workerStmt->execute();
        $workerResult = $workerStmt->get_result();
        $workerRecord = $workerResult->fetch_assoc(); // Fetch worker data
    }

    //search by client id 
    //some
    $roomSql = "SELECT * FROM room_data WHERE client_id = ?";
    $roomStmt = $conn->prepare($roomSql);
    if ($roomStmt) {
        $roomStmt->bind_param("s", $clientId);
        $roomStmt->execute();
        $roomResult = $roomStmt->get_result();
        $roomRecord = $roomResult->fetch_assoc();
    }

    $sql = "SELECT * FROM client_data WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $clientId);
        $stmt->execute();
        $result = $stmt->get_result();
        $record = $result->fetch_assoc();
        if (!$record) {
            echo "<script>alert('No record found for Client ID: $clientId');window.history.back();</script>";
            return;
        }
    }
} elseif (!empty($clientName)) {
    // Search by client_name
    if (!empty($clientName)) {
        // Query for Client Name (supports flexible matching)
        $sql = "SELECT * FROM client_data WHERE client_name LIKE ? OR client_name LIKE ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Split the name into parts (e.g., first and last name)
            $nameParts = explode(" ", $clientName);
            $searchPattern1 = "%" . $clientName . "%"; // Full name pattern
            $searchPattern2 = isset($nameParts[1]) ? "%" . $nameParts[1] . " " . $nameParts[0] . "%" : ""; // Reversed order

            $stmt->bind_param("ss", $searchPattern1, $searchPattern2);
            $stmt->execute();
            $result = $stmt->get_result();

        if ($result->num_rows > 1) {
            $clientIds = [];
            while ($record = $result->fetch_assoc()) {
                $clientIds[] = $record['client_id'];
            }
            $clientIdsString = implode(", ", $clientIds);
            echo "<script>alert('Multiple records found for the client name: $clientName. Client IDs: $clientIdsString');</script>";
        } elseif ($result->num_rows === 1) {
            $record = $result->fetch_assoc();
            $clientId = $record['client_id'];

            //worker data

            $workerSql = "SELECT * FROM worker_data WHERE client_id = ?";
            $workerStmt = $conn->prepare($workerSql);
            if ($workerStmt) {
                $workerStmt->bind_param("s", $clientId);
                $workerStmt->execute();
                $workerResult = $workerStmt->get_result();
                $workerRecord = $workerResult->fetch_assoc(); // Fetch worker data
            }
            //room data
            $roomSql = "SELECT * FROM room_data WHERE client_id = ?";
            $roomStmt = $conn->prepare($roomSql);
            if ($roomStmt) {
                $roomStmt->bind_param("s", $clientId);
                $roomStmt->execute();
                $roomResult = $roomStmt->get_result();
                $roomRecord = $roomResult->fetch_assoc();
            }
        } else {
            echo "<script>alert('No record found for Client Name: $clientName');</script>";
            return;
        }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>UPDATE/SEARCH</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        .list-button {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: larger;
            padding: 10px 20px;
            background-color: #1abc9c;
            color: white;
            border: none;
            width: 10%;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            z-index: 1000;
            /* Ensure it is above other content */
            display: none;
            /* Hide by default */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        .list-container {
            transition: 1s;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            text-decoration: solid;
            text-decoration: none;
            width: 50%;
            color: rgb(0, 0, 0);
            background-color: #2c3e50;
            /* Light blue background with transparency */
            border-right: 1px solid #34495e;
            box-shadow: 1px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            /* Ensure it is above other content */
            overflow-y: auto;
            animation-duration: 0.5s;
            animation-fill-mode: forwards;
            /* Enable scrolling if content overflows */
        }

        .list-container.show {
            display: flex;
            /* Show the container */
            animation-name: slideIn;
            /* Trigger the slide in animation */
        }

        /* Class to trigger the slide out animation */
        .list-container.hide {
            animation-name: slideOut;
            /* Trigger the slide out animation */
        }

        .list-container ul {
            list-style: none;
            margin-top: 150px;
            margin: 0;
            padding: 0px;
            padding-top: 10px;
        }

        .list-container li:last-child {
            border-bottom: none;
        }

        .list-container li {
            height: 8vh;
            display: flex;
            align-items: center;
            text-decoration: none;
            justify-content: center;
            font-size: 15px;
        }

        .list-container a {
            text-decoration: none;
            color: #eeeeee;
            text-transform: uppercase;
            text-shadow: 0 0 2px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.7);
            display: block;
            padding: 12px 20px;
            font-family: "Noto Serif", serif;
        }

        .hr_list {
            height: 3px;
            background: linear-gradient(to right, #000000, #7b0808, #f0f0f0);
            border: none;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            z-index: 998;
        }

        body.blurred .overlay {
            display: block;
        }

        body.blurred {
            overflow: hidden;
        }

        body.blurred *:not(.list-button):not(.list-container):not(.list-container *) {
            filter: blur(3px);
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background: #34495e;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: 1.5s;
        }

        nav:hover {
            height: 12vh;
            transition: 0.5s;
            font-size: larger;
        }

        body.scrolled nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 20px;
        }

        nav .brand {
            float: left;
            height: 100%;
            line-height: 70px;
        }

        nav ul {
            float: center;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            font-size: large;
            list-style: none;

        }

        nav ul li a {
            text-decoration: none;
            color: white;
            display: block;
            height: 70px;
            line-height: 70px;
            padding: 0 20px;
            box-sizing: border-box;
            position: relative;
            z-index: 1;
            font-family: "Noto Serif", serif;
            text-transform: uppercase;
            transition: .8s;
        }

        nav ul li a::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background: #fffAfA;
            transform-origin: right;
            transform: scaleX(0);
            font-size: large;
            transition: transform .5s;
        }

        nav ul li a:hover::before {
            transform-origin: left;
            transform: scaleX(1);
            transition: 0.5s;
        }

        nav ul li a:hover {
            font-size: 20px;
            color: #262622;
            box-shadow: 0 5px 10px white;
        }

        body.scrolled nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 20px;
        }

        nav li {
            font-size: 15px;
            text-transform: uppercase;
            color: white;
            text-decoration: none;
            line-height: 50px;
            position: relative;
            z-index: 1;
            margin: 0;
            display: inline-block;
            text-align: center;
        }

        .btn-menu {
            display: block;
            background-color: #FFFAFA;
            color: black;
            padding: 15px 30px;
            font-size: 22px;
            cursor: pointer;
            width: 100%;
            max-width: 500px;
        }


        @media (max-width: 768px) {
            .list-button {
                font-size: 14px;
                padding: 10px 12px;
                margin-left: 8px;
            }

            .list-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50%;
            }

            body.blurred *:not(.list-button):not(.list-container):not(.list-container *):not(.overlay) {
                filter: blur(5px);
            }

            nav {
                display: none !important;
            }

            .list-button {
                display: block;
            }

            select.mobile {
                display: block;
            }

            select.laptop {
                display: none;
            }

            nav .logout span {
                display: none;
            }

            nav .logout a {
                font-size: 1.5rem;
            }

            .form-group label {
                width: 100%;
                max-width: 200px;

            }

            .form-group input[type="text"],
            .form-group select,
            .form-group input[type="email"],
            .form-group input[type="tel"] {
                width: 80%;
                flex: 1;
            }

            label,
            input[type="text"],
            .row p {
                font-size: 14px;
            }

            .grid-container {

                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 769px) {
            nav a {
                text-decoration: none;
                color: white;
            }

            .list-button {
                display: none;
            }

            .overlay {
                display: block;
            }

            select.mobile {
                display: none;
            }

            select.laptop {
                display: block;
            }

            nav .logout-icon a i {
                margin-right: 5px;
            }

            .form-group {
                flex-direction: row;
            }

            .form-group label {
                flex: 0 0 150px;
                font-size: 18px;
            }

            .form-group input[type="text"],
            .form-group input[type="tel"],
            .form-group select {
                flex: 1;
                max-width: 300px;
            }

            .form-group input[type="email"] {
                flex: 1;
                max-width: 500px;
            }

            .form-group input[type="text"],
            .form-group select,
            .form-group input[type="tel"] {
                flex: 1;
                padding: 15px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
                margin-bottom: 10px;
                box-shadow: 0 0 5px black;
            }

            .form-group input[type="text"],
            .form-group select,
            .form-group input[type="email"],
            .form-group input[type="tel"] {
                width: 100%;
            }

            .grid-container {
                grid-template-columns: repeat(3, 1fr);
            }

        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #company_logo {
            height: 100%;
            margin-left: 30px;
            display: flex;
            align-items: center;
            position: absolute;
            left: 0;
        }

        nav .logout {
            margin-left: auto;
        }

        nav .logout-icon {
            margin-left: auto;
        }

        nav .logout-icon a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .form-container {
            margin-top: 60px;
            background: #fffafa;
            padding: 20px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
            width: 90%;
            text-align: center;
            align-items: center;
            max-width: 900px;
        }

        .form-group {
            position: relative;
            width: 100%;
            border-bottom: 3px solid #ddd;
            margin: 18px 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 40px;
        }

        .form-group input {
            background: transparent;
            width: 100%;
            border: none;
            outline: none;
            height: 50px;
            font-size: 1.2em;
            color: #333;
            padding: 0 30px 0 10px;
        }


        .grid-container {
            display: grid;
            gap: 10px;
            margin-top: 20px;
        }

        .grid-container input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group label {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: inline-block;
            word-wrap: break-word;
        }

        .grid-container .label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        /*This is css for disable or enabled the input box*/
        .grid-container input:disabled {
            background-color: #f0f0f0;
            /* Light gray for disabled inputs */
            cursor: not-allowed;
        }

        .grid-container input:enabled {
            background-color: #ffffff;
            /* White for enabled inputs */
        }

        .form-group p {
            text-align: right;
        }

        .submit {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .btn-submit {
            padding: 1em 2em;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 5px;
            text-transform: uppercase;
            box-shadow: 0 0 20px white;
            cursor: pointer;
            color: #2c9caf;
            outline: 2px solid #040808;
            transition: all 1000ms;
            font-size: 15px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            outline: 2px solid #2c9caf;
            background-color: #ffffff;
        }

        .btn-submit:hover {
            color: #ffffff;
            transform: scale(1.1);
            outline: 2px solid #24a2d8;
            box-shadow: 4px 5px 10px #0d1b1d;
            background-color: #2c9caf;

        }


        .btn-submit:hover::before {
            width: 250%;
        }

        .submit_div {
            align-items: center;
            width: 100%;
            margin-top: 20px;
            max-width: 6000px;
        }

        .special-row {
            border: 2px solid rgb(255, 255, 255);
            padding: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;

        }

        .special-row input[type="text"] {
            border: 2px solid #4CAF50;
            background-color: #fff;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

        }

        .row-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="number"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            width: 100%;
        }

        /*css for Edit button*/

        .edit_container {
            position: absolute;
        }

        .edit {
            background-color: #3498db;
            /* Matches modern blue tones */
            color: white;
            font-size: 14px;
            padding: 5px 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
            font-family: Arial, sans-serif;
        }

        .edit:hover {
            transition: 0.5s;
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }
    </style>
    <script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("nav");
            if (window.scrollY > 50) {
                document.body.classList.add("scrolled");
            } else { document.body.classList.remove("scrolled"); }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const listContainer = document.getElementById('listContainer');
            const overlay = document.getElementById('overlay');
            const body = document.body;
            listContainer.style.display = 'none';
            overlay.style.display = 'none';
            body.classList.remove('blurred');
        });

        function toggleList() {
            const listContainer = document.getElementById('listContainer');
            const overlay = document.getElementById('overlay');
            const body = document.body;

            if (listContainer.style.display === 'none' || listContainer.style.display === '') {
                listContainer.style.display = 'block';
                overlay.style.display = 'block';
                body.classList.add('blurred');
            } else {
                listContainer.style.display = 'none';
                overlay.style.display = 'none';
                body.classList.remove('blurred');
            }
        }

        //Code or logic of the Edit button

        document.addEventListener("DOMContentLoaded", () => {
            // Disable all input fields inside the grid-container by default
            const inputs = document.querySelectorAll(".grid-container input");
            inputs.forEach(input => {
                input.disabled = true;
            });

            // Add an event listener to the Edit button
            const editButton = document.querySelector(".edit");
            editButton.addEventListener("click", () => {
                // Enable all input fields in the grid-container
                inputs.forEach(input => {
                    input.disabled = false;
                });
            });

            // Add a blur event to detect changes and warn if disabled
            inputs.forEach(input => {
                input.addEventListener("click", () => {
                    if (input.disabled) {
                        alert("Please click the Edit button to make changes!");
                    }
                });
            });
        });


    </script>
</head>

<body>
    <button class="list-button" onclick="toggleList()">☰</button>
    <div class="list-container" id="listContainer">
        <ul>
            <a href="./home_2.html">
                <li><b>Home</b></li>
            </a>
            <hr class="hr_list">
            <a href="./WORKER.html">
                <li><b>WORKER</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Room-Details.php">
                <li><b>ROOM</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Live Update.php">
                <li><b>Live Updates</b></li>
            </a>
            <hr class="hr_list">
            <a href="./RT calculator.html">
                <li><b>RT 60</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Sound Propagation Loss Calculator.html">
                <li><b>SPL CALCULATOR</b></li>
            </a>
            <hr class="hr_list">
            <a href="./RH calculator.html">
                <li><b>RH CALCULATOR</b></li>
            </a>
            <hr class="hr_list">
            <a href="./HT calculator.html">
                <li><b>HT CALCULATOR</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Phase calculator.html">
                <li><b>PH CALCULATOR</b></li>
            </a>
            <hr class="hr_list">
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span>Log
                        out</span></a></li>
        </ul>
    </div>
    <div class="overlay" id="overlay" onclick="toggleList()"></div>
    <nav>
        <img src="./images/png logo.png" alt="company_logo" id="company_logo">
        <ul>
            <li><a href="./home_2.html"><b>Home</b></a></li>
            <li><a href="./Worker.php"><b>WORKER</b></a></li>
            <li><a href="Room-Details.php"><b>ROOM</b></a></li>
            <li><a href="./Live Update.php"><b>Live Updates</b></a></li>
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span>Log
                        out</span></a></li>
        </ul>
    </nav>

    <body>
        <div class="form-container">
            <form method="POST" id="myForm">
                <div class="row-container">
                    <div class="special-row">
                        <label for="client_id">Client ID</label>
                        <input type="text" id="client_id" name="client_id"
                            value="<?= isset($record['client_id']) ? $record['client_id'] : '' ?>"
                            placeholder="Enter Client ID">
                    </div>

                    <div class="row or-row">
                        <p><b><span>OR</span></b></p>
                    </div>

                    <div class="special-row">
                        <label for="client_name">Client Name</label>
                        <input type="text" id="client_name" name="client_name"
                            value="<?= isset($record['client_name']) ? $record['client_name'] : '' ?>"
                            placeholder="Enter Client Name">
                    </div>
                </div>
                <div class="submit_div">
                    <button class="btn-submit" type="submit" onclick="document.getElementById('myForm').action='./search_supervisor.php'">SEARCH</button>
                </div>
                <br>
                <div class="edit_container">
                    <div class="edit">
                        <button class="edit" type="button">Edit</button>
                    </div>
                </div>
                <div class="data">
                    <h2>ROOM-DATA</h2>
                    <div class="grid-container">
                        <div>
                            <label for="lenght_ft">Length(Ft)</label>
                            <input type="number" name="length_ft" id="length_ft" value="<?= isset($roomRecord['length_ft']) ? $roomRecord['length_ft'] : '' ?>" placeholder="Length in Feet">
                        </div>
                        <div>
                            <label for="lenght_inch">Lenght(Inch)</label>
                            <input type="tel" name="length_inch" id="length_inch" value="<?= isset($roomRecord['length_inch']) ? $roomRecord['length_inch'] : '' ?>" placeholder="Length in Inch">
                        </div>
                        <div>
                            <label for="width_ft">width(Ft)</label>
                            <input type="number" name="width_ft" id="width_ft"
                                value="<?= isset($roomRecord['width_ft']) ? $roomRecord['width_ft'] : '' ?>"
                                placeholder="Width in Feet">
                        </div>
                        <div>
                            <label for="width_inch">Width(Inch)</label>
                            <input type="number" name="width_inch" id="width_inch"
                                value="<?= isset($roomRecord['width_inch']) ? $roomRecord['width_inch'] : '' ?>"
                                placeholder="Width in Inch">
                        </div>
                        <div>
                            <label for="height_ft">Height(Ft)</label>
                            <input type="text" name="height_ft" id="height_ft"
                                value="<?= isset($roomRecord['height_ft']) ? $roomRecord['height_ft'] : '' ?>"
                                placeholder="Height in Feet">
                        </div>
                        <div>
                            <label for="height_inch">Height(Inch)</label>
                            <input type="number" name="height_inch" id="height_inch"
                                value="<?= isset($roomRecord['height_inch']) ? $roomRecord['height_inch'] : '' ?>"
                                placeholder="Height in Inch">
                        </div>
                    </div>
                </div>
                 <!--Worker-data-->
                 <div class="data">
                    <h2>WORKER-DATA</h2>
                    <div class="grid-container">
                        <div>
                            <label for="carpenter_name">Carpenter Name</label>
                            <input type="text" name="carpenter_name" id="carpenter_name"
                                value="<?= isset($workerRecord['carpenter_name']) ? $workerRecord['carpenter_name'] : '' ?>"
                                placeholder="Name">
                        </div>
                        <div>
                            <label for="carpenter_contact_number">Carpenter contact</label>
                            <input type="text" name="carpenter_contact" id="carpenter_contact"
                                value="<?= isset($workerRecord['carpenter_contact']) ? $workerRecord['carpenter_contact'] : '' ?>"
                                placeholder="Contact">
                        </div>
                        <div>
                            <label for="carpenter_alternate_contact">Carpenter Alternate Contact</label>
                            <input type="text" name="carpenter_alternate_contact" id="carpenter_alternate_contact"
                                value="<?= isset($workerRecord['carpenter_alternate_contact']) ? $workerRecord['carpenter_alternate_contact'] : '' ?>"
                                placeholder="Alternate Contact">
                        </div>
                        <div>
                            <label for="carpenter_email">Carpenter Email</label>
                            <input type="text" name="carpenter_email" id="carpenter_email"
                                value="<?= isset($workerRecord['carpenter_email']) ? $workerRecord['carpenter_email'] : '' ?>"
                                placeholder="Email">
                        </div>
                        <div>
                            <label for="electrician_name">Electrician Name</label>
                            <input type="text" name="electrician_name" id="electrician_name"
                                value="<?= isset($workerRecord['electrician_name']) ? $workerRecord['electrician_name'] : '' ?>"
                                placeholder="Name">
                        </div>
                        <div>
                            <label for="electrician_contact">Electrician Contact</label>
                            <input type="text" name="electrician_contact" id="electrician_contact"
                                value="<?= isset($workerRecord['electrician_contact']) ? $workerRecord['electrician_contact'] : '' ?>"
                                placeholder="Contact">
                        </div>
                        <div>
                            <label for="electrician_alternate_contact">Electrician Alternate Contact</label>
                            <input type="text" name="electrician_alternate_contact" id="electrician_alternate_contact"
                                value="<?= isset($workerRecord['electrician_alternate_contact']) ? $workerRecord['electrician_alternate_contact'] : '' ?>"
                                placeholder="Alternate Contact">
                        </div>
                        <div>
                            <label for="electrician_email">Electrician Email</label>
                            <input type="text" name="electrician_email" id="electrician_email"
                                value="<?= isset($workerRecord['electrician_email']) ? $workerRecord['electrician_email'] : '' ?>"
                                placeholder="Email">
                        </div>
                        <div>
                            <label for="plumber_name">Plumber Name</label>
                            <input type="text" name="plumber_name" id="plumber_name"
                                value="<?= isset($workerRecord['plumber_name']) ? $workerRecord['plumber_name'] : '' ?>"
                                placeholder="Name">
                        </div>
                        <div>
                            <label for="plumber_contact">Plumber Contact</label>
                            <input type="text" name="plumber_contact" id="plumber_contact"
                                value="<?= isset($workerRecord['plumber_contact']) ? $workerRecord['plumber_contact'] : '' ?>"
                                placeholder="Contact">
                        </div>
                        <div>
                            <label for="plumber_alternate_contact">Plumber Alternate Contact</label>
                            <input type="text" name="plumber_alternate_contact" id="plumber_alternate_contact"
                                value="<?= isset($workerRecord['plumber_alternate_contact']) ? $workerRecord['plumber_alternate_contact'] : '' ?>"
                                placeholder="Alternate Contact">
                        </div>
                        <div>
                            <label for="plumber_email">Plumber Email</label>
                            <input type="text" name="plumber_email" id="plumber_email"
                                value="<?= isset($workerRecord['plumber_email']) ? $workerRecord['plumber_email'] : '' ?>"
                                placeholder="Email">
                        </div>
                        <div>
                            <label for="painter_name">Painter Name</label>
                            <input type="text" name="painter_name" id="painter_name"
                                value="<?= isset($workerRecord['painter_name']) ? $workerRecord['painter_name'] : '' ?>"
                                placeholder="Name">
                        </div>
                        <div>
                            <label for="painter_contact">Painter Contact</label>
                            <input type="text" name="painter_contact" id="painter_contact"
                                value="<?= isset($workerRecord['painter_contact']) ? $workerRecord['painter_contact'] : '' ?>"
                                placeholder="Contact">
                        </div>
                        <div>
                            <label for="painter_alternate_contact">Painter Alternate Contact</label>
                            <input type="text" name="painter_alternate_contact" id="painter_alternate_contact"
                                value="<?= isset($workerRecord['painter_alternate_contact']) ? $workerRecord['painter_alternate_contact'] : '' ?>"
                                placeholder="Alternate Contact">
                        </div>
                        <div>
                            <label for="painter_email">Painter Email</label>
                            <input type="text" name="painter_email" id="painter_email"
                                value="<?= isset($workerRecord['painter_email']) ? $workerRecord['painter_email'] : '' ?>"
                                placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="submit_div">
                    <button class="btn-submit" type="submit" onclick="document.getElementById('myForm').action='./update_supervisor_php.php'">UPDATE</button>
                </div>
                </div>
                </form>
                </div>
                </body>