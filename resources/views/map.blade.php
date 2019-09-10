@extends('layouts.main')

@section('head')

	<script src='/js/display_map.js'></script>

@endsection

@section('content')
	<input type=hidden id=mapid value="{{$map->id}}" />
	<div class=container>
		<div class=row>
			<div class="col-12 my-2 text-center">
				<h1 class="mt-5 mb-0"><i class="icon-map m-0"></i> {{$map->name}}</h1>
				<h6 class="mx-1 mb-0">A map by {{$map->user->name}}</h6>
			</div>
		</div>
	</div>
	<div class=container>
	
		<div class=row id=mapWrap>
			<input type=hidden id=lng />
			<input type=hidden id=lat />
			
			<div id=mapbox>
			
			</div>
			<div id=pointer-display>
				<img class=image />
				<h1 class=title></h1>
				<div class=content></div>
				<div class=close><i class=icon-map-pin id=close-display></i></div>
			</div>
		</div>
	</div>
@endsection
