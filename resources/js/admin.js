/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver';
import 'tinymce/skins/ui/oxide/skin.min.css';
import VueMce from 'vue-mce';
Vue.use(VueMce);

import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';



/**
	default objects to pass to our various mechanisms
*/
const defaultLngLat = {
	lng: 145.7709605789372,
	lat: -16.92034149005744
};
const defaultPointer = {
	id: 0,
	lng: defaultLngLat.lng,
	lat: defaultLngLat.lat,
	title: '',
	content: ''
}
/**
	Set up globals
*/
window.itsamap = {
	app: {},
	map: {},
	marker: {},
}

// filestack
document.addEventListener('DOMContentLoaded', function () {
    const apikey = 'Agn7bjpJR4mGaonvvPrJbz';
    const client = filestack.init(apikey);
    const options = {
		displayMode: 'dropPane',
        container: '#filepicker', // the drop pane in our map pointer form
        maxFiles: 20,
        uploadInBackground: false,
		onFileUploadStarted: function(){
			// user feedback, show a loading icon
			$('.fsp-drop-pane__icon').attr( "style", 'background-image: url(img/img-upload-spinner.png)' );
			$('.fsp-drop-pane__icon').removeClass('loaded');
			$('.fsp-drop-pane__icon').addClass('loading');
		},
        onUploadDone: function(response){ // save the handle to our vue instance, which will take care of the rest
			var theImage = response.filesUploaded[0];
			itsamap.app.image_handle = theImage.handle;
			// remove the loading icon
			$('.fsp-drop-pane__icon').attr( "style", 'background-image: url(' + theImage.url + ')' );
			$('.fsp-drop-pane__icon').removeClass('loading');
			$('.fsp-drop-pane__icon').addClass('loaded');
		}
    };
    const picker = client.picker(options);
    picker.open();
});



