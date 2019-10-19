<?php include('include/wheel-meet.php');
    check_logged_in();
?>
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
    
    <div class="main-container">
        <h1>Map</h1>
    </div>

    <div class="map-container">
        <div id="map" style="height:900px"></div>

    </div>
    
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -36.84846, lng: 174.763332},
          zoom: 14,
          mapTypeControl: false,
          streetViewControl: false,
          styles: [
    {
        "stylers": [
            {
                "hue": "#ff1a00"
            },
            {
                "invert_lightness": true
            },
            {
                "saturation": -100
            },
            {
                "lightness": 33
            },
            {
                "gamma": 0.5
            }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#2D333C"
                        }
                    ]
                }
            ]
        });
      }
    </script>
    
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXnfFCg40P4zZ__0DrQLZGvs8m_MdcM-I&callback=initMap"
    async defer></script>

</body>

</html>