<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<title>{{$store->store_name}} Panel</title>
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{url($store->store_photo)}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="GoGrocer Multistore" />
	<meta name="author" content="Tecmanic" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.2/iconfont/material-icons.min.css" integrity="sha512-y9glprRcVESvYY3suAqBUYXx0ySbQNvbzzgvLy9F2o38Y7XCNeq/No2gnHjV3+Rjyq5ijoPZRMXotpdw6jcG4g==" crossorigin="anonymous" />

	<!-- ================== BEGIN core-css ================== -->
	<link href="{{url('assets/theme_assets/css/app.min.css')}}" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
</head>
d

  <style>
      .card-header.card-header-primary {
    padding: 10px !important;
    }
    .alert {
    padding: 6px !important;
    }
    
  </style>
</head>

<body data-spy='scroll' data-target='#sidebar-bootstrap' data-offset='200'>
  	<div id="app" class="app">
     @include('store.layout.nav')
      @include('store.layout.sidebar')
     <!-- BEGIN #content -->
		<div id="content" class="app-content">
        <div class="row">
        	<div class="col-md-7">
			<h1 class="page-header mb-3">
				Hi, {{$store->store_name}}. <small>{{ __('keywords.Here is your store panel')}}.</small>

			</h1></div>
			<div class="col-md-5" align="right">
			
            <div class="col-md-4" align="right">
                <select class="form-control changeLang">
                    <option value="en" {{ session()->get('locale') == 'en'||config('app.locale')=="en" ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('locale') == 'fr'||config('app.locale')=="fr" ? 'selected' : '' }}>France</option>
                    <option value="sp" {{ session()->get('locale') == 'sp'||config('app.locale')=="sp" ? 'selected' : '' }}>Spanish</option>
                </select>
            </div></div></div>
                 @yield('content')
             </div>
        <!--footer-->
         @include('store.layout.footer')

   	        </div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="{{url('assets/theme_assets/js/app.min.js')}}"></script>
	<!-- ================== END core-js ================== -->
	
	<!-- ================== BEGIN page-js ================== -->
	<script src="{{url('assets/theme_assets/plugins/apexcharts/dist/apexcharts.min.js')}}"></script>
	<script src="{{url('assets/theme_assets/js/demo/dashboard.demo.js')}}"></script>
	<!-- ================== END page-js ================== -->
      
<script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";
  
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
</script>
</body>
</html>