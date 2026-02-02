@php
    $controller = DzHelper::controller();
    $page = $action = DzHelper::action();
    $action = $controller.'_'.$action;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title> 

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="keywords" content="admin dashboard, admin template, analytics, bootstrap, bootstrap 5, bootstrap 5 admin template, job board admin, job portal admin, modern, responsive admin dashboard, sales dashboard, sass, ui kit, web app, frontend">
	<meta name="description" content="@yield('page_description', $page_description ?? '')">
	<meta property="og:title" content="Jobick : Laravel Job Admin Dashboard Bootstrap 5 Template">
	<meta property="og:description" content="@yield('page_description', $page_description ?? '')" >
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<meta name="twitter:title" content="Jobick : Laravel Job Admin Dashboard Bootstrap 5 Template">
	<meta name="twitter:description" content="@yield('page_description', $page_description ?? '')">
	<meta name="twitter:image" content="https://jobick.dexignlab.com/laravel/social-image.png">
	<meta name="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png') }}">
    <link class="main-css" href="css/style.css" rel="stylesheet">
    
</head>
       
<body>
    <div class="fix-wrapper">
        <div class="container">
            <div class="row justify-content-center">
				@yield('content')
			</div>
		</div>
    </div>
	
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<!-- Required vendors -->
	@if(!empty(config('dz.public.global.js.top')))
        @foreach(config('dz.public.global.js.top') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
        @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
        @foreach(config('dz.public.global.js.bottom') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
	
	@stack('scripts')
</body>
</html>