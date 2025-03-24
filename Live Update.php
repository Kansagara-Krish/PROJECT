<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Live Upadate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <style>
        html {
            position: relative;
            overflow-x: hidden !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            margin: 0;
            padding: 0;
            position: relative;

        }

        .container-1 {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            /* Add padding for spacing */
            box-sizing: border-box;
            flex-wrap: wrap;
            /* Allow wrapping of child elements */
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            margin: 0 auto;
            /* Center the container horizontally */
            height: auto;
            /* Adjust height dynamically */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-sizing: border-box;
        }

        h1 {
            margin-bottom: 10px;
        }

        #live-time {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            padding-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        textarea {
            width: 90%;
            height: 50%;
            padding: 10px;
            border: 1px solid #353434;
            box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.4);
            border-radius: 5px;
            resize: none;
            height: 20vh;
            margin-bottom: 20px;
            font-size: 16px;
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
            margin-top: 0px;
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

        /* Media query for devices with max-width of 600px */
        @media (max-width: 968px) {

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
                display: block !important;
                font-size: 20px;
                padding: 10px 10px;
                margin-left: 8px;
            }

            select.mobile {
                display: block;
            }

            select.laptop {
                display: none;
            }

            .container {
                width: 100%;
                padding: 0px;
                height: auto;
            }

            h1 {
                font-size: 24px;
            }

            #live-time {
                font-size: 16px;
            }

            label {
                font-size: 16px;
            }

            textarea {
                height: 100px;
                font-size: 14px;
            }

            .container-1 {
                width: 100%;
                justify-content: center;
                margin-left: 0px;
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

            .container {
                width: 70%;
                padding: 0px;
                height: auto;
                margin-top: 5vh;
            }

            .scroll-list {
                width: 100%;
                max-width: 1000px;
                overflow: hidden;
            }

            .form1 {
                width: 100%;
                max-width: 600px;
                /* Adjust the max width as needed */
                padding: 30px;
                background-color: #ffffff;
                /* Background color for the form */
                border-radius: 10px;
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
            font-family: "Noto Serif", serif;
            text-decoration: none;
            color: #eeeeee;
            text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.7);
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

        body.blurred *:not(.list-button):not(.list-container):not(.list-container *) {
            filter: blur(5px);
            /* Apply blur effect */
        }

        .list-button {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: larger;
            padding: auto 20px;
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

        .hr_list {
            height: 3px;
            width: 150px;
            /* Adjust the height of the line */
            background: linear-gradient(to right, #000000, #7b0808, #f0f0f0);
            border: none;
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

        @keyframes slideUp {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0%);
                opacity: 1;
            }
        }

        #timer {
            display: inline-block;
            animation: slideUp 2s ease-in-out forwards;
            font-size: 20px;
            color: red;
            margin-top: 5px;
            margin-bottom: 0px;
        }


        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            border-radius: 20px;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #353434;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.10);
            border-color: 10px solid #353434;
            border-radius: 25px;
            text-align: center;
            /* Could be more or less, depending on screen size */
        }

        .p1 {
            font-size: 20px;
            font-weight: bolder;
            text-align: center;
        }

        .yes-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 15px;
            font-weight: bold;
            transition: 0.8s;
        }

        .no-button {
            background-color: rgb(194, 80, 72);
            color: white;
            padding: 5px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 15px;
            font-weight: bold;
            transition: 0.8s;
        }

        .yes-button:hover {
            background-color: rgb(0, 251, 13);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: 0.8s;
            color: black;
            border-color: 2px solid black;
        }

        .no-button:hover {
            background-color: rgb(255, 4, 0);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: 0.8s;
            color: black;
        }

        .model-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .timestamp {
            font-weight: bold;
        }

        .description {
            padding-left:
        }

        /*Code to make scrollbar*/
        /* General styling */
        .wrapper {
            display: flex;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(-225deg, #1e3c72 0%, #2a5298 50%, #00c6ff 100%);
        }


        @keyframes scroll-up {
            0% {
                transform: translateY(0);
                /* Start position */
            }

            100% {
                transform: translateY(-100%);
                /* Scroll out of view */
            }
        }

        #scrollList {
            overflow-y: auto;
            /* Enable vertical scrolling */
            display: block;
            /* Ensure visibility */
        }

        .scroll-list {
            width: 90%;
            max-width: 1200px;
            padding: 15px;
            padding-left: 0px;
            margin-top: 0px;
            background: #ffffff;
            border-radius: 12px;
            height: fit-content;
            /* margin-left: auto;
            margin-right: auto;*/
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            overflow-y: auto;
            /* Enable vertical scrolling */
            box-sizing: border-box;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            .scroll-list {
                margin-left: 0px;
                padding-top: 20px;
            }

            nav .logout span {
                display: none;
            }

            nav .logout a {
                font-size: 1.5rem;
            }

            .modal-content {
                width: 80%;
                margin: 20% auto;
            }

            .yes-button,
            .no-button {
                font-size: 14px;
                padding: 5px 15px;
            }
        }

        .scroll-list__item p {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            padding-left: 10px;
            font-style: "Noto Serif", serif;
            padding-right: 10px;
        }

        .scroll-list__item .time {
            font-weight: bolder;
            color:rgb(255, 255, 255);
        }

        .scroll-list__wrp {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            height: 300px;
        }

        .scroll-list__wrp::-webkit-scrollbar {
            display: none;
        }

        .card {
            margin-bottom: 30px
        }

        .scroll-list__wrp::-webkit-scrollbar-thumb {
            background: rgb(198, 198, 198);
            border-radius: 8px;
        }

        .scroll-list__item {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color:rgb(255, 255, 255);
            padding: 0px;
        /*    padding-left: 5px;
            padding-right: 5px;
         */   border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 100%;
            font-weight: 200px;
            max-width: 600px;
            font-family: "Noto Serif", serif;
            height: auto;
        }

        .scroll-list__item.visible {
            opacity: 1;
            transform: scale(1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-list__item.visible {
            animation: fadeInUp 0.5s ease-in-out;
        }

        .scroll-list__item.item-hide {
            opacity: 0;
            transform: scale(0.7);
        }

        .scroll-list__item.item-focus {
            opacity: 1;
            transform: scale(1);
        }

        .scroll-list__item.item-next {
            opacity: 1;
            transform: scale(1);
        }

        .scroll-list__item.item-next+.scroll-list__item {
            opacity: 1;
            transform: scale(1);
        }

        .scroll-list__item:last-child {
            margin-bottom: 140px;
        }

        @media screen and (max-width: 768px) {
            .scroll-list__wrp {
                padding: 25px;
            }

            nav .logout-icon a i {
                margin-right: 5px;
            }

            .scroll-list__item {
                max-width: 95%;
                font-size: 14px;
            }
        }

        @media screen and (min-width:768px) {
            .scroll-list {
                padding-left: 20px;
            }
        }

        .scroll-list__wrp .scrollbar-track {
            display: none !important;
        }

        .scroll-list__wrp {
            width: 100%;
            scroll-behavior: smooth;
        }



        .description {
            white-space: nowrap;
            /* Prevent line breaks */
            overflow: hidden;
            /* Hide overflowing text */
            text-overflow: ellipsis;
            /* Add ellipsis (...) to indicate clipped text */
        }

        nav .logout {
            margin-left: auto;
        }

        nav .logout-icon {
            margin-left: auto;
        }


        .scroll-list::-webkit-scrollbar {
            display: none;
            /* Hides the scrollbar for WebKit browsers like Chrome and Safari */
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

        document.addEventListener('DOMContentLoaded', function () {
            const greetingElement = document.getElementById('greeting');
            const liveTimeElement = document.getElementById('live-time');
            const currentHour = new Date().getHours();

            let greeting;
            if (currentHour < 12) {
                greeting = 'Good Morning';
            } else if (currentHour < 18) {
                greeting = 'Good Afternoon';
            } else {
                greeting = 'Good Evening';
            }

            greetingElement.textContent = `${greeting}, have a nice day!`;
            function updateTime() { const now = new Date(); const year = now.getFullYear(); const month = now.toLocaleString('default', { month: 'long' }); const date = now.getDate(); const timeString = now.toLocaleTimeString(); liveTimeElement.textContent = `Current Date & Time: ${month} ${date}, ${year} - ${timeString}`; } // Update time every second 
            setInterval(updateTime, 1000);
            updateTime(); // Initial call to display the time immediately }); // Initial call to display the time immediately
        });


        // this is code of timer and logic to submit the data

        document.addEventListener('DOMContentLoaded', () => {
            const liveUpdateForm = document.getElementById("liveUpdateForm");
            const submitButton = document.getElementById("submitButton");
            const timerDiv = document.getElementById("timer");
            const confirmationModal = document.getElementById("confirmationModal");
            const confirmYes = document.getElementById("confirmYes");
            const confirmNo = document.getElementById("confirmNo");
            const closeModal = document.getElementById("closeModal");
            const updateConfirmationModal = document.getElementById("updateConfirmationModal");
            const updateConfirmYes = document.getElementById("updateConfirmYes");
            const updateConfirmNo = document.getElementById("updateConfirmNo");
            let timer;
            let shouldConfirm = false; // Set to false initially
            let timeLeft = 120; // 2 minutes in seconds
            let isTimerRunning = false;
            let isFormSubmitting = false; // Add a flag to check if the form is already submitting

            submitButton.addEventListener("click", function (event) {
                if (isFormSubmitting) return; // Prevent submitting multiple times
                if (isTimerRunning) {
                    submitButton.disabled = true;
                    clearInterval(timer); // Stop the timer when the update button is pressed
                    isTimerRunning = false;
                    shouldConfirm = false;
                    timerDiv.textContent = ""; // Clear the timer display
                    storeDataAndRedirect(); // Send the data to the PHP script
                } else {
                    shouldConfirm = true; // Set shouldConfirm to true when the timer starts
                    startTimer();
                }
            });

            // Handle internal link clicks
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (event) {
                    if (shouldConfirm) {
                        event.preventDefault(); // Prevent the link from navigating
                        showModal();
                    }
                });
            });

            window.addEventListener("beforeunload", function (event) {
                if (shouldConfirm) {
                    event.preventDefault(); // Prevent the page from unloading
                    event.returnValue = ''; // Required for most browsers to show confirmation
                    showModal();
                    return ""; // Required for most browsers
                }
            });

            confirmYes.addEventListener("click", function () {
                if (isFormSubmitting) return; // Prevent submitting multiple times
                clearInterval(timer);
                shouldConfirm = false;
                liveUpdateForm.submit();
                isFormSubmitting = true; // Set the flag after form submission
                closeModalDialog();
            });

            confirmNo.addEventListener("click", function () {
                closeModalDialog();
            });

            closeModal.addEventListener("click", function () {
                closeModalDialog();
            });

            updateConfirmYes.addEventListener("click", function () {
                if (isFormSubmitting) return; // Prevent submitting multiple times
                clearInterval(timer);
                shouldConfirm = false;
                storeDataAndRedirect();
                isFormSubmitting = true; // Set the flag after form submission
                closeUpdateConfirmationModal();
            });

            updateConfirmNo.addEventListener("click", function () {
                closeUpdateConfirmationModal();
            });

            function showModal() {
                confirmationModal.style.display = "block";
            }

            function closeModalDialog() {
                confirmationModal.style.display = "none";
            }

            function showUpdateConfirmationModal() {
                updateConfirmationModal.style.display = "block";
            }

            function closeUpdateConfirmationModal() {
                updateConfirmationModal.style.display = "none";
            }

            function startTimer() {
                isTimerRunning = true;

                // Disable the submit button and start timer
                submitButton.disabled = true;

                // Re-enable the submit button after 2 seconds
                setTimeout(function () {
                    submitButton.disabled = false;
                }, 500);

                timer = setInterval(function () {
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        isTimerRunning = false;
                        shouldConfirm = false; // Disable the confirmation prompt after timer ends
                        submitButton.disabled = false;
                        timerDiv.textContent = ""; // Clear the timer display
                        storeDataAndRedirect(); // Auto-submit the form if time is up
                    } else {
                        let minutes = Math.floor(timeLeft / 60);
                        let seconds = timeLeft % 60;
                        timerDiv.textContent = `You can Update your Description Within: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                        timeLeft--;
                    }
                }, 1000);
            }

            function storeDataAndRedirect() {
                if (isFormSubmitting) return; // Prevent multiple submissions
                isFormSubmitting = true; // Set the flag before form submission

                // Send data to PHP script
                const formData = new FormData(liveUpdateForm);

                fetch("Live Update_php.php", {
                    method: "POST",
                    body: formData
                }).then(response => {
                    return response.text();
                }).then(data => {
                    console.log(data); // Log the response from the PHP script, if needed
                    window.location.href = "Thanks.html"; // Redirect user to thank.html
                }).catch(error => {
                    console.error("Error:", error);
                });
            }
        });

        // code to show data

        document.addEventListener('DOMContentLoaded', () => {
            const valueButton = document.getElementById('valueButton');
            const scrollList = document.querySelector('.scroll-list'); // Target the scroll list element
            valueButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent any default behavior
                scrollList.style.display = 'block'; // Make the scroller visible
            });
        });


        // code of scroller
        document.addEventListener("DOMContentLoaded", function () {
            const items = document.querySelectorAll('.scroll-list__item');

            const scrollCallback = function () {
                for (const item of items) {
                    if (item.getBoundingClientRect().top < window.innerHeight) {
                        item.classList.add('visible');
                    }
                }
            };

            window.addEventListener('scroll', scrollCallback);

            // Trigger the scrollCallback initially to reveal items in view on page load
            scrollCallback();
        });


        document.addEventListener('DOMContentLoaded', () => {
            const scrollList = document.getElementById('scrollList');

            // Set the max-height to 100% of the viewport height
            function adjustScrollerHeight() {
                const viewportHeight = window.innerHeight;
                scrollList.style.maxHeight = `${viewportHeight}px`; // 100% of viewport height
            }

            adjustScrollerHeight(); // Initial adjustment
            window.addEventListener('resize', adjustScrollerHeight); // Re-adjust on window resize
        });

        /**/

    </script>
    <button class="list-button" onclick="toggleList()">☰</button>
    <div class="list-container" id="listContainer">
        <ul>
            <a href="./home.html">
                <li><b>Home</b></li>
            </a>
            <hr class="hr_list">
            <a href="./WORKER.html">
                <li><b>WORKER</b></li>
            </a>
            <hr class="hr_list">
            <a href="./Room-Details.html">
                <li><b>ROOM</b></li>
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
                <li class="logout-icon"><i class="fas fa-sign-out-alt"></i><span> Log
                        out</span></li>
            </a>
        </ul>
    </div>
    <div class="overlay" id="overlay" onclick="toggleList()"></div>
    <nav>
        <img src="images/png logo.png" alt="company_logo" id="company_logo">
        <ul>
            <li><a href="./home.html"><b>Home</b></a></li>
            <li><a href="./Room-Details.html"><b>ROOM</b></a></li>
            <li><a href="./worker.php"><b>worker</b></a></li>
            <li class="logout-icon"><a href="./Login_page.php"><i class="fas fa-sign-out-alt"></i><span> Log
                        out</span></a></li>
        </ul>
    </nav>
    <div class="container-1">
        <div class="container">
            <form method="POST" id="liveUpdateForm" action="Live Update_php.php" class="form1">
                <h1 id="greeting"></h1>
                <div id="live-time"></div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" placeholder="Today's Update " required></textarea>
                <div id="timer"></div>
                <div class="submit">
                    <button type="submit" class="btn-submit" id="submitButton">Submit</button>
                </div>
            </form>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">LIVE UPDATES</h2>
                    </div>
                    <form id="liveUpdateForm" action="Live Update_show_php.php" method="post">
                        <button type="button" id="valueButton" class="btn-submit">SHOW</button>
                    </form>
                    <div class="scroll-list" id="scrollList" style="display: none;"> <!-- Initially hidden -->
                        <div class="scroll-list__wrp js-scroll-content js-scroll-list">
                            <?php
                            $conn = new mysqli('localhost', 'root', '', 'beat audio');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Modify the query to order results by the most recently inserted data
                            $sql = "SELECT time, description FROM live_update ORDER BY time DESC";
                            $result = $conn->query($sql);
                            if (!$result) {
                                die("Query failed: " . $conn->error); // Output the error for debugging
                            }

                            if ($result->num_rows != 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="scroll-list__item js-scroll-list-item">';
                                    echo '<p class="time">' . $row['time'] . '</p>';
                                    echo '<p>' . $row['description'] . '</p>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="scroll-list__item js-scroll-list-item">';
                                echo '<p class="text-center">No data found</p>';
                                echo '</div>';
                            }

                            $conn->close();
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p class="p1">Are you sure you want to navigate away from this page? Want to store the data!!</p>
            <div class="modal-buttons">
                <button id="confirmYes" class="modal-button yes-button">Yes</button>
                <button id="confirmNo" class="modal-button no-button">No</button>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.3.1/smooth-scrollbar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.3.1/plugins/overscroll.js"></script>

</body>

</html>