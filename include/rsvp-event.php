<?php
/*function to check whether a user is RSVP'd to an event*/
function check_rsvp($db, $user, $event){
    $sql = "SELECT * FROM rsvp WHERE userid = '$user' AND eventid = '$event';";
    $result = mysqli_query($db, $sql);
    if($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}
/*this adds the user to the RSVP table if they select to RSVP to event*/
function add_rsvp($db, $user, $event){
        $sql = "INSERT INTO rsvp (userid, eventid) VALUES ('$user', '$event');";
        mysqli_query($db, $sql);
        header("Location: events.php");
}
/*remove the rsvp given that user is rsvp'd to the event*/
function remove_rsvp($db, $user, $event){
    $sql = "DELETE FROM rsvp WHERE userid = '$user' AND eventid = '$event';";
    mysqli_query($db, $sql);
    header("Location: events.php");
}

function view_rsvp($db, $event){
    $sql = "SELECT u.username FROM users u, rsvp r WHERE r.userid = u.id AND r.eventid = .'$event'.";
    $result = mysqli_query($db,$sql);
    if($result->num_rows > 0){
        $count = 0;
        while($row = $result->fetch_assoc()){
            $count++;
            echo '<p>'.$row['username'].'</p>';
        }
    }
}

function delete_event($db, $user, $event){
    $sql = "DELETE FROM events WHERE user_id = '$user' AND event_id = '$event';";
    mysqli_query($db, $sql);
    header("Location: events.php");
}
?>