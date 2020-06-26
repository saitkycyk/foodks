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
  <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
      <div id="sub_content">
       <h1>Kontakti</h1>
       <p>Këtu mund të na kontaktoni në çdo kohë.</p>
     </div><!-- End sub_content -->
   </div><!-- End subheader -->
 </section><!-- End section -->
 <!-- End SubHeader ============================================ -->

 <div id="position">
  <div class="container">
    <ul>
      <li><a href="#0">Kryefaqja</a></li>
      <li>Kontakti</li>
    </ul>
    <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
  </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row" id="contacts">
   <div class="box_style_2">
     <h2 class="inner">Informacion mbi kompaninë</h2>
     <p class="add_bottom_30">
      <p><strong>Adresa:</strong> Rruga "Kuvendi i Arbrit", Bazhdarhane, Prizren/KOSOVË</p>
      <p><strong>Adresa e email-it:</strong> {{'info@'.env('APP_NAME')}}.com</p>
      <p><strong>Numri i telefonit:</strong> +383 44 478 582 (whatsapp/viber)</p> 
    </p>
    <p><a href="tel://004542344599" class="phone"><i class="icon-phone-circled"></i>  +45 423 445 99</a></p>
    <p class="nopadding"><a href="mailto:customercare{{'@'.env('APP_NAME')}}.com"><i class="icon-mail-3"></i> support{{'@'.env('APP_NAME')}}.com</a></p>
  </div>
</div><!-- End row -->
</div><!-- End container -->
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