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
    
    <!-- Modernizr -->
    <script src="js/modernizr.js"></script> 

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
    <section class="header-video">
        <div id="hero_video">
            <div id="sub_content">
                <h1>Order Takeaway or Delivery Food</h1>
                <p>
                    Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
                </p>
                <form method="post" action="/search">
                    <div id="custom-search-input">
                        <div class="input-group">
                            <input type="text" class=" search-query" placeholder="Your Address or postal code">
                            <span class="input-group-btn">
                                <input type="submit" class="btn_search" value="submit">
                            </span>
                        </div>
                    </div>
                </form>
            </div><!-- End sub_content -->
        </div>
        <img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro" data-teaser-source="video/intro" data-provider="Vimeo" data-video-width="1920" data-video-height="960">
        <div id="count" class="hidden-xs">
            <ul>
                <li><span class="number">{{$restaurants}}</span> Restorante</li>
                <li><span class="number">{{$orders}}</span> Porosi të dërguar</li>
                <li><span class="number">{{$users}}</span> Përdorues të regjistruar</li>
            </ul>
        </div>
    </section><!-- End Header video -->
    <!-- End SubHeader ============================================ -->

    <!-- Content ================================================== -->
    <div class="container margin_60">

     <div class="main_title">
        <h2 class="nomargin_top" style="padding-top:0">Si punon?</h2>
        <p>
            E gjithë procedura përbëhet vetëm nga 4 hapa
        </p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="box_home" id="one">
                <span>1</span>
                <h3>Kërko nga adresa</h3>
                <p>
                    Gjej të gjitha restorantet në regjionin tuaj.
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="two">
                <span>2</span>
                <h3>Zgjedh restorantin</h3>
                <p>
                    Ne kemi shumë menu online.
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="three">
                <span>3</span>
                <h3>Paguaj me kartelë ose me para të gatshme</h3>
                <p>
                    Është e shpejtë, lehtë dhe totalisht e sigurt
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="four">
                <span>4</span>
                <h3>Dorëzim ose marrja nga restoranti</h3>
                <p>
                    Po pritoni? Nuk doni të pritni?
                </p>
            </div>
        </div>
    </div><!-- End row -->

    <div id="delivery_time" class="hidden-xs">
        <strong><span>2</span><span>5</span></strong>
        <h4>Minuta që zakonisht duhen për të dorëzuar porosinë!</h4>
    </div>
</div><!-- End container -->

<div class="white_bg">
    <div class="container margin_60">

        <div class="main_title">
            <h2 class="nomargin_top">Zgjedh nga më të preferuarat</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>

        <div class="row">
            <div class="col-md-6">
                @php $i=0; @endphp
                @foreach($popularFoods as $popularFood)
                @php $i++; @endphp
                <a href="detail_page.html" class="strip_list">
                    <div class="ribbon_1">Popular</div>
                    <div class="desc">
                        <div class="thumb_strip">
                            <img src="{{$popularFood->picture}}" alt="">
                        </div>
                        <div class="rating">
                            @php $r=0; @endphp
                            @while(round($popularFood->rating) != $r)
                            <i class="icon_star voted"></i>
                            @php $r++; @endphp
                            @endwhile
                        </div>
                        <h3>{{$popularFood->name}}</h3>
                        <div class="type">

                        </div>
                        <div class="location">
                            {{$popularFood->restaurant->address}} <span class="opening">{{$popularFood->restaurant->works}}</span>
                        </div>
                        <ul>
                            <li>Në Derë<i class="{{$popularFood->restaurant->door_payment ? 'icon_check_alt2 ok' : 'icon_close_alt2 no'}}"></i></li>
                            <li>Kartelë<i class="{{$popularFood->restaurant->card_payment ? 'icon_check_alt2 ok' : 'icon_close_alt2 no'}}"></i></li>
                        </ul>
                    </div><!-- End desc-->
                </a><!-- End strip_list-->
                @if($i==3)
            </div><!-- End col-md-6-->
            <div class="col-md-6">
                @endif
                @endforeach
            </div><!-- End col-md-6-->
            <div class="col-md-6">
            </div>
        </div><!-- End row -->   

    </div><!-- End container -->
</div><!-- End white_bg -->

<div class="high_light">
   <div class="container">
    <h3>Zgjedh njërën nga {{$restaurants}} Restorantëve!</h3>
    <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
    <a href="list_page.html">Shih restorantët</a>
</div><!-- End container -->
</div><!-- End hight_light -->

<section class="parallax-window" data-parallax="scroll" data-image-src="img/bg_office.jpg" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>Ne po ashtu dërgojmë ushqimin edhe në vendin e punës!</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End Content =============================================== -->

<div class="container margin_60">
  <div class="main_title margin_mobile">
    <h2 class="nomargin_top">Punoni me ne!</h2>
    <p>
        Regjistroni restorantin tuaj tani.
    </p>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
     <a class="box_work" href="/register/restaurant">
        <img src="img/submit_restaurant.jpg" width="848" height="480" alt="" class="img-responsive">
        <h3>Regjistro Restorantin<span>Shërbej më shumë konsumatorë</span></h3>
        <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
        <div class="btn_1">Lexo më shumë</div>
    </a>
</div>
{{-- <div class="col-md-4">
   <a class="box_work" href="submit_driver.html">
    <img src="img/delivery.jpg" width="848" height="480" alt="" class="img-responsive">
    <h3>We are looking for a Driver<span>Start to earn money</span></h3>
    <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
    <div class="btn_1">Read more</div>
</a>
</div> --}}
</div><!-- End row -->
</div><!-- End container -->

<!-- Footer ================================================== -->
@include('layouts.footer')
<!-- End Footer =============================================== -->


<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/video_header.js"></script>
<script>
    $(document).ready(function() {
     'use strict';
     HeaderVideo.init({
      container: $('.header-video'),
      header: $('.header-video--media'),
      videoTrigger: $("#video-trigger"),
      autoPlayVideo: true
  });    

 });
</script>

</body>
</html>