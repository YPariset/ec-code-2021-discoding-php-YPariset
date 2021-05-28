<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

date_default_timezone_set('Europe/Paris');

require_once('controller/conversationController.php');
require_once('controller/friendController.php');
require_once('controller/loginController.php');
require_once('controller/contactController.php');
require_once('controller/signupController.php');
require_once('controller/serverController.php');
require_once('controller/createServerController.php');

$user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            if (!empty($_POST)) {
                login($_POST);
            } else {
                loginPage();
            }
            break;

        case 'signup':
            if (!empty($_POST)) {
                signup($_POST);
            } else {
                signupPage();
                }
            break;

        case 'logout':
            logout();
            break;

        case 'conversation':
            if(empty($user_id)): 
                header('Location:index.php');
              else: 
                conversationPage();
                if ( !empty( $_POST ) ) {messageDelete( $_POST );}
              endif;
            break;

        case 'friend':
            if(empty($user_id)): 
                header('Location:index.php');
              else: 
                friendPage();
              endif;
            break;

        case 'contact':
            sendMail();
            break;

        case 'create_server':
            createServer();
            break;

        case 'server':
            serverPage();
            break;
    }
} else {

    if ($user_id) {
        friendPage();
    } else {
        loginPage();
    }
}
