<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  include 'includes/head.php';

  //instantiate variables
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $email = trim($email);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    $errors = array();

    //login button clicked
    include 'ecode/login_form_submitted.php';

  ?>
  <div class="container">

    <form class="login-form" action="login.php" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>" placeholder="Email Address" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>" placeholder="Password">
        </div>
        <!--<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>-->
        <div class="form-group">
          <input type="submit" value="Login" class="btn btn-primary btn-lg btn-block">
        </div>
        <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
        <p class="text-right mt-5"><a href="/Baine/index.php" alt="home">Visit Site</a></p>
      </div>
    </form>





  <?php include 'includes/footer.php'; ?>
