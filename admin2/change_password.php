<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  include 'includes/head.php';

  //instantiate variables
    $hashed = $user_data['password'];
    $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
    $old_password = trim($old_password);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_DEFAULT);
    $user_id = $user_data['id'];
    $errors = array();

    //login button clicked
    include 'ecode/cp_form_submitted.php';

  ?>
  <div class="container">

    <form class="login-form" action="change_password.php" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <label for="old_password">Old Password:</label>
          <input type="password" name="old_password" id="old_password" class="form-control" value="<?= $old_password; ?>">
        </div>
        <div class="input-group">
          <label for="password"> New Password:</label>
          <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
        </div>
        <div class="input-group">
          <label for="confirm">Confirm New Password:</label>
          <input type="password" name="confirm" id="confirm" class="form-control" value="<?= $confirm; ?>">
        </div>
        <!--<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>-->
        <div class="form-group">
          <a href="index.php" class="btn btn-default">Cancel</a>
          <input type="submit" value="Change Password" class="btn btn-primary">
        </div>
        <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
        <p class="text-right mt-5"><a href="/Baine/index.php" alt="home">Visit Site</a></p>
      </div>
    </form>





  <?php include 'includes/footer.php'; ?>
