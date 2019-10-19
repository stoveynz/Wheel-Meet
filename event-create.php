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
<!-- Create event --> 
    <div class="main-container">
        <form method="post" action="event-create.php" class="form-container">
            <h1>Please enter the event details</h1>
                <label><b>Event Name</b></label>
                <br></br>
                <input type="text" placeholder="Event Name" name="event_name" required>
                    
                <br></br>
                <label><b>Event Date</b></label>
                <br></br>
                <input type="date" placeholder="Event Date" name="event_date" required>
                    
                <br></br>
                <label><b>Event Address</b></label>
                <br></br>
                <input type="text" placeholder="Event Address" name="event_address" required>

                <br></br>
                <label><b>Event Time</b></label>
                <br></br>
                <input type="time" placeholder="Event Time" name="event_time" required>
                    
                <br></br>
                <label><b>Event Description</b></label> 
                <br></br>
                <textarea name="event_description" cols="40" rows="10" style="resize: none;"></textarea>
                <button type="submit" name="create_event" style="margin-left: 14px;" class="btn">Create</button>
                <button type="reset" name="reset" style="margin-left: 14px;" class="btn">Reset</button>
                
                <button type="cancel" onclick="window.location.href='events.php';" name="cancel" style="margin-left: 14px;" class="btn">Cancel</button>
        </form>
    </div>

</body>

</html>