<?php

if ( !isAdminOrEditor()) {
    header("Location: /");
    exit;
}
// load data from database
$database = connectToDB();

// get all the users
$sql = "SELECT * FROM products";
$query = $database->prepare($sql);
$query->execute();

// fetch the data from query
$product = $query->fetch();

    require "parts/header.php";
    require "parts/navbar-home.php";

?>

<div class="container mx-auto my-5" style="max-width: 85vw;">
    <h1 class="mb-4">
        View Product
    </h1>
    <div class="row col-12">
            <div class="col-6">
                <img
                    src="uploads/<?= $product['image']; ?>"
                    class="img-fluid"
                    style="width:40vw; height:40vw"
                    alt="Product_img"
                    />
            </div>
            <div class="col-6" style="width:40vw; height:40vw">
                <div class="d-flex flex-column justify-content-between card-body m-1" style="height:32vw">
                    <div class="card-text mb-4">
                        <h1 style="font-size:3.5rem"> 
                            <?= $product['product_name']; ?> 
                        </h1>
                        <h4 class="mb-4" style="color:#ed510e;"> 
                            RM<?= $product['product_price']; ?>
                        </h4>
                        <div class="">
                            <hr>
                        </div>
                        <h6>
                            Description
                        </h6>
                        <small class="container">
                            <?php $excerpt = str_split( $product['product_description'], 200 );
                                echo $excerpt[0];
                            ?>
                        </small>   
                    </div>
                </div>
                <div class=" m-0 d-flex flex-column" style="">
                    <button type="submit" class="btn mb-2 btn-lg btn-warning">
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
                      <button type="submit" class="btn mb-2 btn-lg btn-fu btn-primary">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-start mt-3 mb-4">
            <a href="/manage-products" class="btn btn-link btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
</div>

<?php

require "parts/footer.php";