<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC090216_3/stylesheet/megnor/bootstrap.min.css" />

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/bootstrap-notify.min.js"></script>
<?php

require_once 'core/init.php';
require_once 'template/header.php';


  if(isset($_POST['imageSubmit']) && isset($_GET['id']) && isset($_GET['product']) && isset($_GET['title'])) {

    $editingid = $_GET['id'];
    $product = $_GET['product'];
    $title = $_GET['title'];

    if($user->isLoggedIn()) {
    	if($user->hasPermission('admin')) {

        try {

          $images = $_FILES['images']['name'];
          $ext = pathinfo($images);
          $newname =  $title.'_humarnia'.rand(). '.'. $ext['extension'];

          move_uploaded_file($_FILES['images']['tmp_name'], "uploads/".$newname);

          $resize = new ResizeImage("uploads/".$newname);
          $resize->resizeTo(180, 219);
          $resize->saveImage("uploads/".$newname);

          $editUpload = DB::getInstance()->update($product, $editingid, [
            'productImage' => $newname
          ]);

          echo '<script>window.location = "edit_dashboard.php?id='.$editingid.'&product='.$product.'"</script>';

        } catch(Exception $e) {
          echo
          "<script>
            $(document).ready(function() {
              $.notify({
                  title: '<strong>Not Succesful!</strong>',
                  icon: 'glyphicon glyphicon-star',
                  message: '".$e."'
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
        echo '<script>
                  window.location = " include/errors/404.php";
                </script>';
      }
    } else{
      echo '<script>
                window.location = " include/errors/404.php";
              </script>';
    }
  } else{
    echo '<script>
              window.location = " include/errors/404.php";
            </script>';
}


?>
