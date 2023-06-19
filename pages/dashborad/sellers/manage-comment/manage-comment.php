<?php
   if ( !isAdminOrEditor()) {
    header("Location: /");
    exit;
}

$database = connectToDB();

$sql='SELECT comments . *,
users.email
FROM comments
JOIN users
ON comments.user_id = users.id
WHERE product_id = :product_id ORDER BY id DESC LIMIT 3';
        $query=$database->prepare($sql);
        $query->execute([
            'product_id' => $product_id
        ]);
        $comments = $query->fetch();

require "parts/header.php";
?>

<div class="mt-3">
<?php foreach ($products as $product) { ?> 
            <?php if (isUserLoggedIn($product['id']) ) : ?>
            <h4>Comments</h4>
            <?php
                $comments = ($product['id']);
            ?>
                <?php
                foreach ($comments as $comment) :
                ?>
            <div class="card mt-2 <?php echo ( $comment["user_id"] === $_SESSION['user']['id'] ? "bg-info" : '' ); ?>">
                <div class="card-body">
                    <p class="card-text"><?= $comment['comments']; ?></p>
                    <p class="card-text"><small class="text-muted" style="font-size: 10px;" >Commented By <?= $comment['email']; ?></small></p>
                </div>
                    </div>
                    <?php endforeach; ?>
            <?php endif; ?>
            <?php if ( isUserLoggedIn($product['id']) ) : ?>
            <form
                action="/comments/add"
                method="POST"    
                >
                <div class="mt-3">
                    <label for="comments" class="form-label">Enter your comment below:</label>
                    <textarea class="form-control" id="comments" rows="3" name="comments"></textarea>
                </div>
                <input type="hidden" name="post_id" value="<?= $comment['id']; ?>" />
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>" />
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
            <?php endif; ?>
<?php } ?>
        </div>