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
	<link href="css/base.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/skins/square/grey.css" rel="stylesheet">
	<link href="css/admin.css" rel="stylesheet">
	<link href="css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
	<link href="css/dropzone.css" rel="stylesheet">

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
				<h1>Admin section</h1>
				<p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
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
				<li>Menaxhimi</li>
			</ul>
			<a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
		</div>
	</div><!-- Position -->

	<!-- Content ================================================== -->
	<div class="container margin_60">
		<div id="tabs" class="tabs">
			<nav>
				<ul>
					<li><a href="#section-1" class="icon-profile"><span>Informacionet Gjenerale</span></a>
					</li>
					<li><a href="#section-2" class="icon-menut-items"><span>Menu</span></a>
					</li>
					<li><a href="#section-3" class="icon-settings"><span>Siguria dhe politika</span></a>
					</li>
					<li><a href="#section-4" class="icon-settings"><span>Preferencat</span></a>
					</li>
				</ul>
			</nav>
			<div class="content">

				<section id="section-1">
            		@if (!$errors->has('email') && !$errors->has('password') && $errors->any())
					<div class="alert alert-danger">
					<ul>
					    @foreach ($errors->all() as $error)
					        <li>{{ $error }}</li>
					    @endforeach
					</ul>
					</div>
					@endif
					<div class="indent_title_in">
						<i class="icon_house_alt"></i>
						<h3>Përshkrimi i restorantit</h3>
						<p>{{$restaurant->preferences['description'] ?? 'Nuk ka përshkrim!'}}</p>
					</div>

					<div class="wrapper_indent">
					<form action="admin/info" method="POST">
					@csrf
						<div class="form-group">
							<label>Emri i restorantit</label>
							<input class="form-control" name="name" id="restaurant_name" value="{{$restaurant->name}}" type="text">
						</div>
						<div class="form-group">
							<label>Përshkrimi i restorantit</label>
							<textarea class="form-control" placeholder="Enter text ..." style="height: 200px;" name="restaurant_description">{{$restaurant->preferences["description"] ?? ''}}</textarea>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nr. Telefonit</label>
									<input type="text" id="Telephone" name="phone" value="{{$restaurant->phone}}" class="form-control">
								</div>
							</div>
						</div>

							<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
					</div><!-- End wrapper_indent -->

					<hr class="styled_2">
					<div class="indent_title_in">
						<i class="icon_pin_alt"></i>
						<h3>Adresa</h3>
						<p>{{($restaurant->city->name ?? '').', '.($restaurant->road->road_nr ?? '').' '.($restaurant->road->name ?? '').', '.$restaurant->address}}</p>
					</div>
					<div class="wrapper_indent">
					<form action="admin/address" method="POST">
					@csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Qyteti</label>
							     <select class="form-control" name="city_id" id="city">
							        @foreach(\App\City::all() as $city)
							        <option value="{{$city->id}}" @if($city->id == $restaurant->city->id)  selected="true" @endif>{{$city->name}}</option>
							        @endforeach
							    </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
							     <label>Rruga/Addresa</label>
							     <select class="form-control" name="road_id" id="road">
							        <option value="{{$restaurant->road->id ?? ''}}" selected="true">{{($restaurant->road->road_nr ?? '').' '.($restaurant->road->name ?? '')}}</option>
							     </select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Adresa specifike</label>
									<input type="text" id="street_2" name="address" value="{{$restaurant->address ?? ''}}" class="form-control">
								</div>
							</div>
						</div>

						<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
					</div><!-- End wrapper_indent -->

				<hr class="styled_2">
				<div class="row">
					<div class="indent_title_in" style="float: left">
						<img height="100" width="100" src="{{$restaurant->picture ? url("{$restaurant->picture}") : url('/public/logos/restaurant-default.png')}}" alt="" class="img-circle">
					</div>

					<div class="wrapper_indent add_bottom_45" style="margin-left: 18%">
						<form action="admin/logo" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>Shkarko fotografin e restorantit</label>
								<div id="logo_picture">
									<input name="file" type="file">
								</div>
							</div>

							<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
					</div><!-- End wrapper_indent -->
				</div>
				<hr class="styled_2">
				</section><!-- End section 1 -->


				<section id="section-2">
					<form action="admin/food/create" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="indent_title_in">
						<i class="icon_document_alt"></i>
						<h3>Lista e Menu-s</h3>
						<p>Më poshtë mund të krijoni kategorinë ose të ndryshoni atë, muund të krijoni një lloj të ushqimit që takonë një kategorisë apo të ndryshoni atë. Mund të shtoni edhe fotografi atij ushqimi!</p>
					</div>
                    
					<div class="wrapper_indent">
							<div class="form-group">
								<label>Kategoria e Menu-s</label>
								<input class="form-control" type="text" name="category" list="categories"/>
								<datalist id="categories">
									@foreach($restaurant->foods as $food)
								    	<option value="{{$food->category}}">{{$food->category}}</option>
								    @endforeach
								</datalist>
							</div>

							<div class="menu-item-section clearfix">
								<h4>Ushqimi</h4>
								<div>
								</div>
							</div>

							<div class="strip_menu_items">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Shkarko logon e ushqimit</label>
											<div id="logo_picture">
												<input name="picture" type="file">
											</div>
										</div>
									</div>
									<div class="col-sm-9">
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label>Emri</label>
													<input type="text"  name="name" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cmimi</label>
													<input type="text" name="price" placeholder="2.00" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Përshkrimi</label>
											<input type="text" name="description" class="form-control">
										</div>

										<div class="form-group">
											<label>Lloji ushqimit</label>
											<div class="table-responsive">
												<table class="table table-striped edit-options">
													<tbody>
														<tr>
															<td style="width:30%">
																<label>
																	<input type="radio" name="drink" checked class="icheck" value="0">Ushqim</label>
																<label class="margin_left">
																	<input type="radio" name="drink" class="icheck" value="1">Pije</label>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div><!-- End form-group -->

										<div class="form-group">
											<label>Përbërësit opsional</label><a href="#0" id="newIng" style="float: right"><i class="icon_plus_alt"></i></a>
	                                        <div class="table-responsive">
											<table class="table table-striped notifications">
												<tbody id="tbody">
													<div id="div">
														<tr id="ingredients0">
															<td style="width:20%">
																<input type="text" id="ingPrice" name="ingredients[0][ingPrice]" class="form-control" placeholder="+ €2.50">
															</td>
															<td style="width:50%">
																<input type="text" id="ingName" name="ingredients[0][ingName]" class="form-control" placeholder="Ketchap">
															</td>
															<td style="width:30%">
																Parazgjedhur?&nbsp;
																<label>
																	<input type="radio" id="ingDefault" name="ingredients[0][ingDefault]" checked value="1">&nbsp;Po</label>
																<label class="margin_left">
																	<input type="radio" id="ingDefault" name="ingredients[0][ingDefault]" value="0">&nbsp;Jo</label>
															</td>
														</tr>
													</div>
												</tbody>
											</table>
	                                        </div>
										</div><!-- End form-group -->
									</div>
								</div><!-- End row -->
							</div><!-- End strip_menu_items -->
					</div><!-- End wrapper_indent -->
					<div class="wrapper_indent" id="this shit works">
						<button type="submit" class="btn_1 green">Krijo</button>
					</div><!-- End wrapper_indent -->
					</form>
					<hr class="styled_2">




					@foreach($restaurant->foods->sortByDesc('created_at') as $food)
					<form action="/admin/food/update/{{$food->id}}" method="POST"  enctype="multipart/form-data">
						@csrf
						@method('PATCH')
						<div class="wrapper_indent">
							<div class="form-group">
								<label>Kategoria e Menu-s</label>
								<input class="form-control" type="text" value="{{$food->category}}" name="category" list="categories"/>
								<datalist id="categories">
									@foreach($restaurant->foods as $foodCat)
								    	<option value="{{$foodCat->category}}">{{$foodCat->category}}</option>
								    @endforeach
								</datalist>
							</div>

							<div class="menu-item-section clearfix">
								<h4>Ushqimi</h4>
								<div>
								</div>
							</div>

							<div class="strip_menu_items">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Ndrysho logon e ushqimit</label>
											<div id="logo_picture">
												<input name="picture" type="file">
											</div>
										</div>
									</div>
									<div class="col-sm-9">
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label>Emri</label>
													<input type="text"  name="name" value="{{$food->name}}" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cmimi</label>
													<input type="text" name="price" value="{{$food->price}}" placeholder="2.00" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Përshkrimi</label>
											<input type="text" name="description" value="{{$food->description}}" class="form-control">
										</div>

										<div class="form-group">
											<label>Lloji ushqimit</label>
											<div class="table-responsive">
												<table class="table table-striped edit-options">
													<tbody>
														<tr>
															<td style="width:30%">
																Parazgjedhur?&nbsp;
																<label>
																	<input type="radio" name="drink" @if(!$food->drink) checked @endif class="icheck" value="0">Ushqim</label>
																<label class="margin_left">
																	<input type="radio" name="drink" @if($food->drink) checked @endif  class="icheck" value="1">Pije</label>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div><!-- End form-group -->

										<div class="form-group">
												@php
														if(json_decode($food->ingredients, true) == null){
															$ingKey = 0;
														} else {
														$ingKey = (int)key(array_slice(json_decode($food->ingredients, true), -1, 1, true));
													}
												@endphp
											<label>Përbërësit opsional</label><a href="#0" id="extIng" onclick="addIngRow({{$food->id}}, {{$ingKey}})" style="float: right"><i class="icon_plus_alt"></i></a>
	                                        <div class="table-responsive">
											<table class="table table-striped notifications">
												<tbody id="tbody{{$food->id}}">
													<div id="div">
													@if($food->ingredients != null)
														@foreach(json_decode($food->ingredients, true) as $key => $ingredient)
													<div id="div">
														<tr id="ingredients{{$key}}">
															<td style="width:20%">
																<input type="text" id="ingPrice" name="ingredients[{{$key}}][ingPrice]" class="form-control" value="{{$ingredient['ingPrice']}}" placeholder="+ €2.50">
															</td>
															<td style="width:50%">
																<input type="text" id="ingName" name="ingredients[{{$key}}][ingName]" class="form-control" value="{{$ingredient['ingName']}}" placeholder="Ketchap">
															</td>
															<td style="width:30%">
																<label>
																	<input type="radio" id="ingDefault" name="ingredients[{{$key}}][ingDefault]" @if($ingredient['ingDefault']) checked @endif value="1">&nbsp;Po</label>
																<label class="margin_left">
																	<input type="radio" id="ingDefault" name="ingredients[{{$key}}][ingDefault]" @if(!$ingredient['ingDefault']) checked @endif value="0">&nbsp;Jo</label>
															</td>
															</tr>
														</div>
															@endforeach
														@endif
														@php
														if(json_decode($food->ingredients, true) == null){
															$key = 0;
														} else {
														$key = (int)key(array_slice(json_decode($food->ingredients, true), -1, 1, true)) + 1;
													}
														@endphp
														<tr id="ingredients{{$key}}">
															<td style="width:20%">
																<input type="text" id="ingPrice" name="ingredients[{{$key}}][ingPrice]" class="form-control" placeholder="+ €2.50">
															</td>
															<td style="width:50%">
																<input type="text" id="ingName" name="ingredients[{{$key}}][ingName]" class="form-control" placeholder="Ketchap">
															</td>
															<td style="width:30%">
																<label>
																	<input type="radio" id="ingDefault" name="ingredients[{{$key}}][ingDefault]" value="1">&nbsp;Po</label>
																<label class="margin_left">
																	<input type="radio" id="ingDefault" name="ingredients[{{$key}}][ingDefault]" value="0">&nbsp;Jo</label>
															</td>
															</tr>
													</div>
												</tbody>
											</table>
	                                        </div>
										</div><!-- End form-group -->
									</div>
								</div><!-- End row -->
							</div><!-- End strip_menu_items -->
						</div><!-- End wrapper_indent -->
						<button type="submit" class="btn_1 green" style="display: inline-block; float: right">Ruaj</button>
						</form>
						<form action="/admin/food/delete/{{$food->id}}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn_1 red" style="background-color: red; display: inline-block; float: right; margin-right: 3%">Fshije</button>
						</form>
						<br><br>
					<hr class="styled_2">

					@endforeach
				</section><!-- End section 2 -->


				<section id="section-3">
					<div class="row">
						<div class="col-md-6 col-sm-6 add_bottom_15">
							<div class="indent_title_in">
								<i class="icon_lock_alt"></i>
								<h3>Ndryshoni fjalëkalimin tuaj</h3>
								<p>
									Plotësoni të dhënat më poshtë për të ndryshuar fjalëkalimin.
								</p>
							@if (Session::has('password'))
								<div class="alert alert-warning">
								<ul>
									<li>{{Session::get('password')}}</li>
								</ul>
								</div>
							@endif
							</div>
							<div class="wrapper_indent">
								<form action="/admin/changepassword" method="POST">
									@csrf
									<div class="form-group">
										<label>Fjalëkalimi vjetër</label>
										<input class="form-control" name="old_password" id="old_password" type="password">
									</div>
									<div class="form-group">
										<label>Fjalëkalimi i ri</label>
										<input class="form-control" name="password" id="new_password" type="password">
									</div>
									<div class="form-group">
										<label>Konfirmo fjalëkalimin e re</label>
										<input class="form-control" name="password_confirmation" id="confirm_new_password" type="password">
									</div>
									<button type="submit" class="btn_1 green">Ndrysho Fjalëkalimin</button>
								</form>
							</div><!-- End wrapper_indent -->
						</div>
                        
						<div class="col-md-6 col-sm-6 add_bottom_15">
							<div class="indent_title_in">
								<i class="icon_mail_alt"></i>
								<h3>Ndryshoni emailin tuaj</h3>
								<p>
									Plotësoni të dhënat më poshtë për të ndryshuar emailin.
								</p>
							@if (Session::has('email'))
								<div class="alert alert-warning">
								<ul>
									<li>{{Session::get('email')}}</li>
								</ul>
								</div>
							@endif
							</div>
							<div class="wrapper_indent">
								<form action="/admin/changeemail" method="POST">
									@csrf
									<div class="form-group">
										<label>Emaili vjetër</label>
										<input class="form-control" name="old_email" id="old_email" type="email">
									</div>
									<div class="form-group">
										<label>Emaili i ri</label>
										<input class="form-control" name="email" id="new_email" type="email">
									</div>
									<div class="form-group">
										<label>Konfirmo emailin e re</label>
										<input class="form-control" name="email_confirmation" id="confirm_new_email" type="email">
									</div>
									<button type="submit" class="btn_1 green">Ndrysho Emailin</button>
								</form>
							</div><!-- End wrapper_indent -->
						</div>
                        
					</div><!-- End row -->

					<hr class="styled_2">
				</section><!-- End section 3 -->

				<section id="section-4">

					<div class="indent_title_in">
						<i class="icon_search_alt"></i>
						<h3>Preferencat e restorantit</h3>
						<p>Ndryshoni preferencat e restorantit tuaj këtu!</p>
					</div>

					<div class="wrapper_indent">
					<form action="admin/preferences" method="POST">
					@csrf

						<div class="row">
							<div class="col-sm-6">
					            <div class="form-group">
					                 <label>Emri juaj</label>
					                 <input type="text" class="form-control" id="name_contact" name="userName" placeholder="Agon" value="{{$restaurant->preferences['userName'] ?? ''}}" required>
					            </div>
							</div>
							<div class="col-sm-6">
					            <div class="form-group">
					            	<label>Mbiemri juaj</label>
					            	<input type="text" class="form-control" id="lastname_contact" name="lastName" placeholder="Gashi" value="{{$restaurant->preferences['lastName'] ?? ''}}" required>
					         	</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Website(optinal)</label>
									<input type="text" id="restaurant_web" value="{{$restaurant->preferences['restaurantWeb'] ?? ''}}" name="restaurantWeb" class="form-control" placeholder="http://">
								</div>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
							    	<label>Kodi Postar</label>
							    	<input type="text" id="restaurant_postal_code" value="{{$restaurant->preferences['restaurantZip'] ?? ''}}" name="restaurantZip" class="form-control" placeholder="20000">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Orari punës</label>
									<input type="text" id="works" name="works" placeholder="10:00-22:00" value="{{$restaurant->works}}" class="form-control">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Porosia minimale në €</label>
									<input type="text" id="porosiamin" name="restaurant_min_order" placeholder="5" value="{{$restaurant->preferences["min_order"] ?? ''}}" class="form-control">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
							     <label>Mënyra e pagesës</label>
							     <select class="form-control" name="payment_type" id="paymentType">
							        <option value="all" @if($restaurant->door_payment && $restaurant->card_payment) selected @endif>Të gjithë</option>
							        <option value="door" @if($restaurant->door_payment && !$restaurant->card_payment) selected @endif>Në derë</option>
							        <option value="card" @if(!$restaurant->door_payment && $restaurant->card_payment) selected @endif>Me kartelë</option>
							     </select>
								</div>
							</div>
						</div>
							<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
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

	<!-- Specific scripts -->
	<script src="/js/tabs.js"></script>
	<script>
		new CBPFWTabs(document.getElementById('tabs'));
	</script>

	<script src="/js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript">
		$('.wysihtml5').wysihtml5({});
	</script>
	<script src="/js/dropzone.min.js"></script>
	<script>


		var i = 0;
		$(document).ready(function(){
		   $("#newIng").click(function(){
		   	i++;

		   	$("#tbody").append('<tr id="ingredients'+i+'"><td style="width:20%"><input type="text" id="ingPrice" name="ingredients['+i+'][ingPrice]" class="form-control" placeholder="+ €2.50"></td><td style="width:50%"><input type="text" id="ingName" name="ingredients['+i+'][ingName]" class="form-control" placeholder="Ketchap"></td><td style="width:30%"><label><input type="radio" id="ingDefault" name="ingredients['+i+'][ingDefault]" checked value="1">&nbsp;Po</label><label class="margin_left"><input type="radio" id="ingDefault" name="ingredients['+i+'][ingDefault]" value="0">&nbsp;Jo</label></td></tr>');
		   });
		});


	function addIngRow(divId){
			var ingKey = $('#tbody'+divId+'').children().length - 1;
		   	ingKey++;

		   	$('#tbody'+divId+'').append('<tr id="ingredients'+ingKey+'"><td style="width:20%"><input type="text" id="ingPrice" name="ingredients['+ingKey+'][ingPrice]" class="form-control" placeholder="+ €2.50"></td><td style="width:50%"><input type="text" id="ingName" name="ingredients['+ingKey+'][ingName]" class="form-control" placeholder="Ketchap"></td><td style="width:30%"><label><input type="radio" id="ingDefault" name="ingredients['+ingKey+'][ingDefault]" checked value="1">&nbsp;Po</label><label class="margin_left"><input type="radio" id="ingDefault" name="ingredients['+ingKey+'][ingDefault]" value="0">&nbsp;Jo</label></td></tr>');
	}

		if ($('.dropzone').length > 0) {
			Dropzone.autoDiscover = false;
			$("#photos").dropzone({
				url: "upload",
				addRemoveLinks: true
			});

			$("#logo_picture").dropzone({
				url: "upload",
				maxFiles: 1,
				addRemoveLinks: true
			});

			$(".menu-item-pic").dropzone({
				url: "upload",
				maxFiles: 1,
				addRemoveLinks: true
			});
		}

	    var roads = @json(\App\Road::all());
	    
	    $('#city').on('change', function() {
	        var selectValue = $(this).val();
	        $('#road').empty();

	        var filtered = roads.filter(function (road) {
	            return road.city_id == selectValue
	        });

	        filtered.forEach(addRoadOption)
	        document.getElementById("road").disabled=false;
	        // $( "#road" ).load(window.location.href + " #road" );
	    });

	    function addRoadOption(item, index){
	        $('#road').append("<option value='" + item['id'] + "'>" + item['road_nr'] + ' ' + item['name'] + "</option>");
	    }

	</script>

</body>

</html>