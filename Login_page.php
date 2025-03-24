<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        body {
            margin: 0;
            width: 100vw;
            height: 100vh;
            background: url("https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832_1280.jpg") no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 90%;
            max-width: 400px;
            height: auto;
            animation: fadeIn 0.8s ease-in-out;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 15px;
        }

        h2 {
            text-transform: uppercase;
            color: aliceblue;
            padding: 20px 0;
            font-size: 2em;
        }

        .form-group {
            position: relative;
            width: 100%;
            border-bottom: 3px solid #fff;
            margin: 18px 0;
        }

        .form-group input {
            background: transparent;
            width: 100%;
            border: none;
            outline: none;
            height: 50px;
            font-size: 1.2em;
            color: aliceblue;
            padding: 0 30px 0 10px;
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 1.2em;
            color: aliceblue;
            transition: 0.5s;
        }

        input:focus~label,
        input:valid~label {
            top: -10px;
            left: 10px;
            font-size: 0.8em;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: aliceblue;
            font-size: 1.2em;
        }

        p {
            text-align: center;
            color: #fff;
            padding: 10px 0;
        }

        p>a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        p>a:hover {
            text-decoration: underline;
            font-style: italic;
        }

        #btn {
            width: 100%;
            height: 50px;
            border-radius: 40px;
            border: none;
            font-size: 1.5em;
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
            cursor: pointer;
            transition: 0.5s;
        }

        .btn-login {
            background-color: #fff;
            transition: 0.5s;
        }
        @media (max-width: 968px) {
            .container
            {
                width: 70%;
                height:auto ;
            }            
        }
        .btn-login:hover {
            background-color: aqua;
            transition: 0.5s;
            box-shadow: 0 0 5px #fff, 0 0 25px #fff;
        }

        .container2 {
            position: fixed;
            top: 10px;
            right: 20px;
            border-radius: 10px;
        }

        .login-btn {
            background-color:rgb(31, 218, 38);
            /* Green */
            border: none;
            color: white;
            padding: 10px 32px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            display: inline-block;
            border-radius: 25px;
            font-size: 16px;
            margin: 4px 2px;
            font-weight: bolder;
            transition-duration: 0.8s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .login-btn::after {
            content: 'Welcome';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            background-color: white;
            transition: transform 0.6s;
            transform: translateY(100%);
        }

        .login-btn:hover::after {
            transform: translateY(0);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <div class="container2">
        <a href="./login_main.php"><button class="login-btn">Log in</button></a>
    </div>
    <div class="container">
        <h2>LOG IN</h2>
        <form action="My_Login_page.php" method="post" id="form">
            <div class="form-group">
                <input type="text" id="company_name" name="company_name" required>
                <label for="username">Company Name</label>
            </div>
            <div class="form-group">
                <input type="text" id="username" name="username" required>
                <label for="username">Username</label>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
                <i class="fa-solid fa-lock"></i>
            </div>

            <p><a href="Forgot Passowrd.html">Forgot password</a></p>

            <input id="btn" type="submit" value="Login" class="btn-login">
        </form>
    </div>
</body>

</html>