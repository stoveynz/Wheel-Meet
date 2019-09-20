<?php 
    /*This handles the inputs in the form and appends to the database for events*/
    function create_event($user, $db){
        $errors = array();
        $name = mysqli_real_escape_string($db, $_POST['event_name']);
        $date = mysqli_real_escape_string($db, $_POST['event_date']);
        $address = mysqli_real_escape_string($db, $_POST['event_address']);
        $time = mysqli_real_escape_string($db, $_POST['event_time']);
        $description = mysqli_real_escape_string($db, $_POST['event_description']);
        /*makes sure all fields have an input*/
        if(empty($name)){
            array_push($errors, "Event Name is required"); 
        }
        if(empty($date)){
            array_push($errors, "Date is required"); 
        }
        if(empty($address)){
            array_push($errors, "Address is required");
        }
        if(empty($time)){
            array_push($errors, "Time is required");
        }
        if(empty($description)){
            array_push($errors, "Description is required");
        }
        /*if there are no errors add to the database*/
        if(count($errors) == 0){
            $sql = "INSERT INTO events (name, date, address, time, description, user_id) VALUES ('$name','$date','$address','$time','$description', '$user')";
            add_event_db($sql, $db);
        }
    }
    /*runs the addition to the database*/
    function add_event_db($sql, $db){
        mysqli_query($db, $sql);
        header("Location: events.php");
    }
?>