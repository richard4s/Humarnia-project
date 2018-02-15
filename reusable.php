<?php

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

$img = resize_image('white6.jpg', 200, 200);

echo '<img src="'.$img.'" />';


die();

  //$product = $_GET['product'];

  if(strlen($product) <= 3) {
    echo $product.'You are a man';
  } else if(strlen($product) > 3) {
    echo $product.'You are a woman';
  }

 ?>

<?php $fetcher = DB::getInstance()->query("SELECT * FROM top_products ORDER BY id DESC"); ?>

<?php
     if(!$fetcher->count()) {
       echo "<script>
        $(document).ready(function() {
          $.notify({
              title: '<strong>Succesful!</strong>',
              icon: 'glyphicon glyphicon-star',
              message: 'There is no data in the database.s'
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
              delay: 200000,
              offset: 180,
              spacing: 10,
              z_index: 1031,
            });
        });
      </script>";
    } else{

      foreach($fetcher->results() as $fetched) {
        $id = $fetched->id;
        echo '<div class="slider-item">
          <div class="product-block product-thumb transition">
            <div class="product-block-inner">

              <div class="image">
                <a href="#">
                  <img src="uploads/'.$fetched->productImage.'" title="'. $fetched->productName .'" alt="'. $fetched->productName .'" class="img-responsive reg-image" />
                  <img src="uploads/'.$fetched->productImage.'" title="'. $fetched->productName .'" alt="'. $fetched->productName .'" class="img-responsive hover-image" />
                </a>
              </div>

              <div class="product-details">
                <div class="caption">
                  <h4 class="name"><a href="#" title="'. $fetched->productName .'">'. $fetched->productName .'</a></h4>
                  <p class="price">'. $fetched->productPrice .'</p>

                  <div class="button-group">
                    <a class="mybtn" type="button" href="products.php?id='. $fetched->id .'">Purchase</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
      }
    }
 ?>





















 <link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

 <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
 <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="catalog/view/javascript/megnor/bootstrap-notify.min.js" type="text/javascript"></script>
 <script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
 <?php

 require_once 'core/init.php';
 require_once 'template/header.php';

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

         $product = $_GET['product'];
         $images = $_FILES['images']['name'];

         //$someimage = $_FILES['images']['tmp_name'];

         $ext = pathinfo($images);
         //@$extend =  $ext['extension'];

         $newname = rand(). '.'. $ext['extension'];

         move_uploaded_file($_FILES['images']['tmp_name'], "uploads/".$newname);

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

 ?>

   <div class="container">
     <div class="row">

       <div class="col-sm-12">
         <h1>INSERT DASHBOARD</h1>
         <br>
       </div>

       <div class="col-sm-12">

         <form method="POST" action="" enctype="multipart/form-data">
           <span class="text-danger" id="bouncyFlip">
 		        <?php
 		          if(isset($_POST['title'])) {
 		            if (empty($_POST['title'])) {
 		              echo '*This field is required';
 		            }
 		          }
 		         ?>
 		      </span>
             Enter Title: <input type="text" name="title" value="<?php
               if(isset($_POST['title'])) {
                   echo $_POST['title'];
                 } ?>" /><br><br>
             <span class="text-danger" id="bouncyFlip">
             <?php
              if(isset($_POST['price'])) {
                if (empty($_POST['price'])) {
                  echo '*This field is required';
                }
              }
             ?>
           </span>
             Enter Price: <input type="text" name="price" value="<?php if(isset($_POST['price'])) { echo $_POST['price']; } ?>"/><br><br>
             <span class="text-danger" id="bouncyFlip">
             <?php
              if(isset($_POST['description'])) {
                if (empty($_POST['description'])) {
                  echo '*This field is required';
                }
              }
             ?>
           </span>
             Enter Product Description: <textarea rows="3" cols="28" name="description" value="<?php if(isset($_POST['description'])) { echo $_POST['description']; } ?>"></textarea><br><br>
             Upload Image:<span class="text-danger" id="bouncyFlip">
               *Images must be 253x309
           </span>
              <input type="file" name="images" accept=".jpg, .jpeg, .png"/><br><br>
             <button name="submit" class="btn-primary btn" type="submit">Submit</button>
         </form>

       </div>
     </div>
   </div>

  <?php require_once 'template/footer.php' ?>
