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
include('add-post.php');


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
    
    //edit car
    if(isset($_POST['edit_details'])){
        edit_details($db);
    }
    
    //delete car
    if(isset($_POST['delete_car'])){
        $car = $_POST['car_id'];
        delete_user_car($db, return_user(),$car);
    }
    
    //add post 
    if(isset($_POST['create_post'])){
        $user = $_SESSION['userId'];
        create_post($db, $user);
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
    
    // Kick user from rsvp
    if(isset($_POST['kick_rsvp'])){
        $user = $_POST['user_rsvp'];
        $event = $_POST['event'];
        kick_rsvp_user($db, $user, $event);
    }
    // create club
    if(isset($_POST['create_club'])){
        create_club(return_user(), $db);
    }
    
    // Join club
    if(isset($_POST['join_club'])){
        $club = $_POST['club'];
        add_club_rsvp($db, return_user(), $club);
    }
    
    // Request Club
    if(isset($_POST['request_club'])){
        $club = $_POST['club'];
        add_club_request($db, return_user(), $club);
    }
    
    // Cancel Request Club
    if(isset($_POST['cancel_request'])){
        $club = $_POST['club'];
        cancel_club_request($db, return_user(), $club);
    }
    
    // Approve Club Request
    if(isset($_POST['approve_member'])){
        $club = $_POST['club'];
        $user = $_POST['user_request'];
        approve_club_request($db, $user, $club);
    }
    
    // Decline Club Request
    if(isset($_POST['decline_member'])){
        $club = $_POST['club'];
        $user = $_POST['user_request'];
        decline_club_request($db, $user, $club);
    }
    
    // Kick user from club
    if(isset($_POST['kick_member'])){
        $club = $_POST['club'];
        $user = $_POST['user_request'];
        kick_from_club($db, $user, $club);
    }
    
    // Make user admin
    if(isset($_POST['admin_member'])){
        $club = $_POST['club'];
        $user = $_POST['user_request'];
        make_admin($db, $user, $club);
    }
    
    // Remove user admin
    if(isset($_POST['admin_remove'])){
        $club = $_POST['club'];
        $user = $_POST['user_request'];
        remove_admin($db, $user, $club);
    }
    
    // Leave club
    if(isset($_POST['leave_club'])){
        $club = $_POST['club'];
        remove_club_rsvp($db, return_user(), $club);
    }
    
    // Delete club
    if(isset($_POST['delete_club'])){
        $club = $_POST['club'];
        delete_club($db, return_user(), $club);
    }
?>