document.addEventListener( 'DOMContentLoaded', function(){
	if( $('#mapbox')[0] ){
		
		/**
			We'll use a vue instance to handle our interactions with the map, the data on the page, and laravel.
			We will only ever keep track of one pointer at a time so we will fetch pointers as we need them.
			The vue instance will handle saving and updating display data.
		*/
		itsamap.app = new Vue({
			el: '#map-and-app',
			data: {
				id: defaultPointer.id,
				lng: defaultPointer.lng,
				lat: defaultPointer.lat,
				title: defaultPointer.title,
				content: defaultPointer.content,
				image_handle: null,
				published: $('input[name="map_public"]').val(),
				form_shown: false,
				pauseEdit: false,
				mode: 'create',
				mceConfig: {
					height: 300,
					inline: false,
					theme: 'silver',
					menubar: 'format',
					fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px",
					toolbar1: '',
					image_advtab: true,
				},
				editmode: false,
				marker: {}
			},
			methods: {
				// retrieve the given pointer from the server and assign it to the vue instance
				fetchPointer: function(id){
					let self = this;
					return new Promise((resolve, reject) => {
						axios.get('/dashboard/pointers/'+id).then(
							function(response){
								// assign the data
								Object.assign(self.$data, response.data);
								// show the marker
								itsamap.marker.setLngLat([ self.lng, self.lat ]);
								itsamap.map.flyTo({
									center: [ self.lng, self.lat ]
								});
								// display the image in the upload image zone, if applicable
								if( self.image_handle == null ){
									$('.fsp-drop-pane__icon').attr( "style", '' );
									$('.fsp-drop-pane__icon').removeClass('loading');
									$('.fsp-drop-pane__icon').removeClass('loaded');
								} else {
									$('.fsp-drop-pane__icon').attr( "style", 'background-image: url(https://cdn.filestackcontent.com/' + self.image_handle + ')' );
									$('.fsp-drop-pane__icon').removeClass('loading');
									$('.fsp-drop-pane__icon').addClass('loaded');
								}
								
								resolve(response.data); // resolve the promise and return the pointer data
							}
						)
					});
				},
				// save the currently active pointer
				savePointer: function(){
					let self = this;
					return new Promise((resolve, reject) => {
						// save the given pointer to the server
						axios.patch('/dashboard/pointers/'+self.id, self.$data).then(
							function(response){
								self.editmode = false;
								self.form_shown = false;
								resolve(response);
							}
						)
					});
				},
				// set the map to public or not public, for displaying on the front page
				setMapPublicStatus: function( status ){
					let self = this;
					self.published = status;
					let map_id = $('input[name="map_id"]').val();
					
					// take a screenshot of the map, and save the data string on the DB
					// I really can't figure out any other way to handle screenshotting the map
					var img = itsamap.map.getCanvas().toDataURL();
					
					return new Promise((resolve, reject) => {
						// save the given pointer to the server
						axios.patch('/dashboard/maps/'+map_id, {
							'published':status,
							'screenshot': img
						}).then(
							function(response){
								self.published = status;
								resolve(response);
							}
						)
					});
				}
			}
		});
		
		
		mapboxgl.accessToken = 'pk.eyJ1IjoiYS1icm9va2VzIiwiYSI6ImNqenRmajM0cTA0dnMzYm55NG9iNWc4cmEifQ.T_9Qw2CRjJntF5eyn2sIKg';
		itsamap.map = new mapboxgl.Map({
			container: 'mapbox',
			style: 'mapbox://styles/a-brookes/ck0eyk0a40pg01cpj01yqdm2p',
			center: [145.7781, -16.9186], // starting position
			zoom: 11, // starting zoom
			preserveDrawingBuffer: true
		});
		
		
		itsamap.map.on('load', function(){
			
			// we will add a single HTML marker to the map
			// which the user can use to interact with whatever
			// mapPointer they are editing at the time
			var markerWrap = document.createElement('div');
			markerWrap.id = 'map-marker-wrap';
			var marker = document.createElement('div');
			marker.id = "the-map-marker";
			marker.classList.add('mapMarker');
			markerWrap.appendChild( marker );
			itsamap.marker = new mapboxgl.Marker({
				element: markerWrap,
				draggable: true,
				anchor: 'bottom'
			})
			.on('dragend', function(e){
				itsamap.app.lng = this._lngLat.lng;
				itsamap.app.lat = this._lngLat.lat;
			})
			.setLngLat([itsamap.app.lng, itsamap.app.lat])
			.addTo(itsamap.map);
			
			// we'll also add a layer with all the map markers a' la
			// https://docs.mapbox.com/mapbox-gl-js/example/popup-on-hover/
			// by looping through the in-DOM .pointer-list-items, reading their
			// datasets and creating a mapbox-friendly geoJSON source.
			// saves a round trip to the server for this data
			var pointers = {  
				"type":"FeatureCollection",
				"features":[]
			};
			$('.pointer-list-item').each( function(index){
				var pointer = this;
				pointers.features.push({  
					"type":"Feature",
					"properties":{  
						"id": pointer.dataset.id,
						"title": pointer.innerText,
						"lng": pointer.dataset.lng,
						"lat": pointer.dataset.lat,
					},
					"geometry":{  
						"type":"Point",
						"coordinates":[  
							pointer.dataset.lng,
							pointer.dataset.lat
						]
					}
				});
			});
			itsamap.map.addLayer({
				id: 'allPointers',
				type: 'symbol',
				// Add a GeoJSON source containing place coordinates and information.
				source: {
					type: 'geojson',
					data: pointers
				},
				layout: {
					'icon-image': 'mapPointer',
					'icon-allow-overlap': true,
				}
			});
			
			
			// when we click on a pointer on the map, show the edit form for that pointer
			itsamap.map.on('click', 'allPointers', function(e) {
				var pointerid = e.features[0].properties.id;
				itsamap.app.fetchPointer(pointerid).then(
					function(){
						itsamap.app.form_shown = true;					
						itsamap.app.mode = 'edit'; // will update the existing pointer on form submit
					}
				);
			});
			
			// when we hover a pointer, show a popup with its title
			var popup = new mapboxgl.Popup({
				closeButton: false,
				closeOnClick: false
			});
			itsamap.map.on('mouseenter', 'allPointers', function(e) {
				// Change the cursor style as a UI indicator.
				itsamap.map.getCanvas().style.cursor = 'pointer';
				 
				var coordinates = e.features[0].geometry.coordinates.slice();
				var title = e.features[0].properties.title;
				 
				// Ensure that if the map is zoomed out such that multiple
				// copies of the feature are visible, the popup appears
				// over the copy being pointed to.
				while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
					coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
				}
			 
				// Populate the popup and set its coordinates
				// based on the feature found.
				popup.setLngLat(coordinates)
				.setHTML('<h5 class=m-0>' + title + '<h5>')
				.addTo(itsamap.map);
			});
			itsamap.map.on('mouseleave', 'allPointers', function() {
				itsamap.map.getCanvas().style.cursor = '';
				popup.remove();
			});
		
			
	
			itsamap.map.resize();
		});
		
		
		
		$('.add-pointer').click( function(){
			Object.assign(itsamap.app.$data, defaultPointer); // default the pointer data
			itsamap.app.mode = 'create'; // will save a new pointer on form submit
			
			$('.fsp-drop-pane__icon').attr( "style", '' ); // (rather clunkily) update the image dropzone
			$('.fsp-drop-pane__icon').removeClass('loading');
			$('.fsp-drop-pane__icon').removeClass('loaded');
			
			itsamap.app.form_shown = true; // shows the pointer form
		});

		$('.activate-pointer-form').click( function(){
			app.form_shown = true;
		});

		// the user clicked a pointer in the list. Fetch the pointer and commence editing
		$('.pointer-list-item').click( function(){
			// fetch the pointer and load it into our Vue instance
			app.fetchPointer(this.dataset.id).then(
				function(){
					app.form_shown = true;					
					app.mode = 'edit'; // will update the existing pointer on form submit
				}
			);
			
		});
		
		// we resize the map container when opening the pointer form, so we need to cal resize() to re-center the map
		$(document).on('transitionend', function(e){
			if( e.target.id == 'mapbox' )
				itsamap.map.resize();
		});
		
		// we'll interrupt the submit event in order to handle submits from within our vue instance
		$('#app form').on('submit', function(e){
			e.stopPropagation();
			
			if( app.mode == "create" )
				return; // we are in create mode, just let the form submit go through to laravel
			//else
			e.preventDefault();
			app.savePointer(); // update instead
		});

	}
});