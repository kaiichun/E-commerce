<?php

    $database = connectToDB();
    // instructions: if the form was submitted, add the product to the wishlist or remove it from the wishlist (if it's already in the wishlist)
    //get all the POST
    $product_id = $_POST['id'];
       
    
    if($_POST['is_wishlist']==0){
    $sql = "UPDATE products set `is_wishlist` =1 where id=:id'";
    }else{
        $sql = "UPDATE products set `is_wishlist` =0 where id=:id'"
    }
    
    $query = $database->prepare($sql);
    $query->execute([
       'id' => $product_id
    ]);
    header('Location:/');
        exit;