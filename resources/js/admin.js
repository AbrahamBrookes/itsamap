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

tinymce.init({
	selector: '.mce',
	skin: false
});

	import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
	import 'mapbox-gl/dist/mapbox-gl.css';
	 
if( $('#mapbox')[0] ){
	mapboxgl.accessToken = 'pk.eyJ1IjoiYS1icm9va2VzIiwiYSI6ImNqenRmajM0cTA0dnMzYm55NG9iNWc4cmEifQ.T_9Qw2CRjJntF5eyn2sIKg';
	var map = new mapboxgl.Map({
		container: 'mapbox',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [145.7781, -16.9186], // starting position
		zoom: 11 // starting zoom
	});

	map.on('click', function(e){
		document.querySelector('input[name="lng"]').value = e.lngLat.lng;
		document.querySelector('input[name="lat"]').value = e.lngLat.lat;
	});
	
	map.on('load', function(){
		map.resize();
	});

}