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
    <a class="navbar-brand" href="/">Shoppe</a>
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
              <?php if ( isEditor() || isUser() ) : ?>
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
                <a class="nav-link ps-2 pe-2" href="/dashboard">Dashboard</a>
              <?php } ?>
      </div>
  </div>
</nav>  

   <section id="newproduct">
   <ul class="nav mt-3 mb-4 justify-content-end">
          <li class="nav-item">
            <a class="nav-link" href="/products">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/beauty">Beauty</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/electronics">Electronics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/fashion">Fashion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/groceries">Groceries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/health">Health</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/toys">Toys</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/category/other">Other</a>
          </li>
        </ul>
  <div class="container mx-auto my-5" style="max-width: 1400px;">
        <h3>Home</h3> 
    
    <div class="row">
      <?php if ( isset( $products) ) : ?>
        <?php 
              foreach( $products as $product ) : ?>
              <?php if($product ["category"] == "home") { ?>
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
          <?php } ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section> 



<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php
    require "parts/footer.php";