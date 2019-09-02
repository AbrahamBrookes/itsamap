@extends('admin.layouts.main')


@section('content')
	<div class=container>
		<div class="row mt-3">
			<div class=col-12>
				<h2 class=section-heading>
					Your Maps
					<a class=float-right href="dashboard/maps/create"><i class=icon-plus-circled></i> Add new</a>
				</h2>
			</div>
		</div>

		<div class=row>
			@foreach($maps as $map)
			<div class=col-12>
				<a href="dashboard/maps/{{$map->id}}">{{ $map->name }}</a>
			</div>
			@endforeach
		</div>

	</div>
@endsection