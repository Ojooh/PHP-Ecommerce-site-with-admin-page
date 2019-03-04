<?php
  if($_POST){
    //form validation
    if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
      $errors[] = 'Please Fill out all Fields.';
    }

    //password is more than 8 characters
    if(strlen($password) < 6){
      $errors[] = 'Invalid Password entered, password must be at least 8 characters Long.';
    }

    //if new password matches confirmed password
      if($password != $confirm){
        $errors[] = 'Please confirm your new pasword correctly they do not match';
      }


    //VALIDATE Password
    if(!password_verify($old_password, $hashed )){
      $errors[] = 'Old Password is Incorrect, Please try again!';
    }

    //check for $errors
    if(!empty($errors)){
      echo display_errors($errors);
    }
    else{
      //change password
        $db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'");
        $_SESSION['success_flash'] = 'Your password has been updated!';
        echo '<script>location.replace("index.php");</script>';
    }
  }


?>
