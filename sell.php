<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navbar.php';

//initialize variables
$first_name = ((isset($_POST['first_name']))?sanitize($_POST['first_name']):'');
$last_name = ((isset($_POST['last_name']))?sanitize($_POST['last_name']):'');
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$number = ((isset($_POST['number']))?sanitize($_POST['number']):'');
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$facebook = ((isset($_POST['facebook']))?sanitize($_POST['facebook']):'');
$instagram = ((isset($_POST['instagram']))?sanitize($_POST['instagram']):'');
$errors = array();


//once submitted
if ($_POST){

  //instantiate variables submitted
  $first_name = sanitize($_POST['first_name']);
  $last_name = sanitize($_POST['last_name']);
  $name = $first_name . $last_name;
  $email = sanitize($_POST['email']);
  $number = sanitize($_POST['number']);
  $password = sanitize($_POST['password']);
  $confirm = sanitize($_POST['confirm']);
  $facebook = sanitize($_POST['facebook']);
  $instagram = sanitize($_POST['instagram']);

  //check if input is blank
  $required = array('first_name', 'last_name', 'email', 'number', 'password', 'confirm', 'facebook', 'instagram');
  foreach($required as $field){
    if($_POST[$field] == ''){
      $errors[] = 'All asteriked(*) fields are required';
      break;
    }
  }


  //validate email
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[] .= 'You must enter a valid email';
  }

  //password is more than 8 characters
  if(strlen($password) < 6){
    $errors[] .= 'Invalid Password entered, password must be at least 6 characters Long.';
  }

  //number is less than 11 digits
  if ((!is_numeric($number)) || (strlen((string)$number) < 11)){
    $errors[] .= 'Invalid Phone Number entered, Phone Number must be at least 11 characters Long.';
  }

  //if user email exists in database
  $query = $db->query("SELECT * FROM vendors WHERE email = '$email' AND name = '$name'");
  $user = mysqli_fetch_assoc($query);
  $userCount = mysqli_num_rows($query);
  if($userCount > 0){
    $errors[] .= 'That email already exist in our database.';
  }
  //if password and confirm are not the same
  if($password != $confirm){
    $errors[] .= 'Please confirm your new pasword correctly they do not match';
  }

  if(empty($errors)){
          //update database
          $hashed = password_hash($password,PASSWORD_DEFAULT);
          $insertSql = "INSERT INTO vendors (`name`, `email`, `number`,`password`, `facebook`,`instagram`)
          VALUES ('$name','$email','$number','$hashed', '$facebook', '$instagram')";
          $db->query($insertSql);
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("THANK YOU!","Your Account has been created, Proceed to your email for the verification Link !","success").then(function(){window.location.relplace("sell.php");});';
          echo '}, 1000);</script>';
          // echo '<script type="text/javascript">';
          // echo 'window.location.replace("index.php");';
          // echo '</script>';
  }

}



?>


<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
  <h2 class="ltext-105 cl0 txt-center">
    Sell on Baine
  </h2>
</section>

<h2 class="txt-center m-t-59">Join The Business Family Now!!</h2>


 <!-- Content page -->
 <section class="bg0 p-t-104 p-b-116">

   <div class="container-fluid padding mb-5">
     <div class="row padding">
      <div class="col-lg-3"></div>
       <div class="border border-dark rounded col-lg-6 p-lr-70 p-t-55 p-b-70 p-lr-15-lg txt-center">
         <form action="sell.php?add=1" method="post">
           <h4 class="mtext-105 cl2 txt-center p-b-30">
             Register Here
           </h4><hr>

           <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>

           <label for="first_name">First Name <span>*</span></label>
           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="first_name" id="first_name" value="<?= $first_name; ?>"  placeholder="Your Firs Name" required>
           </div>


           <label for="last_name">Last Name <span>*</span></label>
           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="last_name" id="last_name" value="<?= $last_name; ?>" placeholder="Your Last Name" required>
           </div>

             <label for="email">*Email</label>
             <div class="bor8 m-b-20 how-pos4-parent">
               <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Your Email" required>
             </div>

           <label for="number">*WhatsApp Phone Number</label>
           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="number" id="number" value="<?= $number; ?>" placeholder="Your WhatsApp Number" required>
           </div>


           <label for="password">*Password</label>
           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" id="password" value="<?= $password; ?>" placeholder="Password not less than 6 characters" required>
           </div>


           <label for="confirm">*Confirm Password</label>
           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="confirm" id="confirm" value="<?= $confirm; ?>" placeholder="Please Re-enter password" required>
           </div>

           <div class="form-row">
             <div class="form-group col-md-6">
               <label for="facebook">*Facebook</label>
               <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $facebook; ?>" placeholder="Enter Facebook Profile Name" required>
             </div>

             <div class="form-group col-md-6">
               <label for="instagram">*Instagram</label>
               <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $instagram; ?>" placeholder="Enter Instagram Handle" required>
             </div>
           </div>


           <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="submit" type="submit" id="contact-submit">
             Submit
           </button>
         </form>
         <p class="text-center label-link mt-5">Already have an account? <a href="Add_Products/index.php" alt="home">Sign In</a></p>
       </div>
      <div class="col-lg-3"></div>
    </div>
  </div>

 </section>



<?php
include 'includes/footer.php';
 ?>
