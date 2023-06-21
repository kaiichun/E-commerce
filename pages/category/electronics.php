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
  require "parts/navbar.php";

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

<section id="electronics">
    <div class="d-flex">
      <h3>Eelectronics</h3> 
      <a class="ms-auto text-decoration-none p-2" role="button" href="/products" style="font-size: 1rem;">see all<i class="bi bi-arrow-right-short"></i></a>
    </div>
    <div class="row">
        <?php foreach( $products as $product ) : ?>
          <?php if($product ["category"] == "electronics") { ?>
          <div class="col-2 g-3 ">
            <a class="card h-80 text-decoration-none" href="/products-view?id=<?=$product['id']?>" type="button">
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
                <?php } else { ?>
                  <a href="/login">
                    <i class="bi bi-heart" style="position: absolute; top: 10px; right: 10px; font-size: 1.3rem; color: #f00;"></i>
                  </a>
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
                  <div class="d-flex justify-content-center m-2 mb-3 ">
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
          <?php } ?> 
        <?php endforeach; ?>
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