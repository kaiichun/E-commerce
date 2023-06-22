<?php

  if ( isset( $_GET['id'])){  
    $database = connectToDB();

    $sql = "SELECT * FROM products WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $_GET['id']
    ]);

    $product = $query->fetch();



    $sql = "SELECT * FROM users WHERE id = :id";
        
      $query = $database->prepare($sql);
      $query->execute([
        'id' => $product['user_id']
      ]);
      $owner = $query->fetch();

    }


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
                        <h4 class="mb-2" style="color:#ed510e;"> 
                            RM<?= $product['product_price']; ?>
                        </h4>
                        <h6 class="nav-link d-flex text-secondary" href="/profile" >Onwer by
                       
                       
                            <?= $owner['firstname'];?>
                        
</h6>
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
                <div class="d-flex justify-content-center mt-5 g-4">
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
                      <button type="submit" class="btn btn-fu btn-primary ms-2">ADD CART</button>
                    </form>
                  </div>
            </div>
        </div>

<div class=" mx-auto">
          

    <div class="d-flex mt-5 mb-3"><h4>Comments</h4>  
    <?php
        $sql = "SELECT
        comments.*,
        users.email
        FROM comments
        JOIN users
        ON comments.user_id = users.id
        WHERE product_id = :product_id ORDER BY id DESC";
      $query = $database->prepare($sql);
      $query->execute([
        "product_id" => $product["id"]
      ]);
      $comments = $query->fetchAll();
?>    
  

     </div> 
     <div class="overflow-scroll" style="height: 300px;">
            <?php
            foreach($comments as $comment): ?> 
               
                    
              <div class="m-0" style="width: 500px;">
               
                    <small class="text-secondary">
                  <?= $comment['email']; ?>  
            </small>
            
                </div>
                  
                    <p><?= $comment['comment']; ?></p>
                    <hr class="m-0">
                    
            
            <?php endforeach; ?>
          </div>
        
        </div>
      </div>
    </div>
</div>
<div class="container mb-5">
    <?php if ( isUserLoggedIn() ) : ?>
          <?php require "parts/message_error.php"; ?>
            <form
                action="/comments/add"
                method="POST"
                >
                <div class="mt-3">
                    <label for="comments" class="form-label">Enter your comment below:</label>
                    <textarea class="form-control" id="comments" rows="3" name="comments"></textarea>
                </div>
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>" />
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>" />
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
          <?php endif; ?>
    </div>
<?php

require "parts/footer.php";