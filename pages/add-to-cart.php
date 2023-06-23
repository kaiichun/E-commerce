<?php

    $database = connectToDB();

    // get the cart from the database based on the current logged in user
    $sql = "SELECT cart.*,
            products.product_name,
            products.product_price 
            FROM cart
            JOIN products
            ON cart.product_id = products.id
            WHERE cart.user_id = :user_id AND order_id IS NULL";
    $query = $database->prepare($sql);
    $query->execute([
        'user_id' => $_SESSION['user']['id']
    ]);
    $products_in_cart = $query->fetchAll();
    $total_in_cart = 0;

    require 'parts/header.php';
    require "parts/navbar.php";

?>

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
                    <th scope="col">Price</th>
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
                        <td><?php echo $product['product_name']; ?></td>
                        <td>$<?php echo $product['product_price']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td>$<?php echo $product_total; ?></td>
                        <td>
                            <form method="POST" action="/cart/remove_from_cart">
                                <input type="hidden" name="cart_id" value="<?php echo $product['id']; ?>"/>
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-end">Total</td>
                        <td>RM<?php echo $total_in_cart; ?></td>
                        <td></td>
                    </tr>
                <?php endif; // end - empty( $products_in_cart ) ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center my-3">
            <a href="/" class="btn btn-light btn-sm">Continue Shopping</a>
            <!-- if there is product in cart, then only display the checkout button -->
            <?php if ( !empty( $products_in_cart ) ) : ?>
                <form method="POST" action="/cart/checkout">
                    <input type="hidden" name="total_amount" value="<?php echo $total_in_cart; ?>" />
                    <button type="submit" class="btn btn-primary">Checkout</a>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php

    require "parts/footer.php";