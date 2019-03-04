<?php
//edit Product
  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $editresult = $db->query("SELECT * FROM vendors WHERE id = '$edit_id'");
    $edit = mysqli_fetch_assoc($editresult);
    $fn = explode(' ', $edit['name']);
    $edit['first'] = $fn[0];
    $edit['last'] = $fn[1];
    $fname = ((isset($_POST['first']))?sanitize($_POST['first']):$edit['first']);
    $lname = ((isset($_POST['last']))?sanitize($_POST['last']):$edit['last']);
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):$edit['email']);
    $number = ((isset($_POST['number']))?sanitize($_POST['number']):$edit['number']);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):$edit['password']);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):$edit['password']);
    $facebook = ((isset($_POST['facebook']))?sanitize($_POST['facebook']):$edit['facebook']);
    //$twitter = ((isset($_POST['twitter']))?sanitize($_POST['twitter']):$edit['twitter']);
    $instagram = ((isset($_POST['instagram']))?sanitize($_POST['instagram']):$edit['instagram']);
    //$snapchat = ((isset($_POST['snapchat']))?sanitize($_POST['snapchat']):$edit['snapchat']);
    //$edit_sql = "SELECT * FROM users WHERE id = '$edit_id'";
    //$edit_result = $db->query($edit_sql);
    //$edit_users = mysqli_fetch_assoc($edit_result);
    $required = array('fname', 'lname', 'email', 'number', 'password', 'confirm', 'facebook', 'instagram');
    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All asteriked(*) fields are required';
        break;
      }
    }
    //validate email

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors[] = 'You must enter a valid email';
    }

    //password is more than 8 characters

    if(strlen($password) < 6){
      $errors[] = 'Invalid Password entered, password must be at least 6 characters Long.';
    }

    if(strlen($number) < 11){
      $errors[] = 'Invalid Phone Number entered, Phone Number must be at least 11 characters Long.';
    }

    //if user email exists in database
    //$query = $db->query("SELECT * FROM vendors WHERE email = '$email' AND name = '$name'");
    //$user = mysqli_fetch_assoc($query);
    //$userCount = mysqli_num_rows($query);
    //if($userCount > 0){
      //$errors[] = 'That email already exist in our database.';
    //}
    //if password and confirm are not the same
    //if password and confirmed password entered match
    if($password != $confirm){
      $errors[] = 'Please confirm your new pasword correctly they do not match';
    }
if(empty($errors)){
  if(isset($_GET['edit'])){
    $insertSql = "UPDATE vendors SET `name` = '$name',`email` = '$email', `number` = `$number`, `password` = '$password', `facebook` = '$facebook', `twitter` = `$twitter`, `instagram` = '$instagram' WHERE id = '$edit_id'";
  }
  $db->query($insertSql);
  echo '<script>location.replace("vendors.php");</script>';

}
  }

//to post added values
  if ($_POST){
    //instantiate variables
    $fname = sanitize($_POST['fname']);
    $lname = sanitize($_POST['lname']);
    $name = $fname. " ".$lname;
    $email = sanitize($_POST['email']);
    $number = sanitize($_POST['number']);
    $password = sanitize($_POST['password']);
    $confirm = sanitize($_POST['confirm']);
    $facebook = sanitize($_POST['facebook']);
    $instagram = sanitize($_POST['instagram']);
    //check if input is blank
    $required = array('fname', 'lname', 'email', 'number', 'password', 'confirm', 'facebook', 'instagram');
    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All asteriked(*) fields are required';
        break;
      }
    }
    //validate email

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors[] = 'You must enter a valid email';
    }

    //password is more than 8 characters

    if(strlen($password) < 6){
      $errors[] = 'Invalid Password entered, password must be at least 6 characters Long.';
    }

    if(strlen($number) < 11){
      $errors[] = 'Invalid Phone Number entered, Phone Number must be at least 11 characters Long.';
    }

    //if user email exists in database
    $query = $db->query("SELECT * FROM vendors WHERE email = '$email' AND name = '$name'");
    $user = mysqli_fetch_assoc($query);
    $userCount = mysqli_num_rows($query);
    if($userCount > 0){
      $errors[] = 'That email already exist in our database.';
    }
    //if password and confirm are not the same
    //if password and confirmed password entered match
    if($password != $confirm){
      $errors[] = 'Please confirm your new pasword correctly they do not match';
    }
if(empty($errors)){
  //update database
  $hashed = password_hash($password,PASSWORD_DEFAULT);
  $insertSql = "INSERT INTO vendors (`name`, `email`, `number`,`password`, `facebook`,`instagram`)
  VALUES ('$name','$email','$number','$hashed', '$facebook', '$instagram')";
  if(isset($_GET['edit'])){
    $insertSql = "UPDATE vendors SET `name` = '$name',`email` = '$email', `number` = `$number`, `password` = '$hashed', `facebook` = '$facebook', `twitter` = `$twitter`, `instagram` = '$instagram' WHERE id = '$edit_id'";
  }
  $db->query($insertSql);
  echo '<script>location.replace("vendors.php");</script>';

}
}


 ?>
