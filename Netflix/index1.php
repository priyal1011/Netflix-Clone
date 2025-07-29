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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email is not valid
        echo "Email is not valid";
    } elseif (strlen($password) < 8) {
        // Password is too short
        echo "Password is too short";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO netflix (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            // Redirect to index2.html
            header("Location: index2.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1 of 3</title>
    <link rel="stylesheet" href="style1.css">
    <script src="validation_js.js"></script>
</head>

<body>
    <header class="navbar">
        <a href="#"><img src="Screenshot 2024-03-28 221926.png" width="185px" height="45px" style="margin-right: 1060px;" alt="logo"></a>
        <div style="text-align: right;">
            <a href="http://localhost:3000/sign-in.php"><button id="first">Sign In</button></a>
        </div>
    </header>
    <hr>

    <main class="container">
        <div id="middle">
            <h6 id="sec">STEP 1 OF 3</h6>
            <h3 id="thir">Create a password to start<br> your membership</h3>
            <h6 id="four">Just a few more steps and you are done!<br>We hate paperwork, too.</h6>
            <form id="signupForm" method="post" onsubmit="return validation()">
                <input type="email" id="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" id="password" placeholder="Add a password" required>
                <span id="passworderror" class="text-danger"></span>
                <br><br>
                <button type="button" id="next">Next</button>
            </form>
        </div>
    </main>

    <br><br><br><br><br><br><br><br><br><br><br>

    <footer class="bottom">
        <hr style="border-top: 1px solid #f3f3f3;">
        <p id="five">Questions? Call <a id="call" href="#">000-800-919-1694</a></p>
        <a id="foot" href="#" style="margin-left: 10px;">FAQ</a>
        <a id="foot" href="#">Help Center</a>
        <a id="foot" href="#">Netflix Shop</a>
        <a id="foot" href="#">Terms of Use</a>
        <br><br>
        <a id="six" href="#" style="margin-left: 10px;">Privacy</a>
        <a id="six" href="#">Cookie Preferences</a>
        <a id="six" href="#" style="margin-left: 110px;">Corporate Information</a>
        <br><br>
        <select id="dropbox">
            <a><img src="Screenshot 2024-03-29 221506.png"></a>
            <option value="English">ENGLISH</option>
            <option value="Hindi">हिंदी</option>
        </select>
    </footer>

    <script>
        document.getElementById("next").addEventListener("click", function() {
            document.getElementById("signupForm").submit();
        });
    </script>
</body>

</html>
