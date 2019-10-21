
<!DOCTYPE html>
<html>

<head>
    <title>Wheel Meet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
</head>

<header id="header">
    <?php include 'header-auth.php';?>
</header>

<body>
<?php

    $db = mysqli_connect('localhost','id10552085_wheel_meet', 'SDPsem2wheelmeet', 'id10552085_wheel_meet');
    $username = '';
    $email = '';

    //select Database
    mysqli_select_db($db,'id10552085_wheel_meet');
    
    //Select Query
    $sql = "SELECT * FROM cars";
    
    //Execute the query 
    $records = mysqli_query($db,$sql);
?>

<table> 
    <tr>
        <th>Model</th>
        <th>Make</th>
        <th>year</th>
        <th>colour</th>
        <th>horsepower</th>
        <th>description</th>
    </tr>
    <?php
    while($row = mysqli_fetch_array ($records))
    {

    echo "<td><input type=text name=model value='".$row['Model']."></td>";
    echo "<td><input type=text name=make value='".$row['Make']."></td>";
    echo "<td><input type=text name=colour value='".$row['Colour']."></td>";
    echo "<td><input type=text name=horsepower value='".$row['Horsepower']."></td>";
    echo "<td><input type=text name=description value='".$row['Description']."></td>";
    echo "<td><input type = submit>";
    echo "</form></tr>";
    }
    ?>
    
</body>
</html> 

-->