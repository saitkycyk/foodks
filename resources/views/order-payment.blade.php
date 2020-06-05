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
              <a href="{{route('orderDetailPage', ['id' => $restaurant->id])}}" class="bs-wizard-dot"></a>
          </div>

          <div class="col-xs-4 bs-wizard-step active">
              <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Pagesa</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a href="javascript:window.location.reload(true)" class="bs-wizard-dot"></a>
          </div>

          <div class="col-xs-4 bs-wizard-step disabled">
              <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Perfundo!</div>
              <div class="progress"><div class="progress-bar"></div></div>
              <a href="" class="bs-wizard-dot"></a>
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
            <li>Mënyra e pagesës</li>
        </ul>
        <a href="#" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">

            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Duhet <span>Ndihmë?</span></h4>
                <a href="#" class="phone">{{$restaurant->phone}}</a>
                <small>{{$restaurant->works}}</small>
            </div>
        </div><!-- End col-md-3 -->
        
        <div class="col-md-6">
            <div class="box_style_2">
                <h2 class="inner">Mënyra e pagesës që ekzistojnë</h2>

                <form id="paymentForm" action="{{route('finalizeOrder', ['orderGroup' => $orderGroup->id])}}" method="POST">
                    @csrf
                    @if($restaurant->door_payment == 1 )
                    <div class="payment_select nomargin">
                        <label><input type="radio" value="door_payment" checked name="payment_method" class="icheck">Paguaj në derë</label>
                        <i class="icon_wallet"></i>
                    </div>
                    @endif

                    @if($restaurant->card_payment == 1)
                    <hr>
                    <div class="payment_select">
                        <label><input type="radio" value="card_payment" name="payment_method" class="icheck">Paguaj me kartelë</label>
                        <i class="icon_creditcard"></i>
                    </div>
                    <div class="form-group">
                        <label>Emri dhe mbiemri në kartelë</label>
                        <input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="Emri dhe mbiemri">
                    </div>
                    <div class="form-group">
                        <label>Numri kartelës</label>
                        <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Numri kartelës">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Data e skadimit</label>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Kodi sigurisë</label>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <img src="/img/icon_ccv.gif" width="50" height="29" alt="ccv"><small>3 numrat e fundit</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--End row -->
                    @endif
                </form>
            </div><!-- End box_style_1 -->
        </div><!-- End col-md-6 -->

        <div class="col-md-3" id="sidebar">
            <div class="theiaStickySidebar">
                <div id="cart_box" >
                    <h3>Porositë <i class="icon_cart_alt pull-right"></i></h3>
                    <table class="table table_summary">
                        <tbody>
                            @foreach(auth()->user()->cart as $order)
                            <tr>
                                <td>
                                    <strong>{{$order->quantity}}x </strong> {{$order->food->name}}
                                </td>
                                <td>
                                    <strong class="pull-right">€ {{$order->price ?? 0}}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <table class="table table_summary">
                        <tbody>
                            <tr>
                                <td class="total">
                                    TOTAL <span class="pull-right">€ {{auth()->user()->cart->sum('price')}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form action="createOrder" method="POST" id="placeOrder">
                        @csrf
                        <a class="btn_full" href="javascript:;" onclick="document.getElementById('paymentForm').submit();">Përfundo</a>
                    </form>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
        </div><!-- End col-md-3 -->

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