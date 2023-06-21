<?php
  require "parts/header.php";
  require "parts/navbar-home.php";

?>
<div class="container my-5 mx-auto" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center">Create a New Account</h1>
        <div class="card p-4">
            <?php    
                require 'parts/message_error.php';
            ?>
        <form method="POST" action="/users/add"   >
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label for="firstname" class="form-label"> First Name</label>
                    <input type="text" class="form-control" placeholder="" aria-label="First name" id="firstname" name="firstname">
                </div>
                <div class="col-sm-6">
                    <label for="lastname" class="form-label"> Last Name</label>
                    <input type="text" class="form-control" placeholder="" aria-label="Last name" id="lastname" name="lastname">
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="email@example.com" aria-label="email" id="email" name="email">
                </div>
                <div class="col-sm-6">
                    <label for="phonecode" class="form-label"> Phone Number</label>
                        <div class="input-group mb-3">
                            <div class="col-sm-4 g-2">
                                <input type="text" class="form-control" placeholder="+60"  disabled readonly>
                            </div>
                                <span class="ms-1 me-1 mt-2">-</span>
                            <div class="col-sm-7 g-2">
                                <input type="text" class="form-control" placeholder="3456789" aria-label="phonenumber" id="phonenumber" name="phonenumber">
                            </div>
                        </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-4">
                    <label for="dob" class="form-label">DOB</label>
                    <input type="date" class="form-control" placeholder="" aria-label="dob" id="dob" name="dob">
                </div>
                <div class="col-sm-5">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                        <option selected disabled readonly> - Please select your sex -</option>
                        <option value="male" >Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option selected value="user" readonly> User </option>
                            <option value="editor" >Editor</option>
                            <option value="admin">Admin</option>
                        </select>
                </div>
            </div>
            <div class="col-12 mb-2">
                <label for="address" class="form-label"> Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Apartment, studio, or floor">
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="City" aria-label="city" id="city" name="city">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Zip" aria-label="zip" id="zip" name="zip">
                </div>
                <div class="col-sm-5">
                    <select id="state" name="state" class="form-select">
                        <option selected>State</option>
                        <option>Johor</option>
                        <option>Kedah</option>
                        <option>Kuala Lumpur</option>
                        <option>Malacca</option>
                        <option>Negeri Sembilan</option>
                        <option>Perak</option>
                        <option>Perlis</option>
                        <option>Penang</option>
                        <option>Terengganu</option>
                        <option>Selangor</option>
                        <option>Sabah</option>
                        <option>Sarawak</option>
                    </select>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-sm-6">
                    <label for="password" class="form-label"> Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                        />
                </div>
                <div class="col-sm-6">
                    <label for="confirm_password" class="form-label"> Confirm Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="confirm_password"
                            name="confirm_password"
                        />
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-fu">
                    Create
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