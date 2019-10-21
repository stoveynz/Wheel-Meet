<?php 
    include('include/wheel-meet.php');
    check_logged_in();
    
    $club = $_GET['club'];
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
        <form method="post" action="clubs.php" class="form-container">
            <h1>Clubs Members</h1>
            <?php
                view_club_members($db, $club);
                view_request_list($db, $club);
            ?>
            <br>
            <button type="cancel" onclick="window.location.href='clubs.php';" name="cancel" style="margin-left: 0px;" class="pagebtn">Go Back</button>
        </form>
    </div>
    
</body>
</html>