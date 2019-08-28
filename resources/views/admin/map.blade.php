@extends('admin.layouts.main')

@section('head')
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.css' rel='stylesheet' />

@endsection


@section('content')

<div id=mapbox>
</div>

	<form class=form-group action="maps" method=POST>
		@csrf
		<input type=hidden name=lng />
		<input type=hidden name=lat />
		<div class=form-group>
			<label for=title>Title</label>
			<input name=title required />
		</div>
		<div class=form-group>
			<label for=content>Content</label>
			<textarea name=content class=mce required></textarea>
		</div>
		<button>go</button>
	</form>

@endsection