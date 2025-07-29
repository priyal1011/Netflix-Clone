<?php
$servername = "localhost";
$username = "root";
$password = "manan";
$dbname = "manan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = "";
$password = "";
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM netflix WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Password is correct, redirect to another page
            header("Location: main.html");
            exit();
        } else {
            // Password is incorrect
            $loginError = "Incorrect password";
            header("Location: password.html");

        }
    } else {
        // Email not found
        $loginError = "Email not found";
        header("Location: email.html");

    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Martel+Sans:wght@600&family=Poppins:wght@300;400;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: black;
        }


        img {
            overflow-clip-margin: content-box;
            overflow: clip;
            opacity: 0.6;
        }

        .login-box {
            color: white;
            position: absolute;
            top: 45%;
            left: 50%;
            height: 600px;
            width: 450px;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: rgba(1, 1, 1, 0.767);
            box-shadow: 0px 0px 10px rgba(1, 1, 1, 0.767);
        }

        .main img {
            width: 100%;
            height: 1000px;

        }

        .main {
            position: relative;
            width: 100%;
            height: auto;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        .button>input {
            border: 2px solid white;
            margin: 0px 0px 20px 6px;
            padding: 9px;
            font-size: 1rem;
            border-radius: 0.2rem;
            width: 90%;
        }

        form .btn3,
        .btn4 {
            margin-left: 5px;
            padding: 9px 60px 9px 60px;
            border-radius: 0.2rem;
            width: 95%;
            font-size: 1rem;
        }

        .login-box form {
            padding: 30px 30px 0px 30px;
        }

        footer .Footer {
            position: absolute;
            background-color: rgba(1, 1, 1, 0.774);
            box-shadow: 0px 0px 10px rgba(1, 1, 1, 0.767);
            bottom: -43%;
            height: 155px;
            width: 100%;
            font-size: 1rem;
            padding-top: 25px;
            font-weight: lighter;
        }

        footer .questions {
            display: flex;
            justify-content: flex-start;
            padding-left: 130px;
            padding-bottom: 10px;
        }

        footer .footer1 {
            display: flex;
            justify-content: space-around;
            padding-bottom: 10px;

        }

        footer .social {
            display: flex;
        }

        .questions a {
            color: white;
            text-decoration: none;
        }

        .questions a:hover {
            text-decoration: underline;
        }

        .footer1 a,
        .social a {
            color: white;
        }

        .button .btn1,
        .btn2 {
            background-color: rgba(30, 28, 28, 0.772); 
        }

        .login-box .btn3 {
            background-color: red;
            color: white;
            border: 1px solid transparent;
        }

        .login-box .btn4 {
            background-color: rgba(105, 96, 96, 0.543);
            color: white;
            border: 1px solid transparent;
        }

        .logo img {
            height: 80px;
            width: 150px;
            position: absolute;
            top: 1%;
            left: 10%;
            opacity: 1;
        }
    </style>
    <script src="validation_js.js"></script>
</head>

<body>
    <div class="main">
        <img src="https://assets.nflxext.com/ffe/siteui/vlv3/9d3533b2-0e2b-40b2-95e0-ecd7979cc88b/a3873901-5b7c-46eb-b9fa-12fea5197bd3/IN-en-20240311-popsignuptwoweeks-perspective_alpha_website_large.jpg" alt="">
        <div class="login-box">

            <form action="" onsubmit="return validation()" method="post">
                <h1 style="padding-left: 5px; padding-bottom: 12px;">Sign in</h1>
                <div class="button">
                        <input type="email" name="email" placeholder="Email address" class="btn1" required><br>
                        <input type="password" name="password" placeholder="Password" class="btn2" required><br>
                        <span id="passworderror" class="text-danger"></span>
                        <input type="submit" value="Sign In" name="submit" class="btn3">
                </div>
                <p style="text-align: center; padding: 10px 0px;">OR</p>
                <input type="button" value="Use a sign-in code" class="btn4">
                <br>
                <p style="text-align: center;padding: 20px 0px; font-weight: lighter; "><a href="" style="text-decoration: none; color: white;">Forgot password?</a></p>
            </form>
            <input type="checkbox" style="margin: 0 0 0 35px;">
            <span>Remember me</span>
            <br>
            <br>
            <p style="padding: 0 0 0 35px; font-size: medium;">New to Netflix?<a href="Netflix_Copy.html" style="text-decoration: none; font-size:medium; color: white; font-weight: 800;">&nbsp;Sign up now.</a></p>
            <br>
            <p style="padding: 0 0 0 35px; font-size: small;">This page is protected by Google reCAPTCHA to ensure you're not a bot <a href="" style="text-decoration: none; color: blue; font-weight: lighter; font-size: small;">Learn more.</a></p>
        </div>
    </div>

    <div class="logo">
        <img src="logo.svg" alt="">
    </div>
    <footer>
        <div class="Footer">
            <div class="questions" style="color: white;">
                <p>Questions? Call&nbsp;</p>
                <a href="tel:000-800-919-1694"> 000-800-919-1694</a>
            </div>
            <div class="footer1">
                <div class="grid-item"><a href="faq">FAQ</a></div>
                <div class="grid-item"><a href="faq">Help Center</a></div>
                <div class="grid-item"><a href="faq">Terms of Use</a></div>
                <div class="grid-item"><a href="faq">Privacy</a></div>
            </div>
            <div class="social">
                <div class="footer2" style="margin: 0px 0px 0px 130px">
                    <div class="grid-item"><a href="faq">Cookie Preferences</a></div>
                </div>
                <div class="footer2" style="margin: 0px 144px">
                    <div class="grid-item"><a href="faq">Corporate Information</a></div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>