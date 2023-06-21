<?php

if ( !isAdmin() && !isEditor()) {
  header("Location: /");
  exit;
}
  $database = connectToDB();

  $sql = "SELECT * FROM products";
  $query = $database->prepare($sql);
  $query->execute();

  $products = $query->fetchAll();


$sql='SELECT comments . *,
users.email,
products.product_name
FROM comments
JOIN users
ON comments.user_id = users.id
JOIN products
ON comments.product_id = products.id';
$query=$database->prepare($sql);
$query->execute();
$comments = $query->fetchAll();

  require "parts/header.php";
  require "parts/navbar-home.php";

?>

<div class="mt-4 ms-2 text-start">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Go To Shopping</a
        >
      </div>

 <h1 class="h1 mt-2 mb-4 text-center">Dashboard</h1>

<div class="container mx-auto my-auto mb-5" style="max-width: 100vw;">  
  <div class="row col-12 mb-4">
        <div class="col-9">
        
              <div>
              <h5 class=" text-start mb-2">
                Comments
                </h5>
              <div class="overflow-scroll " style="height: 280px;">
      <?php
      foreach ($comments as $comment) :
      ?>
        <div class="card mt-2 <?php echo ( $comment["user_id"] === $_SESSION['user']['id'] ? "bg-none" : '' ); ?>">
          <div class="card-body">
            <h5>Prdouct Name: [ <?= $comment['product_name']?> ]</h5>
              <hr class="m-0">
                <p class="card-text mt-1"><?= $comment['comment']; ?></p>
                <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Commented By <?= $comment['email']; ?></small></p>
          </div> 
        </div>
    
  
      <?php endforeach; ?>
      </div>
              </div>
         
        </div>

        <div class="col-3">
         
              <div>
                <h5 class=" text-start">
                  Total Sales
                </h5>

          </div>
        </div>
</div>
</div>



<div class="container mx-auto my-auto" style="max-width: 100vw;">  
     <div class="row col-12">
        <div class="col-3">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-basket" style="font-size: 3rem;"></i>
                </div>
                Manage Order
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-order" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>


        <div class="col-3">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-chat-dots" style="font-size: 3rem;"></i>
                </div>
               Manage Comment
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-comment" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="col-3">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-boxes" style="font-size: 3rem;"></i>
                </div>
                Manage Products
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-products" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>

        <?php if ( isAdmin() ) : ?>
        <div class="col-3">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                </div>
                Manage Users
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-users" class="btn btn-primary btn-sm"
                  >Access</a
                >
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
     
    </div>

<?php

  require "parts/footer.php"

?>
