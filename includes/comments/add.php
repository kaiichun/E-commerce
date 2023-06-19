<?php

if ( !isAdminOrEditor()) {
    header("Location: /");
    exit;
}

$database = connectToDB();

        $comments = $_POST['comments'];
        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];
    
        // do error checking
        if ( empty( $comments ) || empty( $product_id ) || empty( $user_id ) ) {
            $error = "Please fill out the comment";
        }
        
        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /productt?id=$productt_id" ); 
            exit;
        }
    
        // insert the comment into database
        $database->insert(
        "INSERT INTO comments (`comments`, `product_id`, `user_id`)
        VALUES(:comments, :product_id, :user_id)",
        [
            'comments' => $comments,
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);
        
        header("Location: /products?id=$product_id" );
        exit;