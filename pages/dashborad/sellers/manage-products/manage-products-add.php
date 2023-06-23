<?php

  if ( !isAdminOrEditor() ) {
    header("Location: /");
    exit;
  }

  require "parts/header.php";

?>

<div class="container my-5 mx-auto" style="max-width: 75vw;">
  <h1 class="h1 mb-4 text-start">Add New Product</h1>
  <div class="card p-4">
    <?php require 'parts/message_error.php'; ?>
    <form method="POST" action="/products/add" enctype="multipart/form-data">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="product_name" class="form-label">Product Name</label>
              <input type="text" class="form-control" placeholder="" aria-label="product_name" id="product_name" name="product_name">
            </div>
            <div class="col">
              <label for="post-image" class="form-label">Image</label>
              <input type="file" name="image" id="post-image" />
            </div>
            <div class="col">
              <label for="product_price" class="form-label"> Product Price </label>
              <div class="input-group mb-3">
                <label class="input-group-text" for="product_price">RM</label>
                <input type="number" class="form-control" placeholder="00.00" aria-label="product_price" id="product_price" name="product_price">
              </div>
            </div>
            <div class="col">
              <label for="status" class="form-label">Status</label>
              <div class="input-group mb-3">
                <select id="status" name="status" class="form-select">
                  <option selected value="draft"> Draft </option>
                  <option value="publish">Publish</option>
                </select>
              </div>
            </div>
            <div class="col">
              <label for="category" class="form-label">Category</label>
              <div class="input-group mb-3">
                <select id="category" name="category" class="form-select">
                  <option selected value="" disabled readonly>-Pls select a category-</option>
                  <option value="beauty">Beauty</option>
                  <option value="electronics">Electronics</option>
                  <option value="fashion">Fashion</option>
                  <option value="groceries">Groceries</option>
                  <option value="health">Health</option>
                  <option value="home">Home</option>
                  <option value="toys">Toys</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col">
            <img id='img-upload'/>
          </div>
        </div>
        <div class="col mb-4">
          <label for="product_description" class="form-label">Description</label>
          <textarea type="text" class="form-control" placeholder="" rows="3" aria-label="product_description" id="product_description" name="product_description"></textarea>
        </div>
          <div class="text-end m-2">
            <button type="submit" class="btn btn-primary btn">Create now</button>
        </div>
      </div>
    </form>        
  </div>
  <div class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3">
    <a href="/" class="text-decoration-none small">
      <i class="bi bi-arrow-left-circle"></i> Go back
    </a>
  </div>
</div>

<?php

  require "parts/footer.php";