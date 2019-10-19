<?php

// Check if user is already in club or not
function check_club_rsvp($db, $user, $club){
    $sql = "SELECT * FROM club_user WHERE userid = '$user' AND clubid = '$club';";
    $result = mysqli_query($db, $sql);
    if($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}

// Add user to club_user table
function add_club_rsvp($db, $user, $club){
    $sql = "INSERT INTO club_user (userid, clubid, admin) VALUES ('$user', '$club', 0);";
    mysqli_query($db, $sql);
    header("Location: clubs.php");
}

// Remove user from club_user 
function remove_club_rsvp($db, $user, $club){
    $sql = "DELETE FROM club_user WHERE userid = '$user' AND clubid = '$club';";
    mysqli_query($db, $sql);
    header("Location: clubs.php");
}

// Return if club is private or public
function check_privacy($privacy){
    if($privacy == 1){
        // Club is private
        return true;
    }
    else{
        // Club is public
        return false;
    }
}

// Delete Club
function delete_club($db, $user, $club){
    $sql = "DELETE FROM clubs WHERE clubid = '$club' AND ownerid = '$user';";
    mysqli_query($db, $sql);
    header("Location: clubs.php");
}
?>