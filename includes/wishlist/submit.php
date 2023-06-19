<?php

    $database = connectToDB();

    $is_wishlist = $_POST["is_wishlist"];
    $update_id = $_POST["update_id"];

    if($is_wishlist == 1){
        $is_wishlist = 0;
    } else if ($is_wishlist == 0){
        $is_wishlist = 1;
    }


    if (empty($update_id)){
        echo "error";
    } else {
        $sql = 'UPDATE products set is_wishlist = :is_wishlist WHERE id  = :id';
        
        $query = $database -> prepare( $sql );
    
        $query->execute([ 
            'id' => $update_id,
            'is_wishlist' => $is_wishlist
        ]);
    
        // 3. redirect the user back to index.php
        header("Location: /");
        exit;
    }
