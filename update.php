<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>


<?php

require_once 'core/init.php';
require_once 'template/header.php';
$userid = escape($user->data()->id);

$user = new User();

if(!$user->isLoggedIn()) {
  echo '<script>window.location = "include/errors/404.php";</script>';
}

if(Input::exists()) {

  $validate = new Validate();
  $validation = $validate->check($_POST, [
    'firstname' => [
      'required' => true,
      'min' => 2,
      'max' => 50
    ],
    'lastname' => [
      'required' => true,
      'min' => 2,
      'max' => 50
    ],
    'email' => [
      'required' => true,
      'min' => 5
    ],
    'telephone' => [
      'required' => true,
      'min' => 2
    ]
  ]);

  if($validation->passed()) {

$theuser = DB::getInstance()->update('register', $userid, [
        'firstName' => Input::get('firstname'),
        'lastName' => Input::get('lastname'),
        'email' => Input::get('email'),
        'mobileNumber' => Input::get('telephone')
      ]);

      echo '<script>window.location = "index.php";</script>';
      Session::flash('home', 'Your details have been updated. Please remember them!');

  } else {
    foreach($validation->errors() as $error) {
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

 <div class="content-top-breadcum">
 <div class="container">
 <div class="row">
 <div id="title-content">
 </div>
 </div>
 </div>
 </div>

 <div class="container">
   <ul class="breadcrumb">
         <li><a href="index.php"><i class="fa fa-home"></i></a></li>
         <li><a href="update.php.php">Update</a></li>
       </ul>
     <div class="row"><aside id="column-left" class="col-sm-3 hidden-xs">




     <div class="box">
   <div class="box-heading">Account</div>
  <div class="list-group">
     <a href="logout.php" class="list-group-item">Logout</a>
    <a href="update.php" class="list-group-item">Update Profile</a>
 		<a href="changepassword.php" class="list-group-item">Change Password</a>
   </div>
 </div>
   </aside>
                 <div id="content" class="col-sm-9">
       <form action="update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
         <fieldset id="account">
           <legend>Update Your Personal Details</legend>
           <div class="form-group required" style="display: none;">
             <label class="col-sm-2">Customer Group</label>
             <div class="col-sm-10">
                                           <div class="radio">
                 <label>
                   <input type="radio" name="customer_group_id" value="1" checked="checked" />
                   Default</label>
               </div>
                                         </div>
           </div>
 					<span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['firstname'])) {
 		            if (empty($_POST['firstname'])) {
 		              echo '*This field is required';
 		            }
 		          }
 		         ?>
 		      </span>
           <div class="form-group required">
             <label class="col-sm-2" for="input-firstname">First Name</label>
             <div class="col-sm-10">
               <input type="text" name="firstname" placeholder="First Name" id="input-firstname" class="form-control" value="<?php echo escape($user->data()->firstName); ?>" />
                           </div>
           </div>
 					<span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['lastname'])) {
 		            if (empty($_POST['lastname'])) {
 		              echo '*This field is required';
 		            }
 		          }
 		         ?>
 		      </span>
           <div class="form-group required">
             <label class="col-sm-2" for="input-lastname">Last Name</label>
             <div class="col-sm-10">
               <input type="text" name="lastname" placeholder="Last Name" id="input-lastname" class="form-control" value="<?php echo escape($user->data()->lastName); ?>" />
                           </div>
           </div>
 					<span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['email'])) {
 		            if (empty($_POST['email'])) {
 		              echo '*This field is required';
 		            }
 		          }
 		         ?>
 		      </span>
           <div class="form-group required">
             <label class="col-sm-2" for="input-email">E-Mail</label>
             <div class="col-sm-10">
               <input type="email" name="email" placeholder="E-Mail" id="input-email" class="form-control" value="<?php echo escape($user->data()->email); ?>" />
                           </div>
           </div>
 					<span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['telephone'])) {
 		            if (empty($_POST['telephone'])) {
 		              echo '*This field is required';
 		            }
 		          }
 		         ?>
 		      </span>
           <div class="form-group required">
             <label class="col-sm-2" for="input-telephone">Mobile Number</label>
             <div class="col-sm-10">
               <input type="number" name="telephone" placeholder="Mobile Number" id="" class="form-control" value="<?php echo escape($user->data()->mobileNumber); ?>" />
                           </div>
           </div>
                   </fieldset>

                         <div class="buttons">
 						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
             <input type="submit" value="Update" class="btn btn-primary" />
         </div>
               </form>
       </div>
     </div>
 </div>

 <?php require_once 'template/footer.php'; ?>
