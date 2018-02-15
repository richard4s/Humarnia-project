<?php

require_once 'core/init.php';
require_once 'template/header.php';

  $latest = DB::getInstance()->query("SELECT * FROM women_shirts ORDER BY id DESC LIMIT 3");
 ?>

<div class="container">
  <div class="row">
    <aside id="column-left" class="col-sm-3 hidden-xs">

      <div class="box latest">
        <div class="box-heading">Latest</div>

          <div class="box-product productbox-grid" id="latest-grid">

          <!-- product 1 -->

          <?php
          if(!$latest->results()) {
            echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
          } else {
          foreach($latest->results() as $sidebar) {

            echo '<div class="product-items">
              <div class="product-block product-thumb transition">
                <div class="product-block-inner">

                  <div class="image">
                    <a href="products.php?id='.$sidebar->id.'&product=women_shirts">
                      <img src="uploads/'.$sidebar->productImage.'" title="'.$sidebar->productName.'" alt="'.$sidebar->productName.'" class="img-responsive reg-image"/>
                      <img class="img-responsive hover-image" src="uploads/'.$sidebar->productImage.'" title="'.$sidebar->productName.'" alt="'.$sidebar->productName.'"/>
                    </a>

                    <div class="button-gr lists">
                      <div class="quickview-button"><a class="quickview-button" href="#"></a></div>
                    </div>

                    <div class="button-group">
                      <button type="button" class="addtocart"><i class="fa fa-shopping-cart"></i><span class="hidden-xs hidden-sm hidden-md">Purchase</span></button>
                    </div>

                  </div>

                  <div class="product-details">

                    <div class="caption">
                      <h4><a href="products.php?id='.$sidebar->id.'&product=women_shirts">'.$sidebar->productName.'</a></h4>

                      <p class="price">N'.$sidebar->productPrice.'
                        <span class="price-tax">Ex Tax: N199.99</span>
                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>';
          }
        }

           ?>

          <!-- product 1 -->

          </div>
        </div>
      </div><!--row-->

    </aside>

    <div id="content" class="col-sm-9">
      <h2 class="page-title">Women's category</h2>
      <div class="row category_thumb">
        <div class="col-sm-2 category_img"><img src="image/cache/catalog/demo/Untitled-2.jpg" alt="Women's category" class="img-thumbnail"></div>

      </div>

      <div class="category_filter">
        <div class="col-md-4 btn-list-grid">
          <label class="control-label" for="input-sort">Sort By:</label>
          <div class="btn-group">

            <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
            <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
          </div>
        </div>

      </div>


      <div class="row">

        <div class="col-sm-12 category_list" id="tabs_info">
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#tab-shirts" data-toggle="tab">Shirts</a></li>
            <li><a href="#tab-jackets" data-toggle="tab">Jackets</a></li>
            <li><a href="#tab-tshirts" data-toggle="tab">T-Shirts</a></li>
            <li><a href="#tab-pants" data-toggle="tab">Pants</a></li>
            <li><a href="#tab-shoes" data-toggle="tab">Shoes</a></li>
          </ul>

      <div class="tab-content">

    <div class="tab-pane active" id="tab-shirts">
      <div class="row cat_prod">

        <?php
        if($user->isLoggedIn()) {
          if($user->hasPermission('admin')) {
            echo '<div>
                    <div class="col-sm-3 col-xs-offset-9 col-sm-offset-11">
                      <a href="insert_dashboard.php?product=women_shirts" class="btn btn-primary mybtn"><i class="fa fa-plus">Add</i></a>
                    </div>
                  </div>';
          }
        }
         ?>

        <?php
      if($user->isLoggedIn()) {
        if(!$user->hasPermission('admin')){
        $retrieval = DB::getInstance()->query("SELECT * FROM women_shirts ORDER BY id DESC");
        if(!$retrieval->results()) {
          echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
        } else {
        foreach($retrieval->results() as $retrieves) {
          echo '<div class="product-layout product-list col-xs-12">
            <div class="product-block product-thumb">
              <div class="product-block-inner">

                <div class="image">
                  <a href="#products">
                		<img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                		<img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                	</a>

                  <div class="button-gr lists">
                    <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                  </div>

                  <span class="saleicon sale">Sale</span>

                </div>

                <div class="product-details grid">
                  <div class="caption">
                    <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                    </p>

                    <div class="button-group">
                      <a href="products.php?id='.$retrieves->id.'&product=women_shirts" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                    </div>

                  </div>
                </div>

                <div class="product-details list">
                  <div class="caption">
                    <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                    <p class="desc">'.$retrieves->productDescription.'</p>
                    <div class="button-group">
                      <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                      <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                    </div>
                  </div>
                  <div class="list-right">
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                    </p>

                    <a href="#buy" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to Cart</i></a>

                  </div>
                </div>

              </div>
            </div>
          </div>';
        }
      }
    	} else if($user->hasPermission('admin')) {
        $retrieval = DB::getInstance()->query("SELECT * FROM women_shirts ORDER BY id DESC");
        if(!$retrieval->results()) {
          echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
        } else {
        foreach($retrieval->results() as $retrieves) {
          echo '<div class="product-layout product-list col-xs-12">
            <div class="product-block product-thumb">
              <div class="product-block-inner">

                <div class="image">
                  <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shirts">
                    <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                    <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                  </a>

                  <div class="button-gr lists">
                    <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                  </div>

                  <span class="saleicon sale">Sale</span>

                </div>

                <div class="product-details grid">
                  <div class="caption">
                    <h4 class="name"><a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shirts"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                    </p>

                    <div class="row">
                      <div class="col-sm-offset-0 col-sm-3">
                        <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shirts" class="btn btn-warning mybtn"><i class="fa fa-pencil"> Edit</i></a>
                      </div>
                      <div class="col-sm-offset-1 col-sm-3">
                        <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_shirts" class="btn btn-danger mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="product-details list">
                  <div class="caption">
                    <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                    <p class="desc">'.$retrieves->productDescription.'</p>
                    <div class="button-group">
                      <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                      <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                    </div>
                  </div>
                  <div class="list-right">
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                    </p>


                    <div class="row">
                      <div class="col-sm-12"><br>
                        <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shirts" class="btn btn-warning hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-pencil"> Edit</i></a>
                      </div>
                      <div class="col-sm-12"><br>
                        <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_shirts" class="btn btn-danger hidden-xs hidden-sm hidden-md mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>';
        }
      }
      }

    }  else {
        $retrieval = DB::getInstance()->query("SELECT * FROM women_shirts ORDER BY id DESC");
        if(!$retrieval->results()) {
          echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
        } else {
        foreach($retrieval->results() as $retrieves) {
          echo '<div class="product-layout product-list col-xs-12">
            <div class="product-block product-thumb">
              <div class="product-block-inner">

                <div class="image">
                  <a href="#">
                    <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                    <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                  </a>

                  <div class="button-gr lists">
                    <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                  </div>

                  <span class="saleicon sale">Sale</span>

                </div>

                <div class="product-details grid">
                  <div class="caption">
                    <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                    </p>

                    <div class="button-group">
                      <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to cart</i></a>
                    </div>
                  </div>
                </div>

                <div class="product-details list">
                  <div class="caption">
                    <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                    <p class="desc">'.$retrieves->productDescription.'</p>
                    <div class="button-group">
                      <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                      <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                    </div>
                  </div>
                  <div class="list-right">
                    <p class="price">
                      <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                    </p>

                    <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to cart</i></a>

                  </div>
                </div>

              </div>
            </div>
          </div>';
        }
      }
      }

