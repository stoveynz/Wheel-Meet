<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Wheel Meet</title>
</head>
<body>
    <form method="post" action="register.php">
        <!-- error display-->
        <?php include('errors.php'); ?>
        <div class="reg-input">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username ?>">
        </div>
        <div class="reg-input">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email ?>">
        </div>
        <div class="reg-input">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="reg-input">
            <label>Confirm Password</label>
            <input type="password" name="password_2">
        </div>
        <div class="reg-input">
            <button type="submit" name="register" class ="btn">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Login</a>
        </p>
    </form>
</body>
</html>