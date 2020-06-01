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
<section class="parallax-window" data-parallax="scroll" data-image-src="/img/sub_header_1.jpg" data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
        <div id="sub_content">
            <div id="thumb"><img src="{{$restaurant->picture}}" alt=""></div>
            <div class="rating">(<small><a href="restaurant/{{$restaurant->id}}/profile">{{$restaurant->restaurantReviews->count()}} reviews</a></small>)</div>
            <h1><a href="{{route('restaurant-profile', ['id' => $restaurant->id])}}">{{$restaurant->name}}</a></h1>
            {{-- <div><em>Mexican / American</em></div> --}}
            <div><i class="icon_pin"></i>{{$restaurant->address}}{{-- <strong>Delivery charge:</strong> $10, free over $15. --}}</div>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Category</a></li>
            <li>Page active</li>
        </ul>
        <a href="#" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-3">
            <div class="box_style_1">
                <ul id="cat_nav">
                    @foreach($restaurant->foods->groupBy('category') as $key => $category)
                    <li><a href="#{{$key}}" class="active">{{ucfirst($key)}} <span>{{$category->count()}}</span></a></li>
                    @endforeach
                </ul>
            </div><!-- End box_style_1 -->
            
            <div class="box_style_2 hidden-xs" id="help">
                <i class="icon_lifesaver"></i>
                <h4>Duhet <span>Ndihmë?</span></h4>
                <a href="#" class="phone">{{$restaurant->phone}}</a>
                <small>{{$restaurant->works}}</small>
            </div>
        </div><!-- End col-md-3 -->
        
        <div class="col-md-6">
            <div class="box_style_2" id="main_menu">
                <h2 class="inner">Menu</h2>
                @foreach($restaurant->foods->groupBy('category') as $key => $category)
                <h3 class="nomargin_top" id="{{$key}}">{{ucfirst($key)}}</h3>
{{--                 <p>
                    Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
                </p> --}}
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                               Ushqimi
                           </th>
                           <th>
                               Çmimi
                           </th>
                           <th>
                               Shtoj
                           </th>
                       </tr>
                   </thead>
                   <tbody>
                    @foreach($category as $food)
                    <tr>
                        <td>
                            <figure class="thumb_menu_list"><img src="{{$food->picture ? url("{$food->picture}") : url('/public/logos/food-default.png')}}" alt="thumb"></figure>
                            <h5>{{$food->name}}</h5>
                            <p>
                                {{$food->description}}
                            </p>
                        </td>
                        <td>
                            <strong>€ {{$food->price}}</strong>
                        </td>
                        <td class="options">
                            <div class="dropdown dropdown-options">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                                <div class="dropdown-menu">
                                    <h5>Select an option</h5>
                                    <label>
                                        <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                    </label>
                                    <label>
                                        <input type="radio" value="option2" name="options_1" >Large <span>+ $5.30</span>
                                    </label>
                                    <label>
                                        <input type="radio" value="option3" name="options_1" >Extra Large <span>+ $8.30</span>
                                    </label>
                                    <h5>Add ingredients</h5>
                                    <label>
                                        <input type="checkbox" value="">Extra Tomato <span>+ $4.30</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" value="">Extra Peppers <span>+ $2.50</span>
                                    </label>
                                    <a href="#0" class="add_to_basket">Shtoj</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            @endforeach

        </div><!-- End box_style_1 -->
    </div><!-- End col-md-6 -->

    <div class="col-md-3" id="sidebar">
        <div class="theiaStickySidebar">
            <div id="cart_box" >
                <h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
                <table class="table table_summary">
                    <tbody>
                        <tr>
                            <td>
                                <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Enchiladas
                            </td>
                            <td>
                                <strong class="pull-right">$11</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Burrito
                            </td>
                            <td>
                                <strong class="pull-right">$14</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Chicken
                            </td>
                            <td>
                                <strong class="pull-right">$20</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Corona Beer
                            </td>
                            <td>
                                <strong class="pull-right">$9</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Cheese Cake
                            </td>
                            <td>
                                <strong class="pull-right">$12</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="row" id="options_2">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                        <label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                        <label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
                    </div>
                </div><!-- Edn options 2 -->

                <hr>
                <table class="table table_summary">
                    <tbody>
                        <tr>
                            <td>
                               Subtotal <span class="pull-right">$56</span>
                           </td>
                       </tr>
                       <tr>
                        <td>
                           Delivery fee <span class="pull-right">$10</span>
                       </td>
                   </tr>
                   <tr>
                    <td class="total">
                       TOTAL <span class="pull-right">$66</span>
                   </td>
               </tr>
           </tbody>
       </table>
       <hr>
       <a class="btn_full" href="cart.html">Order now</a>
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
<script>
    $('#cat_nav a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 70
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
</script>


</body>
</html>