?>

      </div>
    </div>


    <div class="tab-pane" id="tab-jackets">
      <div class="row cat_prod">
        <?php
        if($user->isLoggedIn()) {
          if($user->hasPermission('admin')) {
            echo '<div class="">
                    <div class="col-sm-3 col-xs-offset-9 col-sm-offset-11">
                      <a href="insert_dashboard.php?product=women_jackets" class="btn btn-primary mybtn"><i class="fa fa-plus">Add</i></a>
                    </div>
                  </div>';

            $retrieval = DB::getInstance()->query("SELECT * FROM women_jackets ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
            }  else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a>
                          </div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_jackets" class="for-font" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="row">
                            <div class="col-sm-offset-0 col-sm-3">
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_jackets" class="btn btn-warning mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-offset-1 col-sm-3">
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_jackets" class="btn btn-danger mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>


                          <div class="row">
                            <div class="col-sm-12"><br>
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_jackets" class="btn btn-warning hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-12"><br>
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_jackets" class="btn btn-danger hidden-xs hidden-sm hidden-md mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }

          } else if(!$user->hasPermission('admin')) {
            $retrieval = DB::getInstance()->query("SELECT * FROM women_jackets ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            }   else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#products">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="products.php?id='.$retrieves->id.'&product=women_jackets" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="#buy" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
        } else{
            $retrieval = DB::getInstance()->query("SELECT * FROM women_jackets ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            } else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>
                          </div>
                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
         ?>
      </div>
    </div>


    <div class="tab-pane" id="tab-tshirts">
      <div class="row cat_prod">
        <?php
        if($user->isLoggedIn()) {
          if($user->hasPermission('admin')) {
            echo '<div class="">
                    <div class="col-sm-3 col-xs-offset-9 col-sm-offset-11">
                      <a href="insert_dashboard.php?product=women_tshirts" class="btn btn-primary mybtn"><i class="fa fa-plus">Add</i></a>
                    </div>
                  </div>';

            $retrieval = DB::getInstance()->query("SELECT * FROM women_tshirts ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
            } else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a>
                          </div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_tshirts" class="for-font" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="row">
                            <div class="col-sm-offset-0 col-sm-3">
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_tshirts" class="btn btn-warning mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-offset-1 col-sm-3">
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_tshirts" class="btn btn-danger mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>


                          <div class="row">
                            <div class="col-sm-12"><br>
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_tshirts" class="btn btn-warning hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-12"><br>
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_tshirts" class="btn btn-danger hidden-xs hidden-sm hidden-md mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }

          } else if(!$user->hasPermission('admin')) {
            $retrieval = DB::getInstance()->query("SELECT * FROM women_tshirts ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            }  else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#products">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="products.php?id='.$retrieves->id.'&product=women_tshirts" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="#buy" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
        } else{
            $retrieval = DB::getInstance()->query("SELECT * FROM women_tshirts ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            } else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>
                          </div>
                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
         ?>
      </div>
    </div>

    <div class="tab-pane" id="tab-pants">
      <div class="row cat_prod">
        <?php
        if($user->isLoggedIn()) {
          if($user->hasPermission('admin')) {
            echo '<div class="">
                    <div class="col-sm-3 col-xs-offset-9 col-sm-offset-11">
                      <a href="insert_dashboard.php?product=women_pants" class="btn btn-primary mybtn"><i class="fa fa-plus">Add</i></a>
                    </div>
                  </div>';

            $retrieval = DB::getInstance()->query("SELECT * FROM women_pants ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
            }  else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a>
                          </div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_pants" class="for-font" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="row">
                            <div class="col-sm-offset-0 col-sm-3">
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_pants" class="btn btn-warning mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-offset-1 col-sm-3">
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_pants" class="btn btn-danger mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>


                          <div class="row">
                            <div class="col-sm-12"><br>
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_pants" class="btn btn-warning hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-12"><br>
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_pants" class="btn btn-danger hidden-xs hidden-sm hidden-md mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }

          } else if(!$user->hasPermission('admin')) {
            $retrieval = DB::getInstance()->query("SELECT * FROM women_pants ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            }   else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#products">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="products.php?id='.$retrieves->id.'&product=women_pants" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="#buy" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
        } else{
            $retrieval = DB::getInstance()->query("SELECT * FROM women_pants ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            }  else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>
                          </div>
                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
         ?>
      </div>
    </div>

    <div class="tab-pane" id="tab-shoes">
      <div class="row cat_prod">
        <?php
        if($user->isLoggedIn()) {
          if($user->hasPermission('admin')) {
            echo '<div class="">
                    <div class="col-sm-3 col-xs-offset-9 col-sm-offset-11">
                      <a href="insert_dashboard.php?product=women_shoes" class="btn btn-primary mybtn"><i class="fa fa-plus">Add</i></a>
                    </div>
                  </div>';

            $retrieval = DB::getInstance()->query("SELECT * FROM women_shoes ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here</a>';
            }   else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a>
                          </div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shoes" class="for-font" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="row">
                            <div class="col-sm-offset-0 col-sm-3">
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shoes" class="btn btn-warning mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-offset-1 col-sm-3">
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_shoes" class="btn btn-danger mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>


                          <div class="row">
                            <div class="col-sm-12"><br>
                              <a href="edit_dashboard.php?id='.$retrieves->id.'&product=women_shoes" class="btn btn-warning hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-pencil"> Edit</i></a>
                            </div>
                            <div class="col-sm-12"><br>
                              <a href="delete_dashboard.php?id='.$retrieves->id.'&product=women_shoes" class="btn btn-danger hidden-xs hidden-sm hidden-md mybtn" onclick="confirmMessage(event)"><i class="fa fa-warning"> Delete</i></a>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }

          } else if(!$user->hasPermission('admin')) {
            $retrieval = DB::getInstance()->query("SELECT * FROM women_shoes ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            }    else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#products">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="products.php?id='.$retrieves->id.'&product=women_shoes" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                          </div>

                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="#buy" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart">Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
          } else{
            $retrieval = DB::getInstance()->query("SELECT * FROM women_shoes ORDER BY id DESC");
            if(!$retrieval->results()) {
              echo 'No products are available here yet. You can contact us to enquire <a href="contact_us.php">here.</a>';
            } else{
              foreach($retrieval->results() as $retrieves) {
                echo '<div class="product-layout product-list col-xs-12">
                  <div class="product-block product-thumb">
                    <div class="product-block-inner">

                      <div class="image">
                        <a href="#">
                          <img src="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'" class="img-responsive reg-image"/>
                          <img class="img-responsive hover-image" src="uploads/'.$retrieves->productImage.'"  title="'.$retrieves->productName.'"/>
                        </a>

                        <div class="button-gr lists">
                          <div class="quickview-button"><a class="quickview-button newbtn" href="uploads/'.$retrieves->productImage.'" title="'.$retrieves->productName.'">Quick View</a></div>
                        </div>

                        <span class="saleicon sale">Sale</span>

                      </div>

                      <div class="product-details grid">
                        <div class="caption">
                          <h4 class="name"><a href="#"  title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>

                          </p>

                          <div class="button-group">
                            <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>
                          </div>
                        </div>
                      </div>

                      <div class="product-details list">
                        <div class="caption">
                          <h4 class="name"><a href="#" title="'.$retrieves->productName.'">'.$retrieves->productName.'</a></h4>

                          <p class="desc">'.$retrieves->productDescription.'</p>
                          <div class="button-group">
                            <label class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><span>Add to Wish List</span></label>
                            <label class="compare" type="button" data-toggle="tooltip" title="Add to Compare"><span>Add to Compare</span></label>
                          </div>
                        </div>
                        <div class="list-right">
                          <p class="price">
                            <span class="price-new">N'.$retrieves->productPrice.'</span> <span class="price-old">N1,202.00</span>
                          </p>

                          <a href="login.php" onclick="loginCheck(event)" class="btn btn-primary hidden-xs hidden-sm hidden-md mybtn"><i class="fa fa-shopping-cart"> Add to Cart</i></a>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>';
              }
            }
          }
         ?>
      </div>
    </div>


    </div>
  </div>
</div>

    </div>
  </div>
</div>



<form id="test-form" class="white-popup-block mfp-hide form-inline">
  <h1 class="text-center block-title">Confirm Your Details</h1>

      <div class="row">
      <div class="col-sm-6">
        <img src="" class="img-responsive reg-image"/>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-6 col-sm-offset-7">
          <label for="name"><br>&nbsp;&nbsp;&nbsp;Name:</label>
          <input id="name" name="name" type="text" >
        </div>

      <div class="col-sm-6 col-sm-offset-7">
        <label for="email"><br>&nbsp;&nbsp;&nbsp;Email:</label>
        <input id="email" name="email" type="email" >
      </div>

      <div class="col-sm-6 col-sm-offset-7">
        <label for="number"><br>Number:</label>
        <input id="number" name="number" type="number" >
      </div>

      <div class="col-sm-6 col-sm-offset-7">
        <label for="address"><br>Address:</label>
        <input id="address" name="address" type="text" >
      </div>

    </div>
  </div><br><Br>
</form>


<?php require_once 'template/footer.php'; ?>
