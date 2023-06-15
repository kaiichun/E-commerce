<?php
     if ( !isAdminOrEditor()) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $id = $_POST["id"];

    if(empty($id)){
        $error = "Error 404";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-products");
        exit;
    }

    $sql = "DELETE FROM products WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    $_SESSION["success"]="Product was deleted";

    header("Location: /manage-products");
    exit;
?>