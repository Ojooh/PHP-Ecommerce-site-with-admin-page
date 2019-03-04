<?php
//edit Product
  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $productresult = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
    $product = mysqli_fetch_assoc($productresult);
    if(isset($_GET['delete_image'])){
      $imgi = (int)$_GET['imgi'] - 1;
      $images = explode(',', $product['image']);
      $image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
      unlink($image_url);
      unset($images[$imgi]);
      $imageString = implode(',',$images);
      $db->query("UPDATE products SET image = '{$imageString}' WHERE id = '$edit_id'");
      echo '<script>location.replace("products.php?edit"'.$edit_id.'");</script>';
    }
    $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);
    $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
    $brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$product['brand']);
    $vendor = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$product['name']);
    $parentQuery2 = $db->query("SELECT * FROM categories WHERE id = '$category'");
    $parentResult = mysqli_fetch_assoc($parentQuery2);
    $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
    $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
    $list_price = ((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
    $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$product['description']);
    $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):$product['sizes']);
    $sizes = rtrim($sizes,',');
    $saved_image = (($product['image'] != '')?$product['image']:'');
    $dbPath = $saved_image;
  }
  if (!empty($sizes)){
    $sizeString = sanitize($sizes);
    $sizeString = rtrim($sizeString,',');
    $sizesArray = explode(',',$sizeString);
    $sArray = array();
    $qArray = array();
    $tArray = array();
    foreach($sizesArray as $ss){
      $s = explode(':', $ss);
      $sArray[] = $s[0];
      $qArray[] = $s[1];
      $tArray[] = $s[2];
    }
  }
  else{
    $sizesArray = array();
  }
//to post added values
  if ($_POST){
    $errors = array();
    //make sure asteriked fields have a value
    $required = array('title', 'brand', 'price', 'parent', 'child', 'sizes');
    $allowed = array('png','jpg','jpeg','gif');
    $photoName = array();
    $tmpLoc = array();
    $uploadPath = array();

    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All asteriked(*) fields are required';
        break;
      }
    }
    //if upload file is empty

    $photoCount = count($_FILES['photo']['name']);
     if ($photoCount > 0) {
       for($i = 0; $i < $photoCount; $i++){
                $name = $_FILES['photo']['name'][$i];
                $nameArray = explode('.',$name);
                $fileName = $nameArray[0];
                $fileExt = $nameArray[1];
                $mime = explode('/',$_FILES['photo']['type'][$i]);
                $mimeType = $mime[0];
                $mimeExt = $mime[1];
                $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
                $fileSize = $_FILES['photo']['size'][$i];
                $uploadName = md5(microtime().$i).'.'.$fileExt;
                $uploadPath[] = BASEURL.'images/products/'.$uploadName;
                if($i != 0){
                  $dbPath .= ',';
                }
                $dbPath .= '/Baine/images/products/'.$uploadName;
          //validation for file upload
            if($mimeType != 'image'){
              $errors[] = 'The file must be an image.';
            }
          //allowed file extensions
            if(!in_array($fileExt, $allowed)){
              $errors[] = 'Submitted file extension is not acceptable, the photo must be .png, .jpg, .jpeg or .gif.';
            }
          //allowed file size
              if ($fileSize >15000000 ){
                $errors[] = 'The files size must be under 10MB.';
              }
           //if fileExt = mimeExt
           if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg' )) {
             $errors[] = 'File extension does not match the file.';
           }
       }
 }
    if(empty($errors)){
      //UPLOAD FILE AND INSERT INTO DATABASE
      if($photoCount > 0){
        for($i = 0; $i < $photoCount; $i++){
            move_uploaded_file($tmpLoc[$i],$uploadPath[$i]);
        }
      }

    $insertSql = "INSERT INTO products (`title`, `price`, `list_price`,`brand`,`categories`, `parent`,`sizes`,`image`,`name`,`description`)
      VALUES ('$title','$price','$list_price','$brand','$category', '$parent','$sizes','$dbPath','$vendor', '$description')";
      if(isset($_GET['edit'])){
        $insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand  = '$brand', categories = '$category', parent = '$parent', sizes = '$sizes', image = '$dbPath', name = '$vendor', description = '$description' WHERE id = '$edit_id'";
      }
      $db->query($insertSql);
      echo '<script>location.replace("products.php");</script>';
    }
  }

 ?>
