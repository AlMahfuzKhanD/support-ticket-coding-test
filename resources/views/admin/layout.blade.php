<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Jassa">
	<meta name="keywords" content="Jassa, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('asset/backend/img/icons/icon-48x48.png')}}">

	<link rel="canonical" href="index.htm">

	<title>Support Ticket System</title>

	<link href="{{asset('asset/backend/css2.css?family=Inter:wght@300;400;600&display=swap')}}" rel="stylesheet">

	<!-- Choose your prefered color scheme -->
	
	<!-- <link href="css/light.css" rel="stylesheet"> -->
	<!-- <link href="css/dark.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- Remove this after purchasing -->
	<link class="js-stylesheet" href="{{ asset('asset/backend/css/light.css')}}" rel="stylesheet">
	<!-- Toastr CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	<!-- Toastr CSS -->
	{{-- <script src="{{asset('asset/backend/js/settings.js')}}"></script> --}}
	<style>
		body {
			opacity: 0;
		}
	</style>
	<!-- END SETTINGS -->
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<div class="wrapper">
        <!-- Sidebar Start -->
		@include('admin.home.sidebar')
        <!-- Sidebar Start -->
		<div class="main">
            <!-- Top nav start -->
			@include('admin.home.top-nav')
            <!-- Top nav end -->
            <!-- main content start -->
			@yield('content')
            <!-- main content end -->
            <!-- footer start -->
			@include('admin.home.footer')
            <!-- footer start -->
		</div>
	</div>
	
	<script src="{{ asset('asset/backend/js/app.js')}}"></script> 
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	@include('common.notification')
	<script src="{{ asset('asset/backend/js/datatables.js')}}"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});
		});
	</script>
	
</body>

</html>