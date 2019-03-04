<?php
//Error function
function display_errors($errors){
  $display = '<div class=" col-lg-12 alert alert-success fade in">';
    $display .= '<button data-dismiss="alert" class="close close-sm" type="button">
        <i class="icon-remove"></i>
    </button>';
  foreach ($errors as $error){
    $display .= ' <strong>ERROR! </strong>' .$error. '<br>';
  }
  $display .= '</div>';
  return $display;

}

function display_errors2($errors){
  $display =   '<p class="text-center alert alert-success">';
  foreach ($errors as $error){
    $display .= ' <strong>ERROR! </strong>' .$error. '<br>';
  }
    $display .= '</p>';
    return $display;
}


//security and cleanup function FOR input
function sanitize($dirty){
  $dirty = trim($dirty);
  //$dirty = stripslashes($dirty);
  $dirty = htmlspecialchars($dirty);
  $dirty = htmlentities($dirty,ENT_QUOTES,"UTF-8");
  return $dirty;
}

//naira format
function money($number){

  //return $nairaformat.number_format($number,2);
  return number_format($number,0);
}

//log in functions
function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_flash'] = 'You are now Logged in!';
  header('Location: index.php');
}

function login2($vendor_id){
  $_SESSION['SBVendor'] = $vendor_id;
  global $db;
  $_SESSION['success_flash'] = 'You are now Logged in!';
  header('Location: brands.php');
}
function login3($customer_id){
  $_SESSION['SBCustomer'] = $customer_id;
  global $db;
  $_SESSION['success_flash'] = 'customer Logged in!';
  header('Location: index.php');
}


function is_logged_in(){
  if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
    return true;
  }
  return false;
}
function is_logged_in2(){
  if(isset($_SESSION['SBVendor']) && $_SESSION['SBVendor'] > 0){
    return true;
  }
  return false;
}
function is_logged_in3(){
  if(isset($_SESSION['SBCustomer']) && $_SESSION['SBCustomer'] > 0){
    return true;
  }
  return false;
}

//redirect you after log in function
function login_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = 'You must be logged in to access that page';
  header('Location: '.$url);
}

//if you have permisison to view page function
function permission_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = 'You do not have permission to access that page';
  header('Location: '.$url);
}

function has_permission($permission = 'admin'){
  global $user_data;
  $permissions = explode(',', $user_data['permissions']);
  if(in_array($permission,$permissions,true)){
    return true;
  }
  return false;
}

//to make our date look pretty
function pretty_date($date){
  return date("M d, y h:i A", strtotime($date));
}

function get_category($child_id){
  global $db;
  $id = sanitize($child_id);
  $sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child' FROM categories c INNER JOIN categories p ON c.parent = p.id WHERE c.id = '$id'";
  $query = $db->query($sql);
  $category = mysqli_fetch_assoc($query);
  return $category;

}

function sizesToArray($string){
  $sizey = rtrim($string,',');
  $sizesArray = explode(',',$sizey);
  $returnArray = array();
  foreach($sizesArray as $size){
    $s = explode(':',$size);
    $returnArray[] = array("size" => $s[0], "quantity" => $s[1], 'threshold' => $s[2]);
  }

  return $returnArray;
}


function sizesToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold']. ',';
  }
  $trimmed = rtrim($sizeString, ',');
  return $trimmed;
}
