/*
document.addEventListener( 'DOMContentLoaded', function(){
	
	const mapid = $('#mapid').val();
	
	mapboxgl.accessToken = 'pk.eyJ1IjoiYS1icm9va2VzIiwiYSI6ImNqenRmajM0cTA0dnMzYm55NG9iNWc4cmEifQ.T_9Qw2CRjJntF5eyn2sIKg';
	window.map = new mapboxgl.Map({
		container: 'mapbox',
		style: 'mapbox://styles/a-brookes/ck03qitqx1cal1cqcrmvl454z',
		center: [145.7781, -16.9186], // starting position
		zoom: 11, // starting zoom
		preserveDrawingBuffer: true
	});


	map.on('load', function(){
		
		map.addLayer({
			id: 'allPointers',
			type: 'symbol',
			// Add a GeoJSON source containing place coordinates and information.
			source: {
				type: 'geojson',
				data: '/geojson/'+mapid
			},
			layout: {
				'icon-image': 'marker-15',
				'icon-allow-overlap': true,
			}
		});
	});
});*/