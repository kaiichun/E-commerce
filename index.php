<?php

    // start session
    session_start();

    // require all the files
    require 'includes/functions.php';
    // get route
    $path = parse_url(  $_SERVER['REQUEST_URI'], PHP_URL_PATH );
     // remove starting and ending slashes

    // remove query string
   $path = trim( $path, '/');

    if ( isset( $path ) ) {
        switch( $path ) {
            case 'auth/login':
                require "includes/auth/login.php";
                break;
            case 'auth/signup':
                require "includes/auth/signup.php";
                break;
            case 'login':
                require 'pages/login/login.php';
                break;
            case 'seller-login':
                require 'pages/login/seller-login.php';
                break;
            case 'signup':
                require 'pages/signup/signup.php';
                break;
            case 'seller-signup':
                require 'pages/signup/seller-signup.php';
                break;
            case 'logout': 
                require "pages/logout.php";
                break;
            case 'editprofile':
                require 'pages/editprofile.php';
                break;
            case 'sellerlogin': 
                require "pages/sellerlogin.php";
                break;
            case 'dashboard': 
                require "pages/dashborad/dashboard.php";
                break;
            case 'manage-users':
                require "pages/dashborad/admin/manage-users-account.php";
                break;
            case 'manage-products': 
                require "pages/dashborad/sellers/manage-products/manage-products.php";
                break;
            default:
                require 'pages/home.php';
                break;
        }
    } else {
        require 'pages/home.php';
    }
