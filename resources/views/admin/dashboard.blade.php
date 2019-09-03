@extends('admin.layouts.main')


@section('content')
	<div class=container>
		<div class="row mt-3">
			<div class=col-12>
				<h2 class=section-heading>
					Your Maps
					<a class="float-right small" href="dashboard/maps/create"><i class=icon-plus-circled></i> <span class="d-none d-md-inline">Add new</span></a>
				</h2>
			</div>
		</div>

		<div class=row>
			@foreach($maps as $map)
				<a class="list-item" href="dashboard/maps/{{$map->id}}">{{ $map->name }}</a>
			@endforeach
		</div>

	</div>
@endsection