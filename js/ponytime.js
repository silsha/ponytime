var bronies = (function() {
    var self = this;
    var map;

    var getViewerLocation = function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.panTo(pos);
			    map.setZoom(11);
			    var dot = "static/dot.png";
			    var marker = new google.maps.Marker({
			        position: pos,
			        map: map,
			        title: "Deine Position",
			        icon: dot
			    });
            }, function() {
                maps.panTo(new google.maps.LatLng(51.1, 10.5));
            });
        }
    }
    
    self.changeLocation = function(){
        var term = document.getElementById('term').value;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': term}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
              } else {
                alert("Fehler: " + status);
              }
            });
        bronies.getPonytimes;
        return false;
    }
    
    self.getPonytimes = function(){
        var bounds = map.getBounds();
		$.ajax({
		  type: "GET",
		  //url: "/bronielocator/",
		  url: "/bronielocator/",
		  data: {
			swlat: bounds.getSouthWest().lat(),
			swlng: bounds.getSouthWest().lng(),
			nelat: bounds.getNorthEast().lat(),
			nelng: bounds.getNorthEast().lng()
			}
		}).done(function(msg){
		    document.getElementById('list').innerHTML = '';
		    $.each(msg, function(index, value){
		        document.getElementById('list').innerHTML += '<div id="' + index + '"><h2>' + value.name + '</h2><b>Webseite:</b> <a href="'+ value.url +'">'+ value.url +'</a></div>';
		    })
		});
    }

    self.init = function() {
        var geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: new google.maps.LatLng(51.1, 10.5),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        $.ajax({
    	    type: "GET",
    		url: "/bronielocator/",
            data: {}
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

        getViewerLocation(map);
    };

    return self;
})();

$(document).ready(function(){ bronies.init(); });