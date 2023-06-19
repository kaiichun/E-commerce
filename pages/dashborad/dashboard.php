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

  require "parts/header.php";
?>
 <h1 class="h1 mt-5 mb-4 text-center">Dashboard</h1>

<div class="container mx-auto my-auto" style="max-width: 100vw;">  
  <div class="row col-12 mb-4">
        <div class="col-9">
        
              <div>
              <h5 class="text-start">
                Comments
              </h5>
             
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
                <a href="/manage-products" class="btn btn-primary btn-sm"
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
      <div class="mt-4 text-center">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

<?php

  require "parts/footer.php"

?>
