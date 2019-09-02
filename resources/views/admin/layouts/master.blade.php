<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<base href='/dashboard' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'It\'s a Map!') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700&display=swap" rel="stylesheet">
	
	<!-- Icons -->
    <link href="{{ asset('css/admin-icons.css') }}" rel="stylesheet">
	
    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
	
	@yield('head')
</head>
<body>
	@yield('header')
	
	@yield('nav')
	
	@yield('content')
</body>
</html>
