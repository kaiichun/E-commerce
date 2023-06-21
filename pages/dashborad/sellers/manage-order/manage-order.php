<?php
  
    $database = connectToDB();
    if ( isAdmin()){
    $sql = "SELECT
    cart.*,
    users.firstname AS user_firstname,
    users.email AS user_email,
    products.product_name,
    products.product_price
    FROM cart
    JOIN users
    ON cart.user_id = users.id
    JOIN products
    ON cart.product_id = products.id";
    $query = $database->prepare($sql);
    $query->execute();
  }else if( isEditor() ){
    $sql = "SELECT
    cart.*,
    users.firstname AS user_firstname,
    users.email AS user_email,
    products.product_name,
    products.product_price
    FROM cart
    JOIN users
    ON cart.user_id = users.id
    JOIN products
    ON cart.product_id = products.id";
    $query = $database->prepare($sql);
    $query->execute([
      'user_id' => $_SESSION["user"]["id"]
    ]);
  }
  $products_in_cart = $query->fetchAll();
  $total_in_cart = 0;
  require "parts/header.php";
  require "parts/navbar-home.php";


?>
<div class="row">
<div class="col-6">
    <?php if(isAdminOrEditor()) :?>
      <div class="container mx-auto my-5" style="max-width: 1000px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h1 class="h1">Cart Form</h1>
        </div>
        <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col" style="width: 20%;">Title</th>
                <th scope="col">Amount</th>
                <th scope="col">Consumer</th>
                <th scope="col">product_price</th>
                <th scope="col">Time</th>
                <th scope="col" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products_in_cart as $cart): ?>
              <tr>
                <?php if($cart['order_id'] === NULL) :?>
                <th scope="row"><?= $cart['id']; ?></th>
                <td>
                  <?php
                    $excerpt = str_split($cart['product_name'],11);
                    if(strlen($excerpt[0])<11){
                      echo $excerpt[0];
                    }else{
                      echo $excerpt[0]."...";
                    }
                  ?>
                </td>
                <td><?= $cart["quantity"]; ?></td>
                <td><?= $cart['user_firstname']; ?><br/><?= $cart['user_email']; ?></td>
                <td>RM<?= $cart["product_price"] * $cart["quantity"] ;?></td>
                <td><?= $cart["added_on"]; ?></td>
                <td>
                  <form
                      method="POST"
                      action="/cart/delete"
                      >
                      <input
                          type="hidden"
                          name="cart_id"
                          value="<?= $cart['id']; ?>"
                          />
                      <button type="submit" class="btn btn-danger btn-sm">
                          <i class="bi bi-trash"></i>
                      </button>
                  </form>
                </td>
                <?php endif ;?>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php else :?>
      <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
            <div class="min-vh-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h1">My Cart</h1>
                </div>
                <!-- List of products user added to cart -->
                <table class="table table-hover table-bordered table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">product_price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- if no products in the cart -->
                    <?php if ( empty( $products_in_cart ) ) : ?>
                        <tr>
                            <td colspan="5">Your cart is empty.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach( $products_in_cart as $product ) :
                            // get the total product_price of the product
                            $product_total =  $product['product_price'] * $product['quantity'];
                            // add the total product_price to the total in cart
                            $total_in_cart += $product_total;
                            ?>
                            <tr>
                                <td><?= $product['product_name']; ?></td>
                                <td>RM<?= $product['product_price']; ?></td>
                                <td><?= $product['quantity']; ?></td>
                                <td>RM<?= $product_total; ?></td>
                                <td>
                                    <form
                                        method="POST"
                                        action="/cart/delete"
                                        >
                                        <input
                                            type="hidden"
                                            name="cart_id"
                                            value="<?= $product['id']; ?>"
                                            />
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td>RM<?= $total_in_cart; ?></td>
                            <td></td>
                        </tr>
                    <?php endif;?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center my-3">
                    <a href="/" class="btn btn-light btn-sm">Continue Shopping</a>
                    <!-- if there is product in cart, then only display the checkout button -->
                    <?php if ( !empty( $products_in_cart ) ) : ?>
                        <form
                            method="POST"
                            action="/cart/checkout"
                            >
                            <input type="hidden" name="total_amount" value="<?= $total_in_cart; ?>" />
                            <button type="submit" class="btn btn-primary">Checkout</a>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif ;?>
