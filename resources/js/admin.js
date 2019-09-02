/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
/*
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
});
*/
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver';
import 'tinymce/skins/ui/oxide/skin.min.css';

/*
tinymce.init({
	selector: '.mce',
	skin: false
});
*/
	
	import VueMce from 'vue-mce';
	Vue.use(VueMce);

	import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
	import 'mapbox-gl/dist/mapbox-gl.css';

document.addEventListener( 'DOMContentLoaded', function(){
	if( $('#mapbox')[0] ){
		
		const app = new Vue({
			el: '#app',
			data: {
				id: 0,
				lng: 145.7709605789372,
				lat: -16.92034149005744,
				title: '',
				content: '',
				mceConfig: {
					height: 300,
					inline: false,
					theme: 'silver',
					fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px",
					toolbar1: 'formatselect | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
					image_advtab: true,
				}
			}
		});
		
		
		mapboxgl.accessToken = 'pk.eyJ1IjoiYS1icm9va2VzIiwiYSI6ImNqenRmajM0cTA0dnMzYm55NG9iNWc4cmEifQ.T_9Qw2CRjJntF5eyn2sIKg';
		window.map = new mapboxgl.Map({
			container: 'mapbox',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [145.7781, -16.9186], // starting position
			zoom: 11 // starting zoom
		});
		
		
		map.on('load', function(){
			
			// we will add a single HTML marker to the map
			// which the user can use to interact with whatever
			// mapPointer they are editing at the time
			var markerWrap = document.createElement('div');
			markerWrap.id = 'map-marker-wrap';
			var marker = document.createElement('div');
			marker.id = "the-map-marker";
			marker.classList.add('mapMarker'); // start the marker hidden
			markerWrap.appendChild( marker );
			var marker = new mapboxgl.Marker({
				element: markerWrap,
				draggable: true,
				anchor: 'bottom'
			})
			.on('dragend', function(e){
				app.lng = this._lngLat.lng;
				app.lat = this._lngLat.lat;
			})
			.setLngLat([app.lng, app.lat])
			.addTo(map);
			
			
			map.resize();
		});
		
		
		
		
		$(document).on('mousedown touchstart', function(e){
			var tgt = e.target;
			
			if( tgt.classList.contains('mapMarker') ){
				tgt.classList.add('dragging');
			}
			
		});
		
		$(document).on('mouseup touchend', function(e){
			$('.mapMarker').removeClass('dragging');
		});

		$('.activate-pointer-form').click( function(){
			$('#map-and-app').addClass( 'editing' );
		});

		$('.toggle-pointer-form').click( function(){
			$('#map-and-app').toggleClass( 'paused' );
		});
		
		$(document).on('transitionend', function(e){
			if( e.target.id == 'mapbox' )
				window.map.resize();
		});

	}
});