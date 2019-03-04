<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';
    //include 'includes/cart.php';


    if(isset($_GET['id'])){
      $id = sanitize($_GET['id']);
    }else{
      $id = '';
    }

    //$id = $_POST['id'];
    $id = (int)$id;
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $db->query($sql);
    $product = mysqli_fetch_assoc($result);
    $brand_id = $product['brand'];
    $sql1 = "SELECT brand FROM brand WHERE id = '$brand_id'";
    $result1 = $db->query($sql1);
    $brand = mysqli_fetch_assoc($result1);
    $vendor_id = $product['name'];
    $sql2 = "SELECT * FROM vendors WHERE id = '$vendor_id'";
    $result2 = $db->query($sql2);
    $vendor = mysqli_fetch_assoc($result2);
    $sizestring = $product['sizes'];
    $sizestring = rtrim($sizestring,',');
    $size_array = explode(',', $sizestring);

?>

<?php
ob_start();

 ?>
 <!-- breadcrumb -->
 <div class="container">
   <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
     <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
       Home
       <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
     </a>

     <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
       Men
       <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
     </a>

     <span class="stext-109 cl4">
       <?= $product['title']; ?>
     </span>
   </div>
 </div>



 <!-- Product Detail -->
 <section class="sec-product-detail bg0 p-t-65 p-b-60">
   <div class="container">
     <div class="row">

       <div class="col-md-6 col-lg-7 p-b-30">
         <div class="p-l-25 p-r-30 p-lr-0-lg">
           <div class="wrap-slick3 flex-sb flex-w">
             <div class="wrap-slick3-dots"></div>
             <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

             <div class="slick3 gallery-lb">
               <?php
                       $photos = explode(',',$product['image']);
                       foreach($photos as $photo):
               ?>
               <div class="item-slick3" data-thumb="<?= $photo; ?>">
                 <div class="wrap-pic-w pos-relative">
                   <img src="<?= $photo; ?>" alt="IMG-PRODUCT">

                   <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $photo; ?>">
                     <i class="fa fa-expand"></i>
                   </a>
                 </div>
               </div>
               <?php endforeach; ?>
             </div>
           </div>
         </div>
       </div>

       <div class="col-md-6 col-lg-5 p-b-30">
         <div class="p-r-50 p-t-5 p-lr-0-lg">
           <h4 class="mtext-105 cl2 js-name-detail p-b-14">
             <input type="hidden" name="product_name" id = "product_name" value="<?= $product['title']; ?>">
             <?= $product['title']; ?>
           </h4>

           <p>Brand: <?= $brand['brand']; ?></p>

           <span class="mtext-106 cl2">
             &#8358;<?= money($product['price']); ?>
           </span>



           <p class="stext-102 cl3 p-t-23">
             <?= nl2br($product['description']); ?>
           </p>

           <span id="modal_errors" class="text-danger p-t-24 col-lg-12"></span>

           <!--  -->
           <form class="p-t-33" action="" id="add_product_form" method="post">
            <input type="hidden" name="product_id" value="<?= $id; ?>">
            <input type="hidden" name="available" id="available" value="">
            <input type="hidden" name="product_name" id = "product_name" value="<?= $product['title']; ?>">
             <div class="flex-w flex-r-m p-b-10">
               <div class="size-203 flex-c-m respon6">
                 Size
               </div>

               <div class="size-204 respon6-next">
                 <div class="rs1-select2 bor8 bg0">
                   <select class="js-select2" name="size" id="size">
                     <option>Choose your size</option>
                     <?php foreach($size_array as $string) {
                        $string_array = explode(':', $string);

                        $size = $string_array[0];
                        $available = $string_array[1];
                        if($available > 0){
                          echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
                        }

                  } ?>
                   </select>
                   <div class="dropDownSelect2"></div>
                 </div>
               </div>
             </div>

             <!--<div class="flex-w flex-r-m p-b-10">
               <div class="size-203 flex-c-m respon6">
                 Color
               </div>

               <div class="size-204 respon6-next">
                 <div class="rs1-select2 bor8 bg0">
                   <select class="js-select2" name="time">
                     <option>Choose an option</option>
                     <option>Red</option>
                     <option>Blue</option>
                     <option>White</option>
                     <option>Grey</option>
                   </select>
                   <div class="dropDownSelect2"></div>
                 </div>
               </div>
             </div>-->

             <div class="flex-w flex-r-m p-b-10">
               <div class="size-204 flex-w flex-m respon6-next p-t-23">
                 <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                   <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                     <i class="fs-16 zmdi zmdi-minus"></i>
                   </div>

                   <input class="mtext-104 cl3 txt-center num-product" type="number" id="quantity" name="quantity" placeholder="0" min="0">

                   <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                     <i class="fs-16 zmdi zmdi-plus"></i>
                   </div>
                 </div>
                 <br>

                 <button type="button" class="flex-c-m stext-101 cl0 size-102 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-js-addcart-detail" onclick="add_to_cart()">
                   Add to cart
                 </button>
               </div>
             </div>
           </form>

           <!--  -->
           <div class="p-r-50 p-t-5 p-lr-0-lg">
             <span class="mtext-10 cl2 p-l-100 p-t-50">
               Vendor Contact details:
             </span>
           </div>
           <div class="flex-w flex-m p-l-100 p-t-2 respon7">
             <form class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" action="add_wish-list.php">
               <a href="#" class="btn-addwish-b2 dis-block pos-relative" onclick="add_to_wish_list('<?= $product['id']; ?>', '<?= $product['sizes']; ?>'); return false">
                 <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                 <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
               </a>
             </form>
             <?php $pie = "107025647214362907876"; ?>

             <a href="https://www.facebook.com/<?= $vendor['facebook']; ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
               <i class="fa fa-facebook"></i>
             </a>

             <a href="https://instagram.com/<?= $vendor['instagram']; ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
               <i class="fa fa-instagram"></i>
             </a>

             <a href="https://plus.google.com/<?= $pie; ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
               <i class="fa fa-google-plus"></i>
             </a>
           </div>
         </div>
       </div>
     </div>

     <div class="bor10 m-t-50 p-t-43 p-b-40">
       <!-- Tab01 -->
       <div class="tab01">
         <!-- Nav tabs -->
         <ul class="nav nav-tabs" role="tablist">
           <li class="nav-item p-b-10">
             <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
           </li>

           <!-- <li class="nav-item p-b-10">
             <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
           </li> -->

           <li class="nav-item p-b-10">
             <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
           </li>
         </ul>

         <!-- Tab panes -->
         <div class="tab-content p-t-43">
           <!-- - -->
           <div class="tab-pane fade show active" id="description" role="tabpanel">
             <div class="how-pos2 p-lr-15-md">
               <p class="stext-102 cl6">
                 <?= nl2br($product['description']); ?>
               </p>
             </div>
           </div>

           <!-- - -->
           <!-- <div class="tab-pane fade" id="information" role="tabpanel">
             <div class="row">
               <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                 <ul class="p-lr-28 p-lr-15-sm">
                   <li class="flex-w flex-t p-b-7">
                     <span class="stext-102 cl3 size-205">
                       Weight
                     </span>

                     <span class="stext-102 cl6 size-206">
                       0.79 kg
                     </span>
                   </li>

                   <li class="flex-w flex-t p-b-7">
                     <span class="stext-102 cl3 size-205">
                       Dimensions
                     </span>

                     <span class="stext-102 cl6 size-206">
                       110 x 33 x 100 cm
                     </span>
                   </li>

                   <li class="flex-w flex-t p-b-7">
                     <span class="stext-102 cl3 size-205">
                       Materials
                     </span>

                     <span class="stext-102 cl6 size-206">
                       60% cotton
                     </span>
                   </li>

                   <li class="flex-w flex-t p-b-7">
                     <span class="stext-102 cl3 size-205">
                       Color
                     </span>

                     <span class="stext-102 cl6 size-206">
                       Black, Blue, Grey, Green, Red, White
                     </span>
                   </li>

                   <li class="flex-w flex-t p-b-7">
                     <span class="stext-102 cl3 size-205">
                       Size
                     </span>

                     <span class="stext-102 cl6 size-206">
                       XL, L, M, S
                     </span>
                   </li>
                 </ul>
               </div>
             </div>
           </div> -->

           <!-- - -->