</div>
<div class="col-6">
<?php

  $database = connectToDB();
  if ( isAdmin()){
    $sql = "SELECT
    orders.*,
    users.firstname AS user_firstname,
    users.email AS user_email
    FROM orders
    JOIN users
    ON orders.user_id = users.id";
    $query = $database->prepare($sql);
    $query->execute();

  }else if( isEditor() ){
    $sql = "SELECT
    cart.*,
    users.firstname AS user_firstname,
    users.email AS user_email,
    orders.total_amount
    FROM cart
    JOIN users
    ON cart.user_id = users.id
    JOIN products
    ON cart.product_id = products.id
    JOIN orders
    ON cart.order_id = orders.id";
    $query = $database->prepare($sql);
    $query->execute([
      'user_id' => $_SESSION["user"]["id"]
    ]);
  }
  $orders = $query->fetchAll();
  require "parts/header.php";
?>
  <?php if(isAdmin()) :?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Order Form</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 30%;">Consumer</th>
              <th scope="col">Total</th>
              <th scope="col">Time</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order): ?>
              <tr>
                <th scope="row"><?= $order['id']; ?></th>
                <td><?= $order['user_firstname']; ?><br/><?= $order['user_email']; ?></td>
                <td>RM<?= $order["total_amount"]; ?></td>
                <td><?= $order["added_on"]; ?></td>
                
                
                  
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php elseif(isEditor()) :?>
    <div class="container mx-auto my-5" style="max-width: 1000px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Order Form</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
            <th scope="col">ID</th>
              <th scope="col" style="width: 20%;">Title</th>
              <th scope="col">Amount</th>
              <th scope="col">Consumer</th>
              <th scope="col">Price</th>
              <th scope="col">Time</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order): ?>
            <tr>
              <th scope="row"><?= $order['id']; ?></th>
              <td>
                <?php
                  $excerpt = str_split($order['title'],11);
                  if(strlen($excerpt[0])<11){
                    echo $excerpt[0];
                  }else{
                    echo $excerpt[0]."...";
                  }
                ?>
              </td>
              <td><?= $order['quantity']; ?></td>
              <td><?= $order['user_name']; ?><br/><?= $order['user_email']; ?></td>
              <td>RM<?= $order['price'] * $order['quantity'] ?></td>
              <td><?= $order["added_on"]; ?></td>
              <td>
                <form method="POST" action="/orders/delete-product">
                  <input
                      type="hidden"
                      name="cart_id"
                      value="<?= $order['id']; ?>"
                      />
                  <input type="hidden" name="price" value="<?= $order['price'] * $order['quantity'] ?>">
                  <input type="hidden" name="total_amount" value="<?= $order['total_amount']?>">
                  <input type="hidden" name="order_id" value="<?= $order['order_id']?>">
                  <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php else :?>
      <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
      <div class="min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h1">My Orders</h1>
        </div>
        <!-- List of orders placed by user in table format -->
        <table
          class="table table-hover table-bordered table-striped table-light"
        >
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">Date</th>
              <th scope="col">Products</th>
              <th scope="col">Total Amount</th>
            </tr>
          </thead>
          <tbody>
          <?php if ( isset( $orders ) ) : ?>
            <?php foreach( $orders as $order ) : ?>
                <tr>
                <th scope="row"><?= $order['id']; ?></th>
                <td><?= $order['added_on']; ?></td>
                <td>
                    <ul class="list-unstyled">
                    <?php
                        $sql = "SELECT
                        carts.*,
                        products.title,
                        products.price
                        FROM carts
                        JOIN products
                        ON carts.product_id = products.id
                        WHERE order_id = :order_id";
                        $query = $database->prepare($sql);
                        $query->execute([
                            'order_id' => $order['id']
                        ]);
                        $products_in_cart = $query->fetchAll();
                        foreach( $products_in_cart as $product ) {
                            echo "<li>{$product['title']} ({$product['quantity']})</li>";
                        }
                    ?>
                    </ul>
                </td>
                <td>RM<?= $order['total_amount']; ?></td>
                </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="4">You have not placed any orders.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center my-3">
          <a href="/" class="btn btn-light btn-sm"
            >Continue Shopping</a
          >
        </div>
      </div>
    </div>
  <?php endif ;?>
    
</div>
</div><div class="text-center">
      <a href="/dashboard" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
      >
    </div>
<?php
  require "parts/footer.php";
                    