<?php

    $database = connectToDB();

    $addtocart = $_POST["addtocart"];
    $noatcart = $_POST["noatcart"];

    if( $addtocart == 1 ) {
        $addtocart = 0;
    } else if ( $addtocart == 0 ) {
        $addtocart = 1;
    }


    if( empty( $noatcart ) ) {
        echo "error";
    } else {
        $sql = 'UPDATE products set addtocart = :addtocart WHERE id  = :id';
        
        $query = $database -> prepare( $sql );
    
        $query->execute([ 
            'id' => $noatcart,
            'addtocart' => $addtocart
        ]);
    
        // 3. redirect the user back to index.php
        header("Location: /");
        // exit;
    }