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
			<div id=map-and-app v-bind:class="{'editing': form_shown, 'paused': pauseEdit }" class="col-12 relative overflow-hidden">
				<h1>{{$map->name}} <span class="small float-right">Make public <div class=checkbox :data-checked="published" @click="setMapPublicStatus(!published)"></div></span></h1>
				<div id=mapbox>
				
				</div>
				<div id=app>
					<p>
						<strong v-bind:class="{'d-none': mode != 'create'}">New pointer</strong>
						<strong v-bind:class="{'d-none': mode == 'create'}">Edit pointer</strong>
						<a href="javascript:void(0)" class="float-right d-lg-none" @click="pauseEdit = !pauseEdit"><i class=icon-down-open></i></a>
					</p>
					<p class=small>Change the location of this pointer by dragging the big marker around the map. Hit 'save' to save the markers location and details.</p>
				
					<form class=form-group action="/dashboard/pointers" method=POST>
						@csrf
						<input type=hidden v-model=lng name=lng />
						<input type=hidden v-model=lat name=lat />
						<input type=hidden name=map_id value="{{$map->id}}"/>
						<input type=hidden name=map_public value="{{$map->published == 1 ? 'true' : '' }}"/>
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
					<a class="float-right small add-pointer activate-pointer-form" href="javascript:void(0)"><i class=icon-plus-circled></i> <span class="d-none d-md-inline">Add new</span></a>
				</h2>
			@if( $pointers )
				@foreach( $pointers as $pointer )
					<a href='javascript:void(0)' class="list-item pointer-list-item" data-id="{{$pointer->id}}" data-lng="{{$pointer->lng}}" data-lat="{{$pointer->lat}}">{{$pointer->title}}</a>
				@endforeach
			@endif
		</div>
	</div>
	
	@show
@endsection