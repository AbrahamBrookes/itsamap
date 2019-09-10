@extends('admin.layouts.main')


@section('content')
	<div class=container>
		<div class="row mt-3">
			<div class=col-6>
				<h2>Create a new map</h2>
			</div>
		</div>

		<div class=row>
			<div class=col-12>
				<form action="/dashboard/maps" method=POST>
					@csrf
					<div class=form-group>
						<label for=name>Name your map</label>
						<input class=form-control name=name required />
					</div>
					<input type=submit class="btn btn-primary" value="Go" />
				</form>
			</div>
		</div>

	</div>
@endsection