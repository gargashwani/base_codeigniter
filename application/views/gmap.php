<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Google Maps JavaScript APIs</title>

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

</head>
<body>
	<h1>My Google Maps API</h1>
    <!-- Show the map here -->
	<div id="map"></div>


    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 28.6139, lng: 77.2090},
          zoom: 8 // max is 14
        });
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAetBRs5wtUi06DX2_0bIyzRqzov74NZII&callback=initMap"
    async defer></script>
</body>
</html>
