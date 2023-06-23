<?php

    if ( !isAdminOrEditor() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    // get all the users
    if( isAdmin() ) {
        $sql = "SELECT * FROM products";
        $query = $database->prepare( $sql );
        $query->execute();
    } else {
        $sql = "SELECT * FROM products WHERE products.user_id = :id";
        $query = $database->prepare( $sql );
        $query->execute([
            'id' => $_SESSION['user']['id']
        ]);
    }
    // fetch the data from query
    $products = $query->fetchAll();

    require "parts/header.php";

?>

<div class="mx-auto my-5" style="max-width: 95vw;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage products</h1>
        <div class="text-end">
            <a href="/manage-products-add" class="btn btn-primary btn-sm">
                Add New Product
            </a>
        </div>
    </div>
</div>
<section> 
    <div class="container">
        <?php require "parts/message_success.php"; ?>
        <div class="row mb-4">
            <?php foreach ($products as $product) { ?> 
                <div class="col-2 g-3">
                    <div class="card">
                        <?php if ( $product['image'] ) : ?>
                            <img src="uploads/<?= $product['image']; ?>" class="img-fluid" style="width:240px; height:180px" alt="Product_Image"/>
                        <?php endif ?>    
                            <span style="position: absolute; top: 12px; right: 8px; font-size: 0.8rem;" class="
                                <?php
                                    if($product["status"] == "draft"){
                                        echo "badge bg-warning";
                                    } else if($product['status'] == "publish"){
                                        echo "badge bg-success";
                                    }
                                ?>">
                                <?= $product['status']; ?>
                            </span>
                            <div class="container">
                                <div class="card-body text-start m-0 p-0 ps-2 pt-1">
                                    <small class="card-title"><?= $product['product_name']; ?></small>
                                    <span class="card-text">
                                        <h5 style="color:#ed510e;">RM 
                                            <?= $product['product_price']; ?>
                                        </h5>       
                                    </span>
                                    <div class="text-center mb-3">
                                        <div class="buttons">
                                            <a href="/manage-products-view" target="_blank" class="btn btn-primary btn-sm me-2">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="/manage-products-edit?id=<?= $product['id']; ?>" class="btn btn-secondary btn-sm me-2">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $product['id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <div class="modal fade" id="delete-modal-<?= $product['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this user: <?= $product['product_name']; ?>?</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body me-auto">
                                                            Are you sure you want to <?= $product['product_name']; ?>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form method= "POST" action="/products/delete">
                                                                <input type="hidden" name="id" value= "<?= $product['id']; ?>" />
                                                                <button type="submit" class="btn btn-danger">Yes, I am sure.</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } ?> 
        </div>
    </div>
</section>
<div class="text-center mb-5">
    <a href="/dashboard" class="btn btn-link btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div> 

<?php

    require "parts/footer.php";