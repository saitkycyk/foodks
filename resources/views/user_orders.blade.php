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
	<link href="/css/base.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="/css/skins/square/grey.css" rel="stylesheet">
	<link href="/css/admin.css" rel="stylesheet">
	<link href="/css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
	<link href="/css/dropzone.css" rel="stylesheet">

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
			<h1>Porositë</h1>
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
			<li>Porositë</li>
		</ul>
		<a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
	</div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60">
	<div id="tabs" class="tabs">
		<nav>
			<ul>
				<li><a href="#section-1" class="icon-menut-items"><span>Porositë aktive</span></a>
				</li>
				<li><a href="#section-2" class="icon-menut-items"><span>Porositë e vjetra</span></a>
				</li>
			</ul>
		</nav>
		<div class="content">

			<section id="section-1">

				<div class="indent_title_in">
					<i class="icon_documents_alt"></i>
					<h3>Porositë aktive</h3>
					<p>Më poshtë janë renditur të gjitha porositë që janë aktive.</p>
				</div>
				<hr>
				<div class="wrapper_indent">

					@foreach($orderGroups->sortByDesc('updated_at') as $orderGroup)
					<caption><h1>Porosia {{$orderGroup->id}}</h1></caption>
					<table class="table table-bordered" style="border:2px solid #c5c5c5;">
						<thead>
							<tr>
								<th>Emri Restorantit</th>
								<th>Komenti porosisë</th>
								<th>Mënyra e pagesës</th>
								<th>Statusi</th>
								<th>Porositur më</th>
								<th>Ndryshuar më</th>
								<th>Totali</th>
								<th>Operacionet</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$orderGroup->restaurant->name}}</td>
								<td title="{{$orderGroup->note}}">{{$orderGroup->note}}</td>
								<td>{{$orderGroup->payment_type == 'door_payment' ? 'Në derë' : 'Me kartelë'}}</td>
								<td @if($orderGroup->status == 'pending') style="color: orange" @else style="color: green" @endif>{{ucfirst($orderGroup->status)}}</td>
								<td title="{{$orderGroup->created_at->diffForHumans()}}">{{$orderGroup->created_at}}</td>
								<td title="{{$orderGroup->updated_at->diffForHumans()}}">{{$orderGroup->updated_at}}</td>
								<th>€ {{$orderGroup->orders->sum('price')}}</th>
								<td>
									<form action="{{route('cancelOrderGroup', ['orderGroup' => $orderGroup->id])}}" method="POST">
										@csrf
										@method('DELETE')
										<a href="javascript:;" onclick="parentNode.submit();" style="color: red">Anulo</a>
									</form>
								</td>
							</tr>
							<tr>
								<td colspan="8">
									<hr>
									@if(!$orderGroup->orders->isEmpty())
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Emri ushqimit</th>
												<th>Përbërësit</th>
												<th>Porcioni</th>
												<th>Çmimi</th>
											</tr>
										</thead>
										<tbody>
											@foreach($orderGroup->orders as $key => $order)
											<tr>
												<td>{{(int)$key+1}}</td>
												<td>{{$order->food->name}}</td>
												<td>
													@if($order->ingredients != null)
													@foreach($order->ingredients as $ingredient)
													{{$ingredient['ingName']}}@if(!$loop->last), @endif
													@endforeach
													@else
													Nuk ka
													@endif
												</td>
												<td>{{$order->quantity}}x</td>
												<td>€ {{$order->price ?? 0}}</td>

											</tr>
											@endforeach
										</tbody>
									</table>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
					@endforeach

				</div><!-- End wrapper_indent -->

			</section><!-- End section 1 -->
			<section id="section-2">

				<div class="indent_title_in">
					<i class="icon_pin_alt"></i>
					<h3>Porositë e vjetra</h3>
					<p>Më poshtë janë renditur të gjitha porositë që nuk janë aktive.</p>
				</div>
				<hr>
				<div class="wrapper_indent">

					@foreach($oldOrderGroups->sortByDesc('updated_at') as $oldOrderGroup)
					<caption><h1>Porosia {{$oldOrderGroup->id}}</h1></caption>
					<table class="table table-bordered" style="border:2px solid #c5c5c5;">
						<thead>
							<tr>
								<th>Emri Restorantit</th>
								<th>Komenti porosisë</th>
								<th>Mënyra e pagesës</th>
								<th>Statusi</th>
								<th>Porositur më</th>
								<th>Ndryshuar më</th>
								<th>Totali</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$oldOrderGroup->restaurant->name}}</td>
								<td title="{{$oldOrderGroup->note}}">{{$oldOrderGroup->note}}</td>
								<td>{{$oldOrderGroup->payment_type == 'door_payment' ? 'Në derë' : 'Me kartelë'}}</td>
								<td @if($oldOrderGroup->status == 'canceled') style="color: red" @else style="color: green" @endif>{{ucfirst($oldOrderGroup->status)}}</td>
								<td title="{{$orderGroup->created_at->diffForHumans()}}">{{$orderGroup->created_at}}</td>
								<td title="{{$orderGroup->updated_at->diffForHumans()}}">{{$orderGroup->updated_at}}</td></td>
								<th>€ {{$oldOrderGroup->orders->sum('price')}}</th>
							</tr>
							<tr>
								<td colspan="8">
									<hr>
									@if(!$oldOrderGroup->orders->isEmpty())
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Emri ushqimit</th>
												<th>Përbërësit</th>
												<th>Porcioni</th>
												<th>Çmimi</th>
											</tr>
										</thead>
										<tbody>
											@foreach($oldOrderGroup->orders as $key => $order)
											<tr>
												<td>{{(int)$key+1}}</td>
												<td>{{$order->food->name}}</td>
												<td>
													@if($order->ingredients != null)
													@foreach($order->ingredients as $ingredient)
													{{$ingredient['ingName']}}@if(!$loop->last), @endif
													@endforeach
													@else
													Nuk ka
													@endif
												</td>
												<td>{{$order->quantity}}x</td>
												<td>€ {{$order->price ?? 0}}</td>

											</tr>
											@endforeach
										</tbody>
									</table>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
					@endforeach

				</div><!-- End wrapper_indent -->

			</section><!-- End section 1 -->
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
<script src="/js/app.js"></script>
<!-- Specific scripts -->
<script src="/js/tabs.js"></script>
<script>
	var auth = {!! auth()->user()->id !!};

	Echo.channel('orders' + auth)
	.listen('OrdersUpdated', (e) => {
		location.reload();
	});
	
	$.noConflict();
	new CBPFWTabs(document.getElementById('tabs'));
</script>

<script src="/js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript">
	$('.wysihtml5').wysihtml5({});
</script>
<script src="/js/dropzone.min.js"></script>

</body>

</html>