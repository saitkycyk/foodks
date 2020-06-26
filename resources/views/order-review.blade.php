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
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png">
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="/css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="/css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="/js/html5shiv.min.js"></script>
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
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="/img/sub_header_1.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
           <h1>Vendos porosinë</h1>
           <div class="bs-wizard">
            <div class="col-xs-4 bs-wizard-step complete">
              <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Detajet</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a href="#" class="bs-wizard-dot"></a>
          </div>

          <div class="col-xs-4 bs-wizard-step complete">
              <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Pagesa</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a href="#" class="bs-wizard-dot"></a>
          </div>

          <div class="col-xs-4 bs-wizard-step active">
              <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Perfundo!</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a href="#" class="bs-wizard-dot"></a>
          </div>  
      </div><!-- End bs-wizard --> 
  </div><!-- End sub_content -->
</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Kryefaqja</a></li>
            <li><a href="#">Menu</a></li>
            <li>Përfundimi i pagesës</li>
        </ul>
        <a href="#" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="box_style_2">
                <h2 class="inner">Porosia është konfirmuar!</h2>
                <div id="confirm">
                    <i class="icon_check_alt2"></i>
                    <h3>Faleminderit!</h3>
                    <p>
                        Porosia juaj është konfirmuar me sukses dhe është dërguar në restorant, gjendjen e porosisë mund të kontrolloni nga <a href="/orders">Menaxhimi i Porosive</a>. 
                    </p>
                </div>
                <h4>Përmbledhje</h4>
                <table class="table table-striped nomargin">
                    <tbody>

                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>{{$order->quantity}}x </strong> {{$order->food->name}}
                            </td>
                            <td>
                                <strong class="pull-right">€ {{$order->price ?? 0}}</strong>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="total_confirm">
                                TOTAL
                            </td>
                            <td class="total_confirm">
                                <span class="pull-right">€ {{$orders->sum('price')}}</span>
                            </td>
                        </tr>
                    </tbody>
        </table>
    </div>
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
<script src="/js/jquery-2.2.4.min.js"></script>
<script src="/js/common_scripts_min.js"></script>
<script src="/js/functions.js"></script>
<script src="/assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script  src="/js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
<script src="/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
  });
</script>


</body>
</html>