<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>
<?php
require_once 'core/init.php';
require_once 'template/header.php';

if (isset($_GET['product'])) {

  $product = $_GET['product'];

  if($user->isLoggedIn()) {
  	if($user->hasPermission('admin')) {

if(Input::exists()) {

$validate = new Validate();
$validation = $validate->check($_POST, [
  'title' => [
    'required' => true,
    'min' => 4,
    'max' => 100
  ],
  'price' => [
    'required' => true,
    'min' => 2,
    'max' => 13
  ],
  'description' => [
    'required' => true,
    'min' => 2
  ]
]);

if($validation->passed()) {

  try{

    $images = $_FILES['images']['name'];
    $ext = pathinfo($images);
    $newname =  Input::get('title').'_humarnia'.rand(). '.'. $ext['extension'];

    move_uploaded_file($_FILES['images']['tmp_name'], "uploads/".$newname);

    $resize = new ResizeImage("uploads/".$newname);
    $resize->resizeTo(180, 219);
    $resize->saveImage("uploads/".$newname);

    $myImage = DB::getInstance()->insert($product, [
      'productName' => Input::get('title'),
      'productPrice' => Input::get('price'),
      'productDescription' => Input::get('description'),
      'productImage' => $newname
    ]);

    echo
    "<script>
      $(document).ready(function() {
        $.notify({
            title: 'Success',
            icon: 'glyphicon glyphicon-star',
            message: 'You have Succesfully added a new product!'
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

    } else{
      echo '<script>
                window.location = " include/errors/404.php";
              </script>';
            }
    } else {
      header('Location: include/errors/404.php');
    }
} else {
  echo '<script>
            window.location = " include/errors/404.php";
          </script>';
}
?>

<div class="container">
  <div class="row">

    <div class="col-sm-offset-4 col-sm-6">
      <div class="jumbotron">
        <h2 class="text-center">INSERT DASHBOARD</h2>
        <h5 class="text-center">You can add more products from here.</h5>

      <form method="POST" action="" enctype="multipart/form-data" class="form-inline">

        <div class="form-group">
          <label class="control-label" class"col-sm-2"><h4>Enter Title:</h4></label>
          <span class="text-danger" id="bouncyFlip">
           <?php
             if(isset($_POST['title'])) {
               if (empty($_POST['title'])) {
                 echo '*This field is required';
               }
             }
            ?>
         </span>
          <input type="text" class="form-control" name="title" value="<?php
            if(isset($_POST['title'])) {
                echo $_POST['title'];
              } ?>" /><br><br>
          </div>

          <div class="form-group">
            <label class="control-label" class"col-sm-2"><h4>Enter Price:</h4></label>
            <span class="text-danger" id="bouncyFlip">
            <?php
             if(isset($_POST['price'])) {
               if (empty($_POST['price'])) {
                 echo '*This field is required';
               }
             }
            ?>
          </span>
           <input type="number" class="form-control" name="price" value="<?php if(isset($_POST['price'])) { echo $_POST['price']; } ?>"/><br><br>
         </div>

         <div class="form-group">
           <label class="control-label" class"col-sm-2"><h4>Enter Product Description:</h4></label>
          <span class="text-danger" id="bouncyFlip">
          <?php
           if(isset($_POST['description'])) {
             if (empty($_POST['description'])) {
               echo '*This field is required';
             }
           }
          ?>
        </span>
           <textarea rows="3" cols="38" class="form-control" name="description"><?php if(isset($_POST['description'])) { echo $_POST['description']; } ?></textarea><br><br>
         </div>

         <div class="form-group">
           <label class="control-label" class"col-sm-2"><h4>Upload Image:</h4></label>
          <span class="text-danger" id="bouncyFlip">*For best quality, upload large images.</span><br>
          <h2 style="color: red !important;" id="imageRequired"></h2>
          <input type="file" name="images" id="imageChecker" accept=".jpg, .jpeg, .png"/><br><br>
        </div>

        <div class="col-sm-offset-4 col-sm-6">
          <button name="submit" class="btn-primary btn" onclick="check(event);" type="submit">Submit</button>
        </div>

      </form>
    </div>
    </div>
  </div>
</div>

<?php

require 'template/footer.php';
 ?>
