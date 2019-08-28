@extends('admin.layouts.main')


@section('content')

	@section('map')
	<div class="container my-5">
		<div class=row>
			<div class=col-md-10>
				<h1>Click on the map to create a pointer</h1>
				<div id=mapbox>
				</div>
			</div>
			<div class=col-md-2>


			</div>
		</div>
	</div>
	
	<div class="new-pointer-popup d-none">
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
	</div>
	@show
	
@endsection