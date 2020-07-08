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
<section class="parallax-window" data-parallax="scroll" data-image-src="/img/sub_header_1.jpg" data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
        <div id="sub_content">
            <div id="thumb"><img src="{{$restaurant->picture ? url("{$restaurant->picture}") : asset('img/default_pictures/restaurant-default.jpg')}}" alt=""></div>
            <div class="rating">(<small><a href="/restaurant/{{$restaurant->id}}/profile">{{$restaurant->restaurantReviews->count()}} reviews</a></small>)</div>
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
            <li><a href="/">Kryefaqja</a></li>
            <li><a href="/restaurants">Restorantët</a></li>
            <li>Menu</li>
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
                <?php $trl = ['monday' => 'E Hënë', 'tuesday' => 'E Martë', 'wednesday' => 'E Mërkurë', 'thursday' => 'E Enjte', 'friday' => 'E Premte', 'saturday' => 'E Shtunë', 'sunday' => 'E Diel']?>
                @foreach($restaurant->preferences['workdays'] ?? [] as $key => $workday)
                    @if($workday != null)
                    <small>{{$trl[$key].' | '.$workday['from'].'-'.$workday['to']}}</small></br>
                    @else
                    <small style="color: #C33">{{$trl[$key].' | Mbyllur'}}</small></br>
                    @endif
                @endforeach
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
                                <figure class="thumb_menu_list"><img src="{{$food->picture ? url("/{$food->picture}") : asset('img/default_pictures/food-default.png')}}" alt="thumb"></figure>
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
                                    <a href="#" id="showIng" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                                    <div class="dropdown-menu">
                                        <form id="ingForm" action="{{route('createOrder', ['food' => $food->id])}}" method="POST">
                                            @csrf
                                            @if($food->ingredients != null)
                                            <h5>Përbërësit opcionale</h5>
                                            @foreach(json_decode($food->ingredients, true) as $key => $ingredient)
                                            <label>
                                                <input name="ingredients[{{$key}}]" type="checkbox" @if($ingredient['ingDefault'] == 1) checked @endif value="{{$ingredient['ingName']}}">{{$ingredient['ingName']}}
                                                <span>€ {{$ingredient['ingPrice'] ?? '0'}}</span>
                                            </label>
                                            @endforeach
                                            @endif
                                            <hr>
                                            @if(auth()->user() && !auth()->user()->restaurant)
                                            <label>
                                                <span style="margin-top: 4px">Nr. i porosisë</span>
                                                <input style="width: 40%" name="quantity" type="number" value="1" min="1">
                                            </label>

                                            <a href="javascript:;" onclick="parentNode.submit();" class="add_to_basket">Shtoj</a>
                                            @endif
                                        </form>
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
        @auth
        @if(!auth()->user()->restaurant)
        <div class="col-md-3" id="sidebar">
            <div class="theiaStickySidebar">
                <div id="cart_box" >
                    <h3>Porositë <i class="icon_cart_alt pull-right"></i></h3>
                    <table class="table table_summary">
                        <tbody>
                            @foreach(auth()->user()->cart->where('restaurant_id', $restaurant->id) as $order)
                            <tr>
                                <td>
                                    <form action="{{route('deleteOrder', ['order' => $order->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:;" onclick="parentNode.submit();" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>{{$order->quantity}}x </strong> {{$order->food->name}}
                                    </form>
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
                                    TOTAL <span class="pull-right">€ {{auth()->user()->cart->sum('price') ?? 0}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form action="createOrder" method="POST" id="placeOrder">
                        @csrf
                        <a class="btn_full" href="{{route('orderDetailPage', ['id' => $restaurant->id])}}">Porosit tani</a>
                    </form>
                </div><!-- End cart_box -->
            </div><!-- End theiaStickySidebar -->
        </div><!-- End col-md-3 -->
        @endif
        @endauth
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

<script type="text/javascript">

    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
  });

    $(document).delegate('#showIng', 'click', function(){
        var auth = {!! auth()->user() !!} 
        console.log();
        if(auth == null) {
            $("#login_2").modal();
        }
    });

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