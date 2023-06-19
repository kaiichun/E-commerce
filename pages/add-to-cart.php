<?php
$database = connectToDB();


// get all the users
$sql = "SELECT * FROM products";
$query = $database->prepare($sql);
$query->execute();

// fetch the data from query
$products = $query->fetchAll();

    require "parts/header.php";
?>
    <div class="container-fluid mx-auto mb-3 mt-4" style="max-width: 98vw;">
            <h1 class="h1">Cart</h1>
    </div>
        
<!--  -->
<div class="container-fluid mx-auto mb-3" style="max-width: 98vw;">
    <?php require "parts/message_success.php"; ?>
        <div class="row">
            <div class="col-12 ">
               
                        <table class="table">
                            <thead>
                                <tr class="col-12">
                                    <th scope="col" style="width: 5%;"></th>
                                    <th scope="col" style="width: 30%;">Product Name</th>
                                    <th scope="col" style="width: 20%;">Quantity</th>
                                    <th scope="col"style="width: 13%;">Price</th>
                                    <th scope="col" style="width: 5%;"></th>
                                    

                                </tr>
                            </thead>
                        <tbody>
                        <!-- display out all the users using foreach -->
                        <?php foreach ($products as $product)  { ?>
                            <?php if($product["addtocart"] == "1") :?>
                               
                                <th scope="row">
                    <button class="btn btn-sm btn-success"><i class="bi bi-check-square"></i></button><span class="ms-2 text-decoration-line-through"></span>
                   
                                </th>
                                <td>
<?= $product['product_name']; ?>
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                     <span>RM
                                        <?= $product['product_price']; ?>
                                </td>
                               
                               
                                <td class="text-end">
                                    
                                   

                                            <form action="addtocart/submit" method="post">
                        <input type="hidden" name="noatcart" value="<?= $product['id']?>">
                        <input type="hidden" name="addtocart" value="<?= $product['addtocart'];?>">
                          <button type="submit" class="btn btn-link p-0 m-0">
                            <?php if($product['addtocart']==1) : ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $product['id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                            <?php else : ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $product['id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                            <?php endif ;?>
                          </button>
                      </form>

                                    
                            </td>
                        </tr>
                        <?php endif ;?>
                    <?php } ?>
                    </tbody>
                </table>
             
             </div>
        </div>
    </div>

    </div>
        <div class="text-start mb-3 ms-2">
            <a href="/products" class="btn btn-link btn-sm">
                <i class="bi bi-arrow-left"></i> 
                    Go back to shopping
            </a>
        </div>

<?php
    require "parts/footer.php";