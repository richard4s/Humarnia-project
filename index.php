<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/megnor/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<?php
require_once 'core/init.php';
require_once 'template/header.php';

if(Session::exists('home')) {
	echo "<script>
		$(document).ready(function() {
			$.notify({
					title: '<strong>Succesful!</strong>',
					icon: 'glyphicon glyphicon-star',
					message: '".Session::flash('home')."'
				},{
					type: 'info',
					animate: {
						enter: 'animated fadeInUp',
						exit: 'animated fadeOutRight'
					},
					placement: {
						from: 'top',
						align: 'right'
					},
					delay: 2000,
					offset: 180,
					spacing: 10,
					z_index: 1031,
				});
		});
	</script>";
}


?>


	<div class="content-top-breadcum">
		<div class="container">
			<div class="row">
				<div id="title-content">
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row home_row">
			<div id="content" class="col-sm-12">
				<div class="content-top">
					<div class="main-slider">

						<div id="spinner"></div>
						<div id="slideshow0" class="owl-carousel" style="opacity: 1;">
							<div class="item">
								<img src="image/cache/catalog/Main-Banner-2-860x527.jpg" alt="MainBanner2" class="img-responsive" />
							</div>
							<div class="item">
								<a href="#"><img src="image/cache/catalog/Main-Banner-1-860x527.jpg" alt="Mainbanner1" class="img-responsive" /></a>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$('#slideshow0').owlCarousel({
							items: 6,
							autoPlay: 5000,
							singleItem: true,
							navigation: true,
							navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
							pagination: true,
							transitionStyle: "fade"
						});
					</script>
					<script type="text/javascript">
						// Can also be used with $(document).ready()
						$(window).load(function() {
							$("#spinner").fadeOut("slow");
						});
					</script>
					<div class="subslider">
						<div class="col-sm-12">
							<div class="embed-responsive embed-responsive-16by9">
								<!-- <iframe src="image/catalog/Big Sean - Moves (HD).mp4" marginheight="1000px"></iframe> -->
								<video class="embed-responsive-item" id="myVideo" src="image/catalog/Big Sean - Moves (HD).mp4" autoplay muted loop height="524px"></video>
							</div>
						</div>
					</div><br>

					<div id="servicecmsblock">
						<div id="servicecmsinfo_block1" class="container">
							<div class="box-content-cms">
								<div class="inner-cms">
									<div class="box-cms-content">
										<div class="first-content-one">
											<div class="inner-content">
												<div class="service-content">
													<div class="icon-left1"></div>
													<div class="service-right">
														<div class="title">Fast Delivery Nationwide</div>
														<div class="sub-title">Delivered Within 7 days</div>
													</div>
												</div>
											</div>
										</div>
										<div class="second-content-two">
											<div class="inner-content">
												<div class="service-content">
													<div class="icon-left2"></div>
													<div class="service-right">
														<div class="title">24/7 customer service</div>
														<div class="sub-title">Call us 24/7 at 000 - 123 - 456</div>
													</div>
												</div>
											</div>
										</div>
										<div class="third-content-three">
											<div class="inner-content">
												<div class="service-content">
													<div class="icon-left3"></div>
													<div class="service-right">
														<div class="title">Money back guaratee</div>
														<div class="sub-title">Send within 30 days</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		<!-- Little Content Ends -->

		<div class="container">
			<div class="row clearfix">

					<div class="col-sm-4 col-sm-offset-2 col-xs-offset-3">
						<div class="col-sm-offset-2">
						<p class="block-title">Men Products</p>
					</div>
						<div class="ih-item square colored effect4 float-left">
							<a href="men.php">
		        		<div class="img"><img id="fblogo" src="image/cache/catalog/white_bg/whitenew.jpg" alt="Humarnia"></div>
		        		<div class="mask1"></div>
				        <div class="mask2"></div>
				        <div class="info">
				          <h3 class="text-white">Shop Men</h3>
				        </div>
							</a>
						</div>
					</div>

					<div class="col-sm-4 col-sm-offset-1 col-xs-offset-3">
						<div class="col-sm-offset-2">
						<p class="block-title">Women Products</p>
					</div>
						<div class="ih-item square colored effect4 float-left">
							<a href="women.php">
		        		<div class="img"><img id="fblogo" src="image/cache/catalog/white_bg/whitenew2.jpg" alt="Humarnia"></div>
		        		<div class="mask1"></div>
				        <div class="mask2"></div>
				        <div class="info">
				          <h3 class="text-white">Shop Women</h3>
				        </div>
							</a>
						</div>
					</div>

			</div>
		</div>


		<!--Newsletter Begins -->
				<div class="newsletter" style="margin-top: 30px;">
					<div class="newsleft">
						<span class="news-title1">Get latest product update</span>
						<span class="news-title2">*Directly into your e-mail</span>
					</div>
					<div class="newsright">
						<div class="list-unstyled">
							<div>
								<div class="row">

									<form method="post">
										<div class="form-group required">
											<label class="col-sm-2 control-label">Email</label>
											<div class="input-news">
												<input type="email" name="txtemail" id="txtemail" value="" placeholder="Enter Your Email Address" class="form-control input-lg" />
											</div>
											<div class="subscribe-btn">
												<button type="submit" class="btn btn-default btn-lg" onclick="return subscribe();">subscribe</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php require 'template/footer.php'; ?>
