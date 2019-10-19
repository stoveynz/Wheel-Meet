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
        <form method="post" action="club-create.php" class="form-container">
            <h1>Enter your club details</h1>
                <label><b>Club Name</b></label>
                <input type="text" placeholder="Club Name" name="club_name" required>
                    
                <label><b>Club Privacy</b></label>
                <!--input type="text" placeholder="Privacy Name" name="event_name" required-->
                <select name="club_privacy" required>
                    <option value="0">Public</option>
                    <option value="1">Private</option>
                </select> 
                
                <br></br>
                <label><b>Club Description</b></label> 
                <br></br>
                <textarea name="club_description" cols="40" rows="10" style="resize: none;"></textarea>
                <button type="submit" name="create_club" style="margin-right: 14px;" class="btn">Create</button>
                <button type="reset" name="reset" style="margin-right: 14px;" class="btn">Reset</button>
                
                <button type="cancel" onclick="window.location.href='events.php';" name="cancel" style="margin-right: 14px;" class="btn">Cancel</button>
        </form>
    </div>
        
</body>

</html>