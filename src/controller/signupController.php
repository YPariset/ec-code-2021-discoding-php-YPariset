<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/signupView.php');
  else:
    require('view/loginView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function signup($post) {
  $data                   = new stdClass();
  $data->email            = $post['email'];
  $data->username         = $post['username'];
  $data->password         = isset($post['password']) ? htmlspecialchars(strip_tags($post['password'])) : null;
  $password_confirm       = isset($post['password_confirm']) ? htmlspecialchars(strip_tags($post['password_confirm'])) : null;

  $user = new User( $data );
  $error_msg = null;

  # Check if passwords are matching
  if( $data->email != null || $data->password != null || $password_confirm != null|| $data->username != null){
    // si le confirm est egal au password user 
    if( $user->getPassword() == $password_confirm){
        // si adresse dispo
        if($user->createUser()){
          $error_msg ="You will receive an email to activate your account";
        }else{

          $error_msg ="This account already exist";
        }
     }else{
          $error_msg = "Password doesn't matching";
     }
  } else{
      $error_msg ="Please, be focus !";
  }

  require('view/signupView.php');
} 