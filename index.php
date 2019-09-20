<?php include('include/wheel-meet.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Wheel Meet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
</head>

<header id="header">
    <?php include 'header.php';?>
</header>

<body>
    
    <div class="main-container">
        <h1>Welcome to Wheel Meet.</h1>
        <h1>Please log in.</h1>
    </div>
<!-- login -->
    <div class="form-popup" id="loginForm">
        <form method="post" action="index.php" class="form-container">
            <h1>Login</h1>

            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="login" style="margin-top: 8px;" class="btn">Login</button>
            <button type="button" class="btn cancel" onclick="closeLogin()">Close</button>
            <button class="link" id="regoBtn" onclick="openRego()">Don't have an account? <b>REGISTER.</b></button>
        </form>
    </div>
<!-- register -->
    <div class="form-popup" id="regoForm">
        <form method="post" action="index.php" class="form-container">
            <h1>Register</h1>

            <input type="text" placeholder="Username" name="username" value="<?php echo $username ?>" required>
            <input type="text" placeholder="Email" name="email" value="<?php echo $email ?>" required>
            <input type="password" placeholder="Password" name="password_1" required>
            <input type="password" placeholder="Confirm Password" name="password_2" required>

            <button type="submit" name="register" style="margin-top: 8px;" class="btn">Register</button>
            <button type="button" class="btn cancel" onclick="closeRego()">Close</button>
        </form>
        <button class="link" id="loginBtn" onclick="openLogin()">Already have an account? <b>LOGIN.</b></button>
    </div>

    <script>
        var loginForm = document.getElementById("loginForm")
        var regoForm = document.getElementById("regoForm")

        function openLogin() {
            regoForm.style.display = "none";
            loginForm.style.display = "block";
        }

        function closeLogin() {
            loginForm.style.display = "none";
        }

        function openRego() {
            loginForm.style.display = "none";
            regoForm.style.display = "block";
        }

        function closeRego() {
            regoForm.style.display = "none";
        }
    </script>

</body>

</html>