<?php
    /*processes user registration*/
    function register_user($db){
        $errors = array();
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        
        //ensure that form field are filled properly
        if(empty($username)){
            array_push($errors, "Username is required"); //add error to array
        }
        if(empty($email)){
            array_push($errors, "Email is required"); //add error to array
        }
        if(empty($password_1)){
            array_push($errors, "Password is required"); //add error to array
        }
        if($password_1 != $password_2){
            array_push($errors, "Passwords do not match");
        }
        
        //if no errors save to db
        
        if(count($errors) == 0){
            $password = md5($password_1);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
            mysqli_query($db, $sql);
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $result->fetch_assoc()["id"];
            login_user();
        }
    }
    /*checks that the user login details match*/
    function check_login($db){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $errors = array();
        
        //ensure that form field are filled properly
        if(empty($username)){
            array_push($errors, "Username is required"); //add error to array
        }
        if(empty($password)){
            array_push($errors, "Password is required"); //add error to array
        }
        
        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $result->fetch_assoc()["id"];
                login_user();
            }
            else{
                array_push($errors, "Wrong username/password combination");
                header('location: index.php');
            }
        }
    }
    /*process user logging in*/
    function login_user(){
        $_SESSION['success'] = "You are now logged in";
        header('location: home-auth.php');
    }
    /*function which processes logging out the user when the logout button is pressed*/
    function logout_user(){
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['userId']);
        header('location: index.php');
    }
    /*checked that the user is logged in so they can view the pages */
    function check_logged_in(){
        if(empty($_SESSION['username'])){
            header('location: index.php');
        }
    }
?>