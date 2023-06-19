<?php
   if ( !isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /dashboard");
    exit;
}

    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $phonenumber = $_POST["phonenumber"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $role = $_POST["role"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $state = $_POST["state"];
    $id = $_POST['id'];


    /* 
        do error check
        - make sure all the fields are not empty
        - make sure the *new* email entered is not duplicated
    */
    if (
    empty($phonenumber) || empty($dob) || empty($gender) || empty($role) ||
    empty($address) ||
    empty($city) ||
    empty($zip) ||
    empty($state) || 
    empty($role) || 
    empty($id) )
    {
    $error = 'All rows are required';
    }
    
    // check if email is already taken by calling the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $database->prepare($sql);
    $query->execute([
        'email'=>$email,
    ]);
    $user = $query->fetch();
    
    // if error found, set error message & redirect back to the manage-users-edit page with id in the url
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /manage-users-account-edit?id=$id");
        exit;
    }   
    // if no error found, update the user data based whatever in the $_POST data
    $sql = "UPDATE users SET gender = :gender, address = :address, role = :role, phonenumber = :phonenumber, dob = :dob, city = :city, zip = :zip, state = :state WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'phonenumber' => $phonenumber, 
        'address' => $address,
        'role' => $role,
        'gender' => $gender,
        'city' => $city,
        'zip' => $zip,
        'state' => $state,
        'dob' =>$dob,
        'id' => $id
    ]);

    // set success message
    $_SESSION["success"] = "user has been edited.";

    // redirect
    header("Location: /manage-users");
    exit;