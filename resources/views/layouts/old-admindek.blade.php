<!DOCTYPE html>
<html lang="en">

	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<head>
		<title>Property Management System</title>
			<!--[if lt IE 10]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}"></script>
			<![endif]-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Lorem Ipsum" />
		<meta name="keywords" content="Lorem Ipsum" />
		<meta name="author" content="Lorem Ipsum" />

		{{-- Icon --}}
		<link rel="icon" href="https://colorlib.com//polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
		{{-- Google Fonts --}}
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
		{{-- CSS Stylesheets --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/bower_components/bootstrap/css/bootstrap.min.css') }}">

		<link rel="stylesheet" href="{{ asset('admindek/files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/icon/feather/css/feather.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/icon/themify-icons/themify-icons.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/icon/icofont/css/icofont.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/icon/font-awesome/css/font-awesome.min.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/css/style.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('admindek/files/assets/css/pages.css') }}">
	
	</head>
	
	<body>
		<div class="loader-bg">
		<div class="loader-bar"></div>
		</div>

		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">

				@include('includes.header')
				
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">

						@include('includes.sidebar')

						<div class="pcoded-content">

							@include('includes.breadcrumb')

							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											@yield('content')
										</div>
									</div>
								</div>
							</div>
						</div>

						<div id="styleSelector">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--[if lt IE 10]>
		    <div class="ie-warning">
		        <h1>Warning!!</h1>
		        <p>You are using an outdated version of Internet Explorer, please upgrade
		            <br/>to any of the following web browsers to access this website.
		        </p>
		        <div class="iew-container">
		            <ul class="iew-download">
		                <li>
		                    <a href="http://www.google.com/chrome/">
		                        <img src="{{ asset('admindek/files/assets/images/browser/chrome.png') }}" alt="Chrome">
		                        <div>Chrome</div>
		                    </a>
		                </li>
		                <li>
		                    <a href="https://www.mozilla.org/en-US/firefox/new/">
		                        <img src="{{ asset('admindek/files/assets/images/browser/firefox.png') }}" alt="Firefox">
		                        <div>Firefox</div>
		                    </a>
		                </li>
		                <li>
		                    <a href="http://www.opera.com">
		                        <img src="{{ asset('admindek/files/assets/images/browser/opera.png') }}" alt="Opera">
		                        <div>Opera</div>
		                    </a>
		                </li>
		                <li>
		                    <a href="https://www.apple.com/safari/">
		                        <img src="{{ asset('admindek/files/assets/images/browser/safari.png') }}" alt="Safari">
		                        <div>Safari</div>
		                    </a>
		                </li>
		                <li>
		                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
		                        <img src="{{ asset('admindek/files/assets/images/browser/ie.png') }}" alt="">
		                        <div>IE (9 & above)</div>
		                    </a>
		                </li>
		            </ul>
		        </div>
		        <p>Sorry for the inconvenience!</p>
		    </div>
		<![endif]-->

		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/jquery/js/jquery.min.js') }}"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/popper.js/js/popper.min.js') }}"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

		<script src="{{ asset('admindek/files/assets/pages/waves/js/waves.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>

		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/modernizr/js/modernizr.js') }}"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

		<script src="{{ asset('admindek/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/pages/data-table/js/jszip.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/pages/data-table/js/pdfmake.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/pages/data-table/js/vfs_fonts.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>

		<script src="{{ asset('admindek/files/assets/pages/data-table/js/data-table-custom.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>

		<script src="{{ asset('admindek/files/assets/js/pcoded.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/vertical/vertical-layout.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript" src="{{ asset('admindek/files/assets/js/script.js') }}"></script>

		<script
		  src="https://code.jquery.com/jquery-3.4.1.js"
		  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		  crossorigin="anonymous">
		</script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

		<script type="text/javascript">
		    $(document).ready(function() {
		        $('.select2').select2();
		    });
		</script>

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		@include('sweet::alert')
		
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script type="2c05aa53a3d714f38c6fbba4-text/javascript">
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-23581568-13');
		</script>
		<script src="{{ asset('admindek/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="2c05aa53a3d714f38c6fbba4-|49" defer=""></script>





		{{-- <script data-cfasync="false" src="{{ asset('admindek/cloudflare-static/email-decode.min.js') }}"></script>


		<script src="{{ asset('admindek/files/bower_components/jquery/js/jquery.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/jquery-ui/js/jquery-ui.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/popper.js/js/popper.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

		<script src="{{ asset('admindek/files/assets/pages/waves/js/waves.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('admindek/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}" type="text/javascript"></script>

		@yield('js')

		<script src="{{ asset('admindek/files/assets/pages/data-table/js/data-table-custom.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/pcoded.min.js') }}" type="a03e1dd1be4b097e43526b44-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/vertical/vertical-layout.min.js') }}" type="a03e1dd1be4b097e43526b44-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}" type="2c05aa53a3d714f38c6fbba4-text/javascript"></script>
		<script src="{{ asset('admindek/files/assets/js/script.min.js') }}" type="a03e1dd1be4b097e43526b44-text/javascript"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="a03e1dd1be4b097e43526b44-text/javascript"></script>
		<script type="a03e1dd1be4b097e43526b44-text/javascript">
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-23581568-13');
		</script>
		<script src="{{ asset('admindek/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="a03e1dd1be4b097e43526b44-|49" defer=""></script> --}}
	</body>

</html>
