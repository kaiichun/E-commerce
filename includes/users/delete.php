<?php
     if ( !isAdmin() ) {
        // if current user is not an admin, redirect to dashboard
        header("Location: /dashboard");
        exit;
    }
    $database = connectToDB();

    $id = $_POST["id"];

    if(empty($id)){
        $error = "Error 404";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-users");
        exit;
    }

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    $_SESSION["success"]="User was deleted";

    header("Location: /manage-users");
    exit;
?>