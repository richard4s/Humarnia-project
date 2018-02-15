<div style="margin-top: 50px;"></div>
<footer>

  <div id="footer" class="container">
  <div class="row">
	<div class="footer-blocks">
	      <div class="col-sm-3 column" id="footer_aboutus_block"><h5 class="toggle">about us<a class="mobile_togglemenu">&nbsp;</a></h5>
<ul>
<li class="tm-about-logo">
<a href="index.php" target="_blank">
<img alt="" src="image/catalog/footer-logo.png">
</a>
</li>
<li class="about">Humarnia is a brand created with the goal to outstand in the fashion industry and also
  represent africa with every pieces and designs by humarnia.
   TRIBES AND TRADITION</li>
<li class="follow">Follow Us </li>
<li class="facebook social">
<a href="#">
<i class="fa fa-facebook" aria-hidden="true"></i>
</a>
</li>
<li class="twitter social">
<a href="#">
<i class="fa fa-twitter" aria-hidden="true"></i>
</a>
</li>
<li class="gplus social">
<a href="#">
<i class="fa fa-google-plus" aria-hidden="true"></i>
</a>
</li>
<li class="linkedin social">
<a href="#">
<i class="fa fa-linkedin" aria-hidden="true"></i>
</a>
</li>
</ul></div>	        <div id="info" class="col-sm-3 column">
        <h5>Information</h5>
        <ul class="list-unstyled">
                    <li><a href="about_us.php">About Us</a></li>
                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                    <li><a href="terms_and_conditions.php">Terms &amp; Conditions</a></li>
		                <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
      </div>


	  <div id="account_link" class="col-sm-3 column">
        <h5>My Account</h5>
        <ul class="list-unstyled">
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


       <div class="col-sm-3 column" id="footer_storeinformation_block">
<h5 class="toggle">contact us<a class="mobile_togglemenu">&nbsp;</a></h5>
<ul>
<li class="address">42 Lafiaji street, Lagos Island.</li>
<li>Oshodi, Lagos, Nigeria.</li>
<li class="call-num"><a href="tel: 08167479618">08167479618</a></li>
<li class="email">
<span class="email">Email:</span>
<a href="mailto:olatejugafar@gmail.com">olatejugafar@gmail.com</a>
</li>
<li class="payment">Payment</li>
<li class="visa paymt"><a href="#"></a></li>
<li class="paypal paymt"><a href="#"></a></li>
<li class="mastercard paymt"><a href="#"></a></li>
<li class="discover paymt"><a href="#"></a></li>
<li class="americanexpress paymt"><a href="#"></a></li>
</ul>
</div>



	  </div>

    </div>
    <!--<hr>-->

  </div>
  <div class="bottomfooter">
        <div class="container">
		 <div class="row">
		<p class="powered">All Rights Reserved. <a href="index.php">Hurmania.</a>&copy;<span id"theyear"> <?php echo date('Y'); ?></span></p>

		</div>
      </div>
	</div>

</footer>

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript" src="catalog/view/javascript/megnor/custom.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jstree.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/carousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/megnor.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.custom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.formalize.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/lightbox/lightbox-2.6.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.elevatezoom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/doubletaptogo.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>


<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<script src="catalog/view/javascript/jquery/ui/jquery-ui.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script>

 function check(event){
   var file = document.getElementById('imageChecker');
   if(file.value === null || file.value === ""){
       alert('There\'s no image selected');
       event.preventDefault();
       document.getElementById('imageRequired').innerHTML = 'An image is required!';
         $.notify({
             title: '<strong>Not Succesful! No image selected. </strong>',
             icon: 'glyphicon glyphicon-star',
             message: 'Please Select an image.'
           },{
             type: 'danger',
             animate: {
               enter: 'animated fadeInUp',
               exit: 'animated fadeOutRight'
             },
             placement: {
               from: 'top',
               align: 'right'
             },
             delay: 15000,
             offset: 180,
             spacing: 10,
             z_index: 1031,
           });
   }
   else{
       event.initEvent();
       document.getElementById('imageRequired').innerHTML = '';
   }
 }

 function confirmMessage(event) {
   if( window.confirm("Do you really want to delete this product?") ) {
     //alert('You\'re alright!');
   } else{
     event.preventDefault();
   }
 }

 function loginCheck(event) {
   if( window.confirm("You need to login to buy!") ) {
     //alert('You\'re alright!');
   } else{
     event.preventDefault();
   }
 }

 function quickbox(){
  //if ($(window).width() > 767) {
 		$('.newbtn').magnificPopup({
 			type:'image',

       closeBtnInside: false,
       closeOnContentClick: true,
       image: {
         verticalFit: true,
         titleSrc: function(item) {
           return item.el.attr('title') + ' &middot; <a href="'+item.src+'"open original</a>';
         }
     //   type: 'inline',
     //   preloader: false,
     //   focus: '#name',
     // callbacks: {
     //   beforeOpen: function() {
     //     if ($(window).width() < 700) {
     //       this.st.focus = false;
     //     } else {
     //       this.st.focus = '#name';
     //     }
     //
     //
     //   }
     // }
   }
   });
 }
 jQuery(document).ready(function() {quickbox();});
 jQuery(window).resize(function() {quickbox();});

</script>
</body>
</html>
