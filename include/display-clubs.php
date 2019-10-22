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
    
    // View members
    function view_club_members($db, $club){
        $sql = "SELECT u.username, u.id FROM users u, club_user cu WHERE cu.userid = u.id AND cu.clubid = '$club';";
        $result = mysqli_query($db,$sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '<p>'.$row['username'].' </p>';
                // Check so admin don't see kick option on themselves
                if($row['id'] != return_user())
                {
                    echo '<form action="clubs.php" method="post">';
                        echo '<input type="submit" class="btn" name="kick_member" value="Kick">';
                        echo '<input type="hidden" name="user_request" value="'.$row['id'].'">';
                        echo '<input type="hidden" name="club" value="'.$club.'">';
                    echo '</form>';
                }
                // Only Owner can add/remove admin.
                if(club_owner($db, return_user(), $club)){
                    if(check_admin($db, $row['id'],$club)){
                        echo '<form action="clubs.php" method="post">';
                            echo '<input type="submit" class="btn" name="admin_remove" value="Remove Admin">';
                            echo '<input type="hidden" name="user_request" value="'.$row['id'].'">';
                            echo '<input type="hidden" name="club" value="'.$club.'">';
                        echo '</form>';
                    }
                    else{
                        echo '<form action="clubs.php" method="post">';
                            echo '<input type="submit" class="btn" name="admin_member" value="Make Admin">';
                            echo '<input type="hidden" name="user_request" value="'.$row['id'].'">';
                            echo '<input type="hidden" name="club" value="'.$club.'">';
                        echo '</form>';
                    }
                }
            }
        }
        else
        {
            echo '<p>No Members!</p>';
        }
    }
    
    function view_request_list($db, $club){
        $sql = "SELECT private FROM clubs WHERE clubid = '$club';";
        $result = mysqli_query($db, $sql);
        $row = $result->fetch_assoc();
        if($row['private'] != 0)
        {
            $sql = "SELECT u.username, u.id FROM users u, club_requests cr WHERE cr.userid = u.id AND cr.clubid ='$club';";
            $result = mysqli_query($db, $sql);
            echo '<h1>Request List</h1>';
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo '<p>'.$row['username'].' </p>';
                    echo '<form action="clubs.php" method="post">';
                        echo '<input type="submit" class="btn" name="approve_member" value="Approve">';
                        echo '<input type="hidden" name="user_request" value="'.$row['id'].'">';
                        echo '<input type="hidden" name="club" value="'.$club.'">';
                    echo '</form>';
                    echo '<form action="clubs.php" method="post">';
                        echo '<input type="submit" class="btn" name="decline_member" value="Decline">';
                        echo '<input type="hidden" name="user_request" value="'.$row['id'].'">';
                        echo '<input type="hidden" name="club" value="'.$club.'">';
                    echo '</form>';
                }
            }
            else
            {
                echo '<p>No Requests!</p>';
            }
        }
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
                        if(club_owner($db, return_user(), $row['clubid'])){
                            echo '<h3>'.$row['name'].' [Owner]</h3>';
                        }
                        else{
                            echo '<h3>'.$row['name'].'</h3>';
                        }
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
                                if(!check_privacy($row['private'])){
                                    echo '<form action="clubs.php" method="post">';
                                        echo '<input type ="submit" class="pagebtn" name="join_club" value = "Join Club">';
                                        echo '<input type="hidden" class="pagebtn"name = "club" value="'.$row['clubid'].'">';
                                    echo '</form>';
                                }
                                // Club is private
                                else{
                                    echo '<form action="clubs.php" method="post">';
                                        if(!check_club_request($db, $user, $row['clubid'])){
                                            echo '<input type ="submit" class="pagebtn" name="request_club" value = "Request Club">';
                                        }
                                        else{
                                            echo '<input type ="submit" class="pagebtn" name="cancel_request" value = "Cancel Request">';
                                        }
                                        echo '<input type="hidden" class="pagebtn"name = "club" value="'.$row['clubid'].'">';
                                    echo '</form>';
                                }
                            }
                            // User already in club
                            else{
                                if(check_admin($db, $user, $row['clubid']))
                                {
                                    echo '<form action="clubs.php" method="get">';
                                        echo '<input type="button" class="pagebtn" onclick="location.href=\'manage-club.php?club='.$row['clubid'].'\';" name="club_members" value="View Members [ADMIN]">';
                                    echo '</form>';
                                }
                                echo '<form action="clubs.php" method="post">';
                                    echo '<input type="submit" class="pagebtn" name="leave_club" value = "Leave Club">';
                                    echo '<input type="hidden" name = "club" value="'.$row['clubid'].'">';
                                echo '</form>';
                            }
                        }
                        else {
                           //User is owner of club
                            echo '<form action="clubs.php" method="get">';
                                echo '<input type="button" class="pagebtn" onclick="location.href=\'manage-club.php?club='.$row['clubid'].'\';" name="club_members" value="View Members">';
                                
                            echo '</form>';
                            echo '<form action="clubs.php" method="post">';
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