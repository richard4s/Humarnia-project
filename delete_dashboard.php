<?php

if (isset($_GET['id']) && isset($_GET['product'])) {

  require_once 'core/init.php';
  require_once 'template/header.php';

  $deleteid = $_GET['id'];
  $product = $_GET['product'];

  if($user->isLoggedIn()) {
  	if($user->hasPermission('admin')) {

      if($deleteProduct = DB::getInstance()->query("DELETE FROM {$product} WHERE id={$deleteid}")) {

        if(substr($product, 0, 3) == 'men') {
          echo '<script>window.location = "men.php";</script>';
        } else {
          echo '<script>window.location = "women.php";</script>';
        }

      } else{
        echo 'Something went wrong.';
      }

  	}
  }

} else {
  header('Location: include/errors/404.php');
}

require 'template/footer.php';
 ?>