<?php
    $reviewsql = "SELECT * FROM reviews WHERE id = '$id'";
    $reviewresult = $db->query($reviewsql);
    $count = 0;


    if(is_logged_in3()){
      $name57 = ((isset($_POST['name57']))?sanitize($_POST['name57']): $customer_data['name']);
      $email57 = ((isset($_POST['email57']))?sanitize($_POST['email57']): $customer_data['email']);
      $review57 = ((isset($_POST['review57']))?sanitize($_POST['review57']):'');
      $rating = ((isset($_POST['rating']))?sanitize($_POST['rating']):'');
    }
    else{
      $name57 = ((isset($_POST['name57']))?sanitize($_POST['name57']):'');
      $email57 = ((isset($_POST['email57']))?sanitize($_POST['email57']):'');
      $review57 = ((isset($_POST['review57']))?sanitize($_POST['review57']):'');
      $rating = ((isset($_POST['rating']))?sanitize($_POST['rating']):'');
    }
    $errors = array();
    if($_POST){
      //echo "<script>alert(\"it woks\");</script>";

      $required = array('name57', 'rating', 'email57', 'review57' );
      foreach($required as $field){
        if($_POST[$field] == ''){
          $errors[] .= 'All * fields are required';
          break;
        }
      }
      if($rating == 0){
        $errors[] .= 'NO RATING SUBMITTED, Please rate this product.';
      }
      if(!empty($errors)){
        echo "<span class=\"text-danger p-t-24 col-lg-12\">". display_errors2($errors). "</span>" ;
      }


      if(empty($errors)){
        //echo $rating;
        // $name57 = $_POST['name57'];
        // $email57 = $_POST['email57'];
        // $review57 = $_POST['review57'];
        // $rating = $_POST['rating'];
          $d = (int)$id;
          $insertSql79 = "INSERT INTO reviews (`id`, `name`, `email`, `rating`, `review`) VALUES ('$d', '$name57', '$email57', '$rating', '$review57')";
          $db->query($insertSql79);
          echo '<script>location.replace("products.php");</script>';
      }
    }

