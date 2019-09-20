<?php
    /*gets all the cars from the database related to the current user*/
    function get_user_cars($db, $user){
        $sql = "SELECT * FROM cars  WHERE userid = '$user';";
        return mysqli_query($db, $sql);
    }
    /*displays all of the user cars*/
    function display_user_cars($db, $user){
        $result = get_user_cars($db, $user);
        print_cars($db, $result);
    }
    /*gets all the cars for all cars except for the user cars*/
    function get_all_cars($db, $user){
        $sql = "SELECT * FROM cars WHERE user_id != '$user';";
        return mysqli_query($db, $sql);
    }
    /*displays all of the cars that aren't the users*/
    function display_all_cars($db, $user){
        $result = get_all_cars($db, $user);
        print_cars($db, $result);
    }
    /*gets the image path related to the current car*/
    function get_car_image($db, $car){
        $sql = "SELECT image_path FROM car_image WHERE car_id = '$car' LIMIT 1;";
        $result = mysqli_query($db, $sql);
        return $result->fetch_assoc()['image_path'];
    }
    /*processes the cars and displays them to the screen*/
    function print_cars($db, $result){
        if($result->num_rows > 0){
            $count = 0;
            while($row = $result->fetch_assoc()){
                $count++; 
                if($count % 3 == 0){
                    echo '<div class = "card-row">';
                }
                        echo '<div class = "card-column">';
                            echo'<div class="card" name="'.$row['carid'].'">';
                                echo '<img src="'.get_car_image($db, $row['carid']).'">';
                                echo '<h3>'.$row["make"]. " " .$row["model"].'</h3>';
                                echo '<p>Year: '.$row['year'].'</p>';
                                echo '<p>Horsepower: '.$row['horsepower'].'</p>';
                                echo '<p>Colour: '.$row['colour'].'</p>';
                                echo '<p>About: '.$row['description'].'</p>';
                            echo'</div>';
                        echo '</div>';
                if($count % 3 == 0){
                    echo '</div>';
                }
            }
        }
    }
?>