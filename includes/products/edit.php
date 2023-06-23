<?php
    
    if ( !isAdminOrEditor() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $original_image = $_POST['original_image'];
    // catch the image file
    $image = $_FILES['image'];
    // get image file name
    $image_name = $image['name'];

    // add image to the uploads folder
    if ( !empty( $image_name ) ) {
    // target the uploads folder
    $target_dir = "uploads/";
    // add the image name to the uploads folder
    $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
    // move the file to the uploads folder
    move_uploaded_file( $image["tmp_name"], $target_file );
    }

    if( empty( $product_name ) || empty( $product_description ) || empty( $product_price ) || empty( $category) || empty( $product_name ) || empty(  $id  )){
        $error = "Please enter fields";
    }

    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /manage-products-edit?id=$id");
        exit;
    }

    $sql = "UPDATE products SET product_name = :product_name, product_description = :product_description, product_price = :product_price, image = :image, category = :category, status = :status WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        'product_name' => $product_name,
        'product_description' => $product_description,
        'product_price' => $product_price,
        'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $original_image ) ? $original_image : null ) ),
        'category' => $category,
        'status' => $status,
        'id' => $id
    ]);
    
    $_SESSION["success"] = "Product are success edited.";
        header("Location: /manage-products");
        exit;
?>