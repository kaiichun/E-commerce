<?php
   if ( !isUserLoggedIn() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $state = $_POST["state"];
    $id = $_POST['id'];
    $image = $_FILES['image'];
    // get image file name
    $image_name = $image['name'];

    // add image to the uploads folder
    if ( !empty( $image_name ) ) {
    // target the uploads folder
    $target_dir = "uploads/";
    // add the image name to the uploads folder
    $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
    // move the file to the uploads folder
    move_uploaded_file( $image["tmp_name"], $target_file );
    }

    /* 
        do error check
        - make sure all the fields are not empty
        - make sure the *new* email entered is not duplicated
    */
    if (
    empty($phonenumber) || empty($dob) || empty($gender) ||
    empty($address) ||
    empty($city) ||
    empty($zip) ||
    empty($state) || 
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
        header("Location: /editprofile");
        exit;
    }   
    // if no error found, update the user data based whatever in the $_POST data
    $sql = "UPDATE users SET gender = :gender, address = :address, image = :image, phonenumber = :phonenumber, dob = :dob, city = :city, zip = :zip, state = :state WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'phonenumber' => $phonenumber, 
        'address' => $address,
        'image' => $image,
        'gender' => $gender,
        'city' => $city,
        'zip' => $zip,
        'state' => $state,
        'dob' =>$dob,
        'id' => $id
    ]);

    // set success message
    $_SESSION["success"] = "Profile has been edited.";

    // redirect
    header("Location: /editprofile");
    exit;