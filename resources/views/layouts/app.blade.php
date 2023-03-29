<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="icon" href="{{ URL::asset('/images/ceisd.png') }}" type="image/x-icon"/>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- <link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> -->
	@yield('styles')
</head>
@if(Auth::user()->acc_lvl == 'Administrator')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
@else
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
@endif
   <div class="wrapper" id="app">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('masters.index')}}" class="nav-link">Dashboard</a>
          </li>
          
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3" method="POST" action="{{ route('main_search') }}">
			@csrf
			@method('GET')
			<div class="input-group input-group-sm">
				<input class="form-control form-control-navbar" type="search" name="keyword" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
				  aria-haspopup="true" aria-expanded="false">
				  {{ Auth::user()->office }}
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-default"
					aria-labelledby="navbarDropdownMenuLink-333">
					<a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">Profile</a>
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="dropdown-item">Log-out</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
            <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
      <!-- /.navbar -->
    @include('sidebar.sidebar')
    @yield('content')
     <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>CEISD &copy; 2014-2020 </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.0.0
        </div>
      </footer>
    </div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	
	<script>
		function myFunctions() {
			if(document.getElementById("training").value != "N/A"){
				document.getElementById("other_training").disabled = true;
			}else{
				document.getElementById("other_training").disabled = false;
			}
		}

		function myFunctions2() {
			if(document.getElementById("employ_stat").value != "Permanent"){
				document.getElementById("select4-dropdown").disabled = false;
				document.getElementById("select3-dropdown").disabled = false;
			}else{
				document.getElementById("select4-dropdown").disabled = true;
				document.getElementById("select3-dropdown").disabled = true;
			}
		}
		
		function myFunction() {
			if(document.getElementById("search").value >= 4.30 && document.getElementById("search").value <= 5){
				document.getElementById("demo").value = "Outstanding";
			}else if(document.getElementById("search").value >= 3.50 && document.getElementById("search").value <= 4.29){
				document.getElementById("demo").value = "Very Satisfactory";
			}else if(document.getElementById("search").value >= 3.00 && document.getElementById("search").value <= 3.49){
				document.getElementById("demo").value = "Satisfactory";
			}else if(document.getElementById("search").value >= 1.60 && document.getElementById("search").value <= 2.99){
				document.getElementById("demo").value = "Unsatisfactory";
			}else if(document.getElementById("search").value >= 1.00 && document.getElementById("search").value <= 1.59){
				document.getElementById("demo").value = "Poor";
			}else{
				document.getElementById("demo").value = ""
			}
		}
		
		function enableTextbox()
		{
			if(document.getElementById("Yes123").checked == true){
				document.getElementById("ab34_yes").disabled = false;
			}else{
				document.getElementById("ab34_yes").disabled = true;
			}
			
			if(document.getElementById("Yes3").checked == true){
				document.getElementById("a36_yes").disabled = false;
			}else{
				document.getElementById("a36_yes").disabled = true;
			}
			
			if (document.getElementById("Yes4").checked == true){
				document.getElementById("a37_yes").disabled = false;
			}else{
				document.getElementById("a37_yes").disabled = true;
			}
			
			if (document.getElementById("Yes5").checked == true){
				document.getElementById("a38_yes").disabled = false;
			}else{
				document.getElementById("a38_yes").disabled = true;
			}
			
			if(document.getElementById("Yes6").checked == true){
				document.getElementById("b38_yes").disabled = false;
			}else{
					document.getElementById("b38_yes").disabled = true;
			}
				
			if (document.getElementById("Yes7").checked == true){
				document.getElementById("a39_yes").disabled = false;
			}else{
				document.getElementById("a39_yes").disabled = true;
			}
				
			if (document.getElementById("Yes2").checked == true){
				document.getElementById("a35_yes").disabled = false;
			}else{
				document.getElementById("a35_yes").disabled = true;
			}
				
			if (document.getElementById("Yes1").checked == true){
				document.getElementById("b35_date").disabled = false;
				document.getElementById("b35_status").disabled = false;
			}else{
				document.getElementById("b35_date").disabled = true;
				document.getElementById("b35_status").disabled = true;
			}
					
			if (document.getElementById("Yes8").checked == true){
				document.getElementById("a40_yes").disabled = false;
			}else{
				document.getElementById("a40_yes").disabled = true;
			}
				
			if (document.getElementById("Yes9").checked == true){
				document.getElementById("b40_yes").disabled = false;
			}else{
				document.getElementById("b40_yes").disabled = true;
			}
				
			if (document.getElementById("Yes10").checked == true){
				document.getElementById("c40_yes").disabled = false;
			}else{
				document.getElementById("c40_yes").disabled = true;
			}
				
		}
		
		
			
	</script>
	<script src="{{ LarapexChart::cdn() }}"></script>
	@if(empty($piechart_age) && empty($barchart_bt))
		<p></p>
	@else
		{{ $piechart_age->script() }}
		{{ $barchart_bt->script() }}
	@endif
	@livewireScripts
	@stack('js')
</body>
</html>