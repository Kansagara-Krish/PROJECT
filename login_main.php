<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title> Login Page </title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #512da8;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }



        .container.active .toggle-container {
            transform: translateX(-100%);
        }

        .toggle {
            background-color: #512da8;
            height: 100%;
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        #register {
            background-color: #512da8;
            /* Green */
            border: 1px solid white;
            color: white;
            padding: 10px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition: all 0.4s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 0px 2px white;
            transition: 0.5s;
        }

        #register:hover {
            background-color: rgb(250, 250, 250);
            color: #512da8;
            box-shadow: 0px 0px 8px white;
            border: 2px solid rgb(0, 0, 0);
            transition: 0.5s;

        }

        #register::after {
            content: '→';
            /* Arrow symbol */
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translateY(-50%);
            font-size: 18px;
            /* Adjust the size of the arrow as needed */
            transition: all 0.4s;
            opacity: 0;
            animation: move-arrow 1s infinite;
            /* Infinite animation */
        }

        #register:hover::after {
            left: calc(100% + 10px);
            /* Adjust the distance from the button as needed */
            opacity: 1;
        }

        #register {
            background-color: #512da8;
            /* Green */
            border: 1px solid white;
            color: white;
            padding: 10px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition: all 0.4s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 0px 2px white;
            transition: 0.5s;
        }

        #login:hover {
            background-color: rgb(250, 250, 250);
            color: #512da8;
            box-shadow: 0px 0px 8px white;
            border: 2px solid rgb(0, 0, 0);
            transition: 0.5s;

        }

        #login::after {
            content: '→';
            /* Arrow symbol */
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translateY(-50%);
            font-size: 18px;
            /* Adjust the size of the arrow as needed */
            transition: all 0.4s;
            opacity: 0;
            animation: move-arrow 1s infinite;
            /* Infinite animation */
        }

        #login:hover::after {
            left: calc(100% + 10px);
            /* Adjust the distance from the button as needed */
            opacity: 1;
        }

        /*beat-audio logo*/

        #company_logo {
            display: block;
            margin: 0 auto;
            /* Centers the logo horizontally */
            position: relative;
            height: 30%;
            top: 0;
            /* Ensures it's at the top */
            animation: fadeZoomIn 2s ease-in-out;
        }
        /*mca logo*/

        #company_logo_2 {
            display: block;
            margin: 0 auto;
            /* Centers the logo horizontally */
            position: relative;
            box-shadow: 0 1px 5px 2px #ffffff;        
            height: 30%;
            top: 0;
            height:80px;
            margin-bottom: 10px;
            /* Ensures it's at the top */
            animation: fadeZoomIn 2s ease-in-out;
        }

        @keyframes fadeZoomIn {
            0% {
                opacity: 0;
                /* Start invisible */
                transform: scale(0.5);
                /* Start smaller */
            }

            50% {
                opacity: 0.5;
                /* Half visible */
                transform: scale(1.1);
                /* Slightly larger */
            }

            100% {
                opacity: 1;
                /* Fully visible */
                transform: scale(1);
                /* Normal size */
            }
        }

        @media screen and (min-width:767px) {
            @keyframes move {

                0%,
                49.99% {
                    opacity: 0;
                    z-index: 1;
                }

                50%,
                100% {
                    opacity: 1;
                    z-index: 5;
                }
            }

            .social-icons {
                margin: 20px 0;
            }

            .social-icons a {
                border: 1px solid #ccc;
                border-radius: 20%;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                margin: 0 3px;
                width: 40px;
                height: 40px;
            }

            .toggle-container {
                position: absolute;
                top: 0;
                left: 50%;
                width: 50%;
                height: 100%;
                overflow: hidden;
                transition: all 0.6s ease-in-out;
                border-radius: 150px 0 0 100px;
                z-index: 1000;
            }

            .container.active .toggle-container {
                transform: translateX(-100%);
                border-radius: 0 150px 100px 0;
            }

            .toggle {
                background-color: #512da8;
                height: 100%;
                background: linear-gradient(to right, #5c6bc0, #512da8);
                color: #fff;
                position: relative;
                left: -100%;
                height: 100%;
                width: 200%;
                transform: translateX(0);
                transition: all 0.6s ease-in-out;
            }

            .container.active .toggle {
                transform: translateX(50%);
            }

            .toggle-panel {
                position: absolute;
                width: 50%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                padding: 0 30px;
                text-align: center;
                top: 0;
                transform: translateX(0);
                transition: all 0.6s ease-in-out;
            }

            .toggle-left {
                transform: translateX(-200%);
            }

            .container.active .toggle-left {
                transform: translateX(0);
            }

            .toggle-right {
                right: 0;
                transform: translateX(0);
            }

            .container.active .toggle-right {
                transform: translateX(200%);
            }

            #register {
                background-color: #512da8;
                /* Green */
                border: 1px solid white;
                color: white;
                padding: 10px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition: all 0.4s;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                box-shadow: 0px 0px 2px white;
                transition: 0.5s;
            }

        }

        @media screen and (max-width: 768px) {
            .toogle
            {
                border-top-left-radius: 20%;
            }
            .toggle-panel {
                position: absolute;
                width: 50%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                padding: 0 30px;
                text-align: center;
                top: 0;
                transform: translateX(0);
                transition: all 0.6s ease-in-out;
            }

            .container {
                width: 100%;
                height: 100vh;
                /* Ensure full viewport height for centering */
                display: flex;
                flex-direction: column;
                /* Stack items vertically */
                align-items: center;
                /* Horizontal centering */
                justify-content: center;
                /* Vertical centering */
                position: relative;
                overflow: hidden;
                /* Prevent content from spilling out */
            }

            .toggle-container {
                position: fixed;
                width: 100%;
                height: 50%;
                border-top-left-radius: 20%;
                right: 0px;
                border: 0px;
                top: 50%;
                /* Initially below the form-container */
                z-index: 2;
                /* Below form-container */
                background-color: lightgray;
                transition: top 0.6s ease-in-out, z-index 0.6s;
                /* Smooth swap transitions */
            }

            .form-container {
                position: absolute;
                width: 100%;
                height: 50%;
                top: 0;
                /* Start above toggle-container */
                z-index: 2;
                /* Above toggle-container */
                background: white;
                transition: top 0.6s ease-in-out, z-index 0.6s;
                /* Smooth transitions */
            }

            /* Swapping positions when the container becomes active */
            .container.active .toggle-container {
                top: 0;
                /* Bring toggle-container to the top */
                z-index: 2;
                border-radius: 20px;
                /* Bring it above form-container */
            }

            .container.active .form-container {
                top: 50%;
                /* Move form-container below */
                z-index: 1;
                /* Push it below toggle-container */
            }

            /* Optional: Add animation when swapping */
            @keyframes slideUpDown {
                from {
                    transform: translateY(100%);
                }

                to {
                    transform: translateY(0);
                }
            }

            .container.active .toggle-container,
            .container.active .form-container {
                animation: slideUpDown 0.6s ease-in-out;
            }
        }
    </style>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>LOGIN</h1><br>
                <span>For the Super Admin</span>
                <input type="text" placeholder="Username" required />
                <input type="password" placeholder="Password" required />
                <button>LOG IN</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>LOG IN</h1><br>
                <span>For the Admin</span>
                <input type="text" placeholder="Username" required />
                <input type="password" placeholder="Password" required />
                <a href="#">Forget Your Password?</a>
                <button>LOG IN</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img src="images/MCA LOGO.png" alt="MCA LOGO" id="company_logo_2">
                    <h1>Welcome to the MNC</h1>
                    <p>Be safe your Username and Password is very important</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="images/beat audio LOGO.png" alt="company_logo" id="company_logo">
                    <h1>Welcome to the beat audio</h1>
                    <p>Login your self as Super-Admin by personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>