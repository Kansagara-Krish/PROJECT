
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Client Detail</title>
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

        @media (max-width: 768px) {
            .list-button {
                font-size: 14px;
                padding: 10px 12px;
                margin-left: 8px;
            }

            .list-container {
                width: 50%;
                /* Make list-container take up half of the screen */
            }

            .list-container li {
                height: 8vh;
                margin-top: 10px;
                align-items: center;
            }

            .list-container li a {
                text-decoration: none;
                color: #000000;
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
                width: 100%;
                max-width: 200px;
            }
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
            padding-top: 30px;
        }

        .list-container li:last-child {
            border-bottom: none;
        }

        .list-container ul li {
            display: flex;
            height: 13vh;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: larger;
        }

        .list-container ul li a {
            text-decoration: none;
            color: white;
            text-shadow: 0px 0px 3px rgba(253, 252, 252, 0.5), 0 0 10px rgba(255, 255, 255, 0.7);
            display: block;
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
            left: 0;
            width: 100%;
            height: 60px;
            transition: 1.5s;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 0 0 8px 8px;
            /* Round bottom corners */
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            display: inline-flex;
            padding: 0 10px;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* Ensure it is above other content */
        }

        nav:hover {
            height: 12vh;
            transition: 0.5s;
            font-size: larger;
        }


        nav ul {
            float: center;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
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
            font-size: large;
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
            height: 70px;
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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 50px rgb(0, 0, 0);
            width: 80%;
            justify-content: center;
            text-align: center;
            max-width: 500px;
        }

        .form-container h2 {
            color: #48cae4;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .form-group label {
            margin-right: 10px;
            font-size: 16px;
            min-width: 100px;
            max-width: 200px;
            width: auto;
            color: #000000;
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

        @media (max-width: 768px) {
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
                width: 100%;
                max-width: 200px;

            }

            .form-group input[type="text"],
            .form-group select,
            .form-group input[type="email"],
            .form-group input[type="tel"] {
                width: 80%;
            }

            nav .logout span {
                display: none;
            }

            nav .logout a {
                font-size: 1.5rem;
                /* Adjust icon size as needed */
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

            .form-group {
                flex-direction: row;
            }

            .form-group label {
                flex: 0 0 150px;
                font-size: 18px;
                /* Adjust the width of the label as needed */
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

            nav .logout-icon a i {
                margin-right: 5px;
            }
        }

        .submit {
            padding-top: 50px;
            font-size: larger;
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
            width: 150px;
            height: 3px;
            /* Adjust the height of the line */
            background: linear-gradient(to right, #000000, #7b0808, #f0f0f0);
            border: none;
        }

        .form-group label .required-asterisk {
            color: red;
            font-size: 18px;
            /* Adjust the size as needed */
        }

        #company_logo {
            height: 100%;
            margin-left: 30px;
            display: flex;
            align-items: center;
            position: absolute;
            left: 0;
        }
        /*logout button code for nav*/ 
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
    </style>
</head>

<body>
    <script>
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

        // Initialize the state correctly
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
    </script>
    <button class="list-button" onclick="toggleList()">☰</button>
    <div class="list-container" id="listContainer">
        <ul>
            <li><a href="./home_2.html"><b>Home</b></a></li>
            <hr class="hr_list">
            <li><a href="./worker.php"><b>WORKER</b></a></li>
            <hr class="hr_list">
            <li><a href="Room-Details.html"><b>Room</b></a></li>
            <hr class="hr_list">
            <li><a href="./Live Update.php"><b>Live Updates</b></a></li>
            <hr class="hr_list">
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a></li>
        </ul>
    </div>

    <div class="overlay" id="overlay" onclick="toggleList()"></div>
    <nav>
        <img src="images/png logo.png" alt="company_logo" id="company_logo">
        <ul>
            <li><a href="./home_2.html"><b>HOME</b></a></li>
            <li><a href="./worker.php"><b>WORKER</b></a></li>
            <li><a href="./Room-Details.html"><b>Room</b></a></li>
            <li><a href="./Live Update.php"><b>Live Updates</b></a></li>
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span>Log
            out</span></a></li>
    </nav>
    <section class="sec2"></section>
    <div class="form-container">
        <h2><b>Client Details</b></h2>
        <hr>
        <form id="form" method="POST">
        <div class="form-group">
            <br>
            <label for="client_name"><b>Client Name<span class="required-asterisk">*</span></b></label>
            <input type="text" name="client_name" id="client_name" placeholder="Client Name" required>
        </div>
        <div class="form-group">
            <label for="contact_number"><b>Contact Number<span class="required-asterisk">*</span></b></label>
            <input type="tel" name="contact_number" id="contact_number" placeholder="Contact Number" required>
        </div>
        <div class="form-group">
            <label for="alternat_contact"><b>Alternet Contact</b></label>
            <input name="alternat_contact" type="tel" id="alternat_contact" placeholder="Alternate Contact">
        </div>
        <div class="form-group">
            <label for="client_e_mail"><b>Client E-mail<span class="required-asterisk">*</span></b></label>
            <input type="text" name="client_email" id="client_e_mail" placeholder="Email" class="email" required>
        </div>
        <hr>
        <h2><b>Client Address</b></h2>
        <hr>
        <div class="form-group">
            <label for="street"><b>Street/Society<span class="required-asterisk">*</span></b></label>
            <input name="street" type="text" id="street" placeholder="Street/Society" required>
        </div>
        <div class="form-group">
            <label for="house_number"><b>House Number<span class="required-asterisk">*</span></b></label>
            <input name="house_number" type="text" id="house_number" placeholder="House Number" required>
        </div>
        <div class="form-group">
            <label for="landmark"><b>Landmark<span class="required-asterisk">*</span></b></label>
            <input type="text" name="landmark" id="landmark" placeholder="Landmark" required>
        </div>
        <div class="form-group">
            <label for="village"><b>Village<span class="required-asterisk">*</span></b></label>
            <input type="text" name="village" id="village" placeholder="Village" required>
        </div>
        <div class="form-group">
            <label for="district"><b>District<span class="required-asterisk">*</span></b></label>
            <input type="text" name="district" id="district" placeholder="District" required>
        </div>
        <div class="form-group">
            <label for="city"><b>City<span class="required-asterisk">*</span></b></label>
            <input type="text" name="city" id="city" placeholder="City" required>
        </div>
        <div class="form-group">
            <label for="state"><b>State<span class="required-asterisk">*</span></b></label>
            <select name="state" id="state" class="state-select" required>
                <option value="" disabled selected>Select State</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pin_code"><b>Pin code<span class="required-asterisk">*</span>:</b></label>
            <input type="text" name="pin_code" id="pin_code" placeholder="Pin code" required>
        </div>
        <hr>
        <h2><b>Interior Designer Details</b></h2>
        <hr>
        <div class="form-group">
            <label for="interior_designer_name"><b>Name of Interior Designer:</b></label>
            <input type="text" name="interior_designer_name" id="interior_designer_name"
                placeholder="Interior Designer Name">
        </div>
        <div class="form-group">
            <label for="interior_contact"><b>Interior Contact</b></label>
            <input type="tel" name="interior_contact" id="interior_contact"
                placeholder="Interior Contact">
        </div>
        <div class="form-group">
            <label for="interior_alternate_contact"><b>Alternat Contact</b></label>
            <input type="tel" name="interior_alternate_contact" id="interior_alternate_contact"
                placeholder="Alternate Contact">
        </div>
        <div class="form-group">
            <label for="interior_designer_email"><b>Interior Designer Email Address:</b></label>
            <input type="text" name="interior_designer_email" id="interior_designer_email"
                placeholder="E-mail">
            </div>  
        <hr>
        <div class="submit">
            <button class="btn-submit" type="submit" onclick="validateContactNumbers(event);">SUBMIT</button>
        </div>
        </form>
        </div>
        <script>
                function disableButton() {
            var btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = "Submitted";
            alert("Button is off");
        }
        function validateContactNumbers(event) {
    // Prevent default form submission
    event.preventDefault();

    let mobileNumber = document.getElementById("contact_number").value.trim();
    let alternateNumber = document.getElementById("alternat_contact").value.trim();
    let interiorNumber = document.getElementById("interior_contact").value.trim();
    let interiorAltNumber = document.getElementById("interior_alternate_contact").value.trim();

    let regex = /^\d{10}$/; // Regular expression for 10 digits

    // Validate client contact numbers
    if (!regex.test(mobileNumber)) {
        alert("❌ Client Number is invalid!");
        return;
    }
    if (alternateNumber.length > 0 && !regex.test(alternateNumber)) {
        alert("❌ Client Alternate Contact Number is invalid!");
        return;
    }

    // Validate interior contact numbers
    if ((interiorNumber.length > 0 && !regex.test(interiorNumber)) || 
        (interiorAltNumber.length > 0 && !regex.test(interiorAltNumber))) {
        alert("❌ Interior Contact Number is invalid!");
        return;
    }

    // If all validations pass, alert success and allow form submission
    document.getElementById("form").action = "./Client Details_php.php";
    document.getElementById("form").submit();
}


        function sendData() {
            var company = localStorage.getItem("company");

            if (company) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Client Details_php.php", true); // Point to the PHP file
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                var responseElement = document.getElementById("response");
                if (responseElement) {
                    responseElement.innerHTML = xhr.responseText;
                } else {
                    console.error("Element 'response' not found.");
                }
                }
            };
            xhr.send("company=" + company);
            } else {
            var responseElement = document.getElementById("response");
            if (responseElement) {
                responseElement.innerHTML = "No database name found in localStorage.";
            } else {
                console.error("Element 'response' not found.");
            }
            }
        }
        </script>
    </body>

    </html>
