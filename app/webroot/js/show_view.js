$(function() {

	$('a.fancybox').fancybox({
		padding : 0
	});

	var $locationField = $('#js-show-location');

	// Resolve address to geocoordinates
	// We still need Google here, do we..??
	$.getJSON ('http://maps.googleapis.com/maps/api/geocode/json?address=' + $locationField.val(), function (response) {

		if (response.status == 'OK') {
			console.log (response['results'][0].geometry.location);

			var lat = response['results'][0].geometry.location.lat;
			var lon = response['results'][0].geometry.location.lng;
			var precision = response['results'][0].geometry.location_type;

			drawMap (lat, lon, precision);
		}
	});

	function drawMap (lat, lon, precision) {

		var $map = $('<div id="map"></div>');
		$map.css ({
			'width' : '100%',
			'height' : '180px',
			'marginTop' : '6em',
			'clear' : 'both'
		});
		$locationField.replaceWith ($map);


		console.log(lat, lon);
		var map = L.map('map').setView([lat, lon], 10);
		
		L.tileLayer('http://{s}.tiles.mapbox.com/v3/hannenz.iodb36pi/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		console.log(precision);
		if (precision == 'ROOFTOP') {

			var marker = L.icon({
				iconUrl : '/img/marker.png',
				iconSize : [48, 48],
			});
			var marker = L.marker([lat, lon], {icon : marker}).addTo(map);

			// var popupOptions = {
			// 	offset : L.point(0, -60),
			// 	minWidth : 260
			// };

			// var popup = L.popup(popupOptions)
			//  	.setLatLng(HalmaLatLong)
			//  	.setContent(popupContent)
			//  	.openOn(map)
			// ;

			// marker.bindPopup(popup, popupOptions);
		}
	}
});