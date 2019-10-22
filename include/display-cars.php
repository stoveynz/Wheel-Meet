<?php
    /*gets all the cars from the database related to the current user*/
    function get_user_cars($db, $user){
        $sql = "SELECT * FROM cars  WHERE userid = '$user';";
        return mysqli_query($db, $sql);
    }
    /*displays all of the user cars*/
    function display_user_cars($db, $user){
        $result = get_user_cars($db, $user);
        print_cars($db, $result, $user);
    }
    /*gets all the cars for all cars except for the user cars*/
    function get_all_cars($db, $user){
        $sql = "SELECT * FROM cars WHERE userid != '$user';";
        return mysqli_query($db, $sql);
    }
    /*displays all of the cars that aren't the users*/
    function display_all_cars($db, $user){
        $result = get_all_cars($db, $user);
        print_cars($db, $result, $user);
    }
    /*gets latest cars*/
    function get_recent_cars($db){
        $sql = "SELECT * FROM cars ORDER BY carid DESC LIMIT 3;";
        return mysqli_query($db, $sql);
    }
    /*displays most recent cars*/
    function display_recent_cars($db, $user){
        $result = get_recent_cars($db);
        print_cars($db, $result, $user);
    }
    /*display single car*/
    function display_single_car($db, $car){
        $sql = "SELECT cars.*, users.username FROM cars, users WHERE carid = '$car' AND cars.userid = users.id;";
        $result = mysqli_query($db, $sql);
        print_single_car($db, $result, $car);
    }
    /*gets the image path related to the current car*/
    function get_car_image($db, $car){
        $sql = "SELECT image_path FROM car_image WHERE car_id = '$car' LIMIT 1;";
        $result = mysqli_query($db, $sql);
        return $result->fetch_assoc()['image_path'];
    }
    
    /* Deleting user car*/
    function delete_user_car($db, $user, $car){
        $sql = "DELETE FROM cars WHERE carid = '$car' AND userid = '$user';";
        mysqli_query($db, $sql);
        Header("location: garage.php");
    }
    /*processes the cars and displays them to the screen*/
    function print_cars($db, $result, $user){
        if($result->num_rows > 0){
            $count = 0;
            while($row = $result->fetch_assoc()){
                $count++; 
                if($count % 3 == 0){
                    echo '<div class = "card-row">';
                }
                        echo '<div class = "card-column">';
                            echo'<div class="card" name="'.$row['carid'].'">';
                                echo '<div class="img-container">';
                                echo '<img src="'.get_car_image($db, $row['carid']).'">';
                                echo '</div>';
                                echo '<h3><a href="car.php?car='.$row['carid'].'">'.$row["make"]. " " .$row["model"].'</a></h3>';
                                echo '<p>Year: '.$row['year'].'</p>';
                                echo '<p>Horsepower: '.$row['horsepower'].'</p>';
                                echo '<p>Colour: '.$row['colour'].'</p>';
                                echo '<p>About: '.$row['description'].'</p>';
                                
                                if($user == $row['userid']){
                                    //button to create build log
                                    echo '<form action="wheel-meet.php" method="get">';
                                        echo '<input type="button" class="pagebtn" onclick="location.href=\'post_create.php?car='.$row['carid'].'\';" name="build_log" value="Add Build Log">';
                                    echo '</form>';
                                    //button to edit details
                                    echo '<form action="wheel-meet.php" method="get">';
                                        echo '<input type="button" class="pagebtn" onclick="location.href=\'edit-car.php?car='.$row['carid'].'\';" name="edit-car" value="Edit Car Details">';
                                    echo '</form>';
                                    //button to delete their car
                                    echo '<form action="garage.php" method="post">';
                                        echo '<input type="submit" class="pagebtn" name="delete_car" value="Delete Car">';
                                        echo '<input type ="hidden" name="car_id" value="'.$row['carid'].'">';
                                    echo '</form>';
                                }
                            echo'</div>';
                        echo '</div>';
                if($count % 3 == 0){
                    echo '</div>';
                }
            }
        }
    }
    /*get build log*/
    function get_build_logs($db, $car){
        $sql = "SELECT * FROM posts WHERE car_id = '$car';";
        $result = mysqli_query($db, $sql);
        return $result;
    }
    /*display car for individual car page*/
    function print_single_car($db, $result, $car){
        while($row = $result->fetch_assoc()){
            echo '<div class="main-container">';
            echo '<h1>'.$row['username']."'s ".$row['year']." ".$row["make"]. " " .$row["model"].'</h1>';
            echo '</div>';
            echo '<div class="main-container" style="padding-right: 25px;">';
            echo '<img src="'.get_car_image($db, $row['carid']).'" class="car-img">';
            echo '<p>Year: '.$row['year'].'</p>';
            echo '<p>Horsepower: '.$row['horsepower'].'</p>';
            echo '<p>Colour: '.$row['colour'].'</p>';
            echo '<p>About: '.$row['description'].'</p>';
            echo '</div>';
            echo '<div class="main-container">';
            echo '<h2>Build Logs</h2>';
            echo '</div>';

            $buildlogs = get_build_logs($db, $car);
            if($buildlogs->num_rows > 0){
                while($logs = $buildlogs->fetch_assoc()){
                    echo '<div class="main-container">';
                    echo '<h2>'.$logs['title'].'</h2>';
                    echo '<h4>'.$logs['date'].'</h4>';
                    echo '<p>'.$logs['post'].'</p>';
                    echo '</div>';
                }
            }
            else{
                //echo '<p>No Build Logs</p>';
            }
            echo '</div>';
        }
    }
?>