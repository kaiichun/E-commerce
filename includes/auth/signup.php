<?php

    $database = connectToDB();

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $state = $_POST["state"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $sql = "SELECT * FROM users where email = :email";
    $query = $database->prepare( $sql );
    $query->execute([
        'email' => $email
    ]);
    $user = $query->fetch();

    if (empty($firstname) ||
        empty($lastname) || 
        empty($phonenumber) ||
        empty($dob) ||
        empty($gender) ||
        empty($address) ||
        empty($city) ||
        empty($zip) ||
        empty($state) || 
        empty($email) ||
        empty($password) ||
        empty($confirm_password)){
        $error = 'All rows are required';
    }else if($password !== $confirm_password){
        $error = 'The password is not match.';
    }else if(strlen($password)<6){
        $error = "your pass must be at least 6 characters";
    }else if ( $user ) {
        $error = "This email has already been register by other user!";
    }else{
        $sql = "INSERT INTO users (`firstname`,`lastname`,`phonenumber`,`dob`,`gender`,`address`,`city`,`zip`,`state`,`email`,`password`) VALUES
         (:firstname, :lastname, :phonenumber, :dob, :gender, :address, :city, :zip, :state, :email, :password)";
        $query = $database->prepare( $sql );
        $query->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenumber' => $phonenumber,
            'dob' => $dob,
            'gender' => $gender,
            'address' => $address,
            'city' => $city,
            'zip' => $zip,
            'state' => $state,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        
        

        $sql = "SELECT * FROM users where email = :email";
        $query = $database->prepare( $sql );
        $query->execute([
            'email' => $email
        ]);
        $user = $query->fetch();
        $_SESSION['user'] = $user;
        header("Location: /");
        exit;
    }

    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /signup");
        exit;
    }