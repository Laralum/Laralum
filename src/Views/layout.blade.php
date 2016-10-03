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

	{!! ConsoleTVs\Charts\Charts::assets() !!}

	<style>
		h1,h2,h3,h4,h5 {
			font-family: 'Source Sans Pro', sans-serif !important;
			font-weight: 300;
		}
		h1 {
			font-size: 35px;
		}
		a,.breadcrumb,.header {
			font-family: 'Source Sans Pro', sans-serif !important;
		}
		body, p, span, {
			font-family: 'Miriam Libre', sans-serif !important;
		}
		.logo-box {
			min-height: 100px;
			max-height: 100px;
			position:relavitve;
		}
		.logo-container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.logo-image {
			max-height: 100px;
		}

		.version-color {
			color: #757575;
			font-size: 30px;
		}

		.menu-margin {
			margin-top: 49px;
		}

		.left-menu {
			max-width: 210px;
		}

		.top-padding {
			padding-top: 100px;
		}

		.content-title {
			padding-top: 75px;
			padding-bottom: 75px;
		}

		.page-content {
			padding-top: 50px;
		}

		.white-text {
			color: white;
		}

		.back {
			background-color: #eeeeee !important;
		}

		.code {
			min-height: 400px;
		}

		#menu {
			display: none;
		}

		#menu-div {
			min-height: 49px;
		}
		#vertical-menu {
			overflow-y:auto;
		}

		#vertical-menu::-webkit-scrollbar-track
		{
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			background-color: #F5F5F5;
		}

		#vertical-menu::-webkit-scrollbar
		{
			width: 6px;
			background-color: #F5F5F5;
		}

		#vertical-menu::-webkit-scrollbar-thumb
		{

			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
			background-color: #bdbdbd;
		}
	</style>


  @yield('top')

  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

	<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>

	<div class="ui inverted dimmer"><div class="ui text loader">{{ trans('Laralum::general.loading') }}</div></div>


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


	<div class="ui sidebar left-menu " >
		<header>
			<div class="ui left fixed vertical menu" id="vertical-menu">
				<div id="vertical-menu-height">
					<a href="{{ route('Laralum::dashboard') }}" class="item logo-box">
						<div class="logo-container">
							<img class="logo-image ui fluid small image" src="{{ asset('/vendor/laralum/images/logo-text.png') }}">
						</div>
					</a>
                    @foreach(session('laralum_menu') as $menu)
                        <div class="item">
                            <div class="header">{{ $menu['header'] }}</div>
                            <div class="menu">
                                @foreach($menu['items'] as $item)
                                    <a href="@if(array_key_exists('url', $item)){{ $item['url'] }}@elseif(array_key_exists('route', $item)){{ route($item['route']) }} @else#@endif" class="item">{{ $item['text'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
				</div>
		</header>
	</div>
	<div class="ui top fixed menu"  id="menu-div">
		<div class="item" id="menu">
			<div class="ui secondary button"><i class="bars icon"></i> {{ trans('laralum::general.menu') }}</div>
		</div>
		<div class="item" id="breadcrumb" style="margin-left: 210px !important;" >
			@yield('breadcrumb')
		</div>
		<div class="right menu">
			<div class="item">
				<div class="ui secondary top labeled icon left pointing dropdown button responsive-button">
				  <i class="globe icon"></i>
				  <span class="text responsive-text">{{ trans('laralum::general.language') }}</span>
				  <div class="menu">

				  </div>
				</div>
			</div>
			<div class="item">
				<div class="ui blue top labeled icon left pointing dropdown button responsive-button">
				  <i class="user icon"></i>
				  <span class="text responsive-text">{{ Auth::user()->name }}</span>
				  <div class="menu">
				  	<a href="" class="item">
						{{ trans('laralum.profile') }}
  					</a>
					<a href="{{ url('/') }}" class="item">
						{{ trans('laralum.visit_site') }}
  					</a>
				  	<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="item">
						{{ trans('laralum.logout') }}
  					</a>
				  </div>
				</div>
			</div>
		</div>
	</div>




	<div class="pusher back">
		<div class="menu-margin">
			<div class="content-title" style="background-color: #1678c2;">
				<div class="menu-pusher">
					<div class="ui one column doubling stackable grid container">
						<div class="column">
							<h2 class="ui header">
								<i class="@yield('icon') icon white-text"></i>
								<div class="content white-text">
									@yield('title')
									<div class="sub header">
										<span class="white-text">@yield('subtitle')</span>
									</div>
								</div>
							</h2>
						</div>
					</div>
				</div>
			</div>






			    <div class="page-content">
					<div class="menu-pusher">
		      			@yield('content')
					</div>
				</div>
				<br><br>
				<div class="page-footer">
					<div class="ui bottom fixed padded segment">
						<div class="menu-pusher">
			      			<div class="ui container">

							</div>
						</div>
					</div>
				</div>
		</div>
	</div>

    <script src="{{ asset('/vendor/laralum/js/semantic.min.js') }}"></script>
    <script src="{{ asset('/vendor/laralum/js/jquery.timeago.js') }}"></script>

	<script>
		initialSetup();

		lookStatus();

		$('#vertical-menu').transition('fade');

		$( window ).resize(lookStatus);

		$(".send-data").click(function(){
			disablePage();
			setTimeout(formSubmit, 500);
		});

		$( ".form" ).submit(function( event ) {
		  disablePage();
		});

		$("a").click(function(){
			if ($(this).hasClass('no-disable')) {
				//Do nothing
			} else {
				disablePage();
			}
		});

		$('.ui.dropdown')
		  .dropdown()
		;

		$('.ui.checkbox')
		  .checkbox()
		;

		$('.pop')
		  .popup()
		;

		setTimeout(function(){
			$('.temp-msg').fadeOut();
		}, 5000);

		$('#close-msg').click(function(){
			$('#msg').fadeOut();
		});

		$('#check_all').click(function(){
			$(".checkable").prop('checked', true);
		});

		$('#uncheck_all').click(function(){
			$(".checkable").prop('checked', false);
		});

		function enablePage() {
			enableButtons();
			hideDimmer();
		}

		function disablePage() {
			showDimmer();
			disableButtons();
		}

		function showDimmer() {
			$("body").dimmer('show');
		}

		function hideDimmer() {
			$("body").dimmer('hide');
		}

		function disableButtons() {
			$(".button").addClass("loading");
			$(".button").addClass("disabled");
		}

		function enableButtons() {
			$(".button").removeClass("loading");
			$(".button").removeClass("disabled");
		}

		function initialSetup() {
			$( "#menu" ).click(function() {
				$('.ui.sidebar').sidebar('toggle');
			});
			$("body").dimmer({closable: false});
		}


		function setSidebarMode(mode){

			var containerPadding = 150;

			if(mode == 'mobile'){

				$('#menu').fadeIn(500);

				$(".menu-pusher").css("padding-left", 0);

				$('#account_button').removeClass('labeled');
				$('#account_text').hide();

				$('.responsive-button').removeClass('labeled');
				$('.responsive-text').hide();

				$('#breadcrumb').fadeOut();

				$('.ui.sidebar').sidebar('setting', { closable: true, dimPage: false, transition: 'overlay'});
				$('.ui.sidebar').sidebar('hide');

			} else if(mode == 'desktop'){

				$('#menu').hide();

				$(".menu-pusher").css("padding-left", 212);

				$('.responsive-button').addClass('labeled');
				$('.responsive-text').show();

				$('#breadcrumb').fadeIn();

				$('.ui.sidebar').sidebar('setting', { closable: false, dimPage: false, transition: 'overlay'});
				$('.ui.sidebar').sidebar('show');

			}
		}

		function lookStatus() {
			var currentWidth = $( window ).width();
			if(currentWidth < 991) {
				setSidebarMode('mobile');
			} else {
				setSidebarMode('desktop');
			}
		}
	</script>

	@yield('bot')

	<script>
		setInterval(function(){
			var footer = $('.page-footer');
			footer.removeAttr("style");
			var footerPosition = footer.position();
			var docHeight = $( document ).height();
			var winHeight = $( window ).height();
			if(winHeight == docHeight) {
				if((footerPosition.top + footer.height() + 3) < docHeight) {
					var topMargin = (docHeight - footer.height()) - footerPosition.top;
					footer.css({'margin-top' : topMargin + 'px'});
				}
			}
		}, 10);
	</script>

</body>
</html>
