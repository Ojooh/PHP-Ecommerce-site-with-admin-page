<?php
if($_POST){
  //form validation
  if(empty($_POST['email']) || empty($_POST['password'])){
    $errors[] = 'You must provide an email and password.';
  }

  //validate email
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[] = 'You must enter a valid email';
  }

  //password is more than 8 characters
  if(strlen($password) < 6){
    $errors[] = 'Invalid Password entered, password must be at least 6 characters Long.';
  }

  //if user email exists in database
  $query = $db->query("SELECT * FROM users WHERE email = '$email'");
  $user = mysqli_fetch_assoc($query);
  $userCount = mysqli_num_rows($query);
  if($userCount < 1){
    $errors[] = 'That email doesn\'t exist in our database.';
  }

  //VALIDATE Password
  if(!password_verify($password, $user['password'] )){
    $errors[] = 'Incorrect Password, Please try again!';
  }

  //check for $errors
  if(!empty($errors)){
    echo display_errors($errors);
  }else{
      //log user in
      $user_id = $user['id'];
      login($user_id);
    }
  }


?>
