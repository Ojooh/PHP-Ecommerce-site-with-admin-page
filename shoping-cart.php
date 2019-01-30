<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';

    $sql = "SELECT * FROM products WHERE featured = 1";
    $result4 = $db->query($sql);
    if ($cart_id != ''){
      $cartQ2 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart2 = mysqli_fetch_assoc($cartQ2);
      $items = json_decode($cart2['items'], true);
      //$i = 1;
      $sub_total = 0;
      $item_count = 0;
    }
 ?>
 <!-- breadcrumb -->
 <div class="container">
   <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
     <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
       Home
       <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
     </a>

     <span class="stext-109 cl4">
       Shoping Cart
     </span>

   </div>
 </div>

 <?php  if($cart_id == ''): ?>
 <span class="text-center pull-right mtext-103 cl2">
 </span>
 <h3 class="mtext-111 cl2 p-b-16 p-t-45 m-l-24 m-l-24 m-b-50">
   Your Cart is empty
 </h3>
<?php else: ?>
  <!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
                <?php
                  foreach($items as $item){
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

								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="<?= $product['image']; ?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?= $product['title']; ?><br> <?= $item['size']; ?></td>
									<td class="column-3">&#8358;<?= $product['price']; ?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<button class="btn-num-product-down1 cl8 hov-btn3 trans-04 flex-c-m" onclick="update_cart('removeone', '<?= $product['id']; ?>', '<?= $item['size']; ?>');">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</button>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?= $item['quantity']; ?>">

                      <?php if($item['quantity'] < $s[1]): ?>
  											<button class="btn-num-product-up1 cl8 hov-btn3 trans-04 flex-c-m" onclick="update_cart('addone', '<?= $product['id']; ?>', '<?= $item['size']; ?>');">
  												<i class="fs-16 zmdi zmdi-plus"></i>
  											</button>
                      </div>
                    <?php else: ?>
                        <span class="text-danger text-center">MAX</span>
                    <?php endif; ?>

									</td>
  									<td class="column-5">
                      <?php $total =  $item['quantity'] * $product['price']; ?>
                      Total : &#8358;<?= $total; ?>
                  </td>
								</tr>
                <?php
                  $sub_total = $sub_total + $total;
                    }
                ?>
							</table>
						</div>

						<!--<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div>-->
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								&#8358;<?= $sub_total; ?>
								</span>
							</div>
						</div>

    <?php if(is_logged_in3()):
      $useraddress2 =  $db->query("SELECT * FROM userlogin WHERE id = '$customer_id'");
      $address = mysqli_fetch_assoc($useraddress2);
      $a1 = $address['city'];
      $a2 = $address['state'];
      $a3 = $address['lga'];
      $a4 = $address['address'];
      $a5 = $address['directions'];
      $a6 = $address['number'];
      $a7 = $address['receiver'];

      $home = $a1. " ". $a2. " ".$a3. " ".$a4. " ".$a5. " ";
?>
						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Delivery:
								</span>
							</div><br>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">

                <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-home m-r-10"></i>
                   <?= $home; ?>
                </p>
                <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-phone-in-talk m-r-10"></i>   <?= $a6; ?></p>

							</div>
						</div>

      <?php else: ?>
        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
          <div class="size-208 w-full-ssm">
            <span class="stext-110 cl2">
              Delivery:
            </span>
          </div><br>

          <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">


          </div>
        </div>

      <?php endif; ?>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									&#8358;<?= $sub_total + 1150; ?>
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
  <?php endif; ?>


 <?php
       //include 'includes/modal.php';
       include 'includes/footer.php';

   ?>
