<?php
  $database = connectToDB();
  
  $sql = "SELECT * FROM products WHERE status = 'publish' ORDER BY id DESC LIMIT 12";
  $query = $database->prepare($sql);
  $query->execute();
  $products = $query->fetchAll();

  $sql = "SELECT * FROM wishlist";
  $query = $database->prepare($sql);
  $query->execute();
  $is_wishlist = $query->fetchAll();
  
  require "parts/header.php";
  require "parts/navbar-home.php";
?>

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

<!-- All Product -->
<section id="all-product">
  <div class="container mx-auto mb-5 mt-5" style="max-width: 1400px;">
    <div class="d-flex">
      <h3>New Product</h3> 
      <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
        <?php foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
              <a class=" card text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
                <img
                src=uploads/<?= $product['image']; ?>
                class="img-fluid"
                style="width:240px; height:180px"
                alt="Product_Image"
                />
                <?php if ( isset( $_SESSION["user"] ) ) { ?>
                  <form action="wishlist/submit" method="post">
                    <input type="hidden" name="update_id" value="<?= $product['id']?>">
                    <input type="hidden" name="is_wishlist" value="<?= $product['is_wishlist'];?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                      <?php if($product['is_wishlist']==0) : ?>
                        <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                        <?php else : ?>
                          <i class="bi bi-heart-fill" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                          <?php endif ;?>
                        </button>
                      </form>
                  
                    <?php } ?>
                    <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                      <small class="card-title">
                        <?= $product['product_name']; ?>
                      </small>
                      <span class="card-text ">
                        <h5 style="color:#ed510e;">
                          RM <?= $product['product_price']; ?>
                        </h5>       
                      </span>
                    </div>
                    <div class="d-flex justify-content-center m-2 mb-3">
                      <button type="submit" class="btn btn-sm btn-warning"> 
                        BUY NOW 
                      </button>
                      
                      <form
                      method="POST"
                      action="/cart/add_to_cart"
                      >
                      <!-- product id will pass to the cart page -->
                      <input 
                      type="hidden"
                      name="product_id"
                      value="<?php echo $product['id']; ?>"
                      />
                      <button type="submit" class="btn btn-primary ms-2">ADD CART</button>
                    </form>
                    
                  </div>
                </a>
                </div>   
              <?php endforeach; ?>
            </div>
          </div>
        </section> 
<!-- All Product --> 
<!-- shuffle($products); -->
<!-- Daily Discover -->
<!-- 24 random 1 time -->
<section id="daily-discover">
<div class="container mx-auto mb-5 mt-5" style="max-width: 1400px;">
    <div class="d-flex">
      <h3>Daily Discover</h3> 
      <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
        <?php shuffle($products); foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
              <a class=" card text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
                <img
                src=uploads/<?= $product['image']; ?>
                class="img-fluid"
                style="width:240px; height:180px"
                alt="Product_Image"
                />
                <?php if ( isset( $_SESSION["user"] ) ) { ?>
                  <form action="wishlist/submit" method="post">
                    <input type="hidden" name="update_id" value="<?= $product['id']?>">
                    <input type="hidden" name="is_wishlist" value="<?= $product['is_wishlist'];?>">
                    <button type="submit" class="btn btn-link p-0 m-0">
                      <?php if($product['is_wishlist']==0) : ?>
                        <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                        <?php else : ?>
                          <i class="bi bi-heart-fill" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                          <?php endif ;?>
                        </button>
                      </form>
                  
                    <?php } ?>
                    <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                      <small class="card-title">
                        <?= $product['product_name']; ?>
                      </small>
                      <span class="card-text ">
                        <h5 style="color:#ed510e;">
                          RM <?= $product['product_price']; ?>
                        </h5>       
                      </span>
                    </div>
                    <div class="d-flex justify-content-center m-2 mb-3">
                      <button type="submit" class="btn btn-sm btn-warning"> 
                        BUY NOW 
                      </button>
                      
                      <form
                      method="POST"
                      action="/cart/add_to_cart"
                      >
                      <!-- product id will pass to the cart page -->
                      <input 
                      type="hidden"
                      name="product_id"
                      value="<?php echo $product['id']; ?>"
                      />
                      <button type="submit" class="btn btn-primary ms-2">ADD CART</button>
                    </form>
                    
                  </div>
                </a>
                </div>   
              <?php endforeach; ?>
            </div>
          </div>
        </section> 
 
<!-- Daily Discover -->
   
<?php
    require 'parts/footer.php';
