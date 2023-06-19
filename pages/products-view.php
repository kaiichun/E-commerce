<?php

    $database = connectToDB();

    $sql = "SELECT * FROM products";
    $query = $database->prepare($sql);
    $query->execute();

    $product = $query->fetch();

    require "parts/header.php";
    require "parts/navbar.php";

?>

<div class="container mx-auto my-5" style="max-width: 85vw;">
    <h4 class="mb-5">
        <a href="/" class="text-decoration-none text-dark">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </h4>
        <div class="row col-12">
            <div class="col-6">
                <img
                    src=<?=  $product['product_image']; ?>
                    class="card-img-top img-fluid"
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
                <div class="d-flex justify-content-center m-4 mb-3 g-4">
                    <button type="submit" class="btn btn-lg btn-warning"> 
                      BUY NOW 
                    </button>
                      <form action="addtocart/submit" method="post">
                        <input type="hidden" name="noatcart" value="<?= $product['id']?>">
                        <input type="hidden" name="addtocart" value="<?= $product['addtocart'];?>">
                          <button type="submit" class="btn btn-link p-0 m-0">
                            <?php if($product['addtocart']==0) : ?>
                              <button type="submit" class="btn-fu btn btn-lg btn-light"> ADD CART </button>
                            <?php else : ?>
                              <button type="submit" class="btn-fu btn btn-lg btn-light"> <i class="bi bi-x-lg"></i> REMOVE  </button>
                            <?php endif ;?>
                          </button>
                      </form>
                  </div>
            </div>
        </div>
</div>

<?php

require "parts/footer.php";