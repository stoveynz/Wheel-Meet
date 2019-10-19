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
        <h1 class="hero-text">Clubs</h1>
        <button type="button" onclick="openClubCreatePopup()" name="club-create"class="pagebtn"><h2>Create Club</h2></button>
    </div>
    
    <div class="test-container">
        <h2>Your Clubs</h2>
        <?php
            display_user_clubs($db, return_user());
            display_joined_clubs($db, return_user());
        ?>
    </div>
    
    <div class="test-container">
        <br></br>
        <h2>Other Clubs</h2>
        <?php
            display_all_clubs($db, return_user());
        ?>
    </div>
    
    <!-- Pop up for creating club -->
    <div class="popup-form" style="width:40%" id="ClubCreation">
        <form method="post" style="width:auto" action="clubs.php" class="popup-container">
            <h2>Enter your club details</h2>
                <label><b>Club Name</b></label>
                <input type="text" placeholder="Enter Club Name" name="club_name" required>

                <br></br><label><b>Club Privacy</b></label>
                <select name="club_privacy" required>
                    <option value="0">Public</option>
                    <option value="1">Private</option>
                </select> 
                
                <br></br>
                <label><b>Club Description</b></label> 
                <br></br>
                <textarea name="club_description" placeholder="Enter Club Description" cols="40" rows="10" style=" resize: none;" required></textarea>
                <br></br>
            <button type="submit" name="create_club" class="btn">Create</button>
            <button type="reset" name="reset" class="btn">Reset</button>
            <button type="cancel" onclick="closeClubCreatePopup()" name="cancel-club" class="btn">Cancel</button>
        </form>
    </div>
    
    <!-- Pop up for viewing club members -->
    <div class="popup-form" style="width:40%" id="ClubMembers">
        <form method="post" style="width:auto" action="clubs.php" class="popup-container">
            <button type="cancel" onclick="closeClubMemberPopup()" name="close-list" class="btn">Close</button>
        </form>
    </div>
        
    <script>
        var clubCreatePopup = document.getElementById("ClubCreation")
        
        function openClubCreatePopup() {
            clubCreatePopup.style.display = "block";
        }
        
        function closeClubCreatePopup() {
            clubCreatePopup.style.display = "none";
            window.location.href='clubs.php';
        }
        
        var clubMemberPopup = document.getElementById("ClubMembers");
        
        function openClubMemberPopup() {
            clubMemberPopup.style.display = "block";
        }
        
        function closeClubMemberPopup() {
            clubMemberPopup.style.display = "none";
        }
    </script>
</body>

</html>