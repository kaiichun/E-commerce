<?php

  if ( !isUserLoggedIn() ) {
  // if current user is not an admin, redirect to dashboard
  header("Location: /");
  exit;
  }

  $database = connectToDB();
  // load the post data based on the id
  $sql = "SELECT * FROM users WHERE id = :id";
  $query = $database->prepare( $sql );
  $query->execute([
          'id' => $_SESSION['user']['id']
  ]);
  $users = $query->fetch();

  require "parts/header.php";
  require "parts/navbar.php";

?>

<div class="container my-5 mx-auto" style="max-width: 800px;">
  <?php if ( isset($_SESSION['user'] ) ) { ?>
    <h1 class="h1 mb-4 text-start">Edit Profile</h1>
      <div class="p-4">
        <?php require 'parts/message_error.php'; ?>
        <?php require "parts/message_success.php"; ?>
        <form method="POST" action="/auth/edit-profile" enctype="multipart/form-data">
          <div class="row g-2 mb-3">
            <div class="col-sm-6 text-center ">
              <img src="uploads/<?= $users['image']; ?>" class="img-fluid" style="width:10vw; height:10vw; border-radius: 50%;"/>
              <?php if ( $users['image'] ) : ?>
                <input type="hidden" name="original_image" value="<?= $users['image']; ?>" />
              <?php endif; ?>
            </div>    
            <div class="col-sm-6 mt-auto mb-2">
              <label for="product-image" class="form-label">Image</label>
              <input type="file" name="image" id="product-image" />
            </div>    
          </div>
          <div class="row g-2 mb-3">
            <div class="col-sm-6">
              <label for="firstname" class="form-label"> First Name</label>
              <input type="text" class="form-control" placeholder="" aria-label="First name" id="firstname" name="firstname" value="<?= $users['firstname']?>"  readonly>
            </div>
            <div class="col-sm-6">
              <label for="lastname" class="form-label"> Last Name</label>
              <input type="text" class="form-control" placeholder="" aria-label="Last name" id="lastname" name="lastname" value="<?= $users['lastname']?>" readonly>
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-sm-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="email@example.com" aria-label="email" id="email" name="email" value="<?= $users['email']?>" readonly >
            </div>
            <div class="col-sm-6">
                <label for="phonecode" class="form-label"> Phone Number</label>
                <div class="input-group mb-3">
                  <div class="col-sm-4 g-2">
                    <input type="text" class="form-control" placeholder="+60"  disabled readonly>
                  </div>
                  <span class="ms-1 me-1 mt-2">-</span>
                  <div class="col-sm-7 g-2">
                    <input type="text" class="form-control" placeholder="3456789" aria-label="phonenumber" id="phonenumber" name="phonenumber" value="<?= $users['phonenumber']?>">
                  </div>
                </div>
              </div>
            <div class="col-sm-6">
              <label for="dob" class="form-label">DOB</label>
              <input type="date" class="form-control" placeholder="" aria-label="dob" id="dob" name="dob" value="<?= $users['dob']?>">
            </div>
            <div class="col-sm-6">
              <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" value="<?= $users['gender']?>">
                  <option selected disabled readonly> - Please select your sex -</option>
                  <option value="male" <?= $users['gender'] === 'male' ? 'selected' : '';?>>Male</option>
                  <option value="famale" <?= $users['gender'] === 'famale' ? 'selected' : '';?>>Female</option>
                </select>
              </div>
            </div>
            <div class="col-12 mb-2">
              <label for="address" class="form-label"> Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Apartment, studio, or floor" value="<?= $users['address']?>">
            </div>
            <div class="row g-2 mb-3">
              <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="City" aria-label="city" id="city" name="city"value="<?= $users['city']?>" >
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="Zip" aria-label="zip" id="zip" name="zip" value="<?= $users['zip']?>">
              </div>
              <div class="col-sm-5">
                <select id="state" name="state" class="form-select">
                  <option selected>State</option>
                  <option value="johor"<?=  $users['state'] === 'johor' ? 'selected' : ''; ?>>Johor</option>
                  <option value="kedah"<?=  $users['state'] === 'kedah' ? 'selected' : ''; ?>>Kedah</option>
                  <option value="kualalumpur"<?=  $users['state'] === 'kualalumpur' ? 'selected' : ''; ?>>Kuala Lumpur</option>
                  <option value="malacca"<?=  $users['state'] === 'malacca' ? 'selected' : ''; ?>>Malacca</option>
                  <option value="negarisembilan"<?=  $users['state'] === 'negarisembilan' ? 'selected' : ''; ?>>Negeri Sembilan</option>
                  <option value="perak"<?=  $users['state'] === 'perak' ? 'selected' : ''; ?>>Perak</option>
                  <option value="perlis"<?=  $users['state'] === 'perlis' ? 'selected' : ''; ?>>Perlis</option>
                  <option value="penang"<?=  $users['state'] === 'penang' ? 'selected' : ''; ?>>Penang</option>
                  <option value="terengganu"<?=  $users['state'] === 'terengganu' ? 'selected' : ''; ?>>Terengganu</option>
                  <option value="selangor"<?=  $users['state'] === 'selangor' ? 'selected' : ''; ?>>Selangor</option>
                  <option value="sabah"<?=  $users['state'] === 'sabah' ? 'selected' : ''; ?>>Sabah</option>
                  <option value="sarawak"<?=  $users['state'] === 'sarawak' ? 'selected' : ''; ?>>Sarawak</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label"> Password</label>
              <input type="password" class="form-control" id="password" name="password"/>
            </div>
            <div class="mb-5">
              <label for="confirm_password" class="form-label"> Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password"/>
            </div>
            <div class="col-12 mb-4">
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-fu">
              Update
            </button>
          </div>
        </form>
      </div>
      <div class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3">
        <a href="/" class="text-decoration-none small">
          <i class="bi bi-arrow-left-circle"></i> Go back
        </a>
      </div>
  <?php } ?>
</div>

<?php

    require "parts/footer.php";
