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
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">

	<!-- Radio and check inputs -->
	<link href="css/skins/square/grey.css" rel="stylesheet">
	<link href="css/ion.rangeSlider.css" rel="stylesheet">
	<link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet" >

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
</div><!-- End Preload -->

<!-- Header ================================================== -->
@include('layouts.header')
<!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
	<div id="subheader">
		<div id="sub_content">
			<h1>{{$restaurants->count()}} rezultat/e për zonën tuaj</h1>
			<div><i class="icon_pin"></i>@if(request()->has('city')) {{\App\City::find(request('city'))->name ?? 'Të gjithë'}} @endif</div>
		</div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
	<div class="container">
		<ul>
			<li><a href="/">Kryefaqja</a></li>
			<li>Restorantet</li>
		</ul>
		<a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
	</div>
</div><!-- Position -->

<div class="collapse" id="collapseMap">
	<div id="map" class="map"></div>
</div><!-- End Map -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row">

		<div class="col-md-3">
{{-- 			<p>
				<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
			</p> --}}
			<div id="filters_col">
				<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filtrimet <i class="icon-plus-1 pull-right"></i></a>
				<div class="collapse" id="collapseFilters">
{{-- 					<div class="filter_type">
						<h6>Distance</h6>
						<input type="text" id="range" value="" name="range">
						<h6>Type</h6>
						<ul>
							<li><label><input type="checkbox" checked class="icheck">All <small>(49)</small></label></li>
							<li><label><input type="checkbox" class="icheck">American <small>(12)</small></label><i class="color_1"></i></li>
							<li><label><input type="checkbox" class="icheck">Chinese <small>(5)</small></label><i class="color_2"></i></li>
							<li><label><input type="checkbox" class="icheck">Hamburger <small>(7)</small></label><i class="color_3"></i></li>
							<li><label><input type="checkbox" class="icheck">Fish <small>(1)</small></label><i class="color_4"></i></li>
							<li><label><input type="checkbox" class="icheck">Mexican <small>(49)</small></label><i class="color_5"></i></li>
							<li><label><input type="checkbox" class="icheck">Pizza <small>(22)</small></label><i class="color_6"></i></li>
							<li><label><input type="checkbox" class="icheck">Sushi <small>(43)</small></label><i class="color_7"></i></li>
						</ul>
					</div> --}}
					<div class="filter_type">
						<h6>Qyteti</h6>
						<select id="citySelect" class="form-control" name="city_id" id="city">
							<option value="all" >Të gjitha</option>
							@foreach(\App\City::all() as $city)
							<option value="{{$city->id}}" @if(request('city') == $city->id)  selected="true" @endif >{{$city->name}}</option>
							@endforeach
						</select>
{{-- 						<h6>Vlerësimi</h6>
						<ul>
							<li><label><input type="checkbox" class="icheck"><span class="rating">
								<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
							</span></label></li>
							<li><label><input type="checkbox" class="icheck"><span class="rating">
								<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" class="icheck"><span class="rating">
								<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" class="icheck"><span class="rating">
								<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
							<li><label><input type="checkbox" class="icheck"><span class="rating">
								<i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
							</span></label></li>
						</ul> --}}
					</div>
{{-- 					<div class="filter_type">
						<h6>Mënyra e pagesës</h6>
						<ul class="nomargin">
							<li><label>
								<input id="paymentType" class="icheck" checked type="checkbox" value="door" name="payment_type"/>Në Derë
							</label></li>
							<li><label>
								<input id="paymentType" class="icheck" checked type="checkbox" value="card" name="payment_type"/>Kartelë
							</label></li>
						</ul>
					</div> --}}
				</div><!--End collapse -->
			</div><!--End filters col-->
		</div><!--End col-md -->

		<div class="col-md-9">

{{-- 			<div id="tools">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="styled-select">
							<select name="sort_rating" id="sort_rating">
								<option value="" selected>Sort by ranking</option>
								<option value="lower">Lowest ranking</option>
								<option value="higher">Highest ranking</option>
							</select>
						</div>
					</div>
					<div class="col-md-9 col-sm-9 hidden-xs">
						<a href="list_page.html" class="bt_filters"><i class="icon-list"></i></a>
					</div>
				</div>
			</div> --}}
			<div class="row">
				@foreach($restaurants as $key => $restaurant)
			@if($key % 2 == 0)</div><div class="row"> @endif

				<div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
					<a class="strip_list grid" href="restaurant/{{$restaurant->id}}">
						{{-- <div class="ribbon_1">Popular</div> --}}
						<div class="desc">
							<div class="thumb_strip">
								<img src="{{$restaurant->picture ? url("{$restaurant->picture}") : asset('img/default_pictures/restaurant-default.jpg')}}" alt="">
							</div>


{{-- 							<div class="rating">
								<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
							</div> --}}
							<h3>{{$restaurant->name}}</h3>
							<div class="type">
								Mexican / American
							</div>
							<div class="location">
								{{$restaurant->address}}<br><span class="opening">{{$restaurant->works}}</span> | Porosia minimale: {{$restaurant->preferences['min_order'] ?? ''}}
							</div>
							<ul>
								<li>Në Derë<i class="{{$restaurant->door_payment ? 'icon_check_alt2 ok' : 'icon_close_alt2 no'}}"></i></li>
								<li>Kartelë<i class="{{$restaurant->card_payment ? 'icon_check_alt2 ok' : 'icon_close_alt2 no'}}"></i></li>
							</ul>
						</div>
					</a><!-- End strip_list-->
				</div><!-- End col-md-6-->
				@endforeach
				@if($restaurants->count() % 2 != 0) </div> @endif

				{{$restaurants->links()}}          
			</div><!-- End col-md-9-->

		</div><!-- End row -->
	</div><!-- End container -->
	<!-- End Content =============================================== -->
	<!-- Footer ================================================== -->
	@include('layouts.footer')
	<!-- End Footer =============================================== -->
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
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>
	<script src="assets/validate.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script  src="js/cat_nav_mobile.js"></script>
	<script>$('#cat_nav').mobileMenu();</script>
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>
	<script src="js/ion.rangeSlider.js"></script>
	<script>

		$('#citySelect').change(function () {
			window.location = "/restaurants?city="+$(this).val();
		});


// $("#paymentType").change(function() {
// console.log('activated');
//     if(this.checked) {
//         insertParam('door_payment', $(this).val());
//     }
// });

// function insertParam(key, value) {
//     key = encodeURIComponent(key);
//     value = encodeURIComponent(value);
//     console.log('activated');
//     // kvp looks like ['key1=value1', 'key2=value2', ...]
//     var kvp = document.location.search.substr(1).split('&');
//     let i=0;

//     for(; i<kvp.length; i++){
//         if (kvp[i].startsWith(key + '=')) {
//             let pair = kvp[i].split('=');
//             pair[1] = value;
//             kvp[i] = pair.join('=');
//             break;
//         }
//     }

//     if(i >= kvp.length){
//         kvp[kvp.length] = [key,value].join('=');
//     }

//     // can return this or...
//     let params = kvp.join('&');

//     // reload page with new params
//     document.location.search = params;
// }


		$(function () {
			'use strict';
			$("#range").ionRangeSlider({
				hide_min_max: true,
				keyboard: true,
				min: 0,
				max: 15,
				from: 0,
				to:5,
				type: 'double',
				step: 1,
				prefix: "Km ",
				grid: true
			});
		});
	</script>
</body>
</html>