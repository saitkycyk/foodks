<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title>QuickFood - Quality delivery or take away food</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="/img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/skins/square/grey.css" rel="stylesheet">
	<link href="css/admin.css" rel="stylesheet">
	<link href="css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
	<link href="css/dropzone.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body>
	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

<div id="preloader">
	<div class="sk-spinner sk-spinner-wave" id="status">
		<div class="sk-rect1"></div>
		<div class="sk-rect2"></div>
		<div class="sk-rect3"></div>
		<div class="sk-rect4"></div>
		<div class="sk-rect5"></div>
	</div>
</div>
<!-- End Preload -->

<!-- Header ================================================== -->
@include('layouts.header')
<!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="/img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
	<div id="subheader">
		<div id="sub_content">
			<h1>Profili jauj</h1>
			<p></p>
		</div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
	<div class="container">
		<ul>
			<li><a href="/">Kryefaqja</a>
			</li>
			<li>Profili</li>
		</ul>
		<a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
	</div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60">
	<div id="tabs" class="tabs">
		<nav>
			<ul>
				<li><a href="#section-1" class="icon-profile"><span>Informacionet Gjenerale</span></a>
				</li>
				<li><a href="#section-2" class="icon-menut-items"><span>Siguria dhe politika</span></a>
				</li>
			</ul>
		</nav>
		<div class="content">

			<section id="section-1">
				@if (!$errors->has('email') && !$errors->has('password') && $errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="indent_title_in">
					<i class="icon_house_alt"></i>
					<h3>Preferencat e llogarisë</h3>
				</div>

				<div class="wrapper_indent">
					<form action="profile/info" method="POST">
						@csrf
						<div class="form-group">
							<label>Emri</label>
							<input class="form-control" name="name" id="name" value="{{$user->name}}" type="text">
						</div>
						<div class="form-group">
							<label>Mbiemri</label>
							<input class="form-control" name="lastname" id="name" value="{{$user->lastname}}" type="text">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nr. Telefonit</label>
									<input type="text" id="Telephone" name="phone" value="{{$user->phone}}" class="form-control">
								</div>
							</div>
						</div>

						<button type="submit" class="btn_1">Ruaj ndryshimet</button>
					</form>
				</div><!-- End wrapper_indent -->

				<hr class="styled_2">
				<div class="indent_title_in">
					<i class="icon_pin_alt"></i>
					<h3>Adresa</h3>
					<p>{{($user->city->name ?? '').', '.($user->road->road_nr ?? '').' '.($user->road->name ?? '').', '.$user->address}}</p>
				</div>
				<div class="wrapper_indent">
					<form action="admin/address" method="POST">
						@csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Qyteti</label>
									<select class="form-control" name="city_id" id="city">
										@foreach(\App\City::all() as $city)
										<option value="{{$city->id}}" @if(isset($user->city) && $city->id == $user->city->id)  selected="true" @endif>{{$city->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Rruga/Addresa</label>
									<select class="form-control" name="road_id" id="road">
										<option value="{{$user->road->id ?? ''}}" selected="true">{{($user->road->road_nr ?? '').' '.($user->road->name ?? '')}}</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Adresa specifike</label>
									<input type="text" id="street_2" name="address" value="{{$user->address ?? ''}}" class="form-control">
								</div>
							</div>
						</div>

						<button type="submit" class="btn_1">Ruaj ndryshimet</button>
					</form>
				</div><!-- End wrapper_indent -->

				<hr class="styled_2">
				<div class="row">
					<div class="indent_title_in" style="float: left">
						<img height="100" width="100" src="{{$user->picture ? url("{$user->picture}") : asset('img/default_pictures/user-default.png')}}" alt="" class="img-circle">
					</div>

					<div class="wrapper_indent add_bottom_45" style="margin-left: 18%">
						<form action="admin/logo" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>Shkarko fotografin</label>
								<div id="logo_picture">
									<input name="file" type="file">
								</div>
							</div>

							<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
					</div><!-- End wrapper_indent -->
				</div>
				<hr class="styled_2">
			</section><!-- End section 1 -->


			<section id="section-2">
				<div class="row">
					<div class="col-md-6 col-sm-6 add_bottom_15">
						<div class="indent_title_in">
							<i class="icon_lock_alt"></i>
							<h3>Ndryshoni fjalëkalimin tuaj</h3>
							<p>
								Plotësoni të dhënat më poshtë për të ndryshuar fjalëkalimin.
							</p>
							@if (Session::has('password'))
							<div class="alert alert-warning">
								<ul>
									<li>{{Session::get('password')}}</li>
								</ul>
							</div>
							@endif
						</div>
						<div class="wrapper_indent">
							<form action="/admin/changepassword" method="POST">
								@csrf
								<div class="form-group">
									<label>Fjalëkalimi vjetër</label>
									<input class="form-control" name="old_password" id="old_password" type="password">
								</div>
								<div class="form-group">
									<label>Fjalëkalimi i ri</label>
									<input class="form-control" name="password" id="new_password" type="password">
								</div>
								<div class="form-group">
									<label>Konfirmo fjalëkalimin e re</label>
									<input class="form-control" name="password_confirmation" id="confirm_new_password" type="password">
								</div>
								<button type="submit" class="btn_1 green">Ndrysho Fjalëkalimin</button>
							</form>
						</div><!-- End wrapper_indent -->
					</div>

					<div class="col-md-6 col-sm-6 add_bottom_15">
						<div class="indent_title_in">
							<i class="icon_mail_alt"></i>
							<h3>Ndryshoni emailin tuaj</h3>
							<p>
								Plotësoni të dhënat më poshtë për të ndryshuar emailin.
							</p>
							@if (Session::has('email'))
							<div class="alert alert-warning">
								<ul>
									<li>{{Session::get('email')}}</li>
								</ul>
							</div>
							@endif
						</div>
						<div class="wrapper_indent">
							<form action="/admin/changeemail" method="POST">
								@csrf
								<div class="form-group">
									<label>Emaili vjetër</label>
									<input class="form-control" name="old_email" id="old_email" type="email">
								</div>
								<div class="form-group">
									<label>Emaili i ri</label>
									<input class="form-control" name="email" id="new_email" type="email">
								</div>
								<div class="form-group">
									<label>Konfirmo emailin e re</label>
									<input class="form-control" name="email_confirmation" id="confirm_new_email" type="email">
								</div>
								<button type="submit" class="btn_1 green">Ndrysho Emailin</button>
							</form>
						</div><!-- End wrapper_indent -->
					</div>

				</div><!-- End row -->

				<hr class="styled_2">
			</section><!-- End section 3 -->

		</div><!-- End content -->
	</div>
</div><!-- End container  -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
@include('layouts.footer')
<!-- End Footer =============================================== -->

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<!-- Search Menu -->
<div class="search-overlay-menu">
	<span class="search-overlay-close"><i class="icon_close"></i></span>
	<form role="search" id="searchform" method="get">
		<input value="" name="q" type="search" placeholder="Search..." />
		<button type="submit"><i class="icon-search-6"></i>
		</button>
	</form>
</div>
<!-- End Search Menu -->

<!-- COMMON SCRIPTS -->
<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/common_scripts_min.js"></script>
<script src="/js/functions.js"></script>
<script src="/assets/validate.js"></script>

<!-- Specific scripts -->
<script src="/js/tabs.js"></script>
<script>
	new CBPFWTabs(document.getElementById('tabs'));
</script>

<script src="/js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript">
	$('.wysihtml5').wysihtml5({});
</script>
<script src="/js/dropzone.min.js"></script>
<script>


	if ($('.dropzone').length > 0) {
		Dropzone.autoDiscover = false;
		$("#photos").dropzone({
			url: "upload",
			addRemoveLinks: true
		});

		$("#logo_picture").dropzone({
			url: "upload",
			maxFiles: 1,
			addRemoveLinks: true
		});

		$(".menu-item-pic").dropzone({
			url: "upload",
			maxFiles: 1,
			addRemoveLinks: true
		});
	}

	var roads = @json(\App\Road::all());

	$('#city').on('change', function() {
		var selectValue = $(this).val();
		$('#road').empty();

		var filtered = roads.filter(function (road) {
			return road.city_id == selectValue
		});

		filtered.forEach(addRoadOption)
		document.getElementById("road").disabled=false;
	        // $( "#road" ).load(window.location.href + " #road" );
	    });

	function addRoadOption(item, index){
		$('#road').append("<option value='" + item['id'] + "'>" + item['road_nr'] + ' ' + item['name'] + "</option>");
	}

</script>

</body>

</html>