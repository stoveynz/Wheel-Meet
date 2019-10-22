<?php 
    /* function for adding the car to the database*/
    function add_car($db, $user){
        $errors = array();
        $make = mysqli_real_escape_string($db, $_POST['car_make']);
        $model = mysqli_real_escape_string($db, $_POST['car_model']);
        $year = mysqli_real_escape_string($db, $_POST['car_year']);
        $colour= mysqli_real_escape_string($db, $_POST['car_colour']);
        $horsepower = mysqli_real_escape_string($db, $_POST['car_horsepower']);
        $description= mysqli_real_escape_string($db ,$_POST['car_description']);
        
        /*ensure all the fields have content before applying to the db*/
        
            if(empty($make)){
                array_push($errors, "Car make is required"); 
            }
            if(empty($model)){
                array_push($errors, "Car model is required"); 
            }
            if(empty($year)){
                array_push($errors, "Car year is required");
            }
            if(empty($colour)){
                array_push($errors, "Car colour is required");
            }
            if(empty($horsepower)){
                array_push($errors, "Car horsepower is required");
            }
            if(empty($description)){
                array_push($errors, "Description is required");
            }
            
            if(count($errors) == 0){
                $sql = "INSERT INTO cars (userid, make, model, year, colour, horsepower, description) VALUES ('$user','$make','$model','$year','$colour', '$horsepower', '$description')";
                mysqli_query($db, $sql);
                upload_images($db, $user);
        }
    }
    
    /*function which handles uploading the images to the file server and inputting the path to the database*/
    function upload_images($db, $user){
        $targetDir = "include/cars/";
        $imageTypes = array('jpg', 'png', 'jpeg', 'gif');
        $carid = get_car_id($db);
        foreach($_FILES['files']['name'] as $key=>$val){
            //upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $user . "_" . $carid . "_" . $fileName;
            //check valid image
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if(in_array($fileType, $imageTypes)){
                //upload file
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    $sql = "INSERT INTO car_image (car_id, image_path) VALUES('$carid', '$targetFilePath');";
                    mysqli_query($db, $sql);
                }
            }
        }
        header("Location: garage.php");
    }
    
    /*this gets the id of the car so that the image path is stored with the associated car*/
    function get_car_id($db){
        $sql = "SELECT carid FROM cars ORDER BY carid DESC LIMIT 1;";
        $result = mysqli_query($db, $sql);
        if($result->num_rows > 0){
            $carid = $result->fetch_assoc()['carid'];
        }
        return $carid; 
    }
    
    /*this retrives all the data for the edit car*/
    function get_details($db, $car){
        $sql = "SELECT * FROM cars WHERE carid = '$car';";   
        return mysqli_query($db, $sql);
    }
    
    /*this function processes the editing of the details*/
    function edit_details($db){
        $errors = array();
        $make = mysqli_real_escape_string($db, $_POST['car_make']);
        $model = mysqli_real_escape_string($db, $_POST['car_model']);
        $year = mysqli_real_escape_string($db, $_POST['car_year']);
        $colour= mysqli_real_escape_string($db, $_POST['car_colour']);
        $horsepower = mysqli_real_escape_string($db, $_POST['car_horsepower']);
        $description= mysqli_real_escape_string($db ,$_POST['car_description']);
        $carid = mysqli_real_escape_string($db, $_POST['carid']);
        
        /*ensure all the fields have content before applying to the db*/
        
            if(empty($make)){
                array_push($errors, "Car make is required"); 
            }
            if(empty($model)){
                array_push($errors, "Car model is required"); 
            }
            if(empty($year)){
                array_push($errors, "Car year is required");
            }
            if(empty($colour)){
                array_push($errors, "Car colour is required");
            }
            if(empty($horsepower)){
                array_push($errors, "Car horsepower is required");
            }
            if(empty($description)){
                array_push($errors, "Description is required");
            }
            
            if(count($errors) == 0){
                $sql = "UPDATE cars SET make = '$make', model = '$model', year = '$year', colour = '$colour', horsepower = '$horsepower', description = '$description' WHERE carid = '$carid';";
                mysqli_query($db, $sql);
                header("Location: /garage.php");
            }
    }
    
    /*this makes the form for the html page and populates the current data*/
    function edit_car_form($db, $car){
        $result = get_details($db, $car);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '<form method="post" action="include/wheel-meet.php" class="form-container" enctype="multipart/form-data">';
                    echo '<label><b>Car Make </b></label>';
                    echo '<input type="text" placeholder="Car Make" name="car_make" value="'.$row['make'].'" required>';
                
                    echo '<br><br><label><b>Car Model </b></label>';
                    echo '<input type="text" placeholder="Car Model" name="car_model" value="'.$row['model'].'" required>';
                    
                    echo '<br><br><label><b>Car Year </b></label>';
                    echo '<input type="number" placeholder ="Car Year" name ="car_year" min="1900" max="2099" step="1" value="'.$row['year'].'" required />';
                    
                    echo '<br><br><label><b>Car Colour </b></label>';
                    echo '<input type="text" placeholder="Car Colour" name="car_colour" value="'.$row['colour'].'" required>';
    
                    echo '<br><br><label><b>Car Horsepower </b></label>';
                    echo '<input type="text" placeholder="Car Horsepower" name="car_horsepower" value="'.$row['horsepower'].'" required>';
                    
                    echo '<br><br><label><b>Description</b></label><br>';
                    echo '<textarea name="car_description" cols="40" rows="10" style="resize: none;">'.$row['description'].'</textarea><br><br>';
                    
                    echo '<input type="hidden" name="carid" value="'.$car.'">';
                    
                    echo '<button type="submit" name="edit_details" style="margin-right: 14px;" class="btn">Edit Details</button>';
                    
                    echo '<button type="reset"  name="reset" style="margin-right: 14px;" class="btn">Reset</button>';
                    
                    echo '<button type="button" onclick="location.href=\'garage.php\';" name="cancel" style="margin-right: 14px;" class="btn">Cancel</button>';
                echo '</form><br>';
            }
        }
    }
?>