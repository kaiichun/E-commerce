<?php
    if ( !isAdminOrEditor()) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();
    

    // $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category = $_POST['category'];
    $status = $_POST['status'];
 
    if( empty( $product_name ) || empty( $product_description ) || empty( $product_price ) || empty( $category) || empty( $product_name )){
        $error = "Please enter all fields";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-products-add");
    }else{
        $sql = "INSERT INTO products ( `product_name`, `product_description`,`product_price`,`category`,`status`,`user_id`)
        VALUES(:product_name, :product_description, :product_price, :category, :status, :user_id)";
        $query = $database->prepare( $sql );
        $query->execute([
            // 'product_image' => $product_image,
            'product_name' => $product_name,
            'product_description' => $product_description,
            'product_price' => $product_price,
            'category' => $category,
            'status' => $status,
            'user_id' => $_SESSION["user"]["id"]
        ]);
        
        $_SESSION["success"] = "New product are added";
        header("Location: /manage-products");
        exit;
    }

?>