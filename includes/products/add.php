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

//     $product_image = $_FILES['product_image'];
//     // get image file name
//    $image_name = $product_image['product_name'];
  
//    if ( !empty( $image_name ) ) {
//    // target the uploads folder
//    $target_dir = "uploads/";
//    // add the image name to the uploads folder
//    $target_file = $target_dir . basename( $image_name );
//    // move the file to the uploads folder
//    move_uploaded_file( $image["tmp_product_image"], $target_file );
//    }
    // catch the image file
    $image = $_FILES['image'];
    // get image file name
    $image_name = $image['name'];

// add image to the uploads folder
if ( !empty( $image_name ) ) {
    // target the uploads folder
    $target_dir = "uploads/";
    // add the image name to the s folder
    $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
    // move the file to the uploads folder
    move_uploaded_file( $image["tmp_name"], $target_file );
}


 
    if( empty( $product_name ) || empty( $product_description ) || empty( $product_price ) || empty( $category) || empty( $product_name )){
        $error = "Please enter all fields";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-products-add");
    }else{
        $sql = "INSERT INTO products ( `product_name`, `product_description`,`product_price`,`image`,`category`,`status`,`user_id`)
        VALUES(:product_name, :product_description, :product_price, :image, :category, :status, :user_id)";
        $query = $database->prepare( $sql );
        $query->execute([
            // 'product_image' => $product_image,
            'product_name' => $product_name,
            'product_description' => $product_description,
            'product_price' => $product_price,
            'image' => ( !empty( $image_name ) ? $image_name : null ), 
            'category' => $category,
            'status' => $status,
            'user_id' => $_SESSION["user"]["id"]
        ]);
        
        $_SESSION["success"] = "New product are added";
        header("Location: /manage-products");
        exit;
    }

?>