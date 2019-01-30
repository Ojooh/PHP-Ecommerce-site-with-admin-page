<?php
//edit Product
  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $editresult = $db->query("SELECT * FROM users WHERE id = '$edit_id'");
    $edit = mysqli_fetch_assoc($editresult);
    if(isset($_GET['delete_image'])){
      $image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];echo $image_url;
      unlink($image_url);
      $db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
      header('Location: users.php?edit='.$edit_id);
    }
    $name = ((isset($_POST['name']))?sanitize($_POST['name']):$edit['full_name']);
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):$edit['email']);
    $occ = ((isset($_POST['Occupation']))?sanitize($_POST['Occupation']):$edit['Occupation']);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):$edit['password']);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):$edit['password']);
    $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):$edit['permissions']);
    $number = ((isset($_POST['number']))?sanitize($_POST['number']):$edit['number']);
    $edit_sql = "SELECT * FROM users WHERE id = '$edit_id'";
    $edit_result = $db->query($edit_sql);
    $edit_users = mysqli_fetch_assoc($edit_result);
    $saved_image = (($product['image'] != '')?$product['image']:'');
    $dbPath = $saved_image;

  }




//validate form
if($_POST){

  //check if email exits in database
 $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email' AND full_name = '$name'");
 $emailCount = mysqli_num_rows($emailQuery);
  if($emailCount != 0){
    $errors[] ='This email already exists in our database';}



  //make sure every field is filled
  $required = array('name', 'email', 'number', 'password', 'confirm', 'permissions');
  foreach($required as $f){
    if(empty($_POST[$f])){
      $errors[] = 'Must fill out all fields.';
      break;
    }
  }
  //if password is more than 8 characters
  if(strlen($password)< 8){
    $errors[] = 'Invalid Password entered, password must be at least 8 characters Long.';
  }

  //if password and confirmed password entered match
  if($password != $confirm){
    $errors[] = 'Please confirm your new pasword correctly they do not match';
  }

  //validate email
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[] = 'Plase enter a Valid Email address';
  }

  if (!empty($_FILES)) {

    $photo = $_FILES['photo'];
    $pname = $photo['name'];
    $nameArray = explode('.',$pname);
    $fileName = $nameArray[0];
    $fileExt = $nameArray[1];
    $mime = explode('/',$photo['type']);
    $mimeType = $mime[0];
    $mimeExt = $mime[1];
    $tmpLoc = $photo['tmp_name'];
    $fileSize = $photo['size'];
    $allowed = array('png','jpg','jpeg','gif');
    $uploadName = md5(microtime()).'.'.$fileExt;
    $uploadPath = BASEURL.'admin2/img/profile_pic/'.$uploadName;
    $dbPath = '/Baine/admin2/img/profile_pic/'.$uploadName;

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

  //to display errors
  if(empty($errors)){
    //UPLOAD FILE AND INSERT INTO DATABASE
    if(!empty($_FILES)){
        move_uploaded_file($tmpLoc,$uploadPath);
    }
    //Add user to database
    $hashed = password_hash($password,PASSWORD_DEFAULT);
    $updatesql3 = "INSERT INTO users (`full_name`,`email`,`Occupation`,`password`,`permissions`,`number`,`images`) VALUES ('$name','$email','$occ','$hashed','$permissions','$number','$dbPath')";
    if(isset($_GET['edit'])){
      $updatesql3 = "UPDATE users SET full_name = '$name', email = '$email', Occupation = '$occ', password = '$password', permissions  = '$permissions', number = '$number', images = '$dbPath' WHERE id = '$edit_id'";
      //$db->query($updatesql3);
      //$_SESSION['success_flash'] = 'User Details have been updated';
      //header('Location: users.php');
    }
    $db->query($updatesql3);
    $_SESSION['success_flash'] = 'User has been added';
    //header('Location: users.php');
  }
}
?>
