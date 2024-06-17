<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
	<meta name="public_url" content="{{ url('/') }}/" />

    <title>{{ config('admin.app_name') }} Admin</title>
    
	{{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

</head>
<body>

    {{-- Vue App --}}
    <div id="app">
        <div id="pageloader" class="loader-wrapper is-active">
            <div class="loader is-loading"></div>
        </div>

        <baseapp />
    </div>
	
    {{-- JS --}}
    @vite('resources/js/admin/app.js')

</body>
</html>
