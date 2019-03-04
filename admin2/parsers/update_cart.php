<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
    $mode = sanitize($_POST['mode']);
    $edit_size = sanitize($_POST['edit_size']);
    $edit_id = sanitize($_POST['edit_id']);
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'],true);
    $updated_items = array();
    $domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);
    if($mode == 'removeone'){
      foreach($items as $item){
        if($item['id'] == $edit_id && $item['size'] == $edit_size){
          $item['quantity'] = $item['quantity'] - 1;
        }
        if($item['quantity'] > 0){
          $updated_items[] = $item;
        }
      }
    }

    if($mode == 'addone'){
      foreach($items as $item){
        if($item['id'] == $edit_id && $item['size'] == $edit_size){
          $item['quantity'] = $item['quantity'] + 1;
        }
          $updated_items[] = $item;
      }
    }

    if($mode == 'remove'){
      foreach($items as $item ){
        if($item['id'] != $edit_id && $item['size'] != $edit_size){
          $updated_items[] = $item;
        }
      }
    }

if(!empty($updated_items)){
  $json_updated = json_encode($updated_items);
  $db->query("UPDATE cart SET items = '{$json_updated}' WHERE id = '{$cart_id}'");
  $_SESSION['succes_flash'] = 'Shopping Cart has been updated';
}

if(empty($updated_items)){
  $db->query("DELETE FROM CART WHERE id = '{$cart_id}'");
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
}
?>
