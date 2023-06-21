<?php


if ( !isUserLoggedIn() ) {
    header("Location: /");
    exit;
}

$database = connectToDB();

// get all the POST data
$product_id = $_POST['product_id'];
$price = $_POST['product_price'];


// do error checking
if ( empty( $product_id ) || empty( $price )) {
    $error = "ERROR";
}

if( isset ($error)){
    $_SESSION['error'] = $error;
    header("Location: /products-view?id=$product_id" ); 
    exit;
}

$sql = "INSERT INTO orders (`user_id`, `total_amount`)
VALUES(:user_id, :total_amount)";
$query = $database->prepare($sql);
$query->execute([
    'user_id' => $_SESSION['user']['id'],
    'total_amount' => $price

]);

$sql = "INSERT INTO cart (`product_id`,`quantity`,`user_id`) VALUES (:product_id, :quantity, :user_id)";
$query = $database->prepare( $sql );
$query->execute([
    'product_id' => $product_id,
    'quantity' => 1,
    'user_id' => $_SESSION['user']['id']
]);



$order_id = $database->lastInsertId();

// $sql = "SELECT * FROM cart WHERE user_id = :user_id AND order_id IS NULL";
// $query = $database->prepare($sql);
// $query->execute([
//     'user_id' => $_SESSION['user']['id']
// ]);
// $products_in_cart = $query->fetchAll();

// foreach( $products_in_cart as $cart ) {
// $sql = "UPDATE cart SET order_id = :order_id WHERE id = :id";
// $query = $database->prepare($sql);
// $query->execute([
//     'order_id' => $order_id,
//     'id' => $cart['id']
// ]);
// }

$_SESSION["success"] = "The product has been added to the order.";
header("Location: /order-history" );
exit;