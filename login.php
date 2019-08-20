<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Wheel Meet</title>
</head>
<body>
    <form method="post" action="login.php">
        <!-- error display-->
        <?php include('errors.php'); ?>
        <div class="reg-input">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="reg-input">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="reg-input">
            <button type="submit" name="login" class ="btn">Login</button>
        </div>
        <p>
            Not a member yet? <a href="register.php">Register</a>
        </p>
    </form>
</body>
</html>