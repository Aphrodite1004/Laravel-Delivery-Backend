<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Parcel | Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="{{url('assets/css/app.min.css')}}" rel="stylesheet" />
	<link href="{{url('css/backend.css')}}" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ================== END core-css ================== -->
	
</head>
<body>
	<!-- BEGIN #app -->
	<div id="app" class="app">
		
		@include('parcel.layout.header')

		@include('parcel.layout.sidebar')
		<!-- BEGIN #content -->
		<div id="content" class="app-content">
		
			@yield('content')
          
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="{{url('assets/js/app.min.js')}}"></script>
	<!-- ================== END core-js ================== -->
	
	<!-- ================== BEGIN page-js ================== -->
	<script src="{{url('assets/plugins/apexcharts/dist/apexcharts.min.js')}}"></script>
	<script src="{{url('assets/js/demo/dashboard.demo.js')}}"></script>
	<!-- ================== END page-js ================== -->
</body>
<script>
$(document).ready(function () {
          if (!$.browser.webkit) {
              $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
          }
      });
</script>
<script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";
  
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
</script>
</html>