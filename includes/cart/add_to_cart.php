<?php
    $database = connectToDB();

    // get the product id
    $product_id = $_POST['product_id'];

    $sql = "INSERT INTO cart ( `product_id`,`quantity`,`user_id` ) VALUES ( :product_id, :quantity, :user_id )";
    $query = $database->prepare( $sql );
    $query->execute([
       'product_id' => $product_id,
        'quantity' => 1,
        'user_id' => $_SESSION['user']['id']
    ]);

    // redirect to cart page
    header("Location: /add-to-cart");
    exit;
