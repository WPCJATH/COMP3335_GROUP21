<?php
/*
 * Send the page based on the request url and the router map defined in ./lib/config.php
 * no session check in the index page
 *
 * Since it is troublesome if use .htaccess on both docker and macOS machine, we decided to use the index.php as the
 * router page, i.e, based on the request url formation: localhost/index/php.A/B/C to directly transfer the page related
 * A (e.g. localhost/index.php/login will use 'require ./static/login.html' in this page)
 */

// Check if '?' contained in the current url and if there is any content after the '?'
$request_uri = explode('?', $_SERVER['REQUEST_URI']);
if (!isset($request_uri[1]) || $request_uri[1]==''){
    header("Location: index.php?home");
    exit;
}

// Will split the after behind '?' based on delimiter '/'
$request_keywords = explode('/', $request_uri[1]);

// Transfer the related page
include_once './lib/toolfuctions.php';
if ($request_keywords && sizeof($request_keywords) > 0){
    if (session_update()){
        switch ($request_keywords[0]){
            case 'signin':
            case 'login':
            case 'signup':
            case 'home':
                require_once "./home.php";
                break;
            case 'logout':
                require_once "./logout.php";
                break;
            default:
                require_once './static/pages-error.html';
        }
    }
    else{
        switch ($request_keywords[0]){
            case 'signin':
            case 'login':
                require_once "./login.php";
                break;
            case 'signup':
                require_once "./signup.php";
                break;
            case 'home':
                require_once "./home_unsigned.php";
                break;
            default:
                require_once './static/pages-error.html';
        }
    }
    exit;
}

// If no match, send error page to client
require_once './static/pages-error.html';