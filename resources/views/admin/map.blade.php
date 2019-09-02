@extends('admin.layouts.main')

@section('head')
	@parent
	
	<!-- mapbox-gl -->
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.css' rel='stylesheet' />
@endsection


@section('content')
	@section('map')
	<div class="container my-5">
		<div class=row>
			<div id=map-and-app class="col-12 relative overflow-hidden">
				<div id=mapbox>
				
				</div>
				<div id=app>
					<h3>
						Map pointer details
						<a href="javascript:void(0)" class="float-right toggle-pointer-form"><i class=icon-down-open></i></a>
					</h3>
					<form class=form-group action="/dashboard/pointers" method=POST>
						@csrf
						<input type=hidden v-model=lng name=lng />
						<input type=hidden v-model=lat name=lat />
						<input type=hidden name=map_id value="{{$map->id}}"/>
						<div class=form-group>
							<label for=title>Title</label>
							<input v-model="title" class=form-control name=title required />
						</div>
						<div class=form-group>
							<label for=content>Content</label>
							<vue-mce
								v-model="content"
								:config="mceConfig"
								name="content"
								ref="content"
							/>
							
						</div>
						<input type=submit class="btn btn-primary float-right" value=save />
					</form>
				</div>
				
			</div>
		</div>
		<div class="row mt-3">
			<div class=col-12>
				<h2 class=section-heading>
					Map features
					<a class="float-right add-pointer activate-pointer-form" href="javascript:void(0)"><i class=icon-plus-circled></i> Add new</a>
				</h2>
			@if( $pointers )
				@foreach( $pointers as $pointer )
					<div class=col-12>
					{{$pointer->title}}
					</div>
				@endforeach
			@endif
		</div>
	</div>
	
	@show
@endsection