<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>

<?php

require_once 'core/init.php';


//var_dump(Token::check(Input::get('token')));


if(Input::exists()) {
	//if(Token::check(Input::get('token'))) {

		//echo 'I have been run';

		$validate = new Validate();
		$validation = $validate->check($_POST, [
			'firstname' => [
				'required' => 'true',
				'min' => 2,
				'max' => 50
			],
			'lastname' => [
				'required' => true,
				'min' => 2,
				'max' => 50
			],
			'password' => [
				'required' => true,
				'min' => 6
			],
			'confirm' => [
				'required' => true,
				'matches' => 'password'
			],
			'email' => [
				'required' => true,
				'min' => 5,
				'unique' => 'register'
			],
			'telephone' => [
				'required' => true,
				'min' => 2
			]
		]);

		if($validation->passed()){
			// Session::flash('success', 'You registered successfully');
			// header('Location: index.php');
			$user = new User();
			$salt = Hash::salt(32);

			try {

				$user->create([
					'firstName' => Input::get('firstname'),
					'lastName' => Input::get('lastname'),
					'email' => Input::get('email'),
					'mobileNumber' => Input::get('telephone'),
					'password' => Hash::make(Input::get('password'), $salt),
					'confirmPassword' => $salt,
					'joined' => date('Y-m-d H:i:s'),
					'grouped' => 1
				]);

				Session::flash('home', 'You have been registered and can now log in!');
				header('Location: login.php');

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
	//}
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
        <li><a href="register.php">Register</a></li>
      </ul>
    <div class="row"><aside id="column-left" class="col-sm-3 hidden-xs">




    <div class="box">
  <div class="box-heading">Account</div>
 <div class="list-group">
    <a href="login.php" class="list-group-item">Login</a>
		<a href="register.php" class="list-group-item">Register</a>
  </div>
</div>
  </aside>
                <div id="content" class="col-sm-9">      <h1>Register Account</h1>
      <p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
      <form action="register.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend>Your Personal Details</legend>
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
              <input type="text" name="firstname" placeholder="First Name" id="input-firstname" class="form-control" value="<?php echo escape(Input::get('firstname')) ?>" />
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
              <input type="text" name="lastname" placeholder="Last Name" id="input-lastname" class="form-control" value="<?php if(isset($_POST['lastname'])) {
								echo $_POST['lastname'];
							} ?>" />
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
              <input type="email" name="email" placeholder="E-Mail" id="input-email" class="form-control" value="<?php if(isset($_POST['email'])) {
								echo $_POST['email'];
							} ?>" />
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
              <input type="number" name="telephone" placeholder="Mobile Number" id="" class="form-control" value="<?php if(isset($_POST['telephone'])) {
								echo $_POST['telephone'];
							} ?>" />
                          </div>
          </div>
                  </fieldset>
          <legend>Your Password</legend>
					<span class="text-danger" id="bouncyFlip">
		        <?php
		          if(isset($_POST['password'])) {
		            if (empty($_POST['password'])) {
		              echo '*This field is required';
		            }
		          }
		         ?>
		      </span>
          <div class="form-group required">
            <label class="col-sm-2" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" placeholder="Password" id="input-password" class="form-control" value="<?php if(isset($_POST['password'])) {
								echo $_POST['password'];
							} ?>" />
                          </div>
          </div>
					<span class="text-danger" id="bouncyFlip">
		        <?php
		          if(isset($_POST['confirm'])) {
		            if (empty($_POST['confirm'])) {
		              echo '*This field is required';
		            }
		          }
		         ?>
		      </span>
          <div class="form-group required">
            <label class="col-sm-2" for="input-confirm">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="confirm" placeholder="Password Confirm" id="input-confirm" class="form-control" value="<?php if(isset($_POST['confirm'])) {
								echo $_POST['confirm'];
							} ?>" />
            </div>
          </div>
        </fieldset>

                        <div class="buttons">
						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" value="Register" id="register" class="btn btn-primary" />
        </div>
              </form>
      </div>
    </div>
</div>

<?php require 'template/footer.php';
