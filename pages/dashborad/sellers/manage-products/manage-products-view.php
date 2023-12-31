<?php

    if ( !isAdminOrEditor() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    // get all the users
    $sql = "SELECT * FROM products";
    $query = $database->prepare( $sql );
    $query->execute();
    // fetch the data from query
    $product = $query->fetch();

    require "parts/header.php";

?>

<div class="container mx-auto my-5" style="max-width: 85vw;">
    <h1 class="mb-4">View Product</h1>
    <div class="row col-12">
        <div class="col-6">
            <img src="uploads/<?= $product['image']; ?>" class="img-fluid" style="width:40vw; height:40vw" alt="Product_img"/>
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
                    <div>
                        <hr>
                    </div>
                    <h6>
                        Description
                    </h6>
                    <small class="container">
                        <?php $excerpt = str_split( $product['product_description'], 200 ); echo $excerpt[0]; ?>
                    </small>   
                </div>
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