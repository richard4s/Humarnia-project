<?php

require_once 'core/init.php';
require_once 'template/header.php';

if(!$user->isLoggedIn()) {
  echo '<script>
            window.location = " include/errors/404.php";
          </script>';
} else {

  $user->logout();

  //echo 'You\'re logged out';
  echo '<script>
            window.location = "index.php";
          </script>';
}

 ?>
