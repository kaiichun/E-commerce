<?php
     if ( !isAdminOrEditor()) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $id =$_POST['id'];

    if( empty( $product_name ) || empty( $product_description ) || empty( $product_price ) || empty( $category) || empty( $product_name )){
        $error = "Please enter fields";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-products-edit?id=$id");
        exit;
    }

    $sql = "UPDATE products SET product_name = :product_name, product_description = :product_description, product_price = :product_price, category = :category, status = :status WHERE user_id = :user_id";
    $query = $database->prepare($sql);
    $query->execute([
        'product_name' => $product_name,
        'product_description' => $product_description,
        'product_price' => $product_price,
        'category' => $category,
        'status' => $status,
        'user_id' => $_SESSION["user"]["id"]
    ]);
    
    $_SESSION["success"] = "Product are success edited.";
        header("Location: /manage-products");
        exit;
?>