<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

date_default_timezone_set('Europe/Paris');

require_once('controller/conversationController.php');
require_once('controller/friendController.php');
require_once('controller/loginController.php');
require_once( 'controller/contactController.php' );

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

        case 'logout':
            logout();
            break;

        case 'conversation':
            if(empty($user_id)): 
                header('Location:index.php');
              else: 
                conversationPage();
              endif;

        case 'friend':
            if(empty($user_id)): 
                header('Location:index.php');
              else: 
                friendPage();
              endif;

        case 'contact':
            sendMail();
            break;
    }
} else {

    if ($user_id) {
        friendPage();
    } else {
        loginPage();
    }
}
