<?php 
    include('include/wheel-meet.php');
    check_logged_in();
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
    
    <div class="main-container">
   
    <h1> Upload your Cars  </h1>
         <form method="post" action="garage-create.php" class="form-container" enctype="multipart/form-data">
           <input type="file" name="files[]" multiple />
            <h3>Add your Car Specifications</h3>
                <label><b>Car Make</b></label>
                <input type="text" placeholder="Car Make" name="car_make" required>
            
                <br><br><label><b>Car Model</b></label>
                <input type="text" placeholder="Car Model" name="car_model" required>
                    
                <br><br><label><b>Car Year</b></label>
                <input type="number" placeholder ="Car Year" name ="car_year" min="1900" max="2099" step="1" required />
                
                <br><br><label><b>Car Colour</b></label>
                <input type="text" placeholder="Car Colour" name="car_colour" required>

                <br><br><label><b>Car Horsepower</b></label>
                <input type="text" placeholder="Car Horsepower" name="car_horsepower"  required>
                
                <br><br><label><b>Description</b></label>
                <textarea name="car_description" cols="40" rows="10" style="resize: none;"></textarea>
                
                <button type="submit" value="Upload Images" name="add_details" style="margin-right: 14px;" class="btn">Add Details</button>
                
                <button type="reset"  name="reset" style="margin-right: 14px;" class="btn">Reset</button>
                
                <button type="cancel" onclick="window.location.href='garage.php';" name="cancel" style="margin-right: 14px;" class="btn">Cancel</button>
        </form>
    </div>
</body>
</html>