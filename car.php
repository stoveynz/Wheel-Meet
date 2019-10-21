<?php include('include/wheel-meet.php');
    check_logged_in();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Wheel Meet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<header id="header">
    <?php include 'header-auth.php';?>
</header>

<body>
<div class="main-container">
        
         <h1 class="hero-text">Your Car</h1>
       
            <form method="post" action="post_create.php" class="form-container">
            <button onclick="window.location.href='post_create.php';" name="create" class="pagebtn"><h2>Create Post</h2></button>
            </form>
    </div>
</body>

</html>