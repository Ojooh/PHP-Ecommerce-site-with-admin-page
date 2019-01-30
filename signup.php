<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
    include 'includes/head.php';

      //instantiate variables
        $fname = ((isset($_POST['fname']))?sanitize($_POST['fname']):'');
        $lname = ((isset($_POST['lname']))?sanitize($_POST['lname']):'');
        $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
        $number = ((isset($_POST['number']))?sanitize($_POST['number']):'');
        $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
        $cpassword = ((isset($_POST['cpassword']))?sanitize($_POST['cpassword']):'');
        $email = trim($email);
        $password = trim($password);
        $name = $fname. " " .$lname;
        $errors = array();

  //once submitted
  if ($_POST){

          //check if input is blank
          $required = array('fname', 'lname', 'email', 'number', 'password', 'cpassword');
          foreach($required as $field){
            if($_POST[$field] == ''){
              $errors[] = 'All fields are required';
              break;
            }
          }

            //validate email
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
              $errors[] = 'You must enter a valid email';
            }


            //if user email exists in database
            $query = $db->query("SELECT * FROM userlogin WHERE email = '$email' AND name = '$name'");
            $customer4 = mysqli_fetch_assoc($query);
            $customerCount4 = mysqli_num_rows($query);
            if($customerCount4 > 0){
              $errors[] = 'That email already exist in our database.';
            }

            //password is more than 8 characters
            if(strlen($password) < 4){
              $errors[] = 'Invalid Password entered, password must be at least 4 characters Long.';
            }

            //number is less than 11 digits
            if ((!is_numeric($quantity)) && (strlen($number) < 11)){
              $errors[] = 'Invalid Phone Number entered, Phone Number must be at least 11 characters Long.';
            }

            //if password and confirm are the same
            if($password != $cpassword){
              $errors[] = 'Please confirm your new pasword correctly they do not match';
            }

            if(empty($errors)){
              //log user in
                $hashed = password_hash($password,PASSWORD_DEFAULT);
                $insertSql1 = "INSERT INTO userlogin (`name`, `email`, `number`, `password`) VALUES ('$name', '$email', '$number', '$hashed')";
                $db->query($insertSql1);
                header('Location: login.php');
            }
          }
      ?>




      <div id="signup-form">
        <div></div>
        <h2 class="text-center">Create An Account</h2><hr>
        <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>
        <form action="signup.php" method="post">
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" class="form-control" value="<?= $fname; ?>">
          </div>
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" class="form-control" value="<?= $lname; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>">
          </div>
          <div class="form-group">
            <label for="number">Phone Number</label>
            <input type="text" name="number" id="number" class="form-control" value="<?= $number; ?>">
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
          </div>
          <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="form-control" value="<?= $cpassword; ?>">
          </div>
          <div class="form-group move">
            <input class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit" value="signup">
          </div>
          </form>
          <hr class="move">
          <div class="have-account">
              <p class="text-center"Already have an Account?</p>
          </div>
          <a href="login.php" class="btn btn-outline-secondary size-121">Log In.</a>


      </div>




<?php include 'includes/footer.php'; ?>
