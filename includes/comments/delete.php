<?php
    if ( !isAdminOrEditor()) {
        header("Location: /");
        exit;
    }
 
    $database = connectToDB();

    $id = $_POST["id"];
    
    if(empty($id)){
        $error = "ERROR!";
    }
    if(isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-comment");
        exit;
    }
    $sql = "DELETE FROM comments WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    $_SESSION["success"] = "The comment has been deleted.";
    header("Location: /manage-comment");
    exit;