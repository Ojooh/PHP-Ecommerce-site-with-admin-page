<?php
    $user_no = $customer_id;
    $userresult = $db->query("SELECT * FROM userlogin WHERE id = '$user_no'");
    $userproduct = mysqli_fetch_assoc($userresult);
    $sn = explode(' ', $userproduct['name']);
    $name['first'] = $sn[0];
    $name['last'] = $sn[1];
    $fname = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$name['first']);
    $lname = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$name['last']);
    $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$userproduct['email']);
    $password = ((isset($_POST['password']) && $_POST['password'] != '' )?sanitize($_POST['password']):'');
    $npassword = ((isset($_POST['npassword']) && $_POST['npassword'] != '' )?sanitize($_POST['npassword']):'');
    $confirm = ((isset($_POST['confirm']) && $_POST['confirm'] != '' )?sanitize($_POST['confirm']):'');
    $errors = array();
    $name = $fname. " " .$lname;
    if($_POST){
      $required = array('fname','lname', 'email');
      foreach($required as $f){
        if(empty($_POST[$f])){
          $errors[] = 'Must fill out all fields.';
          break;
        }
      }

      if($password != ''){

          if(!password_verify($password, $userproduct['password'] )){
            $errors[] = 'Incorrect Password, Please try again!';
          }

          $required = array('npassword','confirm');
          foreach($required as $f){
            if(empty($_POST[$f])){
              $errors[] = 'Must fill out all fields.';
              break;
            }
          }

          if($npassword != $confirm){
            $errors[] = 'Password do not match, Please try again!';
          }

          if(empty($errors)){
            $hashed = password_hash($npassword,PASSWORD_DEFAULT);
            $fname = sanitize($_POST['fname']);
            $lname = sanitize($_POST['lname']);
            $email = sanitize($_POST['email']);
            $name = $fname. " " .$lname;
            $updatesql3 = "UPDATE userlogin SET name = '$name', email = '$email', password = '$hashed' WHERE id = '$user_no'";
            $db->query($updatesql3);

        }
        echo '<script>location.replace("account.php")</script>';
      }


    }

    ?>
<?php if(isset($_GET['add'])): ?>
  <div id="account-information" class="tab-pane">
<?php else: ?>
  <div id="account-information" class="tab-pane active">
<?php endif; ?>
      <h4 class="mtext-109 cl2 m-t-9 m-b-15 p-t-20">
        Account Information
      </h4><hr>
      <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>
      <form class="container" action="account.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="fname"> First Name: </label>
          <input type="text" name="fname" id="fname" class="form-control" value="<?= $fname; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="lname"> Last Name: </label>
          <input type="text" name="lname" id="lname" class="form-control" value="<?= $lname; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="email"> Emai Address: </label>
          <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="password"> Password: </label>
          <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="npassword"> New Password: </label>
          <input type="password" name="npassword" id="npassword" class="form-control" value="<?= $npassword; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="confirm"> Confirm Password: </label>
          <input type="password" name="confirm" id="confirm" class="form-control" value="<?= $confirm; ?>">
        </div>
        <div class="form-group col-md-6 text-right vida" >

          <input type="submit" value="Save Changes" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
        </div>
      </div>
      </form>
    </div>
