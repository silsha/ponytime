<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <title>Template</title>

    <style type="text/css">
      html, body {
        height: 100%;
        margin: 0;
      }

      #map {
        height: 100%;
      }
    </style>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script type="text/javascript">
      /**
       * Called on the intiial page load.
       */
      var map;
      function init() {
        var mapCenter = new google.maps.LatLng(0, 0);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: new google.maps.LatLng(51.1, 10.5),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
		//var RZL = new google.maps.LatLng(49.50795, 8.4995)
		/*var marker = new google.maps.Marker({
		      position: RZL, 
		      map: map, 
			animation: google.maps.Animation.DROP,
		      title:"RaumZeitLabor"
		  });*/
		
		$.ajax({
			type: "GET",
			url: "json.php"
		}).done(function(msg){
			console.log(msg);
			$.each(msg, function(index, value){
				var coords = new google.maps.LatLng(value.lat, value.lng)
				var marker = new google.maps.Marker({
					position: coords,
					map: map,
					animation: google.maps.Animation.DROP,
					title: value.name
				});
			});
		});
		
		/*google.maps.event.addListener(map, 'zoom_changed', function(a) {
		   // console.log(map.getBounds());
			var bounds = map.getBounds();
			console.log(bounds.getNorthEast())
			$.ajax({
			  type: "GET",
			  url: "/nodejs/",
			  data: {
				swlat: bounds.getSouthWest().lat(),
				swlng: bounds.getSouthWest().lng(),
				nelat: bounds.getNorthEast().lat(),
				nelng: bounds.getNorthEast().lng()
				}
			}).done(function( msg ) {
			  alert( "Data Saved: " + msg );
			});
		console.log(bounds.getNorthEast().toString());	
		  });*/
		
        getUsersLocation();
      }

      function getUsersLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
              position.coords.longitude);
              map.panTo(pos);
          }, function() {
            map.panTo(new google.maps.LatLng(51.1, 10.5));
          });
        }
      }

	

      // Register an event listener to fire when the page finishes loading.
      google.maps.event.addDomListener(window, 'load', init);
    </script>
  </head>
  <body>
    <div id="map"></div>
  </body>
</html>