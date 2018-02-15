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

if(Input::exists()) {

		$validate = new Validate();
		$validation = $validate->check($_POST, [
      'name' => [
        'required' => true,
        'min' => 4
      ],
      'email' => [
        'required' => true,
        'min' => 5
      ],
      'enquiry' => [
        'required' => true,
        'min' => 2
      ]
		]);

		if($validation->passed()) {

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
            $mail->Subject = 'HURMANIA, Someone Enquired About You!';
            $mail->Body = 'Name: '.$_POST['name'].'<br>Email: '.$_POST['email'].'<br>Enquiry: '.$_POST['enquiry'].'
            <br><br><br>
            <small>All rights reserved. &copy; '.date('Y').' <a href="www.hurmania.com">Hurmania.com</a><small>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo
    				"<script>
    					$(document).ready(function() {
    						$.notify({
    				        title: '<strong>Succesful!</strong>',
    				        icon: 'glyphicon glyphicon-star',
    				        message: 'We'll surely get back to you!'
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
      }else{
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

 <div class="container">
  <ul class="breadcrumb">
     <li><a href="index.php"><i class="fa fa-home"></i></a></li>
     <li><a href="contact_us.php">Contact Us</a></li>
   </ul>

   <div class="row">
     <aside id="column-left" class="col-sm-3 hidden-xs">
      <div class="box">
       <div class="box-heading">Information</div>
       	<div class="list-group">
					<a class="list-group-item" href="about_us.php">About Us</a>
					<a class="list-group-item" href="privacy_policy.php">Privacy Policy</a>
					<a class="list-group-item" href="terms__and_conditions.php">Terms &amp; Conditions</a>
				  <a class="list-group-item" href="contact_us.php">Contact Us</a>
       	</div>
     </div>
   </aside>

   <div id="content" class="col-sm-9">
     <h1 class="block-title text-center">Contact Us</h1><br>
       <div class="panel panel-default">
         <div class="panel-body">
           <div class="row contact-info">
             <div class="col-sm-6">
 		  	       <div class="left">
                <div class="address-detail"><strong>Your Store</strong>
                  <address>Address 1</address>
                </div>
                <div class="telephone"><strong>Telephone</strong>
                <address>+234 816 747 9618 </address>
 			          </div>
              </div>
            </div>
           </div>
         </div>
       </div>

       <div class="col-sm-6">
             <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
           <h3>Contact Form</h3>

           <div class="form-group required">
             <label class="col-sm-2 control-label" for="input-name">Your Name</label>
               <span class="text-danger">
               <?php
                if(isset($_POST['name'])) {
                  if (empty($_POST['name'])) {
                    echo '*This field is required';
                  }
                }
               ?>
             </span>
             <div class="col-sm-10">
               <input type="text" name="name" value="<?php
                 if(isset($_POST['name'])) {
                     echo $_POST['name'];
                   } ?>" id="input-name" class="form-control" /></div>
           </div>

           <div class="form-group required">
             <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
             <span class="text-danger">
             <?php
              if(isset($_POST['email'])) {
                if (empty($_POST['email'])) {
                  echo '*This field is required';
                }
              }
             ?>
           </span>
             <div class="col-sm-10">
               <input type="text" name="email" value="<?php
                 if(isset($_POST['email'])) {
                     echo $_POST['email'];
                   } ?>"  id="input-email" class="form-control" />
                           </div>
           </div>
           <div class="form-group required">
             <label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
             <span class="text-danger">
             <?php
              if(isset($_POST['enquiry'])) {
                if (empty($_POST['enquiry'])) {
                  echo '*This field is required';
                }
              }
             ?>
           </span>
             <div class="col-sm-10">
               <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"><?php
                 if(isset($_POST['enquiry'])) {
                     echo $_POST['enquiry'];
                   } ?></textarea>
                           </div>
           </div>

           <div class="buttons">
             <div class="pull-right">
               <input class="btn btn-primary" type="submit" value="Submit" />
             </div>
          </div>

       </form>
       </div>
       </div>
     </div>
 </div>

 <?php require_once 'template/footer.php'; ?>
