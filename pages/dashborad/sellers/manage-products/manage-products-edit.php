<?php
      if ( !isAdminOrEditor()) {
        header("Location: /");
        exit;
    }

    if ( isset( $_GET['id'] ) ) {
        // load database
        $database = connectToDB();
        // load the post data based on the id
        $sql = "SELECT * FROM products WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
                'id' => $_GET['id']
        ]);
    
        $product = $query->fetch();
    
        if ( !$product ) {
            header("Location: /manage-products");
            exit;
        }
    
    } else {
        header("Location: /manage-products");
        exit;
    }
  require "parts/header.php";
  // require "parts/navbar.php";

?>
       <div class="container my-5 mx-auto" style="max-width: 75vw;">
      <h1 class="h1 mb-4 text-start">Edit Product Info</h1>

      <div class="card p-4">
        <?php    
            require 'parts/message_error.php';
            require "parts/message_success.php"; 
        ?>
        <form method="POST" action="/products/edit"  enctype="multipart/form-data">
        
        <div class="container">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="" aria-label="product_name" id="product_name" name="product_name" value="<?= $product['product_name']; ?>">
              </div>
             
                <div class="col">
                <label for="product-image" class="form-label">Image</label>
            <input type="file" name="image" id="product-image" />
            <?php if ( $product['image'] ) : ?>
              <input type="hidden" name="original_image" value="<?= $product['image']; ?>" />
              <!-- <p><img src="uploads/<?= $product['image']; ?>" width="150px" /></p> -->
            <?php endif; ?>
           
                </div>

                <div class="col">
                  <label for="product_price" class="form-label"> Product Price </label>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="product_price">RM</label>
                        <input type="number" class="form-control" placeholder="00.00" aria-label="product_price" id="product_price" name="product_price" value="<?= $product['product_price']; ?>">
                    </div>
                </div>
                
                <div class="col">
                  <label for="status" class="form-label">Status</label>
                    <div class="input-group mb-3">
                      <select id="status" name="status" class="form-select">
                    <option selected value="draft"<?=  $product['status'] === 'draft' ? 'selected' : ''; ?>> Draft </option>
                    <option value="publish" <?=  $product['status'] === 'publish' ? 'selected' : ''; ?>>Publish</option>
                  </select>
                    </div>
                </div>

                <div class="col">
                  <label for="category" class="form-label">Category</label>
                    <div class="input-group mb-3">
                      <select id="category" name="category" class="form-select">
                        <option selected value="" disabled readonly>-Pls select a category-</option>
                        <option value="beauty"<?=  $product['category'] === 'beauty' ? 'selected' : ''; ?>>Beauty</option>
                        <option value="electronics"<?=  $product['category'] === 'electronics' ? 'selected' : ''; ?>>Electronics</option>
                        <option value="fashion"<?=  $product['category'] === 'fashion' ? 'selected' : ''; ?>>Fashion</option>
                        <option value="groceries"<?=  $product['category'] === 'groceries' ? 'selected' : ''; ?>>Groceries</option>
                        <option value="health"<?=  $product['category'] === 'health' ? 'selected' : ''; ?>>Health</option>
                        <option value="home"<?=  $product['category'] === 'home' ? 'selected' : ''; ?>>Home</option>
                        <option value="toys"<?=  $product['category'] === 'toys' ? 'selected' : ''; ?>>Toys</option>
                        <option value="other"<?=  $product['category'] === 'other' ? 'selected' : ''; ?>>Other</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="col-6">
            <img src="uploads/<?= $product['image']; ?>" class="img-fluid h-75 mt-5" />
        </div>
           
          </div>

       <div class="col mb-4">
              <label for="product_description" class="form-label">Description</label>
              <textarea type="text" class="form-control" placeholder="" rows="3" aria-label="product_description" id="product_description" name="product_description">
              <?= $product['product_description']; ?>
                </textarea>
            </div>
            <div class="text-end m-2">
              <input type="hidden" name="id" value="<?= $product['id'];?>"/> 
            <button type="submit" class="btn btn-primary btn">
              Comfrim update
            </button>
          </div>
        </div>
            
  </form>     


</div>

      <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
      >
        <a href="/" class="text-decoration-none small"
          ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
      </div>
    </div>

<?php
    require "parts/footer.php";
?>