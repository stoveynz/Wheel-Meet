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
<!-- Create event --> 
    <div class="main-container">
        <form method="post" action="include/wheel-meet.php" class="form-container">
            <h1>Create Build Log</h1>
                <input type="hidden" name="carid" value="<?php echo $car;?>">
                <label><b>Title</b></label>
                <br>
                <input type="input" placeholder="Title" name="post_title" required>
                <br><br>
                <label><b>Description</b></label> 
                <br>
                <textarea name="post_description" cols="40" rows="10" placeholder="Build log description" style="resize: none;"></textarea>
                <br><br>
                    <button type="submit" name="create_post" style="margin-left: 14px;" class="pagebtn">Add Build Log</button><br>
                    <button type="button" onclick="window.location.href='garage.php';" name="cancel" style="margin-left: 14px;" class="pagebtn">Cancel</button><br>
        </form>
    </div>
</body>
</html>