<!-- wish-list -->
<div class="wrap-header-wish-list js-panel-wish-list">
 <div class="s-full js-hide-wish-list"></div>

 <div class="header-wish-list flex-col-l p-l-65 p-r-25">
   <div class="header-wish-list-title flex-w flex-sb-m p-b-8">
     <span class="mtext-103 cl2">
       wish-list
     </span>

     <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wish-list">
       <i class="zmdi zmdi-close"></i>
     </div>
   </div>

   <?php  if($wish_id == '' || $wish4 === NULL): ?>
   <span class="mtext-103 cl2">
     Your Wish List is empty
   </span>

   <div class="header-wish-list-content flex-w js-pscroll">

     <div class="w-full">
       <div class="header-wish-list-total w-full p-tb-40">
         Total No. of Items: 0
       </div>

       <div class="header-wish-list-buttons flex-w w-full">
         <a href="products.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
           Continue Shopping.
         </a>
       </div>
     </div>
   </div>
 </div>
</div>
<?php else: ?>
  <div class="wrap-header-wish-list js-panel-wish-list">
   <div class="s-full js-hide-wish-list"></div>

   <div class="header-wish-list flex-col-l p-l-65 p-r-25">
     <div class="header-wish-list-title flex-w flex-sb-m p-b-8">
       <span class="mtext-103 cl2">
         wish-list
       </span>

       <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-wish-list">
         <i class="zmdi zmdi-close"></i>
       </div>
     </div>


   <div class="header-wish-list-content flex-w js-pscroll">
     <?php
       foreach($items4 as $item){
         $product_id = $item['id'];
         $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
         $product = mysqli_fetch_assoc($productQ);
         $sArray = explode(',', $product['sizes']);
         foreach($sArray as $sizeString ){
           $s = explode(':', $sizeString);
           if($s[0] == $item['size']){
             $available = $s[1];
           }
         }
         ?>
     <ul class="header-wish-list-wrapitem w-full">
       <li class="header-wish-list-item flex-w flex-t m-b-12">
         <div class="header-wish-list-item-img" onclick="update_wish_list('remove', '<?= $product['id']; ?>', '<?= $item['size']; ?>');">
           <?php $photos = explode(',',$product['image']); ?>
               <img src="<?= $photos[0]; ?>" alt="IMG-PRODUCT">
         </div>

         <div class="header-wish-list-item-txt p-t-8">
           <a href="#" class="header-wish-list-item-name m-b-18 hov-cl1 trans-04">
             <?= $product['title']; ?>
           </a>

           <!--<span class="header-wish-list-item-info">
            // $available; Available
          </span>-->

           <span class="header-wish-list-item-info">
            <?= money($product['price']); ?>
           </span>
         </div>
       </li>
     </ul>
   <?php } ?>

   <div class="w-full">
     <div class="header-wish-list-total w-full p-tb-40">
       Total No. of Items: <?= $m; ?>
     </div>

     <div class="header-wish-list-buttons flex-w w-full">
       <a href="products.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
         Continue Shopping.
       </a>

       <a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
         check cart
       </a>
     </div>
   </div>
 </div>
</div>
</div>
<?php endif; ?>
