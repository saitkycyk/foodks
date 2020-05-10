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
				</ul>
			</nav>
			<div class="content">

				<section id="section-1">
					@if ($errors->any())
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
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input type="email" id="Email" name="email" value="{{$restaurant->email}}" class="form-control">
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
					<div class="indent_title_in">
						<i class="icon_images"></i>
						<h3>Logoja e restorantit</h3>
						<p>
							Shkarkoni një fotografi që representon restorantin tuaj!
						</p>
					</div>

					<div class="wrapper_indent add_bottom_45">
					<form action="admin/logo" method="POST" enctype="multipart/form-data">
					@csrf
						<div class="form-group">
							<label>Shkarko logon e restorantit</label>
							<div id="logo_picture">
								<input name="file" type="file">
							</div>
						</div>

						<button type="submit" class="btn_1">Ruaj ndryshimet</button>
						</form>
					</div><!-- End wrapper_indent -->
                    
					<hr class="styled_2">
				</section><!-- End section 1 -->

				<section id="section-2">
					<div class="indent_title_in">
						<i class="icon_document_alt"></i>
						<h3>Edit menu list</h3>
						<p>Partem diceret praesent mel et, vis facilis alienum antiopam ea, vim in sumo diam sonet. Illud ignota cum te, decore elaboraret nec ea. Quo ei graeci repudiare definitionem. Vim et malorum ornatus assentior, exerci elaboraret eum ut, diam meliore no mel.</p>
					</div>
                    
					<div class="wrapper_indent">
						<div class="form-group">
							<label>Menu Category</label>
							<input type="text" name="menu_category" class="form-control" placeholder="EX. Starters">
						</div>

						<div class="menu-item-section clearfix">
							<h4>Menu item #1</h4>
							<div><a href="#0"><i class="icon_plus_alt"></i></a><a href="#0"><i class="icon_minus_alt"></i></a>
							</div>
						</div>

						<div class="strip_menu_items">
							<div class="row">
								<div class="col-sm-3">
									<div class="menu-item-pic dropzone">
										<input name="file" type="file">
										<div class="dz-default dz-message"><span>Click or Drop<br>Images Here</span>
										</div>
									</div>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Title</label>
												<input type="text"  name="menu_item_title" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Price</label>
												<input type="text" name="menu_item_title_price" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Short description</label>
										<input type="text" name="menu_item_description" class="form-control">
									</div>

									<div class="form-group">
										<label>Item options</label>
										<div class="table-responsive">
											<table class="table table-striped edit-options">
												<tbody>
													<tr>
														<td style="width:20%">
															<input type="text" class="form-control" placeholder="+ $3.50">
														</td>
														<td style="width:50%">
															<input type="text" class="form-control" placeholder="Ex. Medium">
														</td>
														<td style="width:30%">
															<label>
																<input type="radio" name="option_item_settings_1" checked class="icheck" value="checkbox">Checkbox</label>
															<label class="margin_left">
																<input type="radio" name="option_item_settings_1" class="icheck" value="radio">Radio</label>
														</td>
													</tr>
													<tr>
														<td style="width:20%">
															<input type="text" class="form-control" placeholder="+ $5.50">
														</td>
														<td style="width:50%">
															<input type="text" class="form-control" placeholder="Ex. Large">
														</td>
														<td style="width:30%">
															<label>
																<input type="radio" name="option_item_settings_2" class="icheck" value="checkbox">Checkbox</label>
															<label class="margin_left">
																<input type="radio" name="option_item_settings_2" class="icheck" value="radio" checked>Radio</label>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div><!-- End form-group -->

									<div class="form-group">
										<label>Item ingredients</label>
                                        <div class="table-responsive">
										<table class="table table-striped notifications">
											<tbody>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $2.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra tomato">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_3" checked class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_3" class="icheck" value="radio">Radio</label>
													</td>
												</tr>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $5.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra Pepper">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_4" class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_4" class="icheck" value="radio" checked>Radio</label>
													</td>
												</tr>
											</tbody>
										</table>
                                        </div>
									</div><!-- End form-group -->
								</div>
							</div><!-- End row -->
						</div><!-- End strip_menu_items -->



						<div class="menu-item-section clearfix">
							<h4>Menu item #2</h4>
							<div><a href="#0"><i class="icon_plus_alt"></i></a><a href="#0"><i class="icon_minus_alt"></i></a>
							</div>
						</div>

						<div class="strip_menu_items">
							<div class="row">
								<div class="col-sm-3">
									<div class="menu-item-pic dropzone">
										<input name="file" type="file">
										<div class="dz-default dz-message"><span>Click or Drop<br>Images Here</span>
										</div>
									</div>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Title</label>
												<input type="text" name="menu_item_title" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Price</label>
												<input type="text" name="menu_item_title_price" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Short description</label>
										<input type="text" name="menu_item_description" class="form-control">
									</div>

									<div class="form-group">
										<label>Item options</label>
                                        <div class="table-responsive">
										<table class="table table-striped notifications">
											<tbody>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $3.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Medium">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_5" checked class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_5" class="icheck" value="radio">Radio</label>
													</td>
												</tr>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $5.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Large">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_7" class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_7" class="icheck" value="radio" checked>Radio</label>
													</td>
												</tr>
											</tbody>
										</table>
                                        </div>
									</div><!-- End form-group -->

									<div class="form-group">
										<label>Item ingredients</label>
                                        <div class="table-responsive">
										<table class="table table-striped notifications">
											<tbody>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $2.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra tomato">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_8" checked class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_8" class="icheck" value="radio">Radio</label>
													</td>
												</tr>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $5.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra Pepper">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_9" class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_9" class="icheck" value="radio" checked>Radio</label>
													</td>
												</tr>
											</tbody>
										</table>
                                        </div>
									</div><!-- End form-group -->
								</div>
							</div><!-- End row -->
						</div><!-- End strip_menu_items -->
					</div><!-- End wrapper_indent -->

					<hr class="styled_2">
                    
					<div class="wrapper_indent">
						<div class="form-group">
							<label>Menu Category</label>
							<input type="text" name="menu_category" class="form-control" placeholder="EX. Main courses">
						</div>

						<div class="menu-item-section clearfix">
							<h4>Menu item #1</h4>
							<div><a href="#0"><i class="icon_plus_alt"></i></a><a href="#0"><i class="icon_minus_alt"></i></a>
							</div>
						</div>

						<div class="strip_menu_items">
							<div class="row">
								<div class="col-sm-3">
									<div class="menu-item-pic dropzone">
										<input name="file" type="file">
										<div class="dz-default dz-message"><span>Click or Drop<br>Images Here</span>
										</div>
									</div>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Title</label>
												<input type="text" name="menu_item_title" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Price</label>
												<input type="text" name="menu_item_title_price" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Short description</label>
										<input type="text" name="menu_item_description" class="form-control">
									</div>

									<div class="form-group">
										<label>Item options</label>
                                        <div class="table-responsive">
										<table class="table table-striped notifications">
											<tbody>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $3.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Medium">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_10" checked class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_10" class="icheck" value="radio">Radio</label>
													</td>
												</tr>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $5.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Large">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_11" class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_11" class="icheck" value="radio" checked>Radio</label>
													</td>
												</tr>
											</tbody>
										</table>
                                        </div>
									</div><!-- End form-group -->

									<div class="form-group">
										<label>Item ingredients</label>
                                        <div class="table-responsive">
										<table class="table table-striped notifications">
											<tbody>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $2.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra tomato">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_12" checked class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_12" class="icheck" value="radio">Radio</label>
													</td>
												</tr>
												<tr>
													<td style="width:20%">
														<input type="text" class="form-control" placeholder="+ $5.50">
													</td>
													<td style="width:50%">
														<input type="text" class="form-control" placeholder="Ex. Extra Pepper">
													</td>
													<td style="width:30%">
														<label>
															<input type="radio" name="option_item_settings_13" class="icheck" value="checkbox">Checkbox</label>
														<label class="margin_left">
															<input type="radio" name="option_item_settings_13" class="icheck" value="radio" checked>Radio</label>
													</td>
												</tr>
											</tbody>
										</table>
                                        </div>
									</div><!-- End form-group -->
								</div>
							</div><!-- End row -->
						</div><!-- End strip_menu_items -->
					</div><!-- End wrapper_indent -->
                    
					<hr class="styled_2">
                    
					<div class="wrapper_indent">
						<div class="add_more_cat"><a href="#0" class="btn_1">Save now</a> <a href="#0" class="btn_1">Add menu category</a> </div>
					</div><!-- End wrapper_indent -->
                    
				</section><!-- End section 2 -->

				<section id="section-3">

					<div class="row">
                    
						<div class="col-md-6 col-sm-6 add_bottom_15">
							<div class="indent_title_in">
								<i class="icon_lock_alt"></i>
								<h3>Change your password</h3>
								<p>
									Mussum ipsum cacilds, vidis litro abertis.
								</p>
							</div>
							<div class="wrapper_indent">
								<div class="form-group">
									<label>Old password</label>
									<input class="form-control" name="old_password" id="old_password" type="password">
								</div>
								<div class="form-group">
									<label>New password</label>
									<input class="form-control" name="new_password" id="new_password" type="password">
								</div>
								<div class="form-group">
									<label>Confirm new password</label>
									<input class="form-control" name="confirm_new_password" id="confirm_new_password" type="password">
								</div>
								<button type="submit" class="btn_1 green">Update Password</button>
							</div><!-- End wrapper_indent -->
						</div>
                        
						<div class="col-md-6 col-sm-6 add_bottom_15">
							<div class="indent_title_in">
								<i class="icon_mail_alt"></i>
								<h3>Change your email</h3>
								<p>
									Mussum ipsum cacilds, vidis litro abertis.
								</p>
							</div>
							<div class="wrapper_indent">
								<div class="form-group">
									<label>Old email</label>
									<input class="form-control" name="old_email" id="old_email" type="email">
								</div>
								<div class="form-group">
									<label>New email</label>
									<input class="form-control" name="new_email" id="new_email" type="email">
								</div>
								<div class="form-group">
									<label>Confirm new email</label>
									<input class="form-control" name="confirm_new_email" id="confirm_new_email" type="email">
								</div>
								<button type="submit" class="btn_1 green">Update Email</button>
							</div><!-- End wrapper_indent -->
						</div>
                        
					</div><!-- End row -->

					<hr class="styled_2">
                    
					<div class="indent_title_in">
						<i class="icon_shield"></i>
						<h3>Notification settings</h3>
						<p>
							Mussum ipsum cacilds, vidis litro abertis.
						</p>
					</div>
					<div class="row">
                    
						<div class="col-md-6 col-sm-6">
							<div class="wrapper_indent">
								<table class="table table-striped notifications">
									<tbody>
										<tr>
											<td style="width:5%">
												<i class="icon_pencil-edit_alt"></i>
											</td>
											<td style="width:65%">
												New orders
											</td>
											<td style="width:35%">
												<label>
													<input type="checkbox" name="option_1_settings" checked class="icheck" value="yes">Yes</label>
												<label class="margin_left">
													<input type="checkbox" name="option_1_settings" class="icheck" value="no">No</label>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon_pencil-edit_alt"></i>
											</td>
											<td>
												Modified orders
											</td>
											<td>
												<label>
													<input type="checkbox" name="option_2_settings" checked class="icheck" value="yes">Yes</label>
												<label class="margin_left">
													<input type="checkbox" name="option_2_settings" class="icheck" value="no">No</label>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon_pencil-edit_alt"></i>
											</td>
											<td>
												New user registration
											</td>
											<td>
												<label>
													<input type="checkbox" name="option_3_settings" checked class="icheck" value="yes">Yes</label>
												<label class="margin_left">
													<input type="checkbox" name="option_3_settings" class="icheck" value="no">No</label>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon_pencil-edit_alt"></i>
											</td>
											<td>
												New comments
											</td>
											<td>
												<label>
													<input type="checkbox" name="option_4_settings" checked class="icheck" value="yes">Yes</label>
												<label class="margin_left">
													<input type="checkbox" name="option_4_settings" class="icheck" value="no">No</label>
											</td>
										</tr>
									</tbody>
								</table>
								<button type="submit" class="btn_1 green">Update notifications settings</button>
							</div>
                            
						</div><!-- End row -->
					</div><!-- End wrapper_indent -->
                    
				</section><!-- End section 3 -->

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