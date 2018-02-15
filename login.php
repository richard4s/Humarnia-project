<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>
<?php

require_once 'core/init.php';

if(Input::exists()) {
  $validate = new Validate();
  $validation = $validate->check($_POST, [
    'email' => [
      'required' => true
    ],
    'password' => [
      'required' => true
    ]
  ]);

  if($validation->passed()) {
    $user = new User();

    $remember = (Input::get('remember') === 'on') ? true : false;
    $login = $user = $user->login(Input::get('email'), Input::get('password'), $remember);

    if($login) {
      echo 'Success';
      header('Location: index.php');
    } else{
      echo
      "<script>
        $(document).ready(function() {
          $.notify({
              title: '<strong>Not Succesful!</strong>',
              icon: 'glyphicon glyphicon-star',
              message: 'Sorry, Logging in failed'
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
					delay: 15000,
					offset: 180,
					spacing: 10,
					z_index: 1031,
				});
		});
	</script>";
}

?>

<div class="container">
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>

    <div class="row">
  <aside id="column-left" class="col-sm-3 hidden-xs">
    <div class="box">
      <div class="box-heading">Account</div>
      <div class="list-group">
        <a href="login.php" class="list-group-item">Login</a>
        <a href="register.php" class="list-group-item">Register</a>
      </div>
    </div>
  </aside>
                <div id="content" class="col-sm-9">
  <h1>Account Login</h1>
  <div class="row">

    <div class="col-sm-6">
      <div class="well">
        <h3>New Customer</h3>
        <p><strong>Register Account</strong></p>
        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
        <a href="register.php" class="btn btn-primary">Continue</a></div>
    </div>
    <div class="col-sm-6">
      <div class="well">
        <h3>Returning Customer</h3>
        <p><strong>I am a returning customer</strong></p>

        <form action="login.php" method="post" enctype="multipart/form-data">

          <div class="form-group">

            <label class="control-label" for="input-email">E-Mail Address</label>
            <span class="text-danger" id="bouncyFlip">
  		        <?php
  		          if(isset($_POST['email'])) {
  		            if (empty($_POST['email'])) {
  		              echo '*This field is required';
  		            }
  		          }
  		         ?>
  		      </span>
            <input type="text" name="email" placeholder="E-Mail Address" id="input-email" class="form-control" value="<?php if(isset($_POST['email'])) {
              echo $_POST['email'];
            } ?>" />
          </div>

          <div class="form-group">

            <label class="control-label" for="input-password">Password</label>
            <span class="text-danger" id="bouncyFlip">
  		        <?php
  		          if(isset($_POST['password'])) {
  		            if (empty($_POST['password'])) {
  		              echo '*This field is required';
  		            }
  		          }
  		         ?>
  		      </span>
            <input type="password" name="password" placeholder="Password" id="input-password" class="form-control" />
          </div>

          <div class="form-group">
            <label class="control-label">Remember Me</label>
            <input type="checkbox" name="remember" id="remember" />
          </div>

          <input type="submit" value="Login" class="btn btn-primary" />
        </form>

      </div>
    </div>
  </div>
</div>
    </div>
</div>

<?php require 'template/footer.php';
