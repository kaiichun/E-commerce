<?php
    
    if ( !isAdmin() ) {
    header("Location: /dashboard");
    exit;
    }

    $database = connectToDB();
    // get all the users
    $sql = "SELECT * FROM users";
    $query = $database->prepare( $sql );
    $query->execute();
    // fetch the data from query
    $users = $query->fetchAll();

    require "parts/header.php";

?>

<div class="container-fluid mx-auto mb-5 mt-4" style="max-width: 98vw;">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h1 class="h1">Manage Users</h1>
        <div class="text-end">
            <a href="/manage-users-account-add" class="btn btn-primary btn-sm"
            >Add New User</a
            >
        </div>
    </div>
</div>
<div class="container-fluid mx-auto mb-3" style="max-width: 98vw;"> 
    <?php require "parts/message_success.php"; ?>
    <div class="row">
        <div class="col-12 mt-4 mb-5">
            <table class="table">
                <thead>
                    <tr class="col-12">
                        <th scope="col" style="width: 13%;">Register Time</th>
                        <th scope="col" style="width: 4%;">ID</th>
                        <th scope="col" style="width: 10%;">Name</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col"style="width: 13%;">Phone Number</th>
                        <th scope="col"style="width: 10%;">Zip Code</th>
                        <th scope="col" style="width: 5%;">Role</th>
                        <th scope="col" class="text-end" style="width: 15%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- display out all the users using foreach -->
                    <?php foreach ( $users as $user )  { ?>
                        <?php if( $user["role"] == "admin" ) : ?>
                            <tr class="
                                <?php
                                    if(    isset( $_SESSION['new_user_email'] ) && $_SESSION['new_user_email'] == $user['email'] ) {
                                    echo "table-success";
                                    unset( $_SESSION['new_user_email'] );
                                    }
                                ?>
                            ">
                                <th scope="row">
                                    <?= $user['register_at']; ?>
                                </th>
                                <td>
                                    <strong><?= $user['id']; ?></strong>
                                </td>
                                <td>
                                    <?= $user['firstname']; ?>
                                </td>
                                <td>
                                    <?= $user['email']; ?>
                                </td>
                                <td>
                                    <span>+60 
                                        <?= $user['phonenumber']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $user['zip']; ?>
                                </td>
                                <td>
                                    <p class="
                                        <?php
                                            if($user["role"] == "admin"){
                                                echo "badge bg-primary ps-2 pe-2";
                                            }
                                        ?>
                                    ">
                                        <?= $user['role']; ?>
                                    </p>
                                </td>
                                <td class="text-end">
                                </td>
                            </tr>
                        <?php endif ;?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4 mb-5">
            <table class="table">
                <thead>
                    <tr class="col-12">
                        <th scope="col" style="width: 13%;">Register Time</th>
                        <th scope="col" style="width: 4%;">ID</th>
                        <th scope="col" style="width: 10%;">Name</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col"style="width: 13%;">Phone Number</th>
                        <th scope="col"style="width: 10%;">Zip Code</th>
                        <th scope="col" style="width: 5%;">Role</th>
                        <th scope="col" class="text-end" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- display out all the users using foreach -->
                    <?php foreach ( $users as $user )  { ?>
                        <?php if( $user["role"] == "editor" ) : ?>
                            <tr class="
                                <?php
                                    if(    isset( $_SESSION['new_user_email'] ) && $_SESSION['new_user_email'] == $user['email'] ) {
                                    echo "table-success";
                                    unset( $_SESSION['new_user_email'] );
                                    }
                                ?>
                            ">
                                <th scope="row">
                                    <?= $user['register_at']; ?>
                                </th>
                                <td>
                                    <strong><?= $user['id']; ?></strong>
                                </td>
                                <td>
                                    <?= $user['firstname']; ?>
                                </td>
                                <td>
                                    <?= $user['email']; ?>
                                </td>
                                <td>
                                    <span>+60 
                                        <?= $user['phonenumber']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $user['zip']; ?>
                                </td>
                                <td>
                                    <p class="
                                        <?php
                                            if($user["role"] == "editor"){
                                                echo "badge bg-info ps-2 pe-2";
                                            }
                                        ?>
                                    ">
                                        <?= $user['role']; ?>
                                    </p>
                                </td>
                                <td class="text-end">
                                    <div class="buttons">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $user['id']; ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete-modal-<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <?= $user['firstname']; ?> Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method= "POST" action="users/delete">
                                                            <input type="hidden" name="id" value= "<?= $user['id']; ?>" />
                                                            <button type="submit" class="btn btn-danger">Yes, please delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ;?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4 mb-5">
            <table class="table">
                <thead>
                    <tr class="col-12">
                        <th scope="col" style="width: 13%;">Register Time</th>
                        <th scope="col" style="width: 4%;">ID</th>
                        <th scope="col" style="width: 10%;">Name</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col"style="width: 13%;">Phone Number</th>
                        <th scope="col"style="width: 10%;">Zip Code</th>
                        <th scope="col" style="width: 5%;">Role</th>
                        <th scope="col" class="text-end" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- display out all the users using foreach -->
                    <?php foreach ( $users as $user )  { ?>
                        <?php if( $user["role"] == "user" ) : ?>
                            <tr class="
                                <?php
                                    if(    isset( $_SESSION['new_user_email'] ) && $_SESSION['new_user_email'] == $user['email'] ) {
                                    echo "table-success";
                                    unset( $_SESSION['new_user_email'] );
                                    }
                                ?>
                            ">
                                <th scope="row">
                                    <?= $user['register_at']; ?>
                                </th>
                                <td>
                                    <strong><?= $user['id']; ?></strong>
                                </td>
                                <td>
                                    <?= $user['firstname']; ?>
                                </td>
                                <td>
                                    <?= $user['email']; ?>
                                </td>
                                <td>
                                    <span>+60 
                                        <?= $user['phonenumber']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $user['zip']; ?>
                                </td>
                                <td>
                                    <p class="
                                        <?php
                                            if( $user["role"] == "user") {
                                                echo "badge bg-warning ps-2 pe-2";
                                            }
                                        ?>
                                    ">
                                        <?= $user['role']; ?>
                                    </p>
                                </td>
                                <td class="text-end">
                                    <div class="buttons">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $user['id']; ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete-modal-<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <?= $user['firstname']; ?> Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method= "POST" action="users/delete">
                                                            <input type="hidden" name="id" value= "<?= $user['id']; ?>" />
                                                            <button type="submit" class="btn btn-danger">Yes, please delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ;?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
   
</div>

<div class="text-start mb-5 ms-2">
    <a href="/dashboard" class="btn btn-link btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>
