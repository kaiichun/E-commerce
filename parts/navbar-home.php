
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Shoppe</a>
   
      <div class="d-flex ms-auto pt-2">
        <?php if ( isUserLoggedIn() ) : ?>
          <a class="nav-link ps-3 pe-3 d-flex" href="/editprofile" > <img
                src=uploads/<?= $_SESSION['user']['image']; ?>
                class="me-2"
                style="width:30px; height:30px; border-radius: 50%;"
                alt="Product_Image"
                /><h5 class="mt-1">
              <?= $_SESSION['user']['firstname'] ?>
        </h5>
            </a>
          <a class="nav-link ps-3 pe-3" href="/add-to-cart" ><i class="bi bi-cart4" style="font-size: 1.4rem; "></i></a>
          <a class="nav-link ps-3 pe-3" href="/add-to-cart"><i class="bi bi-bag-heart" style="font-size: 1.4rem; "></i></a>
        <?php endif; ?>
        <?php if ( isAdmin() || isEditor() ) : ?>
          <a class="nav-link ps-3 pe-3" href="/dashboard"><i class="bi bi-gear" style="font-size: 1.4rem; "></i></a>
        <?php endif; ?>
        <?php if ( isset( $_SESSION["user"] ) ) { ?>
          <a href="/logout" class="nav-link ps-3 pe-3"><i class="bi bi-box-arrow-right" style="font-size: 1.4rem; "></i></a>
        <?php } else { ?>
          <a href="/login" class="nav-link ps-3 pe-3">Login</a>
          <a href="/signup" class="nav-link ps-3 pe-3">Sign Up</a>
          <a class="nav-link ps-2 pe-2" href="/seller-signup">Seller Center</a>
        <?php } ?>
      </div>
  </div>
</nav>  