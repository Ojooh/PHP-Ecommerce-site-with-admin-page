<?php $sub_total = 0; ?>
<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
 <div class="s-full js-hide-cart"></div>

 <div class="header-cart flex-col-l p-l-65 p-r-25">
   <div class="header-cart-title flex-w flex-sb-m p-b-8">
     <span class="mtext-103 cl2">
       My Cart
     </span>

     <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
       <i class="zmdi zmdi-close"></i>
     </div>
   </div>

   <?php  if($cart_id == ''|| $cart2 === NULL): ?>
   <span class="mtext-103 cl2">
     Your Cart is empty
   </span>

   <div class="header-cart-content flex-w js-pscroll">

     <div class="w-full">
       <div class="header-cart-total w-full p-tb-40">
         Total: &#8358;0.00
       </div>

       <!-- <div class="header-cart-buttons flex-w w-full">
         <a href="/Baine/checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
           Check Out
         </a>
       </div> -->
     </div>
   </div>
 </div>
</div>
<?php else: ?>
 <div class="wrap-header-cart js-panel-cart">
   <div class="s-full js-hide-cart"></div>

   <div class="header-cart flex-col-l p-l-65 p-r-25">
     <div class="header-cart-title flex-w flex-sb-m p-b-8">
       <span class="mtext-103 cl2">
         My Cart
       </span>

       <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
         <i class="zmdi zmdi-close"></i>
       </div>
     </div>

     <div class="header-cart-content flex-w js-pscroll">
       <?php
         foreach($items2 as $item){
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

       <ul class="header-cart-wrapitem w-full">
         <li class="header-cart-item flex-w flex-t m-b-10">
           <div class="header-cart-item-img" onclick="update_cart('remove', '<?= $product['id']; ?>', '<?= $item['size']; ?>');">
             <?php $photos = explode(',',$product['image']); ?>
                 <img src="<?= $photos[0]; ?>" alt="IMG-PRODUCT">
           </div>

           <div class="header-cart-item-txt p-t-8">
             <a href="#" class="header-cart-item-name m-b-8 hov-cl1 trans-04">
               <?= $product['title']; ?>
             </a>

             <span class="header-cart-item-info">
               <?= $item['quantity']; ?> x &#8358;<?= money($product['price']); ?>
             </span>
             <span class="header-cart-item-info">
               <?php $total =  $item['quantity'] * $product['price']; ?>
               Total : &#8358;<?= money($total); ?>
             </span>
           </div>
         </li>
       </ul>
       <?php
        $i++;
         $sub_total = $sub_total + $total;
           }
       ?>
       <div class="w-full">
         <div class="header-cart-total w-full p-tb-40">
           Sub-Total: &#8358;<?= money($sub_total); ?>
         </div>

         <div class="header-cart-buttons flex-w w-full col-12">
         <a href="/Baine/checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
           Check Out
         </a>
         </div>
       </div>

     </div>
   </div>
 </div>
 <?php endif; ?>
