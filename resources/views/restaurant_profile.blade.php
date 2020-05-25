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

  <!-- Gallery -->
  <link href="/css/slider-pro.min.css" rel="stylesheet">

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
<section class="parallax-window" data-parallax="scroll" data-image-src="/img/sub_header_1.jpg" data-natural-width="1400" data-natural-height="470">
  <div id="subheader">
    <div id="sub_content">
      <div id="thumb"><img src="{{$restaurant->picture ?? '/img/no-image.png'}}" ></div>
      <div class="rating">(<small><a href="restaurant/{{$restaurant->id}}/profile">{{$restaurant->restaurantReviews->count()}} reviews</a></small>)</div>
      <h1>{{$restaurant->name}}</h1>
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
      <li>Profili Restaurantit</li>
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

    <div class="col-md-4">
      <p>
        <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
      </p>
      <div class="box_style_2">
        <h4 class="nomargin_top">Opening time <i class="icon_clock_alt pull-right"></i></h4>
        <ul class="opening_list">
          <li>Monday<span>12.00am-11.00pm</span></li>
          <li>Tuesday<span>12.00am-11.00pm</span></li>
          <li>Wednesday <span class="label label-danger">Closed</span></li>
          <li>Thursday<span>12.00am-11.00pm</span></li>
          <li>Friday<span>12.00am-11.00pm</span></li>
          <li>Saturday<span>12.00am-11.00pm</span></li>
          <li>Sunday <span class="label label-danger">Closed</span></li>
        </ul>
      </div>
      <div class="box_style_2 hidden-xs" id="help">
        <i class="icon_lifesaver"></i>
        <h4>Duhet <span>Ndihmë?</span></h4>
        <a href="#" class="phone">{{$restaurant->phone}}</a>
        <small>{{$restaurant->works}}</small>
      </div>
    </div>

    <div class="col-md-8">
      <div class="box_style_2">
        <h2 class="inner">Përmbajtja</h2>

        <div id="Img_carousel" class="slider-pro">
          <div class="sp-slides">

            @foreach($restaurant->foods as $food)
            <div class="sp-slide">
              <img alt="" class="sp-image" src="../src/css/images/blank.gif" data-src="{{$food->picture ?? '/img/no-image.png'}}">
              <p class="sp-layer sp-black sp-padding" data-horizontal="50" data-vertical="50" data-show-transition="down" data-show-delay="500">
                {{$food->name}}
              </p>
              <p class="sp-layer sp-white sp-padding" data-horizontal="50" data-vertical="100" data-show-transition="up" data-show-delay="500">
                {{$food->description}}
              </p>
            </div>
            @endforeach

          </div>
          <div class="sp-thumbnails">
            @foreach($restaurant->foods as $food)
            <img alt="" class="sp-thumbnail" src="{{$food->picture}}">
            @endforeach
          </div>
        </div>
        <h3>Rreth nesh</h3>
        <p class="add_bottom_30">
          {{$restaurant->preferences['description'] ?? null}}
        </p>
        <div id="summary_review">
          <div id="general_rating">
            {{$restaurant->restaurantReviews->count()}} Reviews
            <div class="rating">
            </div>
          </div>

          <div class="row" id="rating_summary">
            <div class="col-md-6">
              <ul>
                <li>Food Quality
                  <div class="rating">
                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                  </div>
                </li>
                <li>Price
                  <div class="rating">
                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul>
                <li>Punctuality
                  <div class="rating">
                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                  </div>
                </li>
                <li>Courtesy
                  <div class="rating">
                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                  </div>
                </li>
              </ul>
            </div>
          </div><!-- End row -->
          <hr class="styled">
          <a href="#" class="btn_1 add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
        </div><!-- End summary_review -->

        <div class="review_strip_single">
          <img src="/img/avatar1.jpg" alt="" class="img-circle">
          <small> - 10 March 2015 -</small>
          <h4>Jhon Doe</h4>
          <p>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
          </p>
          <div class="row">
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
              </div>
              Food Quality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Price
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
              </div>
              Punctuality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
              </div>
              Courtesy
            </div>
          </div><!-- End row -->
        </div><!-- End review strip -->

        <div class="review_strip_single">
          <img src="/img/avatar3.jpg" alt="" class="img-circle">
          <small> - 25 March 2015 -</small>
          <h4>Markus Schulz</h4>
          <p>
            "At sed dico invenire facilisis, sed option sapientem iudicabit ad, sea idque doming vituperatoribus at. Duo ut inani tantas scaevola. Commodo oblique at cum. Duo id vide delectus. Vel et doctus laoreet minimum, ei feugait pertinacia usu.
          </p>
          <div class="row">
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Food Quality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Price
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Punctuality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
              </div>
              Courtesy
            </div>
          </div><!-- End row -->
        </div><!-- End review strip -->

        <div class="review_strip_single last">
          <img src="/img/avatar2.jpg" alt="" class="img-circle">
          <small> - 10 April 2015 -</small>
          <h4>Frank Cooper</h4>
          <p>
            "Ne mea congue facilis eligendi, possit utamur sensibus id qui, mel tollit euismod alienum eu. Ad tollit lucilius praesent per, ex probo utroque placerat eos. Tale verear efficiendi et cum, meis timeam vix et, et duis debet nostro mel. Aeterno labitur per no, id nec tantas nemore. An minim molestie per, mei sumo vulputate cu."
          </p>
          <div class="row">
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
              </div>
              Food Quality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Price
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
              </div>
              Punctuality
            </div>
            <div class="col-md-3">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
              </div>
              Courtesy
            </div>
          </div><!-- End row -->
        </div><!-- End review strip -->

      </div><!-- End box_style_1 -->
    </div>
  </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
