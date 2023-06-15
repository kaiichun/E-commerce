<?php
  // load data from database
  $database = connectToDB();

 // ASC - acens
 $sql = "SELECT * FROM products";
  $query = $database->prepare($sql);
  $query->execute();

  // fetch the data from query
  $products = $query->fetchAll();
  require "parts/header.php";
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shoppe</a>
      <div class="d-flex ms-auto pt-2">
      <!-- <?php if ( isUserLoggedIn() ) { ?>
        <p class="nav-link ps-2 pe-2"><i class="bi bi-person-circle"><?= $_SESSION['user']['firstname'] ?></i></p> -->
          <!-- <p>|</p> -->
            <!-- <a class="nav-link ps-2 pe-2" href="/editprofile">Edit Profile</a> -->
              <!-- <p disabled readonly>|</p> -->
                <!-- <a class="nav-link ps-2 pe-2" href="/logout">Login out</a>
        <?php } else { ?>
        <a class="nav-link ps-2 pe-2" href="/login">Login</a> -->
          <!-- <p disabled readonly>|</p> -->
            <!-- <a class="nav-link ps-2 pe-2" href="/signup">Signup</a> -->
              <!-- <p disabled readonly>|</p> -->
                <!-- <a class="nav-link ps-2 pe-2" href="/dashboard">Seller Center</a> -->
                <!-- <?php if ( isAdmin() ) : ?>
                  <a class="nav-link ps-2 pe-2" href="/dashboard">Dashboard</a>
                <?php endif; ?>
              <?php } ?> -->
              <!--  -->
              <?php if ( isUserLoggedIn() ) { ?>
                <p class="nav-link ps-2 pe-2"><i class="bi bi-person-circle"><?= $_SESSION['user']['firstname'] ?></i></p>
              <?php } ?>
              <?php if ( isUserLoggedIn() ) : ?>
                <a class="nav-link ps-2 pe-2" href="/editprofile">Edit Profile</a>
                <?php endif; ?>
              <?php if ( isAdmin() || isEditor() ) : ?>
                  <a class="nav-link ps-2 pe-2" href="/dashboard">Dashboard</a>
                <?php endif; ?>
              <?php if ( isset( $_SESSION["user"] ) ) { ?>
                <a href="/logout" class="nav-link ps-2 pe-2">Logout</a>
              <?php } else { ?>
                <a href="/login" class="nav-link ps-2 pe-2">Login</a>
                <a href="/signup" class="nav-link ps-2 pe-2">Sign Up</a>
                <a class="nav-link ps-2 pe-2" href="/dashboard">Seller Center</a>
              <?php } ?>
      </div>
  </div>
</nav>  

 <!-- banner -->
 <section id="banner">
  <!-- post control -->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        <img src="./asstes/Banner-here.jpeg" class="d-block w-100" alt="banner">
      </div>
    </div>
  </div>
  <!-- post control -->  
</section>
<!-- banner -->

<!-- hot selling -->
<section id="newproduct">
  <div class="container mx-auto mb-5" style="max-width: 1400px;">
    <div class="d-flex">
        <h3>New Product</h3> 
          <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
      <?php if ( isset( $products) ) : ?>
        <?php 
              // Limit the number of products to 6
              $products = array_slice($products, 0, 6);
              foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
            <div class="card h-80">
              <form action="wishlist/submit" method="post">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                  <input type="hidden" name="is_wishlist" value="<?= $product['is_wishlist'];?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                      <?php if($product['is_wishlist']==0) : ?>
                        <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php else : ?>
                        <i class="bi bi-heart-fill" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php endif ;?>
                      <img
                        src=<?=  $product['product_image']; ?>
                        class="card-img-top img-fluid"
                        style="width:240px; height:200px"
                        alt="Produc"
                      />
                    </button>
              </form>
              <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                <small class="card-title"><?= $product['product_name']; ?></small>
                  <span class="card-text ">
                    <h5 style="color:#ed510e;">RM <?= $product['product_price']; ?>
                 <!-- <?php $excerpt = str_split( $product['product_description'], 80 );
                            echo $excerpt[0];
                      ?>  -->
                    </h5>       
                  </span>
                      </div>
                      <div class="text-center mb-3 g-3">
                        <button type="submit" class="btn btn-sm btn-warning"> BUY NOW </button>
                        <button type="submit" class="btn btn-sm btn-light"> ADD CART </button>
                      </div>
                    </div>
          </div>   
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section> 

<!-- hot selling -->
<!-- All Product -->
<section id="hotselling">
  <div class="container mx-auto mb-5" style="max-width: 1400px;">
    <div class="d-flex">
        <h3>Hot Selling</h3> 
          <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
      <?php if ( isset( $products) ) : ?>
        <?php foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
            <div class="card h-80">
              <form action="wishlist/submit" method="post">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                  <input type="hidden" name="is_wishlist" value="<?= $product['is_wishlist'];?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                      <?php if($product['is_wishlist']==0) : ?>
                        <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php else : ?>
                        <i class="bi bi-heart-fill" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php endif ;?>
                      <img
                        src=<?=  $product['product_image']; ?>
                        class="card-img-top img-fluid"
                        style="width:240px; height:200px"
                        alt="Produc"
                      />
                    </button>
              </form>
              <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                <small class="card-title"><?= $product['product_name']; ?></small>
                  <span class="card-text ">
                    <h5 style="color:#ed510e;">RM <?= $product['product_price']; ?>
                 <!-- <?php $excerpt = str_split( $product['product_description'], 80 );
                            echo $excerpt[0];
                      ?>  -->
                    </h5>       
                  </span>
                      </div>
                      <div class="text-center mb-3 g-3">
                        <button type="submit" class="btn btn-sm btn-warning"> BUY NOW </button>
                        <button type="submit" class="btn btn-sm btn-light"> ADD CART </button>
                      </div>
              </div>
          </div>   
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section> 
    <!-- All Product -->

    <!-- Daily Discover -->
    <!-- 24 random 1 time -->
<section id="daily discover">
  <div class="container mx-auto mb-5" style="max-width: 1400px;">
    <div class="d-flex">
        <h3>Daily Discover</h3> 
          <a class="ms-auto text-decoration-none p-2" role="button" href="" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
      <?php if ( isset( $products) ) : ?>
        <?php shuffle($products); foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
            <div class="card h-80">
              <form action="wishlist/submit" method="post">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                  <input type="hidden" name="is_wishlist" value="<?= $product['is_wishlist'];?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                      <?php if($product['is_wishlist']==0) : ?>
                        <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php else : ?>
                        <i class="bi bi-heart-fill" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                      <?php endif ;?>
                      <img
                        src=<?= $product['product_image']; ?>
                        class="card-img-top img-fluid"
                        style="width:240px; height:200px"
                        alt="Produc"
                      />
                    </button>
              </form>
              <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                <small class="card-title"><?= $product['product_name']; ?></small>
                  <span class="card-text ">
                    <h5 style="color:#ed510e;">RM <?= $product['product_price']; ?>
                 <!-- <?php $excerpt = str_split( $product['product_description'], 80 );
                            echo $excerpt[0];
                      ?>  -->
                    </h5>       
                  </span>
                      </div>
                      <div class="text-center mb-3 g-3">
                        <button type="submit" class="btn btn-sm btn-warning"> BUY NOW </button>
                        <button type="submit" class="btn btn-sm btn-light"> ADD CART </button>
                      </div>
              </div>
          </div>   
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section> 


<?php
    require 'parts/footer.php';
?>