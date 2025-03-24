<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORKER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset default margin and padding */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            height: 100%;
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

        .list-container li {
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
            text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.7);
            display: block;
            padding: 12px 20px;
            font-family: "Noto Serif", serif;
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

        body.blurred *:not(.list-button):not(.list-container):not(.list-container *) {
            filter: blur(5px);
            /* Apply blur effect */
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

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .form-group input[type="text"],
        .form-group select {
            flex: 1;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
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
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            max-width: 500px;
        }

        .form-container {
            /* Adjust this value if needed */
            background: #fffAfA;
            padding: 20px;
            /*margin-top: 20px;*/
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
            text-align: right;
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

        @media (min-width: 969px) {
            .form-container {
                margin-top: 50px;
            }

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
                flex: 0 0 200px;
                font-size: 20px;
                /* Adjust the width of the label as needed */
            }

            .form-group input[type="text"],
            .form-group input[type="tel"],
            .form-group select {
                flex: 1;
                max-width: 250px;
            }

            .form-group input[type="email"] {
                flex: 1;
                max-width: 200px;
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
            height: 3px;
            /* Adjust the height of the line */
            background: linear-gradient(to right, #000000, #7b0808, #f0f0f0);
            border: none;
            width: 150px;
        }

        #company_logo {
            height: 100%;
            margin-left: 30px;
            display: flex;
            align-items: center;
            position: absolute;
            left: 0;
        }

        .form-group label .required-asterisk {
            color: red;
            font-size: 18px;
            /* Adjust the size as needed */
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
    </style>
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
        function validateForm() { const name = document.getElementById('carpenter_name').value; const contactNumber = document.getElementById('carpenter_contact_number').value; const contactErrorMessage = document.getElementById('contact-error-message'); if (name && !contactNumber) { contactErrorMessage.style.display = 'block'; return false; } else { contactErrorMessage.style.display = 'none'; } return true; }    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <button class="list-button" onclick="toggleList()">☰</button>
    <div class="list-container" id="listContainer">
        <ul>
            <a href="./home.html">
                <li><b>Home</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Room-Details.php">
                <li><b>ROOM</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Live Update.php">
                <li><b>LIVE UPDATES</b></li>
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
            <a href="./Login_page.php">
                <li class="logout-icon"><i class="fas fa-sign-out-alt"></i><span>Log out</span></li>
            </a>
            <hr class="hr_list">
        </ul>
    </div>
    <div class="overlay" id="overlay" onclick="toggleList()"></div>
    <nav>
        <img src="images/png logo.png" alt="company_logo" id="company_logo">
        <ul>
            <li><a href="./home.html"><b>Home</b></a></li>
            <li><a href="./Room-Details.php"><b>ROOM</b></a></li>
            <li><a href="./Live Update.php"><b>Live Updates</b></a></li>
            <li class="logout-icon">
                <a href="./Login_page.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log out</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="form-container">
        <form id="form"  method="POST">
            <div class="form-group">
                <label for="client_id"><b>Client Id<span class="required-asterisk">*</span></b></label>
                <input type="text" name="client_id" step="any" id="client_id" placeholder="Client Id">
            </div>
            <h2><b>Carpenter Details</b></h2>
            <hr><br>
            <div class="form-group">
                <label for="carpenter_name"><b>Name<span class="required-asterisk">*</span></b></label>
                <input type="text" name="carpenter_name" id="carpenter_name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="carpenter_contact"><b>Contact Number<span
                            class="required-asterisk">*</span></b></label>
                <input name="carpenter_contact" type="tel" id="carpenter_contact"
                    placeholder="contact Number" required>
            </div>
            <div class="form-group">
                <label for="Emergency Contact"><b>Alternat Contact Number</b></label>
                <input type="tel" name="carpenter_alternate_contact" id="carpenter_alternate_contact"
                    placeholder="Alternat contact Number">
            </div>
            <div class="form-group">
                <label for="carpenter_email" id="carpenter_email" placeholder="Email Address"><b>Email
                        Address<span class="required-asterisk">*</span></b></label>
                <input type="text" name="carpenter_email" id="carpenter_email" placeholder="Email" required>
            </div>
            <hr>
            <h2><b>Electrician Details</b></h2>
            <hr><br>
            <div class="form-group">
                <label for="electrician"><b>Name<span class="required-asterisk">*</span></b></label>
                <input type="text" name="electrician_name" id="carpenter_name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="electrician"><b>Contact Number<span class="required-asterisk">*</span></b></label>
                <input name="electrician_contact" type="tel" id="electrician" placeholder="Contact Number"
                    required>
            </div>
            <div class="form-group">
                <label for="Emergency Contact"><b>Alternate Contact Number</b></label>
                <input type="tel" name="electrician_alternate_contact" id="electrician_alternate_contact"
                    placeholder="Alternat Contact Number">
            </div>
            <div class="form-group">
                <label for="electrician_email" id="electrician_email" placeholder="Email Address"><b>Email
                        Address<span class="required-asterisk">*</span></b></label>
                <input type="text" name="electrician_email" id="electrician_email" placeholder="Email" required>
            </div>
            <hr>
            <h2><b>Plumber Details</b></h2>
            <hr><br>
            <div class="form-group">
                <label for="plumber_name"><b>Name<span class="required-asterisk">*</span></b></label>
                <input type="text" name="plumber_name" id="plumber_name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="plumber_contact"><b>Contact Number<span
                            class="required-asterisk">*</span></b></label>
                <input name="plumber_contact" type="tel" id="plumber_contact" placeholder="Contact Number"
                    required>
            </div>
            <div class="form-group">
                <label for="Emergency Contact"><b>Alternat Contact Number</b></label>
                <input type="tel" name="plumber_alternate_contact" id="plumber_alternate_number"
                    placeholder="Contact Number">
            </div>
            <div class="form-group">
                <label for="plumber_email" id="plumber_email" placeholder="Email Address"><b>Email
                        Address<span class="required-asterisk">*</span></b></label>
                <input type="text" name="plumber_email" id="plumber_email" placeholder="Email" required>
            </div>
            <hr>
            <h2><b>Painter Details</b></h2>
            <hr><br>
            <div class="form-group">
                <label for="painter_name"><b>Name<span class="required-asterisk">*</span></b></label>
                <input type="text" name="painter_name" id="painter_name" placeholder="Painter Name" required>
            </div>
            <div class="form-group">
                <label for="Painter_contact"><b>Contact Number<span
                            class="required-asterisk">*</span></b></label>
                <input name="painter_contact" type="tel" id="painter_contact" placeholder="Contact Number"
                    required>
            </div>
            <div class="form-group">
                <label for="Emergency Contact"><b>Alternat Contact Number</b></label>
                <input type="tel" name="painter_alternate_contact" id="painter_alternate_number"
                    placeholder="Alternat Contact Number">
            </div>
            <div class="form-group">
                <label for="paniter_email" id="painter_email" placeholder="Email Address"><b>Email
                        Address<span class="required-asterisk">*</span></b></label>
                <input type="text" name="painter_email" id="painter_email" placeholder="Email" required>
            </div>
            <hr>
            <div class="submit">
                <button type="submit" class="btn-submit" onclick="validateAndSubmit(event)">SUBMIT</button>
            </div>
        </form>
    </div>
    </div>
    <script>
       function validateAndSubmit(event) {
    event.preventDefault(); // Prevent default form submission
    let regex = /^\d{10}$/; // Regular expression for exactly 10-digit numbers

    // Get all input values
    let carpenter_contact = document.getElementById("carpenter_contact").value.trim();
    let carpenter_alternate_contact = document.getElementById("carpenter_alternate_number")?.value.trim();

    let electrician_contact = document.getElementById("electrician").value.trim();
    let electrician_alternate_contact = document.getElementById("electrician_alternate_contact")?.value.trim();

    let painter_contact = document.getElementById("painter_contact").value.trim();
    let painter_alternate_contact = document.getElementById("painter_alternate_number")?.value.trim();

    let plumber_contact = document.getElementById("plumber_contact").value.trim();
    let plumber_alternate_contact = document.getElementById("plumber_alternate_number")?.value.trim();

    // Check if at least one main contact is filled & valid
    if (!carpenter_contact && !electrician_contact && !painter_contact && !plumber_contact) {
        alert("❌ Please insert at least one required contact number!");
        return;
    }

    if (!regex.test(carpenter_contact)) {
        alert("❌ Carpenter Contact Number must be exactly 10 digits!");
        return;
    }
    if (!regex.test(electrician_contact)) {
        alert("❌ Electrician Contact Number must be exactly 10 digits!");
        return;
    }
    if (!regex.test(painter_contact)) {
        alert("❌ Painter Contact Number must be exactly 10 digits!");
        return;
    }
    if (!regex.test(plumber_contact)) {
        alert("❌ Plumber Contact Number must be exactly 10 digits!");
        return;
    }

    // Check alternate numbers only if provided
    if (carpenter_alternate_contact && !regex.test(carpenter_alternate_contact)) {
        alert("❌ Carpenter Alternate Contact Number must be exactly 10 digits!");
        return;
    }
    if (electrician_alternate_contact && !regex.test(electrician_alternate_contact)) {
        alert("❌ Electrician Alternate Contact Number must be exactly 10 digits!");
        return;
    }
    if (painter_alternate_contact && !regex.test(painter_alternate_contact)) {
        alert("❌ Painter Alternate Contact Number must be exactly 10 digits!");
        return;
    }
    if (plumber_alternate_contact && !regex.test(plumber_alternate_contact)) {
        alert("❌ Plumber Alternate Contact Number must be exactly 10 digits!");
        return;
    }

    // Submit the form if all validations pass
    document.getElementById("form").action = "Worker Details_php.php";
    document.getElementById("form").submit();
}

    </script>
</body>

</html>