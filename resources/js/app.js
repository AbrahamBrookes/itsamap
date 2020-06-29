/**
	We'll use mapbox to display our map, using our Map->geojson endpoint to supply the display data
 */


import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';


document.addEventListener( 'DOMContentLoaded', function(){
	
	const mapid = document.querySelector('#mapid').value;
	
	
	// init the map
	mapboxgl.accessToken = 'pk.eyJ1IjoiYS1icm9va2VzIiwiYSI6ImNqenRmajM0cTA0dnMzYm55NG9iNWc4cmEifQ.T_9Qw2CRjJntF5eyn2sIKg';
	window.map = new mapboxgl.Map({
		container: 'mapbox',
		style: 'mapbox://styles/a-brookes/ck0eyk0a40pg01cpj01yqdm2p',
		center: [145.7781, -16.9186], // starting position
		zoom: 11, // starting zoom
		preserveDrawingBuffer: true
	});


	map.on('load', function(){
		
		// add a layer containing our existing map pointers
		map.addLayer({
			id: 'allPointers',
			type: 'symbol',
			source: {
				type: 'geojson',
				data: '/geojson/'+mapid // our geojson endpoint, runs Map->geojson
			},
			layout: {
				'icon-image': 'mapPointer',
				'icon-allow-overlap': true,
			}
		});
		
		// clicking on pointers and displaying data
		map.on('click', 'allPointers', function(e) {
			var pointer = e.features[0].properties;
			
			// update and show the display panel
			// I could totally use vue for this but ehh, why the overhead? I don't even have jquery loaded
			document.querySelector('#pointer-display').dataset.display = "true";
			document.querySelectorAll('#pointer-display .title')[0].innerText = pointer.title;
			document.querySelectorAll('#pointer-display .content')[0].innerHTML = pointer.content;
			document.querySelectorAll('#pointer-display .image')[0].setAttribute( "src", "https://cdn.filestackcontent.com/" + pointer.handle );
			
		});
		
		// when we hover a pointer, show a popup with its title
		var popup = new mapboxgl.Popup({
			closeButton: false,
			closeOnClick: false
		});
		map.on('mouseenter', 'allPointers', function(e) {
			// Change the cursor style as a UI indicator.
			map.getCanvas().style.cursor = 'pointer';
			 
			var coordinates = e.features[0].geometry.coordinates.slice();
			var title = e.features[0].properties.title;
			 
			// Ensure that if the map is zoomed out such that multiple
			// copies of the feature are visible, the popup appears
			// over the copy being pointed to.
			while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
				coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
			}
		 
			// Populate the popup and set its coordinates
			popup.setLngLat(coordinates)
			.setHTML('<h5 class=m-0>' + title + '<h5>')
			.addTo(map);
		});
		map.on('mouseleave', 'allPointers', function() { // remove the popup
			map.getCanvas().style.cursor = '';
			popup.remove();
		});
	
	
	});
	
	
	document.getElementById( 'close-display' ).addEventListener( 'click', function(){ // vanilla js
		document.getElementById('pointer-display').dataset.display = "false";
	});
	
	
});