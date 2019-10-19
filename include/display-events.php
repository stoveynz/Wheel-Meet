<?php
    /*gets all events that are created by the user*/
    function get_user_events($db, $user){
        $sql = "SELECT * FROM events WHERE user_id = '$user';";
        return mysqli_query($db, $sql);
    }
    /*displays all events that were created by the user*/
    function display_user_events($db, $user){
        $result = get_user_events($db, $user);
        print_events($db, $result, $user);
    }
    /*gets all the events that are not created by the user*/
    function get_all_events($db, $user){
        $sql = "SELECT * FROM events WHERE user_id != '$user';";
        return mysqli_query($db, $sql);
    }
    /*process all events that are not created by the user*/
    function display_all_events($db, $user){
        $result = get_all_events($db, $user);
        print_events($db, $result, $user);
    }
    /*gets the last 3 events that were created*/
    function get_latest_events($db){
        $sql = "SELECT * FROM events ORDER BY event_id DESC LIMIT 3;";
        return mysqli_query($db, $sql);
    }
    /*process latest events*/
    function display_latest_events($db, $user){
        $result = get_latest_events($db);
        print_events($db, $result, $user);
    }
    /*uses the functions for getting the events and prints them to the screen*/
    function print_events($db, $result, $user){
        if($result->num_rows > 0){
            $count = 0;
            while($row = $result->fetch_assoc()){
                $count++; 
                if($count % 3 == 0){
                    echo '<div class = "card-row">';
                }
                    echo '<div class = "card-column">';
                        echo'<div class="card" name="'.$row['event_id'].'">';
                            echo '<h3>'.$row["name"].'</h3>';
                            echo '<p>Time: '.$row['time'].'</p>';
                            echo '<p>Date: '.$row['date'].'</p>';
                            echo '<p>Location: '.$row['event_address'].'</p>';
                            echo '<p>About: '.$row['description'].'</p>';
                            //if it is not the users own event display button so they can rsvp
                            if($user != $row["user_id"]){
                                //if they user is not RSVP'd show RSVP button
                                if(!check_rsvp($db, $user, $row["event_id"])){
                                    echo '<form action="events.php" method = "post">';
                                        echo '<input type="submit" class="pagebtn" name = "event_rsvp" value = "RSVP">';
                                        echo '<input type="hidden" class="pagebtn"name = "event" value="'.$row['event_id'].'">';
                                    echo '</form>';
                                }
                                //if the user is RSVP'd show the UN RSVP button
                                else{
                                    echo '<form action="events.php" method = "post">';
                                        echo '<input type="submit" class="pagebtn" name = "event_un_rsvp" value = "REMOVE RSVP">';
                                        echo '<input type="hidden" name = "event" value="'.$row['event_id'].'">';
                                    echo '</form>';
                                }
                            }
                            else{
                                echo '<form action="events.php" method ="post">';
                                    echo '<input type = "submit" class="pagebtn" onclick="openRsvpPopup()" name = "event_view_rsvp" value = "VIEW RSVPs">';
                                    echo '<input type = "submit" class="pagebtn" name="delete_event" value="Delete Event">';
                                    echo '<input type = "hidden" name = "event" value = "'.$row['event_id'].'">';
                                echo '</form>';
                            }
                        echo '</div>';
                    echo '</div>';
                if($count % 3 == 0){
                    echo '</div>';
                }
            }
        }
    }
?>