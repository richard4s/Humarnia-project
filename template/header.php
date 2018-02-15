<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Humarnia Clothingline</title>
	<meta name="description" content="Hurmania" />


	<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="catalog/view/theme/OPC090216_3/stylesheet/stylesheet.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/carousel.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/custom.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/lightbox.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/animate.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/magnific/magnific-popup.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/ihover.min.css" />

	<link href="catalog/view/javascript/jquery/ui/jquery-ui.css" type="text/css" rel="stylesheet" media="screen" />
	<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
	<link href="catalog/view/javascript/jquery/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />

	<link href="image/catalog/favicon.png" rel="icon" />

</head>


<body class="common-home layout-1">


	<div class="header-container">
		<div class="container">
			<div class="row">

				<div class="header-center">

					<div class="content_header_topleft">
						<div class="header-left">
							<div class="col-sm-4 header-logo">
								<div id="logo">
									<a href="index.php"><img src="image/catalog/Logo.png" title="Your Store" alt="Your Store" class="img-responsive" /></a>
								</div>
							</div>
						</div>

					</div>

					<div class="head-right-bottom">
						<div class="headertopright">
							<div class="text2">
								<div class="cms-data-info">
									<div class="text2-dec">Information Service</div>
									<a href="tel: 08167479618">
									<span class="hidden-xs hidden-sm hidden-md">08167479618</span>
									</a>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>
		</div>

		<header>

			<div class="container">
				<div class="row">
					<div class="header-main">
						<div class="header_left">
							<div class="box-category">

								<div class="box-heading">Shop<i class="fa fa-angle-down" aria-hidden="true"></i></div>
							</div>

							<div class="box-content-category">
								<ul id="nav-one" class="dropmenu">
									<li class="top_level"><a href="men.php">Men</a></li>
									<li class="top_level"><a href="women.php">Women</a></li>
								</ul>
							</div>

						</div>

						<div class="header-right">
							<!--  =============================================== Mobile menu start  =============================================  -->
							<div id="res-menu" class="main-menu nav-container1">
								<div class="nav-responsive"><span>Menu</span>
									<div class="expandable"></div>
								</div>
								<ul class="main-navigation">
									<li><a href="men.php">Men</a></li>
									<li><a href="women.php">Women</a></li>
							</div>
							<!--  ================================ Mobile menu end   ======================================   -->
							<!-- ======= Menu Code END ========= -->

							<!-- ======= Menu Code START ========= -->

							<div class="head-right-top">
								<ul class="static_links">
									<li class="head-links"> <a href="index.php">Home</a></li>
									<li class="head-links"><a href="about_us.php">About Us</a></li>
									<li class="head-links"><a href="contact_us.php">Contact Us</a></li>
								</ul>


								<div class="header-topr">
									<div class="head">
										<div class="col-sm-3 header-cart">
											<div id="cart" class="btn-group btn-block">
												<button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
													<i class="fa fa-shopping-basket"></i>
													<span id="cart-total">
														<?php
															$offset = 0;
															$current_dir = $_SERVER['SCRIPT_NAME'];

															if(substr($current_dir, -12) == 'products.php') {
																echo '1';
															} else{
																echo '0';
															}

														 ?>
													</span>
												</button>
												<h4>My Cart</h4>
											</div>


											<ul class="dropdown-menu pull-right cart-menu">
												<li>
													<p class="text-center">
														<?php
															if(substr($current_dir, -12) == 'products.php') {
																if(isset($_GET['product']) && isset($_GET['id'])) {
																	$product = $_GET['product'];
																	$gottenid = $_GET['id'];

																	require_once 'core/init.php';
																	$retrieval = DB::getInstance()->query("SELECT * FROM {$product} WHERE id={$gottenid}");

																	foreach($retrieval->results() as $retrieves) {
																	  $thename = $retrieves->productName;
																	}
																	echo '<b style="font-weight: bolder; font-size: 1.2em;">'.$thename.'</b> is in the cart!';
																}
															} else{
																echo 'Your shopping cart is empty!';
															}
													 ?>
												 </p>
												</li>
											</ul>
											<!--<i class="fa fa-shopping-basket" aria-hidden="true"></i>--></div>
										<div class="dropdown myaccount"><a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php $user = new User();
										//echo $user->data()->firstName;

										if($user->isLoggedIn()) {
											echo 'Welcome, '.escape($user->data()->firstName).'!';
										} else{
											echo 'Account';
										} ?></span> <!--<i class="fa fa-angle-down" aria-hidden="true"></i>--></a>
											<ul class="dropdown-menu dropdown-menu-right myaccount-menu">
												<?php if(!$user->isLoggedIn()) {
													echo '<li><a href="register.php">Register</a></li>
													<li><a href="login.php">Login</a></li>';
												} else{
													echo '<li><a href="update.php">Update Profile</a></li>
													<li><a href="changepassword.php">Change Password</a></li>
													<li><a href="logout.php">Logout</a></li>';
												} ?>

											</ul>
										</div>
									</div>
								</div>
								</ul>



							</div>
						</div>
					</div>

				</div>
			</div>

		</header>
	</div>
	<style>
     #test-form{
       background-color: #fff;
     }

     .block-title{
     	font-size: 1.9em;
       font-weight: bolder;
       letter-spacing: -1px;
     	padding-top: 20px;
     }

		 #fblogo {
		 height: 400px !important;
		 border: 1px solid black !important;
		 }

		 .text-white{
		 color: #fff !important;
		 }

		 .clearfix{
		 	padding-top: 20px;
		 	padding-bottom: 20px;
		 }
  </style>
<div style="margin-top: 50px;"></div>
