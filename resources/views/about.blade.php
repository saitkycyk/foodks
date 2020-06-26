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

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- GOOGLE WEB FONT -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">

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
	<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
		<div id="subheader">
			<div id="sub_content">
				<h1>Rreth Nesh</h1>
				<p>Një pëmbajtje e shkurtë rreth historisë tonë.</p>
				<p></p>
			</div><!-- End sub_content -->
		</div><!-- End subheader -->
	</section><!-- End section -->
	<!-- End SubHeader ============================================ -->

	<div id="position">
		<div class="container">
			<ul>
				<li><a href="/">Kryefaqja</a></li>
				<li>Reth Nesh</li>
			</ul>
		</div>
	</div><!-- Position -->

	<!-- Content ================================================== -->
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-md-4">
				<h3 class="nomargin_top">Kliko dhe jepi fund urisë!</h3>
				<p>
					Kurseni kohë dhe hani shijshëm...
				</p>
				<p>
					Hajatedera.com ua bën më të lehtë porositjen e ushqimit. Mjafton të ndiqni vetëm disa hapa të thjeshtë, për të pasur ushqimin tuaj të preferuar në vendin e kërkuar.
				</p>
				<p>
					Ushqimi na mban në energji! Ajo që na bashkon të gjithë ne është pasioni për ushqimin dhe shija qe marrim nga ajo . I tillë është hajatedera.com
				</p>
				<p>
					Jemi treguar të kujdesshëm në çdo detaj dhe të tillë do të tregohemi dhe në përzgjedhjen e restoranteve për t’ju shërbyer ushqimet më cilësore.
				</p>
				<p>
					Fillimi duket i vështirë, por jo i pamundur. Ne besojmë që të gjithë së bashku do të sjellim diçka ndryshe. Ushqehuni me pasion dhe me dashuri. Jepni fund urisë me hajatedera.com!
				</p>
			</div>
			<div class="col-md-7 col-md-offset-1 text-right hidden-sm hidden-xs">
				<img src="img/devices.jpg" alt="" class="img-responsive">
			</div>
		</div><!-- End row -->
		<hr class="more_margin">
	</div><!-- End container -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 nopadding features-intro-img">
				<div class="features-bg">
					<div class="features-img">
					</div>
				</div>
			</div>
			<div class="col-md-6 nopadding">
				<div class="features-content">
					<h3>Kush mund ta përdorë Hajatedera.com?</h3>
					<p>
						Hajatedera është mënyra më e lehtë për një klient për të porositur ushqimin online dhe një mundësi e shkëlqyer për restorantin, për të rritur të ardhurat dhe klientët.
					</p>
				</div>
			</div>
		</div>
	</div><!-- End container-fluid  -->
	<!-- End Content =============================================== -->

	<!-- Footer ================================================== -->
	@include('layouts.footer')
	<!-- End Footer =============================================== -->

	<div class="layer"></div><!-- Mobile menu overlay mask -->

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

</body>
</html>