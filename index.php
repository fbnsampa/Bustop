<!DOCTYPE html>
<html>
    <head>
        <title>BusTOP</title>
        
        <!--define a viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        
        
        <!-- adicionar CSS Bootstrap-->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <!-- adicionar CSS Personalizado-->
        <link href="css/style.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <h1>Olá Mundo! (branch: gmaps.gavinhos)</h1>
        <div id="map"></div>
        <script>
        function initMap() {
            var myLatLng = {lat: -25.363, lng: 131.044};

            // Create a map object and specify the DOM element
            // for display.
            var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 4
            });

            // Create a marker and set its position.
            var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title: 'TestMap - Australia'
            });
        }
        </script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADUk4Y_cwF5ObmSJTMZ8w3L2g6E-GZEE4
&callback=initMap" async defer>
        </script>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>