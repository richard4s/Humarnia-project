<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>


<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
  echo '<script>
            window.location = "include/errors/404.php";
          </script>';
}

if(Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, [
      'password_current' => [
        'required' => true,
        'min' => 6
      ],
      'password_new' => [
        'required' => true,
        'min' => 6
      ],
      'password_new_again' => [
        'required' => true,
        'min' => 6,
        'matches' => 'password_new'
      ]
    ]);

    if($validation->passed()) {
      if(Hash::make(Input::get('password_current'), $user->data()->confirmPassword) !== $user->data()->password) {
        echo "<script>
					$(document).ready(function() {
						$.notify({
				        title: '<strong>Not Succesful!</strong>',
				        icon: 'glyphicon glyphicon-star',
				        message: 'Your current password is wrong!'
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
      } else{
        $salt = Hash::salt(32);
        $user->update([
          'password' => Hash::make(Input::get('password_new'), $salt),
          'confirmPassword' => $salt
        ]);

        Session::flash('home', 'Your password has been changed!');
        header('Location: index.php');
      }
    } else{
      foreach($validation->errors() as $error) {
        echo "<script>
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

require_once 'template/header.php';

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
         <li><a href="update.php">Update</a></li>
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
       <form action="changepassword.php" method="post" enctype="multipart/form-data" class="form-horizontal">
         <legend>Change Your Password</legend>
         <span class="text-danger" id="bouncyFlip">
           <?php
             if(isset($_POST['password_current'])) {
               if (empty($_POST['password_current'])) {
                 echo '*This field is required';
               }
             }
            ?>
         </span>
         <div class="form-group required">
           <label class="col-sm-2" for="input-password">Current Password</label>
           <div class="col-sm-10">
             <input type="password" name="password_current" placeholder="Current Password" id="input-password" class="form-control" value="<?php if(isset($_POST['password_current'])) {
               echo $_POST['password_current'];
             } ?>" />
                         </div>
         </div>

         <span class="text-danger" id="bouncyFlip">
           <?php
             if(isset($_POST['password_new'])) {
               if (empty($_POST['password_new'])) {
                 echo '*This field is required';
               }
             }
            ?>
         </span>
         <div class="form-group required">
           <label class="col-sm-2" for="input-password">New Password</label>
           <div class="col-sm-10">
             <input type="password" name="password_new" placeholder="New Password" id="input-password" class="form-control" value="<?php if(isset($_POST['password_new'])) {
               echo $_POST['password_new'];
             } ?>" />
                         </div>
         </div>

         <span class="text-danger" id="bouncyFlip">
           <?php
             if(isset($_POST['password_new_again'])) {
               if (empty($_POST['password_new_again'])) {
                 echo '*This field is required';
               }
             }
            ?>
         </span>
         <div class="form-group required">
           <label class="col-sm-2" for="input-confirm">Password Confirm</label>
           <div class="col-sm-10">
             <input type="password" name="password_new_again" placeholder="Password Confirm" id="input-confirm" class="form-control" value="<?php if(isset($_POST['password_new_again'])) {
               echo $_POST['password_new_again'];
             } ?>" />
                         </div>
         </div>

                         <div class="buttons">
 						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
             <input type="submit" value="Change Password" class="btn btn-primary" />
         </div>
               </form>
       </div>
     </div>
 </div>

 <?php require_once 'template/footer.php'; ?>
