<?php
$db = mysqli_connect('127.0.0.1','root','','baine');
if(mysqli_connect_errno())
{
  echo 'Database connection failed with following errors: '. mysqli_connect_error();
  die();
}

//to start session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/config.php';
require_once BASEURL.'helpers/helpers.php';
require_once BASEURL.'vendor/autoload.php';

$cart_id = '';

if(isset($_COOKIE[CART_COOKIE])){
  $cart_id = sanitize($_COOKIE[CART_COOKIE]);
}
//if(isset($_COOKIE2[WISH_COOKIE])){
  //$wish_id = sanitize($_COOKIE2[WISH_COOKIE]);
//}

if ($cart_id != ''){
    $cartQ2 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $cart2 = mysqli_fetch_assoc($cartQ2);
    $i = 0;
    if($cart2 === NULL){
      $i = 0;
    }
    else{
      $items2 = json_decode($cart2['items'], true);
      foreach($items2 as $item2){
        $i++;
      }
    }
}

$wish_id = '';
if(isset($_COOKIE[WISH_COOKIE])){
  $wish_id = sanitize($_COOKIE[WISH_COOKIE]);
}
if ($wish_id != ''){
    $wishQ4 = $db->query("SELECT * FROM wish WHERE id = '{$wish_id}'");
    $wish4 = mysqli_fetch_assoc($wishQ4);
    $m = 0;
    if($wish4 === NULL){
      $m = 0;
    }
    else{
      $items4 = json_decode($wish4['items'], true);
      foreach($items4 as $item4){
        $m++;
      }
    }
}



if(isset($_SESSION['SBUser'])){
  $user_id = $_SESSION['SBUser'];
  $query = $db->query("SELECT * FROM users WHERE ID = '$user_id'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ', $user_data['full_name']);
  $user_data['first'] = $fn[0];
  $user_data['last'] = $fn[1];
}

if(isset($_SESSION['SBVendor'])){
  $vendor_id = $_SESSION['SBVendor'];
  $query = $db->query("SELECT * FROM vendors WHERE id= '$vendor_id'");
  $vendor_data = mysqli_fetch_assoc($query);
  $fn = explode(' ', $vendor_data['name']);
  $vendor_data['first'] = $fn[0];
  $vendor_data['last'] = $fn[1];
}

if(isset($_SESSION['SBCustomer'])){
  $customer_id = $_SESSION['SBCustomer'];
  $query = $db->query("SELECT * FROM userlogin WHERE id= '$customer_id'");
  $customer_data = mysqli_fetch_assoc($query);
  $fn = explode(' ', $customer_data['name']);
  $customer_data['first'] = $fn[0];
  $customer_data['last'] = $fn[1];
  //unset($_SESSION['SBCustomer']);
}


//session success_flash check
if(isset($_SESSION['success_flash'])){
  echo '<div class="alert alert-warning"><p class="text-danger text-center">' .$_SESSION['success_flash']. '</p></div>';
  unset($_SESSION['success_flash']);
}

//session error_flash check
if(isset($_SESSION['error_flash'])){
  echo '<div class="alert alert-warning"><p class="text-danger text-center">' .$_SESSION['error_flash']. '</p></div>';
  unset($_SESSION['error_flash']);
}

//to destroy session
//session_destroy();*/
