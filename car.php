<?php include('include/wheel-meet.php');
    check_logged_in();
    $car = $_GET['car'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Wheel Meet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<header id="header">
    <?php include 'header-auth.php';?>
</header>

<body>
<?php
            display_single_car($db, $car);
         ?>
</body>

</html>