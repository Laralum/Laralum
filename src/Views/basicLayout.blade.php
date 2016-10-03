<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>@yield('title')</title>
	<meta name="description" content="Laralum - Laravel administration panel">
	<meta name="author" content="Èrik Campobadal Forés">

	<link rel='shortcut icon' href="{{ asset('/vendor/laralum/laralum.ico') }}" type='image/x-icon'/ >
    <link rel='stylesheet' type='text/css' href="{{ asset('/vendor/laralum/css/semantic.min.css') }}">
    <link rel='stylesheet' type='text/css' href="{{ asset('/vendor/laralum/css/sweetalert.css') }}">
    <script src="{{ asset('/vendor/laralum/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('/vendor/laralum/js/sweetalert.min.js') }}"></script>
	<link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:200,300,400" rel="stylesheet">

	<style>
		h1,h2,h3,h4,h5 {
			font-family: 'Source Sans Pro', sans-serif !important;
			font-weight: 300;
		}
		a,.breadcrumb,.header {
			font-family: 'Source Sans Pro', sans-serif !important;
		}
		body, p, span, {
			font-family: 'Miriam Libre', sans-serif !important;
		}
	</style>



  @yield('top')

  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body style="background-color: @yield('background-color');">

	@if(session('success'))
		<script>
			swal({
				title: "{{ trans('laralum::general.nice') }}!",
				text: "{!! session('success') !!}",
				type: "success",
				confirmButtonText: "{{ trans('laralum::general.okai') }}"
			});
		</script>
	@endif
	@if(session('error'))
		<script>
			swal({
				title: "{{ trans('laralum::general.whops') }}!",
				text: "{!! session('error') !!}",
				type: "error",
				confirmButtonText: "{{ trans('laralum::general.okai') }}"
			});
		</script>
	@endif
	@if(session('warning'))
		<script>
			swal({
				title: "{{ trans('laralum::general.watch_out') }}!",
				text: "{!! session('warning') !!}",
				type: "warning",
				confirmButtonText: "{{ trans('laralum::general.okai') }}"
			});
		</script>
	@endif
	@if(session('info'))
		<script>
			swal({
				title: "{{ trans('laralum::general.watch_out') }}!",
				text: "{!! session('info') !!}",
				type: "info",
				confirmButtonText: "{{ trans('laralum::general.okai') }}"
			});
		</script>
	@endif
	@if (count($errors) > 0)
		<script>
			swal({
				title: "{{ trans('laralum::general.whops') }}!",
				text: "<?php foreach($errors->all() as $error){ echo "$error<br>"; } ?>",
				type: "error",
				confirmButtonText: "{{ trans('laralum::general.okai') }}",
				html: true
			});
		</script>
	@endif

    @yield('content')

    <script src="{{asset('/vendor/laralum/js/semantic.min.js') }}"></script>

	@yield('bot')

</body>
</html>
