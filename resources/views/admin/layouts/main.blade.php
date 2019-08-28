@extends('admin.layouts.master')

@section('header')
		<img class='logo-icon' src="{{ asset('img/logo-icon.png')}}" />
		<h1>It's a Map!</h1>
@endsection

@section('nav')
		<ul>
			<li><a href="/dashboard">Home</a></li>
			<li><a href="/dashboard/map">Map Editor</a></li>
		</ul>
@endsection


@section('footer')
		&copy; rtfn
@endsection