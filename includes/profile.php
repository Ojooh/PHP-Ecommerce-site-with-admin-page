<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  $email2 = ((isset($_POST['email2']))?sanitize($_POST['email2']):'');
  $email2 = trim($email2);
  $password4 = ((isset($_POST['password4']))?sanitize($_POST['password4']):'');
  $password4 = trim($password4);
  $errors = array();
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
    if(!password_verify($password4, $user['password'] )){
      $errors[] = 'Incorrect Password, Please try again!';
    }

    //check for $errors
    if(empty($errors)){
        //log user in
        $user_id = $user['id'];
        login($user_id);
      }
    }


  ?>


?>
<!-- profile -->
<div class="wrap-header-profile js-panel-profile">
  <div class="s-full js-hide-profile"></div>

  <div class="header-profile flex-col-l p-l-5 p-r-5">
    <div class="header-profile-title flex-w flex-sb-m p-b-45 m-l-15">
      <span class="mtext-103 cl2">
        <i class="zmdi zmdi-account-o zmdi-hc-3x p-r-35"></i>
        Login
      </span>

      <div class="fs-35 lh-10 cl2 p-lr pointer hov-cl1 trans-04 js-hide-profile">
        <i class="zmdi zmdi-close"></i>
      </div>
    </div>

    <div class="header-profile-content container flex-w js-pscroll">
      <?php if(!empty($errors)){
        echo display_errors($errors);
      }
      ?>
    <span id="sidebar_errors" class="text-danger p-t-2 col-lg-12"></span>
      <div class="header-profile-wrapitem w-full m-t-25" id="login_form">
        <div class="bor8 m-b-45 how-pos4-parent">
          <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email2" id="email2" aria-describedby="emailHelp" value="<?= $email2; ?>" placeholder="Your Email Address">
          <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
        </div>

        <div class="bor8 m-b-45 how-pos4-parent">
          <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password4" id="password4" value="<?= $password4; ?>" placeholder="Your Password...">
          <img class="how-pos4 pointer-none" src="images/icons/icon-password.png" alt="ICON" width="22" height="22">
        </div>

        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
          Submit
        </button>

      </div>
      <!--<ul class="header-profile-wrapitem w-full">
        <li class="header-profile-item flex-w flex-t m-b-12">


          <div class="header-profile-item-img">
            <img src="images/item-profile-01.jpg" alt="IMG">
          </div>

          <div class="header-profile-item-txt p-t-8">
            <a href="#" class="header-profile-item-name m-b-18 hov-cl1 trans-04">
              White Shirt Pleat
            </a>

            <span class="header-profile-item-info">
              1 x $19.00
            </span>
          </div>
        </li>


      </ul>-->
      <div class="header-profile-total">
        <div class="header-profile-total-text text-center">
          Don’t have an account? <a href="/Baine/signup.php">Sign Up</a>
        </div>
      </div>
    </div>
  </div>

</div>
