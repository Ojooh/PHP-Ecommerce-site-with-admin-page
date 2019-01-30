<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
    include 'includes/head.php';

      //instantiate variables
        $email = ((isset($_POST['email2']))?sanitize($_POST['email2']):'');
        $email = trim($email);
        $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
        $password = trim($password);
        $errors = array();
        if($_POST){
            //validate email
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
              $errors[] = 'You must enter a valid email';
            }
            //if user email exists in database
            $query = $db->query("SELECT * FROM userlogin WHERE email = '$email'");
            $customer = mysqli_fetch_assoc($query);
            $customerCount = mysqli_num_rows($query);
            if($customerCount < 1){
              $errors[] = 'That email doesn\'t exist in our database.';
            }

            //VALIDATE Password
            if(!password_verify($password, $customer['password'] )){
              $errors[] = 'Incorrect Password, Please try again!';
            }

            if(empty($errors)){
              //log user in
              $customer_id = $customer['id'];
              login3($customer_id);
            }
          }
      ?>




      <div id="login-form">
        <div></div>
        <h2 class="text-center">Login</h2><hr>
        <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="email2">Email</label>
            <input type="email" name="email2" id="email2" class="form-control" value="<?= $email; ?>">
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
          </div>
          <div class="form-group move">
            <input class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit" value="Login">
          </div>
          </form>
          <p class="text-center"><a href="#">Forgot your password?</a></p>
          <hr class="move">
          <div class="have-account">
              <p class="text-center">Don't have an Account?</p>
          </div>
          <a href="signup.php" class="btn btn-outline-secondary size-121 move">Create One Now.</a>


      </div>




<?php include 'includes/footer.php'; ?>
