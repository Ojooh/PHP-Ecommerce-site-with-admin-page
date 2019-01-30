<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
    $product_id = sanitize($_POST['id']);
    $size =   $size = sanitize($_POST['size']);
    $item2 = array();
    $item2[] = array(
      'id'         =>    $product_id,
      'size'       =>    $size,
    );

    $domain = ($_SERVER['HTTP_HOST'] !=  'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
    $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($query);

    //$_SESSION['success_flash'] = $product['title']. ' was saved to your Wish List.';


    //check to see if the wish list cookie exists
    if($wish_id != ''){
      $wishQ = $db->query("SELECT * FROM wish  WHERE id = '{$wish_id}'");
      $wish = mysqli_fetch_assoc($wishQ);
      if ($wish === NULL){
        //add the wish to the database and set the cookie
        $item2s_json = json_encode($item2);
        $wish_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("INSERT INTO wish (items,expired_date) VALUES ('{$item2s_json}','{$wish_expire}')");
        $wish_id = $db->insert_id;
        setcookie(WISH_COOKIE,$wish_id,WISH_COOKIE_EXPIRE,'/',$domain,false);


      }else {
        $previous_items = json_decode($wish['items'],true);
        $item2_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item2[0]['id'] == $pitem['id'] && $item2[0]['size'] == $pitem['size']){
            $item2_match = 1;
          }
          $new_items[] = $pitem;
        }
      if($item2_match != 1){
        $new_items = array_merge($item2, $previous_items);
      }

      $item2s_json = json_encode($new_items);
      $wish_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("UPDATE wish SET items = '{$item2s_json}', expired_date = '{$wish_expire}' WHERE id = '{$wish_id}'");
      setcookie(wish_COOKIE,'',1,"/",$domain,false);
      setcookie(wish_COOKIE,$wish_id,WISH_COOKIE_EXPIRE,'/',$domain,false);
    }


      }

  else{
    //add the wish to the database and set the cookie
    $item2s_json = json_encode($item2);
    $wish_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
    $db->query("INSERT INTO wish (items,expired_date) VALUES ('{$item2s_json}','{$wish_expire}')");
    $wish_id = $db->insert_id;
    setcookie(WISH_COOKIE,$wish_id,WISH_COOKIE_EXPIRE,'/',$domain,false);
  }
  ?>
