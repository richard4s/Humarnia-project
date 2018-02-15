<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once 'core/init.php';
require_once 'template/header.php';

if(isset($_GET['id']) && isset($_GET['product'])){
  $gottenid = $_GET['id'];
  $product = $_GET['product'];
  if(!$user->isLoggedIn()) {
    echo '<script>
              window.location = "include/errors/404.php";
            </script>';
  }
} else{
  echo '<script>
            window.location = "include/errors/404.php";
          </script>';
}

$retrieval = DB::getInstance()->query("SELECT * FROM {$product} WHERE id={$gottenid}");

foreach($retrieval->results() as $retrieves) {
  $thename = $retrieves->productName;
  $theprice = $retrieves->productPrice;
  $theimage = $retrieves->productImage;
  $thedesecription = $retrieves->productDescription;
}


if(Input::exists()) {

		$validate = new Validate();
		$validation = $validate->check($_POST, [
      'address' => [
        'required' => true,
        'min' => 4
      ]
		]);

		if($validation->passed()) {

      try {

        $checkout = DB::getInstance()->insert('checkout', [
          'firstName' => escape($user->data()->firstName),
          'lastName' => escape($user->data()->lastName),
          'email' => escape($user->data()->email),
          'mobileNumber' => escape($user->data()->mobileNumber),
          'productBought' => $thename,
          'address' => Input::get('address'),
          'checkoutTime' => date('Y-m-d H:i:s')
        ]);


        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'richardoluwo50@gmail.com';
            $mail->Password = 'identity';
            $mail->From = escape($user->data()->email);
            $mail->FromName = escape($user->data()->firstName);
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->smtpConnect([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                ]
            ]);

            $mail->setFrom(escape($user->data()->email), escape($user->data()->firstName));
            $mail->addAddress('richardoluwo50@gmail.com', 'Richard Oluwo');

            $mail->isHTML(true);
            $mail->Subject = 'HURMANIA, You Have a Delivery To Make!';
            $mail->Body = 'User <b>'.escape($user->data()->firstName).'</b> just ordered <b>'.$thename.'</b><br><br>
            <h1>Here are '.escape($user->data()->firstName).'\'s delivery information:</h1>
            <p>Full Name: '.escape($user->data()->firstName).' '.escape($user->data()->lastName).'</p>
            <p>Email: '.escape($user->data()->email).'</p>
            <p>Phone Number: '.escape($user->data()->mobileNumber).'</p>
            <p>Ordered Product: '.$thename.'</p><br>
            <p style="color: red; font-size: 2em;">*Delivery Address: '.$_POST['address'].'</p><br><br><br>
            <small>All rights reserved. &copy; '.date('Y').' <a href="www.hurmania.com">Hurmania.com</a><small>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo
    				"<script>
    					$(document).ready(function() {
    						$.notify({
    				        title: '<strong>Succesful!</strong>',
    				        icon: 'glyphicon glyphicon-star',
    				        message: 'Your delivery would arrive within 7 working days. Thanks!'
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
    				        delay: 15000,
    				        offset: 180,
    				        spacing: 10,
    				        z_index: 1031,
    				      });
    					});
    				</script>";


        } catch (Exception $e) {
            echo
    				"<script>
    					$(document).ready(function() {
    						$.notify({
    				        title: '<strong>Not Succesful!</strong>',
    				        icon: 'glyphicon glyphicon-star',
    				        message: 'Please try again later. ".$mail->ErrorInfo."'
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
    					});
    				</script>";
        }


      } catch(Exception $e) {
        die($e->getMessage());
      }

    } else{
			foreach($validation->errors() as $error) {
				echo
				"<script>
					$(document).ready(function() {
						$.notify({
				        title: '<strong>Not Succesful!</strong>',
				        icon: 'glyphicon glyphicon-star',
				        message: '".$error."'
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
					});
				</script>";

			}
		}
  }


?>

<div class="quickview">
  <div class="quickview-container">

    <div id="content" class="productpage-quickview">
      <div class="">


        <div class="col-sm-6 product-left">
          <div class="product-info">
            <div class="left product-image thumbnails">

          <!-- Megnor Cloud-Zoom Image Effect Start -->
          <div class="image">
            <a class="thumbnail" title="<?php echo $thename; ?>">
              <img id="tmzoom" src="uploads/<?php echo $theimage; ?>" title="<?php echo $thename; ?>" alt="<?php echo $thename; ?>" />
            </a>
          </div>

          <!-- Megnor Cloud-Zoom Image Effect End-->
            </div>

          </div>
        </div>

        <div class="col-sm-6 product-right">
          <h3 class="product-title"><?php echo $thename; ?></h3>
          <div class="rating-wrapper">
            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
            <a class="review-count" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a><a class="write-review" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><i class="fa fa-pencil"></i> Write a review</a>
          </div>

          <ul class="list-unstyled attr">
            <li><span>Product Name :</span> <?php echo $thename; ?></li>
            <li><span>Availability :</span> Order</li>
            <li><span>Hot Line :</span> 08167479618</li>
          </ul>
          <ul class="list-unstyled price">
            <li>
              <h3 class="product-price">Price: <?php echo 'N'.$theprice; ?></h3>
            </li>

          </ul>

          <div id="product2">
            <div class="form-group qty">
              <label class="control-label" for="input-quantity">Qty</label>
              <input type="number" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
              <!--<br />-->
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Buy</a>
              <div class="btn-group prd_page">
              <button type="button" data-toggle="tooltip" class="btn btn-default wishlist" title="Add to Wish List" onclick="wishlist.add('49');">Add to Wish List</button>
              <button type="button" data-toggle="tooltip" class="btn btn-default compare" title="Add to Compare" onclick="compare.add('49');">Add to Compare</button>
              </div>

          </div>
        </div>
      </div>

      </div>
    </div>

  </div>
</div>

<div class="container">
<div class="row">
<div class="col-sm-12" id="tabs_info">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
    <li><a href="#tab-review" data-toggle="tab">Reviews (0)</a></li>
  </ul>
  <div class="tab-content">

    <div class="tab-pane active" id="tab-description">
      <p><?php echo $thedesecription; ?></p>
    </div>

    <div class="tab-pane" id="tab-review">
      <form class="form-horizontal" id="form-review">
        <div id="review"></div>
        <h3>Write a review</h3>
        <div class="form-group required">
          <div class="col-sm-12">
            <label class="control-label" for="input-name">Your Name</label>
            <input type="text" name="name" value="" id="input-name" class="form-control" />
          </div>
        </div>
        <div class="form-group required">
          <div class="col-sm-12">
            <label class="control-label" for="input-review">Your Review</label>
            <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
            <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
          </div>
        </div>
        <div class="form-group required">
          <div class="col-sm-12">
            <label class="control-label">Rating</label> &nbsp;&nbsp;&nbsp; Bad&nbsp;
            <input type="radio" name="rating" value="1" /> &nbsp;
            <input type="radio" name="rating" value="2" /> &nbsp;
            <input type="radio" name="rating" value="3" /> &nbsp;
            <input type="radio" name="rating" value="4" /> &nbsp;
            <input type="radio" name="rating" value="5" /> &nbsp;Good
          </div>
        </div>

        <div class="buttons clearfix">
          <div class="pull-right">
            <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Checkout</h4>

      </div>
      <div class="modal-body">
        <h3>Please add your <span class="text-danger">delivery address</span> and confirm these details</h3>

        <form class="form-inline" method="post" action="">
          <span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['firstname'])) {
 		            if (empty($_POST['firstname'])) {
 		              echo '*This field is required';
 		            } else if($_POST['firstname'] != escape($user->data()->firstName)) {
                  echo 'You can\'t edit details from here. <a href="update.php">Update instead</a>';
                }
 		          }
 		         ?>
 		      </span>
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" disabled value="<?php echo escape($user->data()->firstName); ?>">
        </div>

        <span class="text-danger" id="bouncyFlip">
          <?php
            if(isset($_POST['lastname'])) {
              if (empty($_POST['lastname'])) {
                echo '*This field is required';
              } else if($_POST['lastname'] != escape($user->data()->lastName)) {
                echo 'You can\'t edit details from here. <a href="update.php">Update instead</a>';
              }
            }
           ?>
        </span>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" disabled value="<?php echo escape($user->data()->lastName); ?>"><br>
        </div>

        <span class="text-danger" id="bouncyFlip">
          <?php
            if(isset($_POST['email'])) {
              if (empty($_POST['email'])) {
                echo '*This field is required';
              } else if($_POST['email'] != escape($user->data()->email)) {
                echo 'You can\'t edit details from here. <a href="update.php">Update instead</a>';
              }
            }
           ?>
        </span>
        <div class="form-group">
          <label for="email"><br>Email</label>
          <input type="email" class="form-control" name="email" disabled value="<?php echo escape($user->data()->email); ?>"><br>
        </div>

        <span class="text-danger" id="bouncyFlip">
          <?php
            if(isset($_POST['telephone'])) {
              if (empty($_POST['telephone'])) {
                echo '*This field is required';
              } else if($_POST['number'] != escape($user->data()->mobileNumber)) {
                echo 'You can\'t edit details from here. <a href="update.php">Update instead</a>';
              }
            }
           ?>
        </span>
        <div class="form-group">
          <label for="number"><br>Mobile Number</label>
          <input type="number" class="form-control" name="number" disabled value="<?php echo escape($user->data()->mobileNumber); ?>"><br>
        </div><hr>

        <div class="text-danger" id="bouncyFlip">
          <?php
            if(isset($_POST['address'])) {
              if (empty($_POST['address'])) {
                echo '*This field is required';
              }
            }
           ?>
        </div>
        <div class="form-group">
          <label for="address" class="text-danger">Add Delivery Address*</label>
          <input type="text" class="form-control" name="address"><br>
        </div><br><br>
        <input type="submit" class="btn btn-primary text-center" value="Confirm">
      </form>

      </div>
      <div class="modal-footer">

        <a href="update.php" class="btn btn-warning">Update profile instead</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php require 'template/footer.php'; ?>
