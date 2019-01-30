<?php
//edit Product
  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $productresult = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
    $product = mysqli_fetch_assoc($productresult);
    if(isset($_GET['delete_image'])){
      $image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];echo $image_url;
      unlink($image_url);
      $db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
      header('Location: products.php?edit='.$edit_id);
    }
    $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);
    $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
    $brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$product['brand']);
    $vendor = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$product['name']);
    $parentQuery2 = $db->query("SELECT * FROM categories WHERE id = '$category'");
    $parentResult = mysqli_fetch_assoc($parentQuery2);
    $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
    $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
    $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):$product['list_price']);
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
    foreach($sizesArray as $ss){
      $s = explode(':', $ss);
      $sArray[] = $s[0];
      $qArray[] = $s[1];
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
    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All asteriked(*) fields are required';
        break;
      }
    }
    //if upload file is empty
    if (!empty($_FILES)) {

      $photo = $_FILES['photo'];
      $name = $photo['name'];
      $nameArray = explode('.',$name);
      $fileName = $nameArray[0];
      $fileExt = $nameArray[1];
      $mime = explode('/',$photo['type']);
      $mimeType = $mime[0];
      $mimeExt = $mime[1];
      $tmpLoc = $photo['tmp_name'];
      $fileSize = $photo['size'];
      $allowed = array('png','jpg','jpeg','gif');
      $uploadName = md5(microtime()).'.'.$fileExt;
      $uploadPath = BASEURL.'images/products/'.$uploadName;
      $dbPath = '/Baine/images/products/'.$uploadName;

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
    if(empty($errors)){
      //UPLOAD FILE AND INSERT INTO DATABASE
      if(!empty($_FILES)){
          move_uploaded_file($tmpLoc,$uploadPath);
      }

    $insertSql = "INSERT INTO products (`title`, `price`, `list_price`,`brand`,`categories`,`sizes`,`image`,`name`,`description`)
      VALUES ('$title','$price','$list_price','$brand','$category','$sizes','$dbPath','$vendor', '$description')";
      if(isset($_GET['edit'])){
        $insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand  = '$brand', categories = '$category', sizes = '$sizes', image = '$dbPath', name = '$vendor', description = '$description' WHERE id = '$edit_id'";
      }
      $db->query($insertSql);
      header('Location: products.php');
    }
  }

 ?>
