<?php

    function create_club($user, $db){
        $errors = array();
        $name = mysqli_real_escape_string($db, $_POST['club_name']);
        $privacy = mysqli_real_escape_string($db, $_POST['club_privacy']);
        $description = mysqli_real_escape_string($db, $_POST['club_description']);
        
        /*makes sure all fields have an input*/
        if(empty($name)){
            array_push($errors, "Club Name is required"); 
        }
        if(empty($description)){
            array_push($errors, "Description is required");
        }
        
        /*if there are no errors add to the database*/
        if(count($errors) == 0){
            $sql = "INSERT INTO clubs (name, description, private, ownerid) VALUES ('$name','$description', '$privacy','$user')";
            mysqli_query($db, $sql);
            header("Location: clubs.php");
        }
    }
?>