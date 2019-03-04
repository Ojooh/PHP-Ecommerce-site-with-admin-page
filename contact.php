<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';


    $name =((isset($_POST['name']) && $_POST['name'] != '' )?sanitize($_POST['name']):'');
    $email =((isset($_POST['email']) && $_POST['email'] != '' )?sanitize($_POST['email']):'');
    $message =((isset($_POST['message']) && $_POST['message'] != '' )?sanitize($_POST['message']):'');
    $name_error = $email_error= $subject_error= $message_error = "";
    $success = "";

    if ($cart_id != ''){
      $cartQ2 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart2 = mysqli_fetch_assoc($cartQ2);
      $items = json_decode($cart2['items'], true);
      $i = 1;
      $sub_total = 0;
      $item_count = 0;
    }

    if($_POST){


          if(empty($_POST['name'])){
              $name_error = 'Your Name is required';
          }
          if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
              //check if name has only letters and whitespace
                $name_error = "Only letters and white space allowed";
          }
          else{
            $name = sanitize($_POST['name']);
          }

        if (empty($_POST["email"])) {
          $email_error = "Your Email is required";
        }
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_error = "Invalid email format";
        } else {
          $email = sanitize($_POST["email"]);
        }

      if (empty($_POST["message"])) {
        $message_error = "Please Enter Your Message";
      } else {
        $message = sanitize($_POST["message"]);
      }



      if ($name_error == '' and $email_error == '' and $subject_error == '' and $message_error == '' ){
          $to = 'davidmatthew708@gmail.com';
          $header = "From: ".$email;
          $email_subject = "CUSTOMER COMPLAINT OR ENQUIRY";
          $message_body = "You have recieved an email from ". $name.".\n\n".$message;
          if(mail($to, $email_subject, $message_body, $header)){
            $success = '<p class="text-center alert alert-success">Message sent, thank you for contacting us!</p>';
            $name = $email = $subject = $message =  '';
            header('Location: contact.php?');
          }


              }
    }

 ?>

 <!-- Title page -->
 <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
   <h2 class="ltext-105 cl0 txt-center">
     Contact Us
   </h2>
 </section>


 <!-- Content page -->
 <section class="bg0 p-t-104 p-b-116">
   <div class="container">
     <div class="flex-w flex-tr">
       <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
         <form action="contact.php?contact=1" method="post">
           <h4 class="mtext-105 cl2 txt-center p-b-30">
             Send Us A Message
           </h4>

           <span id="message" class="text-danger p-t-24 col-lg-12"><?= $success; ?></span>

           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" id="name" value="<?= $name; ?>" placeholder="Your Name">
             <img class="how-pos4 pointer-none" src="images/icons/icon-user.png" alt="ICON" width="22" height="22">
           </div>
           <span class="text-danger"><?= $name_error; ?></span>

           <div class="bor8 m-b-20 how-pos4-parent">
             <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" id="email" aria-describedby="emailHelp" value="<?= $email; ?>" placeholder="Your Email Address">
             <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
           </div>
           <span class="text-danger"><?= $email_error; ?></span>

           <div class="bor8 m-b-30">
             <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" id="message" name="message" value="<?= $message; ?>" placeholder="How Can We Help?"></textarea>
             <span class="text-danger"><?= $message_error; ?></span>
           </div>


           <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="submit" type="submit" id="contact-submit">
             Submit
           </button>
         </form>
       </div>

       <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
         <div class="flex-w w-full p-b-42">
           <span class="fs-18 cl5 txt-center size-211">
             <span class="lnr lnr-map-marker"></span>
           </span>

           <div class="size-212 p-t-2">
             <span class="mtext-110 cl2">
               Address
             </span>

             <p class="stext-115 cl6 size-213 p-t-18">
               Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
             </p>
           </div>
         </div>

         <div class="flex-w w-full p-b-42">
           <span class="fs-18 cl5 txt-center size-211">
             <span class="lnr lnr-phone-handset"></span>
           </span>

           <div class="size-212 p-t-2">
             <span class="mtext-110 cl2">
               Lets Talk
             </span>

             <p class="stext-115 cl1 size-213 p-t-18">
               +1 800 1236879
             </p>
           </div>
         </div>

         <div class="flex-w w-full">
           <span class="fs-18 cl5 txt-center size-211">
             <span class="lnr lnr-envelope"></span>
           </span>

           <div class="size-212 p-t-2">
             <span class="mtext-110 cl2">
               Sale Support
             </span>

             <p class="stext-115 cl1 size-213 p-t-18">
               baine@gmail.com
             </p>
           </div>
         </div>

         <div class="flex-w w-full p-b-42 mt-4">
           <span class="fs-18 cl5 txt-center size-211">
             <span class="lnr lnr-phone-handset"></span>
           </span>

           <div class="size-212 p-t-2">
             <span class="mtext-110 cl2">
               Social Media Link
             </span>

             <p class="stext-115 cl1 size-213 p-t-18">
                 <a href="https://www.facebook.com/baine" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                   <i class="fa fa-facebook"></i>
                 </a>

                 <a href="https://instagram.com/baine" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                   <i class="fa fa-instagram"></i>
                 </a>

                 <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                   <i class="fa fa-twitter"></i>
                 </a>

                 <a href="https://plus.google.com/" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                   <i class="fa fa-google-plus"></i>
                 </a>
             </p>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>






 <?php
    include 'includes/footer.php';
  ?>
