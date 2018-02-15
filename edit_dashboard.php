<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>
<?php
require_once 'core/init.php';
require_once 'template/header.php';

//echo $_SERVER['SCRIPT_NAME'];

if (isset($_GET['id']) && isset($_GET['product'])) {



  $editingid = $_GET['id'];
  $product = $_GET['product'];

  if($user->isLoggedIn()) {
  	if($user->hasPermission('admin')) {

      $edit = DB::getInstance()->query("SELECT * FROM {$product} WHERE id={$editingid}");

      foreach($edit->results() as $editvalue) {
        $editId = $editvalue->id;
        $editName = $editvalue->productName;
        $editPrice = $editvalue->productPrice;
        $editDescription = $editvalue->productDescription;
        $editImage = $editvalue->productImage;
      }

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

    $myImage = DB::getInstance()->update($product, $editingid, [
      'productName' => Input::get('title'),
      'productPrice' => Input::get('price'),
      'productDescription' => Input::get('description')
    ]);

    if(substr($product, 0, 3) == 'men') {
      echo '<script>window.location = "men.php";</script>';
    } else {
      echo '<script>window.location = "women.php";</script>';
    }

    echo
    "<script>
      $(document).ready(function() {
        $.notify({
            title: 'Success',
            icon: 'glyphicon glyphicon-star',
            message: 'You have Succesfully added a new product!'
          },{
            type: 'success',
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
      echo '<script>
                window.location = " include/errors/404.php";
              </script>';
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
          <h2 class="text-center">EDITS DASHBOARD</h2>
          <h5 class="text-center">Make quick changes to your products from here.</h5>

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
         <input type="text" name="title" class="form-control" value="<?php echo $editName; ?>"/><br><br>
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
        <input type="text" name="price" class="form-control" value="<?php echo $editPrice; ?>"/><br><br>
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
         <textarea rows="3" cols="38" class="form-control" name="description"> <?php echo $editDescription; ?></textarea><br><br>
       </div>

       <img src="uploads/<?php echo $editImage; ?>" class="img-responsive" /><br>

        <a data-toggle="modal" data-target="#changeImage" class="btn-primary btn">Change This Image</a><br><br>

        <div class="col-sm-offset-4 col-sm-6">
          <button name="submit" class="btn-primary btn" type="submit">Submit</button>
        </div>
      </form>
    </div>

    </div>
  </div>
</div>

<div class="modal fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="imageChange">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="imageChange">Upload New Image</h4>

      </div>
      <div class="modal-body">
        <form method="post" action="upload_image.php?id=<?php echo $editingid ?>&product=<?php echo $product ?>&title=<?php echo $editName ?>" enctype="multipart/form-data" class="form-inline">

          <div class="form-group">
            <label for="image">Upload Image</label>
            <span class="text-danger">*For best quality, upload large images.</span>
            <h2 style="color: red !important;" id="imageRequired"></h2>
            <input type="file" name="images" id="imageChecker" accept=".jpg, .jpeg, .png"/>
          </div><br><br>

          <div class="col-sm-offset-4 col-sm-6">
            <button name="imageSubmit" class="btn-primary btn" onclick="check(event);" type="submit">Upload</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
  require 'template/footer.php';
?>
