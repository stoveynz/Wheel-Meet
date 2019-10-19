<?php
include('login-registration.php');
include('add-event.php');
include('add-car.php');
include('display-events.php');
include('display-cars.php');
include('rsvp-event.php');
include('clubs-handling.php');
include('display-clubs.php');
include('rsvp-club.php');


//functions
    //checks that the user is logged in and the session exists, if not start the session
    function check_session(){
        if(!isset($_SESSION)) { 
            return false; 
        } 
        else return true;
    }
    //return the user id 
    function return_user(){
        return $_SESSION['userId'];
    }

//main entry
    if(check_session() == false){
        session_start();
    }

    //connect to db
    $db = mysqli_connect('localhost','id10552085_wheel_meet', 'SDPsem2wheelmeet', 'id10552085_wheel_meet');
    $username = '';
    $email = '';
    
    //if the register button is clicked
    if(isset($_POST['register'])){
        register_user($db);
    }

    //log user in
    if(isset($_POST['login'])){
        check_login($db);
    }

    //if user logout
    if(isset($_GET['logout'])){
        logout_user();
    }
    
    //create event 
    if(isset($_POST['create_event'])){
        $user = $_SESSION['userId'];
        create_event($user, $db);
    }
    
    //add car 
    if(isset($_POST['add_details'])){
        $user = $_SESSION['userId'];
        add_car($db, $user);
    }
    
    //rsvp to event
    if(isset($_POST['event_rsvp'])){
        $user = $_SESSION['userId'];
        $event = $_POST['event'];
        add_rsvp($db, $user, $event);
    }
    
    //un rsvp to event
    if(isset($_POST['event_un_rsvp'])){
        $user = $_SESSION['userId'];
        $event = $_POST['event'];
        remove_rsvp($db, $user, $event);
    }
    
    // Delete event
    if(isset($_POST['delete_event'])){
        $user = $_SESSION['userId'];
        $event = $_POST['event'];
        delete_event($db, $user, $event);
    }
    
    // create club
    if(isset($_POST['create_club'])){
        $user = return_user();
        create_club($user, $db);
    }
    
    // Join club
    if(isset($_POST['join_club'])){
        $user = $_SESSION['userId'];
        $club = $_POST['club'];
        add_club_rsvp($db, $user, $club);
    }
    
    // Leave club
    if(isset($_POST['leave_club'])){
        $user = $_SESSION['userId'];
        $club = $_POST['club'];
        remove_club_rsvp($db, $user, $club);
    }
    
    // Delete club
    if(isset($_POST['delete_club'])){
        $user = $_SESSION['userId'];
        $club = $_POST['club'];
        delete_club($db, $user, $club);
    }
?>