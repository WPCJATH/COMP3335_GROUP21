<?php
/*
 * Send the page based on the request url and the router map shown at the switch statements
 * no session check in this index page
 *
 * Since it is troublesome if use .htaccess on both docker and macOS machine, we decided to use the index.php as the
 * router page, i.e, based on the request url formation: localhost/index/php? A to directly transfer the page related
 * A (e.g. localhost/index.php?login will use 'require ./static/login.html' in this page)
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
    if ($role = session_update()){
        switch ($role){
            case "customer":
                switch ($request_keywords[0]){
                    case 'signin':
                    case 'login':
                    case 'signup':
                        header("Location: index.php?") ;
                        break;
                    case 'home':
                        require_once "./home.php";
                        break;
                    case 'logout':
                        require_once "./logout.php";
                        break;
                    case 'order':
                        require_once "./order.php";
                        break;
                    case 'profile':
                        require_once "./profile.php";
                        break;
                    case 'new_profile':
                        require_once "./new_profile.php";
                        break;
                    case "new_reservation":
                        require_once "./new_reservation.php";
                        break;
                    case "del_order":
                        require_once "./del_order.php";
                        break;
                    case 'delete_profile':
                        require_once "./delete_profile.php";
                        break;
                    default:
                        require_once './static/pages-error.html';
                }
                break;
            case "FD":
                switch ($request_keywords[0]){
                    case 'signin':
                    case 'login':
                        header("Location: index.php?") ;
                        break;
                    case "home":
                    case 'room_occupancy':
                        require_once "./room_occupancy.php";
                        break;
                    case 'logout':
                        require_once "./logout.php";
                        break;
                    case 'checkin':
                        require_once "./checkin.php";
                        break;
                    case 'checkout':
                        require_once "./checkout.php";
                        break;
                    case 'update_checkin':
                        require_once "./update_checkin.php";
                        break;
                    case 'update_checkout':
                        require_once "./update_checkout.php";
                        break;
                    case 'profile':
                        require_once "./fd_profile.php";
                        break;
                    default:
                        require_once './static/pages-error.html';
                }
                break;
            case "MA":
                switch ($request_keywords[0]){
                    case 'signin':
                    case 'login':
                        header("Location: index.php?") ;
                        break;
                    case "home":
                    case 'room_occupancy':
                        require_once "./manager_room.php";
                        break;
                    case 'logout':
                        require_once "./logout.php";
                        break;
                    case 'profile':
                        require_once "./manager_profile.php";
                        break;
                    case "order":
                        require_once "./manager_order.php";
                        break;
                    case "new_profile":
                        require_once "./new_staff.php";
                        break;
                    case "del_staff":
                        require_once "./del_staff.php";
                        break;
                    default:
                        require_once './static/pages-error.html';
                }
                break;
            case "CL":
                switch ($request_keywords[0]){
                    case 'signin':
                    case 'login':
                        header("Location: index.php?") ;
                        break;
                    case "home":
                    case 'clean_status':
                        require_once "./clean_status.php";
                        break;
                    case "update_clean":
                        require_once "./update_clean.php";
                        break;
                    case 'logout':
                        require_once "./logout.php";
                        break;
                    case 'profile':
                        require_once "./cl_profile.php";
                        break;
                    default:
                        require_once './static/pages-error.html';
                }
                break;
            default:
                require_once './static/pages-error.html';
        }

    }
    else{
        switch ($request_keywords[0]){
            case 'signin':
            case 'login':
            case 'profile':
                require_once "./login.php";
                break;
            case 'signup':
                require_once "./signup.php";
                break;
            case 'logout':
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