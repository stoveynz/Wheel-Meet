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

// Add user to request list
function add_club_request($db, $user, $club){
    $sql = "INSERT INTO club_requests(userid, clubid) VALUES ('$user','$club');";
    mysqli_query($db, $sql);
    header("Location: clubs.php");
}

// Check if user has request to join club or not
function check_club_request($db, $user, $club){
    $sql = "SELECT * FROM club_requests WHERE userid = '$user' AND clubid = '$club';";
    $result = mysqli_query($db, $sql);
    if($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}

// user cancels request to club
function cancel_club_request($db, $user, $club){
    $sql = "DELETE FROM club_requests WHERE userid = '$user' AND clubid = '$club';";
    mysqli_query($db, $sql);
    header("Location: clubs.php");
}

// Approve user request to club
function approve_club_request($db, $user, $club){
    $sql = "DELETE FROM club_requests WHERE userid = '$user' AND clubid = '$club';";
    mysqli_query($db, $sql);
    $sql = "INSERT INTO club_user (userid, clubid, admin) VALUES ('$user', '$club', 0);";
    mysqli_query($db, $sql);
    header("Location: manage-club.php?club=$club");
}

// Decline user request to club
function decline_club_request($db, $user, $club){
    $sql = "DELETE FROM club_requests WHERE userid = '$user' AND clubid = '$club';";
    mysqli_query($db, $sql);
    header("Location: manage-club.php?club=$club");
}

// Kick user from club
function kick_from_club($db, $user, $club){
    $sql = "DELETE FROM club_user WHERE userid = '$user' AND clubid = '$club';";
    mysqli_query($db, $sql);
    header("Location: manage-club.php?club=$club");
}

?>