?>

           <div class="tab-pane fade" id="reviews" role="tabpanel">
             <div class="row">
               <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                 <div class="p-b-30 m-lr-15-sm">
                   <!-- Review -->
          <?php while($review = mysqli_fetch_assoc($reviewresult)) : ?>
                   <div class="flex-w flex-t p-b-68">
                     <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                       <img src="images/avatar-01.jpg" alt="AVATAR">
                     </div>

                     <div class="size-207">
                       <div class="flex-w flex-sb-m p-b-17">
                         <span class="mtext-107 cl2 p-r-20">
                           <?= $review['name']; ?>
                         </span>

                         <span class="fs-18 cl11">
                      <?php   $rate = 1;
                              $num = $review['rating'];
                              while($rate <= $num) : ?>
                                <i class="zmdi zmdi-star"></i>
                            <?php $rate++; endwhile; ?>

                        <?php   $c = 1;
                                $rem = 5 - $num;
                                while($c  <= $rem): ?>
                                  <i class="zmdi zmdi-star-outline"></i>
                            <?php $c++; endwhile; ?>

                              </span>

                       </div>

                       <p class="stext-102 cl6">
                         <?= $review['review']; ?>
                       </p>
                     </div>
                   </div>
            <?php

                $count++;
                if ($count == 3){break;}
                endwhile;
            ?>

                   <!-- Add review -->
                   <form class="w-full" action="product-detail.php?id=<?= $id; ?>" method="POST">
                     <h5 class="mtext-108 cl2 p-b-7">
                       Add a review
                     </h5>

                     <p class="stext-102 cl6">
                       Your email address will not be published. Required fields are marked *

                     </p>

                     <div class="flex-w flex-m p-t-50 p-b-23">
                       <span class="stext-102 cl3 m-r-16">
                         Your Rating* :
                       </span>

                       <span class="wrap-rating fs-18 cl11 pointer">
                         <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                         <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                         <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                         <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                         <i class="item-rating pointer zmdi zmdi-star-outline"></i>

                         <input class="" type="" name="rating" id="rating" value="">


                       </span>
                     </div>

                     <div class="row p-b-25">
                       <div class="col-12 p-b-5">
                         <label class="stext-102 cl3" for="review57">Your review* :</label>
                         <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review57" name="review57"><?= $review57; ?></textarea>
                       </div>

                       <div class="col-sm-6 p-b-5">
                         <label class="stext-102 cl3" for="name57">Name* : </label>
                         <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name57" type="text" name="name57" value="<?= $name57; ?>">
                       </div>

                       <div class="col-sm-6 p-b-5">
                         <label class="stext-102 cl3" for="email57">Email* :</label>
                         <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email57" type="email" name="email57" value="<?= $email57; ?>">
                       </div>
                     </div>

                     <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                       Submit
                     </button>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
     <span class="stext-107 cl6 p-lr-25">
       SKU: JAK-01
     </span>

     <span class="stext-107 cl6 p-lr-25">
       Categories: Jacket, Men
     </span>
   </div>
 </section>


 <?php
        echo ob_get_clean();
       include 'includes/footer.php';

   ?>
