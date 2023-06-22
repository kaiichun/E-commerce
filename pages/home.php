<?php
  $database = connectToDB();
  
  $sql = "SELECT * FROM products WHERE status = 'publish' ORDER BY id DESC LIMIT 12";
  $query = $database->prepare($sql);
  $query->execute();
  $products = $query->fetchAll();

  
  
  
  require "parts/header.php";
  require "parts/navbar.php";
?>

<!-- banner -->
<section id="banner" class="">
  <!-- post control -->
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="6000">
      <img src="./asstes/Banner-1.gif" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="800">
      <img src="./asstes/Banner-2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="800">
      <img src="./asstes/Banner-3.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
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
    <span class="text-secondary">New Product is lucnh now</span>
    <div class="row">
        <?php foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
              <a class=" card text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
              <img
                src="uploads/<?= $product['image']; ?>"
                    class="img-fluid"
                style="width:240px; height:180px"
                alt="Product_Image"
                />
                    <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                      <small class="card-title">
                        <?= $product['product_name']; ?>
                      </small>
                      <span class="card-text  mb-2">
                        <h4 style="color:#ed510e;">
                          RM <?= $product['product_price']; ?>
                        </h4>       
                      </span>
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
<div class="container mx-auto mt-5 mb-5" style="max-width: 1400px;">
    <div class="d-flex">
      <h3>Daily Discover</h3> 
      <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <span class="text-secondary">Think you will like this</span>
    <div class="row">
        <?php shuffle($products); foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
              <a class=" card text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
              <img
                src="uploads/<?= $product['image']; ?>"
                    class="img-fluid"
                style="width:240px; height:180px"
                alt="Product_Image"
                />
                    <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                      <small class="card-title">
                        <?= $product['product_name']; ?>
                      </small>
                      <span class="card-text  mb-2">
                        <h4 style="color:#ed510e;">
                          RM <?= $product['product_price']; ?>
                        </h4>       
                      </span>
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
