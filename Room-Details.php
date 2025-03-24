<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Room Detail</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            margin: 0;
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

        .list-container {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 50%;
            background-color: #2c3e50;
            /* Dark blue background for better contrast */
            border-right: 1px solid #34495e;
            /* Slightly lighter border */
            box-shadow: 1px 0 5px rgba(0, 0, 0, 0.2);
            /* Darker shadow for better depth */
            z-index: 999;
            overflow-y: auto;
            justify-content: center;
            align-items: center;
            display: none;
            /* Hide by default */
            transform: translateX(-100%);
            /* Initial state for animation */
            animation-duration: 0.5s;
            /* Duration of the animation */
            animation-fill-mode: forwards;
            /* Retain the final state of the animation */
            /* Retain the final state of the animation */
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

        /* Class to trigger the slide in animation */
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
            margin: 0;
            padding: 0;
            padding-top: 10px;
            margin-top: 150px;
        }

        .list-container li:last-child {
            border-bottom: none;
        }

        .list-container ul li {
            display: flex;
            height: 8vh;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 15px;
        }

        .list-container a {
            text-decoration: none;
            color: #eeeeee;
            text-shadow: 0 0 2px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.7);
            display: block;
            font-family: "Noto Serif", serif;
            padding: 12px 20px;
        }

        /* Overlay for blur effect */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent dark background */
            z-index: 998;
            /* Ensure it's below the menu but above other content */
        }

        body.blurred .overlay {
            display: block;
        }

        body.blurred {
            overflow: hidden;
            /* Prevent scrolling when overlay is active */
        }

        body.blurred *:not(.list-button):not(.list-container):not(.list-container *):not(.overlay) {
            filter: blur(3px);
            /* Apply blur effect */
        }

        nav {
            position: fixed;
            /* Fix the header at the top */
            top: 0;
            width: 100%;
            height: 60px;
            background: #34495e;
            border-radius: 0 0 8px 8px;
            /* Round bottom corners */
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: 1.5s;
            /* Ensure it is above other content */
        }

        nav:hover {
            height: 12vh;
            transition: 0.5s;
            font-size: larger;
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
            list-style: none;
            font-size: large;
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

        .form-container {
            margin-top: 60px;
            /* Adjust this value if needed */
            background: #fffAfA;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 50px rgb(0, 0, 0);
            width: 100%;
            justify-content: center;
            text-align: center;
            max-width: 700px;
        }

        .form-container h2 {
            color: #48cae4;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .row {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        .form-group-2 {

            display: flex;
            grid-template-columns: 0fr 1.5fr 0fr 1.5fr;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-group-2 label {
            flex: 1;
            margin-right: 5px;
            font-size: 15px;
            min-width: 80px;
            max-width: 200px;
            width: 30%;
            text-align: right;
            color: #000000;
        }

        .form-group-2 input {
            flex: 1;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
            width: calc(100% - 200px);
            box-shadow: 0 0 5px black;
            width: 35%;
            margin-right: 5px;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            flex: 1 1 40%;
        }

        .form-group label {
            margin-right: 10px;
            font-size: 14px;
            min-width: 100px;
            max-width: 400px;
            width: 100%;
            text-align: right;
            color: #000000;
            flex: 0 0 auto;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group input[type="number"] {
            flex: 1;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
            width: calc(100% - 110px);
            box-shadow: 0 0 5px black;
        }

        @media (max-width: 968px) {
            .list-button {
                font-size: 14px;
                padding: 10px 12px;
                margin-left: 8px;
            }

            .list-container ul {
                width: 100%;
                /* Make list-container take up the full width */
            }

            .list-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50%;
                /* Make list-container take up half of the screen */
            }

            body.blurred *:not(.list-button):not(.list-container):not(.list-container *):not(.overlay) {
                filter: blur(5px);
                /* Apply blur effect */
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

            .form-group {
                flex-direction: column;
            }

            .form-group label {
                text-align: center;
                width: 100%;
                margin-bottom: 10px;
                max-width: 200px;
            }

            .form-group input[type="text"],
            .form-group select,
            #speak-config select,
            .form-group input[type="number"],
            .form-group input[type="tel"] {
                width: 80%;
            }
            .form-container
            {
                width: 85%;
            }
            .form-group-2 input[type="number"]
            {
                max-width: 400px;
                width: 100%;
            }
        }

        @media (min-width: 969px) {
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
            #speak-config select 
            {
                width: 40px;
            }
            .form-group {
                flex-direction: row;
            }

            .form-group label {
                flex: 0 0 400px;
                font-size: 20px;
                width: 200px;
                max-width: 250px;
                /* Adjust the width of the label as needed */
            }

            .form-group input[type="text"],
            .form-group input[type="number"],
            .form-group select {
                flex: 1;
                max-width: 250px;
            }

            .form-group-2 label
            {
                font-size: 20px;
            }
            .form-group input[type="email"] {
                flex: 1;
                max-width: 1000px;
            }
        }

        .submit {
            padding-top: 50px;
            font-size: larger;
            margin-bottom: 20px;
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

       hr {
            height: 2px;
            /* Adjust the height of the line */
            background: linear-gradient(to right, #f0f0f0, #000000, #f0f0f0);
            border: none;
        }

        .hr_list {
            height: 3px;
            /* Adjust the height of the line */
            background: linear-gradient(to right, #000000, #7b0808, #f0f0f0);
            border: none;
            width: 150px;
        }

        .form-group label .required-asterisk {
            color: red;
            font-size: 18px;
            /* Adjust the size as needed */
        }

        #speak-config option {
            font-size: 18px;
            /* Adjust font size as needed */
            padding: 10px;
            
        } 

        #company_logo {
            height: 100%;
            margin-left: 30px;
            display: flex;
            align-items: center;
            position: absolute;
            left: 0;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            max-width: 1000px;
            box-shadow: 30px rgba(0, 0, 0, 0.5);
            font-size: 18px;
            text-align: left;
        }

        .results-table th,
        .results-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .results-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .results-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .results-table tr:hover {
            background-color: #f1f1f1;
        }

        .results-table td {
            color: #555;
        }

        .form-group label .required-asterisk {
            color: red;
            font-size: 18px;
            /* Adjust the size as needed */
        }

        .form-group-2 label .required-asterisk {
            color: red;
            font-size: 18px;
            /* Adjust the size as needed */
        }
    </style>
</head>

<body>
    <script>
        // Initialize the state correctly
        document.addEventListener('DOMContentLoaded', () => {
            const listButton = document.querySelector('.list-button');
            const listContainer = document.querySelector('.list-container');
            const overlay = document.querySelector('.overlay');

            listButton.addEventListener('click', () => {
                if (listContainer.classList.contains('show')) {
                    listContainer.classList.add('hide');
                    listContainer.classList.remove('show');
                    overlay.style.display = 'none'; // Hide the overlay
                    document.body.classList.remove('blurred');
                } else {
                    listContainer.classList.add('show');
                    listContainer.classList.remove('hide');
                    listContainer.style.display = 'flex'; // Ensure the container is displayed
                    overlay.style.display = 'block'; // Show the overlay
                    document.body.classList.add('blurred');
                }
            });

            overlay.addEventListener('click', () => {
                listContainer.classList.add('hide');
                listContainer.classList.remove('show');
                overlay.style.display = 'none'; // Hide the overlay
                document.body.classList.remove('blurred');
            });

            // Ensure the animation ends properly
            listContainer.addEventListener('animationend', () => {
                if (listContainer.classList.contains('hide')) {
                    listContainer.style.display = 'none';
                }
            });
        });

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
            const body = document.body;
            const overlay = document.getElementById('overlay');
            if (listContainer.style.display === 'none' || listContainer.style.display === '') {
                listContainer.style.display = 'block';
                overlay.style.display = 'block'; // Show overlay
                body.classList.add('blurred'); // Add blur effect
            } else {
                listContainer.style.display = 'none';
                overlay.style.display = 'none'; // Hide overlay
                body.classList.remove('blurred'); // Remove blur effect
            }
        }
        function calculateSum() {
            var length_ft = parseFloat(document.getElementById("length-ft").value) || 0;
            var length_inch = parseFloat(document.getElementById("length-inch").value) || 0;
            var width_ft = parseFloat(document.getElementById("width-ft").value) || 0;
            var width_inch = parseFloat(document.getElementById("width-inch").value) || 0;
            var height_ft = parseFloat(document.getElementById("height-ft").value) || 0;
            var height_inch = parseFloat(document.getElementById("height-inch").value) || 0;
            var Seating_height = parseFloat(document.getElementById("Seating_height").value) || 0;
            var Seating_length = parseFloat(document.getElementById("Seating_length").value) || 0;
            var Seating_width = parseFloat(document.getElementById("Seating_width").value) || 0;

            if (isNaN(length_ft) && length_inch) {
                length_ft = length_inch / 12;
            }
            if (isNaN(width_ft) && width_inch) {
                width_ft = width_inch / 12;
            }
            if (isNaN(height_ft) && height_inch) {
                height_ft = height_inch / 12;
            }

            var volume_ft = length_ft * width_ft * height_ft;

            // Ensure variables are defined and not NaN
            if (isNaN(length_ft)) length_ft = 0;
            if (isNaN(length_inch)) length_inch = 0;
            if (isNaN(width_ft)) width_ft = 0;
            if (isNaN(width_inch)) width_inch = 0;
            if (isNaN(height_ft)) height_ft = 0;
            if (isNaN(height_inch)) height_inch = 0;

            // Make sure these variables are defined somewhere in your code
            var width_meter, first_harmonic_W, first_harmonic_WL, first_harmonic_L, first_harmonic_WL_2;
            var first_harmonic_H, first_harmonic_WL_3, first_harmonic_radiance, first_harmonic_sine, first_harmonic_cosine;
            var length_meter, length_mode, second_harmonic_W, second_harmonic_WL, second_harmonic_L, second_harmonic_WL_2;
            var second_harmonic_H, second_harmonic_WL_3, second_harmonic_radiance, second_harmonic_sine, second_harmonic_cosine;
            var height_meter, height_mode, thirde_harmonic_W, thirde_harmonic_WL, thirde_harmonic_L, thirde_harmonic_WL_2;
            var thirde_harmonic_H, thirde_harmonic_WL_3, thirde_harmonic_radiance, thirde_harmonic_sine, thirde_harmonic_cosine;
            var volume_meter, fourth_harmonic_W, fourth_harmonic_WL, fourth_harmonic_L, fourth_harmonic_WL_2, fourth_harmonic_H;
            var fourth_harmonic_WL_3, fourth_harmonic_radiance, fourth_harmonic_sine, fourth_harmonic_cosine;

            // Store the results in a temporary object
            var results = {
                length_ft: length_ft,
                length_inch: length_inch,
                width_ft : width_ft,
                width_inch : width_inch,
                height_ft : height_ft,
                height_inch : height_inch,
                Seating_length: Seating_length,
                Seating_height: Seating_height,
                Seating_width: Seating_width,
            };

            localStorage.setItem("length_ft", results.length_ft);
            localStorage.setItem("length_inch", results.length_inch);
            localStorage.setItem("width_ft", results.width_ft);
            localStorage.setItem("width_inch", results.width_inch);
            localStorage.setItem("height_ft", results.height_ft);
            localStorage.setItem("height_inch", results.height_inch);
            localStorage.setItem("Seating_length", results.Seating_length);
            localStorage.setItem("Seating_height", results.Seating_height);
            localStorage.setItem("Seating_width", results.Seating_width);

        }

    </script>
    <button class="list-button" onclick="toggleList()">☰</button>
    <div class="list-container" id="listContainer">
        <ul>
            <a href="./home.html"><li><b>HOME</b></li></a>
            <hr class="hr_list">
            <a href="./WORKER.html"><li><b>WORKER</b></li></a>
            <hr class="hr_list">
            <a href="./Live Update.html"><li><b>LIVE UPDATES</b></li></a>
            <hr class="hr_list">
            <a href="./RT calculator.html"><li><b>RT 60</b></li></a>
            <hr class="hr_list">
            <a href="./Sound Propagation Loss Calculator.html"><li><b>SPL CALCULATOR</b></li></a>
            <hr class="hr_list">
            <a href="./RH calculator.html"><li><b>RH CALCULATOR</b></li></a>
            <hr class="hr_list">
            <a href="./HT calculator.html"><li><b>HT CALCULATOR</b></li></a>
            <hr class="hr_list">
            <a href="./Phase calculator.html"><li><b>PH CALCULATOR</b></li></a>
            <hr class="hr_list">
            <a href="./Login_page.php"><li class="logout-icon"><i class="fas fa-sign-out-alt"></i><span> Log out</span></li></a>
      </ul>
        </ul>
    </div>

    <div class="overlay" id="overlay" onclick="toggleList()"></div>
    <nav>
        <img src="images/png logo.png" alt="company_logo" id="company_logo">
        <ul class="ul_header">
            <li><a href="./home.html"><b>Home</b></a></li>
            <li><a href="./WORKER.php"><b>WORKER</b></a></li>
            <li><a href="./Live Update.php"><b>Live Updates</b></a></li>
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span> Log out</span></a></li>
    </nav>
    <div class="form-container">
        <h2>Room Description</h2>
        <form action="Room-Details_php.php" method="post">
            <hr><br>
            <div class="row">
                <div class="form-group-2">
                    <label for="length-ft"><b>Length(Ft)<span class="required-asterisk">*</span></b></label>
                    <input type="number" step="any" name="length-ft" id="length-ft" placeholder="Lenght(Ft)" required>
                    </select>
                    <label for="length-inch"><b>Inch</b></label>
                    <input type="number" step="any" name="length-inch" id="length-inch" placeholder="00 (Inch)">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group-2">
                    <label for="width-ft"><b>Width(Ft)<span class="required-asterisk">*</span></b></label>
                    <input type="number" step="any" id="width-ft" name="width-ft" placeholder="Width(Ft)" required>
                    <label for="width-inch"><b>Inch</b></label>
                    <input type="number" step="any" id="width-inch" name="width-inch" placeholder="00 (Inch)">
                </div>
            </div>
            <div class="row">
                <div class="form-group-2">
                    <label for="height-ft"><b>Height(Ft)<span class="required-asterisk">*</span></b></label>
                    <input type="number" step="any" id="height-ft" name="height-ft" placeholder="Height(Ft)" required>
                    <label for="height-inch"><b>Inch</b></label>
                    <input type="number" step="any" id="height-inch" name="height-inch" placeholder="00 (Inch)">
                </div>
            </div>
            <br>
            <div class="form-group">
                    <label for="client_id"><b>Client Id<span class="required-asterisk">*</span></b></label>
                    <input type="text" name="client_id" step="any" id="client_id" placeholder="Client Id" required>
                </div>
            <div class="form-group">
                <label for="Seating_length"><b>Seating position Length(Ft)<span
                class="required-asterisk">*</span></b></label>
                <input type="number" step="any" id="Seating_length" name="Seating_length" placeholder="Length(Ft)" required>
            </div>
            <div class="form-group">
                <label for="Seating_width"><b>Seating position Width(Ft)<span
                            class="required-asterisk">*</span></b></label>
                <input type="number" step="any" id="Seating_width" name="Seating_width" placeholder="Width(Ft)" required>
            </div>

            <div class="form-group">
                <label for="Seating_height"><b>Seating position Height(FT)<span
                            class="required-asterisk">*</span></b></label>
                <input type="number" step="any" id="Seating_height" name="Seating_height" placeholder="Height(Ft)" required>
            </div>
            <div class="form-group">
                <label for="select1"><b>Room Types<span class="required-asterisk">*</span></b></label>
                <select name="room_type" id="room_type" required>
                <option value="" selected disabled>----Room-type----</option>
                    <option value="Drawing Room">Drawing Room</option>
                    <option value="Media Room">Media Room</option>
                    <option value="Dedicated Home Theater">Dedicated Home Theater</option>
                    <option value="Lounge">Lounge</option>
                    <option value="Bedroom">Bedroom</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_seats"><b>No of Seats<span class="required-asterisk">*</span></b></label>
                <input type="number" id="no_seats" name="no_seats" placeholder="No Of Seats" required>
            </div>
            <div class="form-group">
                <label for="avr_or_pre_amplifier"><b>AVR or Pre Amplifier<span
                            class="required-asterisk">*</span></b></label>
                <select name="avr_or_pre_amplifier" id="avr_or_pre_amplifier" required>
                    <option value="" selected disabled>----Select-Room-type----</option>
                    <option value="avr">AVR</option>
                    <option value="pre_amplifier">Pre Amplifier</option>
                </select>
            </div>
            <div class="form-group">
                <label for="speak-config"><b>Speaker Configuration<span class="required-asterisk">*</span></b></label>
                <select name="speak-config" id="select1" required>
                    <option value="" selected disabled>----Select-Speaker-config----</option>
                    <option value="config1">5.1</option>
                    <option value="config2">5.2</option>
                    <option value="config3">5.4</option>
                    <option value="config4">5.1.2</option>
                    <option value="config5">5.1.6</option>
                    <option value="config6">7.1.2</option>
                    <option value="config7">7.1.4</option>
                    <option value="config8">7.1.6</option>
                    <option value="config9">9.1.2</option>
                    <option value="config10">9.1.4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="avr/pre/pro"><b>Make(AVR/Pre/Pro)<span class="required-asterisk">*</span></b></label>
                <select name="avr/pre/pro" id="avr/pre/pro" required>
                <option value="" selected disabled>----AVRPRE/PRO----</option>
                    <option value="Denon">Denon</option>
                    <option value="Marantz">Marantz</option>
                    <option value="Anthem">Anthem</option>
                    <option value="Onkyo">Onkyo</option>
                    <option value="Pioneer">Pioneer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model"><b>ModelAddress<span class="required-asterisk">*</span></b></label>
                <select name="model" id="model" required>
                <option value="" selected disabled>----Select-Room-type----</option>
                    <option value="Denon AVR-X6800H">Denon AVR-X6800H</option>
                    <option value="Denon AVR-X4800H">Denon AVR-X4800H</option>
                    <option value="Denom AVR-X3800H">Denon AVR-X3800H</option>
                    <option value="Denom AVR-X2800H">Denon AVR-X2800H</option>
                    <option value="Denom AVR-X1800H">Denon AVR-X1800H</option>
                    <option value="Denom AVR-X6700H">Denon AVR-X6700H</option>
                    <option value="Denom AVR-X8500H">Denon AVR-X8500H</option>
                    <option value="Denom AVR-X3600H">Denon AVR-X3600H</option>
                </select>
            </div>
            <hr>
            <div class="submit">
                <button type="submit" class="btn-submit" onclick="calculateSum()">SUBMIT</button>
            </div>
        </form>
    </div>
</body>

</html>