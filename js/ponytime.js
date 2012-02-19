var bronies = (function() {
    var self = this;
    var map;

    var getViewerLocation = function() {
    var getViewerLocation = function(maps) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                maps.panTo(pos);
			    maps.setZoom(11);
			    
			    var dot = "static/dot.png";
			    var marker = new google.maps.Marker({
			        position: pos,
			        map: maps,
			        title: "Deine Position",
			        icon: dot
			    });
            }, function() {
                map.panTo(new google.maps.LatLng(51.1, 10.5));
            });
        }
    }

    self.init = function() {
        var mapCenter = new google.maps.LatLng(0, 0);
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: new google.maps.LatLng(51.1, 10.5),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        $.ajax({
    	    type: "GET",
    		url: "/bronielocator",
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

        getViewerLocation();
        getViewerLocation(map);
    };

    return self;
})();

$(document).ready(function(){ bronies.init(); });
