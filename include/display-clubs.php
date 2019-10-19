<?php

    // Get all clubs that were created by user
    function get_user_clubs($db, $user){
        $sql = "SELECT * FROM clubs WHERE ownerid = '$user';";
        return mysqli_query($db, $sql);
    }
    
    // Display the clubs that were created by user
    function display_user_clubs($db, $user){
        $result = get_user_clubs($db, $user);
        print_clubs($db, $result, $user);
    }
    
    function get_joined_clubs($db, $user){
        $sql = "SELECT * FROM clubs c, club_user cu WHERE c.clubid = cu.clubid
        AND userid = '$user'";
        return mysqli_query($db, $sql);
    }
    
    function display_joined_clubs($db, $user){
        $result = get_joined_clubs($db, $user);
        print_clubs($db, $result, $user);
    }
    // Get rest of clubs that weren't created by user
    function get_all_clubs($db, $user){
        $sql = "SELECT * FROM clubs where ownerid != '$user';";
        return mysqli_query($db, $sql);
    }
    
    // Display the clubs that weren't created by user
    function display_all_clubs($db, $user){
        $result = get_all_clubs($db, $user);
        print_clubs($db, $result, $user);
    }
    
    // Get newest clubs
    function get_newest_clubs($db){
        $sql = "SELECT * FROM clubs  ORDER BY clubid LIMIT 3;";
        return mysqli_query($db, $sql);
    }
    
    // Display newest clubs
    function display_newest_clubs($db, $user){
        $result = get_newest_clubs($db);
        print_clubs($db, $result, $user);
    }
    
    function print_clubs($db, $result, $user){
        if($result->num_rows > 0){
            $count = 0;
            while($row = $result->fetch_assoc()){
                $count++;
                if($count % 3 == 0){
                    echo '<div class = "card-row">';
                }
                    echo '<div class = "card-column">';
                        echo '<div class = "card" name="'.$row['clubid'].'">';
                        echo '<h3>'.$row['name'].'</h3>';
                        if($row["private"] == 0){
                            echo '<p>Privacy: Public</p>';
                        }
                        else {
                            echo '<p>Privacy: Private</p>';
                        }
                        echo '<p>About: '.$row['description'].'</p>';
                        // IF user doesn't own the clubs
                        if($user != $row["ownerid"]){
                            //IF user hasn't joined club yet
                            if(!check_club_rsvp($db, $user, $row["clubid"])){
                                //IF club is not private
                                if(!check_privacy($row["private"])){
                                    echo '<form action="clubs.php" method="post">';
                                        echo '<input type ="submit" class="pagebtn" name="join_club" value = "Join Club">';
                                        echo '<input type="hidden" class="pagebtn"name = "club" value="'.$row['clubid'].'">';
                                    echo '</form>';
                                }
                                else{
                                    echo '<form action="clubs.php" method="post">';
                                        echo '<input type ="submit" class="pagebtn" name="request_club" value = "Request Club">';
                                        echo '<input type="hidden" class="pagebtn"name = "club" value="'.$row['clubid'].'">';
                                    echo '</form>';
                                }
                            }
                            // User already in club
                            else{
                                echo '<form action="clubs.php" method="post">';
                                    echo '<input type="submit" class="pagebtn" name="leave_club" value = "Leave Club">';
                                    echo '<input type="hidden" name = "club" value="'.$row['clubid'].'">';
                                echo '</form>';
                            }
                        }
                        else {
                           //User is owner of club
                            echo '<form action="clubs.php" method="post">';
                                echo '<input type="button" class="pagebtn" onclick="openClubMemberPopup()" name="club_members" value="View Members">';
                                echo '<input type="submit" class="pagebtn" name="delete_club" value="Delete Club">';
                                echo '<input type="hidden" name="club" value="'.$row['clubid'].'">';
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