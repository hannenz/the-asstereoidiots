<?php
/* LeafletJs assets (map generation) */
$this->Html->css('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css', null, array('inline' => false));
$this->Html->script(array(
		'http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js',
	),
	 array('inline' => false)
);
?>

<h1>All Locations</h1>
<div id="map" style="width:100%; height:800px"></div>



<script>
document.addEventListener('DOMContentLoaded', init);
function init() {

	var map = L.map('map').setView([48.3876816, 9.8724054], 6);
		
	L.tileLayer('http://{s}.tiles.mapbox.com/v3/hannenz.iodb36pi/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);


	$.get('/locations/get_all', function(response) {
		var locations = JSON.parse(response);

		for (var i = 0; i < locations.length; i++) {
			if (locations[i].Location.lat && locations[i].Location.lng) {
				console.log(locations[i]);
				addMarker(locations[i]);
			}

		}
		console.log(locations);
	});

	function addMarker(location) {
		var marker = L.icon({
			iconUrl : '/img/marker.png',
			iconSize : [48, 48],
		});
		var marker = L.marker([location.Location.lat, location.Location.lng], {icon : marker}).addTo(map);
		var popupOptions = {
			offset : L.point(0, -60),
			minWidth : 260
		};

		var content = '<p>';
		content += '<strong>' + location.Location.name + " " + location.Location.city + '</strong>';
		for (var i = 0; i < location.Show.length; i++) {
			var date = new Date(location.Show[i].showtime);
			content += "<br>";
			content += '<a href="/shows/view/' + location.Show[i].id + '">' + date.toString() + '</a>';
		}
		content += '</p>';

		var popup = L.popup(popupOptions)
		 	.setLatLng([location.Location.lat, location.Location.lng])
		 	.setContent(content)
		 	.openOn(map)
		;

		marker.bindPopup(popup, popupOptions);
	}

	return;

	console.log(precision);
	if (precision == 'ROOFTOP') {
		var marker = L.icon({
			iconUrl : '/img/marker.png',
			iconSize : [48, 48],
		});
		//var marker = L.marker([lat, lon], {icon : marker}).addTo(map);

	}
}
</script>

