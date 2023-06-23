<?php

  $database = connectToDB();

  $sql = "SELECT * FROM products WHERE status = 'publish' ORDER BY id DESC";
  $query = $database->prepare( $sql );
  $query->execute();
  $products = $query->fetchAll();
  
  require "parts/header.php";
  require "parts/navbar.php";
  require "parts/category.php";


?>

<div class="container mx-auto mb-5 mt-5" style="max-width: 1400px;">
  <section id="allproduct">
    <div class="container mx-auto mb-5 mt-5" style="max-width: 1400px;">
      <div class="d-flex">
        <h3>All Product</h3> 
      </div>
      <div class="row">
        <?php foreach( $products as $product ) : ?>
          <div class="col-2 g-3 ">
            <a class=" card text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
              <img src="uploads/<?= $product['image']; ?>" class="img-fluid" style="width:240px; height:180px" alt="Product_Image"/>
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
</div>

<?php
  
  require "parts/footer.php";