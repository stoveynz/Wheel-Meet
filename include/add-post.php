<?php 

    /*This handles the inputs in the form and appends to the database for posts*/
    function create_post($db, $user){
        $errors = array();
        $car = mysqli_real_escape_string($db, $_POST['carid']);
        $title = mysqli_real_escape_string($db, $_POST['post_title']);
        $post = mysqli_real_escape_string($db, $_POST['post_description']);
        /*makes sure all fields have an input*/
        if(empty($title)){
            array_push($errors, "Title is required"); 
        }
        if(empty($post)){
            array_push($errors, "Post is required");
        }
        /*if there are no errors add to the database*/
        if(count($errors) == 0){
            $sql = "INSERT INTO posts (title, post, car_id) VALUES ('$title', '$post', '$car')";
            add_post_db($sql, $db);
        }
    }
    /*runs the addition to the database*/
    function add_post_db($sql, $db){
        mysqli_query($db, $sql);
        header("Location: /garage.php");
    }
?>