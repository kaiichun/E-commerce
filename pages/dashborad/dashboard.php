<?php

  if ( !isAdmin() && !isEditor() ) {
    header("Location: /");
    exit;
  }

  $database = connectToDB();

  $sql = "SELECT * FROM products";
  $query = $database->prepare( $sql );
  $query->execute();
  $products = $query->fetchAll();

  $sql = 'SELECT comments . *,
  users.email,
  products.product_name
  FROM comments
  JOIN users
  ON comments.user_id = users.id
  JOIN products
  WHERE comments.product_id = products.id ORDER BY id DESC';
  $query=$database->prepare($sql);
  $query->execute();
  $comments = $query->fetchAll();

  require "parts/header.php";
  require "parts/navbar.php";

?>

<h1 class="h1 mt-5 mb-4 text-center">Dashboard</h1>
<div class="container mx-auto my-auto" style="max-width: 50vw;">  
  <div class="row col-12">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title text-center">
            <div class="mb-1">
              <i class="bi bi-chat-dots" style="font-size: 3rem;"></i>
            </div>
            Manage Comment
          </h5>
          <div class="text-center mt-3">
            <a href="/manage-comment" class="btn btn-primary btn-sm">
              Access
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title text-center">
            <div class="mb-1">
              <i class="bi bi-boxes" style="font-size: 3rem;"></i>
            </div>
            Manage Products
          </h5>
          <div class="text-center mt-3">
            <a href="/manage-products" class="btn btn-primary btn-sm">
              Access
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php if ( isAdmin() ) : ?>
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title text-center">
              <div class="mb-1">
                <i class="bi bi-people" style="font-size: 3rem;"></i>
              </div>
              Manage Users
            </h5>
            <div class="text-center mt-3">
              <a href="/manage-users" class="btn btn-primary btn-sm">
                Access
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="mt-3 ms-2 mb-5 text-start">
    <a href="/" class="btn btn-link btn-sm">
      <i class="bi bi-arrow-left"></i> Go To Shopping
    </a>
  </div>
</div>


<?php

  require "parts/footer.php";

