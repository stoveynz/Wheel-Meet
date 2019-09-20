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
    <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
</head>

<header id="header">
    <?php include 'header-auth.php';?>
</header>

<body>
    
    <div class="main-container">
        <h1>Events</h1>
            <form method="post" action="event-create.php" class="form-container">
            <button onclick="window.location.href='event-create.php';" name="create" style="margin-right: 14px;" class="btn"><h2>Add event</h2></button>
            </form>
    </div>
    <div class="test-container">
        <h2>Your Events</h2>
        <?php
            display_user_events($db, return_user());
        ?>
    </div>
        
    <div class="test-container">
        <br>
        <h2>Other Events</h2>
        <?php
            display_all_events($db, return_user());
        ?>
        <br>
    </div>
        
</body>

</html>