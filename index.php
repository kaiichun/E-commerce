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
            case 'users/add':
                require "includes/users/add.php";
                break;
            case 'users/changepwd':
                require "includes/users/changepwd.php";
                break;
            case 'users/delete':
                require "includes/users/delete.php";
                break;
            case 'users/edit':
                require "includes/users/edit.php";
                break;
            case 'products/add':
                require "includes/products/add.php";
                break;
            case 'products/edit':
                require "includes/products/edit.php";
                break;
            case 'products/delete':
                require "includes/products/delete.php";
                break;
            case 'wishlist/submit':
                require "includes/wishlist/submit.php";
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
            case 'products': 
                require "pages/products.php";
                break;
            case 'category/beauty': 
                require "pages/category/beauty.php";
                break;
            case 'category/electronics': 
                require "pages/category/electronics.php";
                break;
            case 'category/fashion': 
                require "pages/category/fashion.php";
                break;
            case 'category/groceries': 
                require "pages/category/groceries.php";
                break;
            case 'category/health': 
                require "pages/category/health.php";
                break;
            case 'category/home': 
                require "pages/category/home.php";
                break;
            case 'category/toys': 
                require "pages/category/toys.php";
                break;
            case 'category/other': 
                require "pages/category/other.php";
                break;
            case 'manage-users':
                require "pages/dashborad/admin/manage-users-account.php";
                break;
                case 'manage-users-account-add':
                require "pages/dashborad/admin/manage-users-account-add.php";
                break;
            case 'manage-users-account-edit':
                require "pages/dashborad/admin/manage-users-account-edit.php";
                break;
            case 'manage-users-account-changepwd':
                require "pages/dashborad/admin/manage-users-account-changepwd.php";
                break;
            case 'manage-comment': 
                require "pages/dashborad/sellers/manage-comment/manage-comment.php";
                break; 
            case 'manage-products': 
                require "pages/dashborad/sellers/manage-products/manage-products.php";
                break; 
            case 'manage-products-add': 
                require "pages/dashborad/sellers/manage-products/manage-products-add.php";
                break;
            case 'manage-products-edit': 
                require "pages/dashborad/sellers/manage-products/manage-products-edit.php";
                break;
            case 'manage-products-view': 
                require "pages/dashborad/sellers/manage-products/manage-products-view.php";
                break;
            default:
                require 'pages/home.php';
                break;
        }
    } else {
        require 'pages/home.php';
    }
