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
?>