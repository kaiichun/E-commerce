<?php
      if ( !isAdmin()) {
        header("Location: /");
        exit;
    }

    if ( isset( $_GET['id'] ) ) {
        // load database
        $database = connectToDB();
        // load the post data based on the id
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
                'id' => $_GET['id']
        ]);
    
        $users = $query->fetch();
    
        if ( !$users ) {
            header("Location: /manage-users");
            exit;
        }
    
    } else {
        header("Location: /manage-users");
        exit;
    }
  require "parts/header.php";
  require "parts/navbar-home.php";

?>

<div class="container my-5 mx-auto" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center">Edit a Account</h1>
        <div class="card p-4">
            <?php    
                require 'parts/message_error.php';
            ?>
        <form method="POST" action="/users/edit"   >
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label for="firstname" class="form-label"> First Name</label>
                    <input type="text" class="form-control" placeholder="" aria-label="First name" id="firstname" name="firstname" value="<?= $users['firstname']; ?>" readonly>
                </div>
                <div class="col-sm-6">
                    <label for="lastname" class="form-label"> Last Name</label>
                    <input type="text" class="form-control" placeholder="" aria-label="Last name" id="lastname" name="lastname" value="<?= $users['lastname']; ?>" readonly>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="email@example.com" aria-label="email" id="email" name="email" value="<?= $users['email']; ?>" readonly>
                </div>
                <div class="col-sm-6">
                    <label for="phonecode" class="form-label"> Phone Number</label>
                        <div class="input-group mb-3">
                            <div class="col-sm-4 g-2">
                                <input type="text" class="form-control" placeholder="+60"  disabled readonly>
                            </div>
                                <span class="ms-1 me-1 mt-2">-</span>
                            <div class="col-sm-7 g-2">
                                <input type="text" class="form-control" placeholder="3456789" aria-label="phonenumber" id="phonenumber" name="phonenumber" value="<?= $users['phonenumber']; ?>">
                            </div>
                        </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-4">
                    <label for="dob" class="form-label">DOB</label>
                    <input type="date" class="form-control" placeholder="" aria-label="dob" id="dob" name="dob" value="<?= $users['dob']; ?>">
                </div>
                <div class="col-sm-5">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                        <option value="male" <?= $users['gender'] === 'male' ? 'selected' : '';?>>Male</option>
                        <option value="famale" <?= $users['gender'] === 'famale' ? 'selected' : '';?>>Female</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option selected value="user" <?= $users['role'] === 'user' ? 'selected' : '';?>> User </option>
                            <option value="editor" <?= $users['role'] === 'editor' ? 'selected' : '';?>>Editor</option>
                            <option value="admin" <?= $users['role'] === 'admin' ? 'selected' : '';?>>Admin</option>
                        </select>
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="address" class="form-label"> Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Apartment, studio, or floor" value="<?= $users['address']; ?>">
            </div>
            <div class="row g-2 mb-5">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="City" aria-label="city" id="city" name="city" value="<?= $users['city']; ?>">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Zip" aria-label="zip" id="zip" name="zip" value="<?= $users['zip']; ?>">
                </div>
                <div class="col-sm-5">
                    <select id="state" name="state" class="form-select">
                        <!-- <option selected>State</option> -->
                        <option value="johor"<?=  $users['state'] === 'johor' ? 'selected' : ''; ?>>Johor</option>
                        <option value="kedah"<?=  $users['state'] === 'kedah' ? 'selected' : ''; ?>>Kedah</option>
                        <option value="kualalumper"<?=  $users['state'] === 'kualalumper' ? 'selected' : ''; ?>>Kuala Lumpur</option>
                        <option value="malacca"<?=  $users['state'] === 'malacca' ? 'selected' : ''; ?>>Malacca</option>
                        <option value="negerisembilan"<?=  $users['state'] === 'negerisembilan' ? 'selected' : ''; ?>>Negeri Sembilan</option>
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
            
            <div class="d-grid mt-3">
            <input type="hidden" name="id" value="<?= $users['id'];?>"/> 
                <button type="submit" class="btn btn-primary btn-fu">
                    Update Now
                </button>
            </div>
        </form>
    </div>
    <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
    >
        <a href="/manage-users" class="text-decoration-none small">
            <i class="bi bi-arrow-left-circle"></i> 
                Go back
        </a>
    </div>
</div>

<?php
    require "parts/footer.php";
?>