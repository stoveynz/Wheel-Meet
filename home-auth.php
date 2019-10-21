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
        <?php if(isset($_SESSION['username'])): ?>
            <h1>Welcome,  <strong>&nbsp<?php echo $_SESSION['username']; ?></strong>!</h1>
        <?php endif ?>
    </div>
    
    
    <div class="test-container">
        <h2>Most Recent Cars</h2>
        <?php
            display_recent_cars($db, return_user());
        ?>
    </div>
    <div class="test-container">
        <h2>Latest Events</h2>
        <?php
            display_latest_events($db, return_user());
        ?>
    </div>
    <div class="test-container">
        <h2>Newest Clubs</h2>
        <?php
            display_newest_clubs($db, return_user());
        ?>
    </div>
</body>
</html>