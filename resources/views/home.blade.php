@extends('layouts.main')

@section('header')
@endsection


@section('nav')
	<nav>
		<a href="/dashboard" class="float-right">Make a map</a>
	</nav>
@endsection

@section('content')
	<div id=home class="container map-page">
		<div class=row>
			<div class=col-12>
				<h1 class="my-5 text-center"><i class=icon-map></i> It's a map!</h1>
			</div>
			@if(count($maps))
			<div class="col-12 text-left">
				<h4>Check out these maps</h4>
			</div>
			
				@foreach($maps as $map)
					<div class="col-sm-6 col-md-4 col-lg-3 my-2">
						<a href="/map/{{$map->id}}" class="map-thumb">
							<img class=w-100 src="{{$map->screenshot}}" />
							{{$map->name}}
						</a>
					</div>
				@endforeach
			
			@endif
		</div>
	</div>
@endsection