@include('layouts.footer')
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Register modal -->   
<div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="review" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-popup">
      <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
      <form method="post" action="assets/review_restaurant.php" name="review" id="review" class="popup-form">  
        <div class="login_icon"><i class="icon_comment_alt"></i></div>
        <input name="restaurant_name" id="restaurant_name" type="hidden" value="Mexican Taco Mex">	
        <div class="row" >
          <div class="col-md-6">
            <input name="name_review" id="name_review" type="text" placeholder="Name" class="form-control form-white">			
          </div>
          <div class="col-md-6">
            <input name="email_review" id="email_review" type="email" placeholder="Your email" class="form-control form-white">
          </div>
        </div><!-- End Row --> 

        <div class="row">
          <div class="col-md-6">
            <select class="form-control form-white" name="food_review" id="food_review">
              <option value="">Food Quality</option>
              <option value="Low">Low</option>
              <option value="Sufficient">Sufficient</option>
              <option value="Good">Good</option>
              <option value="Excellent">Excellent</option>
              <option value="Superb">Super</option>
              <option value="Not rated">I don't know</option>
            </select>                            </div>
            <div class="col-md-6">
              <select class="form-control form-white"  name="price_review" id="price_review">
                <option value="">Price</option>
                <option value="Low">Low</option>
                <option value="Sufficient">Sufficient</option>
                <option value="Good">Good</option>
                <option value="Excellent">Excellent</option>
                <option value="Superb">Super</option>
                <option value="Not rated">I don't know</option>
              </select>
            </div>
          </div><!--End Row -->    

          <div class="row">
            <div class="col-md-6">
              <select class="form-control form-white"  name="punctuality_review" id="punctuality_review">
                <option value="">Punctuality</option>
                <option value="Low">Low</option>
                <option value="Sufficient">Sufficient</option>
                <option value="Good">Good</option>
                <option value="Excellent">Excellent</option>
                <option value="Superb">Super</option>
                <option value="Not rated">I don't know</option>
              </select>                       </div>
              <div class="col-md-6">
                <select class="form-control form-white"  name="courtesy_review" id="courtesy_review">
                  <option value="">Courtesy</option>
                  <option value="Low">Low</option>
                  <option value="Sufficient">Sufficient</option>
                  <option value="Good">Good</option>
                  <option value="Excellent">Excellent</option>
                  <option value="Superb">Super</option>
                  <option value="Not rated">I don't know</option>
                </select>
              </div>
            </div><!--End Row -->     
            <textarea name="review_text" id="review_text" class="form-control form-white" style="height:100px" placeholder="Write your review"></textarea>
            <input type="text" id="verify_review" class="form-control form-white" placeholder="Are you human? 3 + 1 =">
            <input type="submit" value="Submit" class="btn btn-submit" id="submit-review">
          </form>
          <div id="message-review"></div>
        </div>
      </div>
    </div><!-- End Register modal -->

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
    <script src="/http://maps.googleapis.com/maps/api/js"></script>
    <script src="/js/map_single.js"></script>
    <script src="/js/infobox.js"></script>
    <script src="/js/jquery.sliderPro.min.js"></script>
    <script type="text/javascript">
      $( document ).ready(function( $ ) {
        $( '#Img_carousel' ).sliderPro({
          width: 960,
          height: 500,
          fade: true,
          arrows: true,
          buttons: false,
          fullScreen: false,
          smallSize: 500,
          startSlide: 0,
          mediumSize: 1000,
          largeSize: 3000,
          thumbnailArrows: true,
          autoplay: false
        });
      });
    </script>

  </body>
  </html>