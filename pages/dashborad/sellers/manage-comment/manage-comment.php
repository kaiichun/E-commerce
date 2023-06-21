<?php
   if ( !isAdminOrEditor()) {
    header("Location: /");
    exit;
}

$database = connectToDB();

$sql='SELECT comments . *,
users.email,
products.product_name
FROM comments
JOIN users
ON comments.user_id = users.id
JOIN products
ON comments.product_id = products.id';
$query=$database->prepare($sql);
$query->execute();
$comments = $query->fetchAll();

require "parts/header.php";
require "parts/navbar-home.php";

?>

<div class="mt-3">
    <div class="container">
            <h3 class="mb-3">Comments </h3>
            
                <?php
                foreach ($comments as $comment) :
                ?>
            <div class="card mt-2 <?php echo ( $comment["user_id"] === $_SESSION['user']['id'] ? "bg-none" : '' ); ?>">
                <div class="card-body">
                    <h5>Prdouct Name: [ <?= $comment['product_name']?> ]</h5>
                    <hr class="m-0">
                    <p class="card-text mt-1"><?= $comment['comment']; ?></p>
                    <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Commented By <?= $comment['email']; ?></small></p>
             </div>  </div>
             <div class="mb-5"> 
                <form
                action="/comments/delete"
                method="POST"    
                >
                <input type="hidden" name="id" value="<?= $comment['id']; ?>" />
                <button type="submit" class="btn btn-sm btn-danger mt-2">Delete</button>
            </form>
            
    </div>
                    
            
            <?php endforeach; ?>

            <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        </div>

        </div>