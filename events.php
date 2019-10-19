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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXnfFCg40P4zZ__0DrQLZGvs8m_MdcM-I&libraries=places"></script>
</head>

<header id="header">
    <?php include 'header-auth.php';?>
</header>

<body>
    
    <div class="main-container">
        <h1 class="hero-text">Events</h1>
            <button onclick="openCreatePopup()" name="create" class="pagebtn"><h2>Add event</h2></button>
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
        
    <div class="popup-form" id="RSVP">
        <div class="popup-container">
            <h1>Going</h1>

            <button type="button" class="btn cancel" onclick="closePopup()">Close</button>
        </div>
    </div>
    
        <div class="popup-form"  style="width:40%" id="EventCreation">
            <form method="post" style="width:auto" action="events.php" class="popup-container">
            <h1>Please enter the event details</h1>
                <input type="text" placeholder="Event Name" name="event_name" required>
                <input type="text" placeholder="Enter Location" id="event_address" name="event_address" required>
                <input type="date" placeholder="Event Date" name="event_date" required>
                <input type="time" placeholder="Event Time" name="event_time" required>
                <br></br>
                <label><b>Event Description</b></label> 
                <br></br>
                <textarea name="event_description" cols="40" rows="10" style="width: -webkit-fill-available;"></textarea>
                <br></br>
                <button type="submit" name="create_event" class="btn">Create</button>
                <button type="reset" name="reset" class="btn">Reset</button>
                <button type="cancel" onclick="closeCreatePopup()" name="cancel"class="btn">Cancel</button>
        </form>
    </div>
    
    <script>
    
        var rsvpPopup = document.getElementById("RSVP")
        var creationPopup = document.getElementById("EventCreation")
        
        function initialize(){
            // initialising google places api
            var input = document.getElementById('event_address');
        
            var defaultBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(-37.0997, 175.1041),
                new google.maps.LatLng(-36.6935, 174.5493)
                );
            var options = {
                types: ['geocode', 'establishment'],
                componentRestrictions: {country: 'nz'}};
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.setFields(['address_component']);
        }
        
        google.maps.event.addDomListener(window, 'load', initialize);


        function openRsvpPopup() {
            rsvpPopup.style.display = "block";
            creationPopup.style.display = "none";
        }

        function closeRsvpPopup() {
            rsvpPopup.style.display = "none";
        }
        function openCreatePopup() {
            creationPopup.style.display = "block";
            rsvpPopup.style.display = "none";
        }

        function closeCreatePopup() {
            creationPopup.style.display = "none";
        }
    </script>
    
</body>

</html>