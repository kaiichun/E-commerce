<?php
  // load data from database
  $database = connectToDB();

 // ASC - acens
 $sql = "SELECT * FROM products WHERE status = 'publish' ORDER BY id ASC";
  $query = $database->prepare($sql);
  $query->execute();
  // fetch the data from query
  $products = $query->fetchAll();
  
  require "parts/header.php";
  require "parts/navbar-category.php";

?>


<ul class="nav mt-3 mb-4 justify-content-end">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/products">All Products</a>
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
        <div class="container mx-auto mb-5 mt-5" style="max-width: 1400px;">

<section id="other">
    <div class="d-flex">
      <h3>Other</h3> 
    </div>
    <div class="row">
        <?php foreach( $products as $product ) : ?>
          <?php if($product ["category"] == "other") { ?>
            <div class="col-2 g-3 ">
              <img
                src="/uploads/<?= $product['image']; ?>"
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
          <?php } ?> 
        <?php endforeach; ?>
    </div>
  </div>
</section> 


<?php
    require "parts/footer.php";