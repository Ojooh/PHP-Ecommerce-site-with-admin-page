<?php
		require_once 'core/init.php';
		if(!is_logged_in3()){
      login_error_redirect();
    }
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
			$grand_total = 0;
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
<?php else:
	$useraddress2 =  $db->query("SELECT * FROM userlogin WHERE id = '$customer_id'");
	$address = mysqli_fetch_assoc($useraddress2);
	$stateQuery = $db->query("SELECT * FROM states WHERE parent = 0 ORDER BY states");
	$state_id2 = $address['state'];
	$statesql = $db->query("SELECT * FROM states WHERE id ='$state_id2'");
	$addstate = mysqli_fetch_assoc($statesql);
	$lga_id2 = $address['lga'];
	$lgasql = $db->query("SELECT * FROM states WHERE id ='$lga_id2'");
	$addlga = mysqli_fetch_assoc($lgasql);
	$a1 = $address['city'];
	$a2 = $addstate['states'];
	$a3 = $addlga['states'];
	$a4 = $address['address'];
	$a5 = $address['directions'];
	$a6 = $address['number'];
	$a7 = $address['receiver'];

	$home = $a1. " ". $a2. " ".$a3. " ".$a4. " ".$a5. " ";
	$receiver = ((isset($_POST['receiver']) && $_POST['receiver'] != '' )?sanitize($_POST['receiver']):'');
	$number = ((isset($_POST['number']) && $_POST['number'] != '' )?sanitize($_POST['number']):'');
	$state = ((isset($_POST['state']) && $_POST['state'] != '' )?sanitize($_POST['state']):'');
	$city = ((isset($_POST['city']) && $_POST['city'] != '' )?sanitize($_POST['city']):'');
	$lga = ((isset($_POST['lga']) && $_POST['lga'] != '' )?sanitize($_POST['lga']):'');
	$address = ((isset($_POST['address']) && $_POST['address'] != '' )?sanitize($_POST['address']):'');
	$directions = ((isset($_POST['directions']) && $_POST['directions'] != '' )?sanitize($_POST['directions']):'');

	if(isset($_GET['add'])){

		$receiver = ((isset($_POST['receiver']) && $_POST['receiver'] != '' )?sanitize($_POST['receiver']):'');
		$number = ((isset($_POST['number']) && $_POST['number'] != '' )?sanitize($_POST['number']):'');
		$state = ((isset($_POST['state']) && $_POST['state'] != '' )?sanitize($_POST['state']):'');
		$city = ((isset($_POST['city']) && $_POST['city'] != '' )?sanitize($_POST['city']):'');
		$lga = ((isset($_POST['lga']) && $_POST['lga'] != '' )?sanitize($_POST['lga']):'');
		$address = ((isset($_POST['address']) && $_POST['address'] != '' )?sanitize($_POST['address']):'');
		$directions = ((isset($_POST['directions']) && $_POST['directions'] != '' )?sanitize($_POST['directions']):'');
		$errors = array();
		$required = array('receiver','number','state','lga','city','address');
		foreach($required as $f){
			if(empty($_POST[$f])){
				$errors[] = 'Must fill out all fields.';
				break;
			}
		}

		//too lazy to do other checks
		if(empty($errors)){
			$insertsql28 = "UPDATE userlogin SET `number` ='$number', city = '$city', state = '$state', lga = '$lga', address = '$address',  directions = '$directions', receiver = '$receiver' WHERE id = '$customer_id'";
			$db->query($insertsql28);
		}

		echo '<script>location.replace("checkout.php")</script>';


	}

?>
<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="">
        		<div class="panel-body">
          		<div class="tab-content">
							<?php if($a1 == '' || $a2 == '' || $a3 == '' || $a4 == '' ): ?>
								<div id="delivery-address" class="tab-pane active m-b-57">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
										<h4 class="card-title">
											Address
											<ul class="nav pull-right"><li><a data-toggle="tab" href="#change-address" class="btn btn-outline-secondary m-t-0">Add Address</a></li></ul>
									</h4>
											<hr>
											<h4 class="mtext-109 cl2 m-t-9 m-b-15 p-t-20">
												No Address has been set
											</h4>
										</div>
									</div>
								</div>
							</div>
					<?php else: ?>


						<div id="delivery-address" class="tab-pane active m-b-57">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
											Address
											<ul class="nav pull-right"><li><a data-toggle="tab" href="#change-address" class="btn btn-outline-secondary m-t-0">Change Address</a></li></ul>
									</h4>
									<hr>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-account-circle m-r-10"></i>      <?= $a7; ?></p>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-home m-r-10"></i>
                     <?= $home; ?>
                  </p>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-phone-in-talk m-r-10"></i>   <?= $a6; ?></p>
                </div>
              </div>
            </div>
          </div>
				<?php endif; ?>

				<?php if(isset($_GET['add'])): ?>
          <div id="change-address" class="tab-pane active m-b-57">
        <?php else: ?>
          <div id="change-address" class="tab-pane m-b-57">
        <?php endif; ?>
				<div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
											Address
										<a href="checkout.php" class="btn btn-outline-secondary pull-right m-t-0">Cancel</a>
									</h4>
									<hr>
                  <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>
                  <form class="container" action="checkout.php?add=1" method="POST" enctype="multipart/form-data">
									<div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="receiver"> Receivers Name: </label>
                      <input type="text" name="receiver" id="receiver" class="form-control" value="<?= $receiver; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="number"> Number: </label>
                      <input type="text" name="number" id="number" class="form-control" value="<?= $number; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="state"> State: </label>
                      <select class="form-control" id="state" name="state" data-stripe = "address_state">
                                              <option value="<?= (($state == '')?' selected':''); ?>">- Choose A State -</option>
                                            <?php while($s = mysqli_fetch_assoc($stateQuery)): ?>
                                              <option value="<?= $s['id']; ?>"<?= (($state == $s['id'])?' selected':''); ?>><?= $s['states']; ?></option>
                                            <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lga"> LGA: </label>
                      <select name="lga" id="lga" class="form-control">
                      </select>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="city"> City: </label>
                      <input type="text" name="city" id="city" class="form-control" value="<?= $city; ?>" data-stripe = "address_city">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address"> Street Address: </label>
                      <input type="text" name="address" id="address" class="form-control" value="<?= $address; ?>" data-stripe = "address_line1">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="directions">Directions:</label>
                      <textarea id="directions" name="directions" class="form-control" rows="6" data-stripe = "address_city"><?= $directions; ?></textarea>
                    </div>
                    <div class="form-group col-md-6 text-right vida" >
                    </div>
                  </div>
                  <div class="form-group move">
                    <input class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer" type="submit" value="Save">
                  </div>
                  <!-- <a href="account.php?add=1" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">Save</a> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
				</div>
			</div>
		</div>

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
										$item_count++;
                    ?>

								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<div class="header-cart-item-img" onclick="update_cart('remove', '<?= $product['id']; ?>', '<?= $item['size']; ?>');">
					              <?php $photos = explode(',',$product['image']); ?>
					                  <img src="<?= $photos[0]; ?>" alt="IMG-PRODUCT">
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
                      Total :  &#8358;<?= money($total); ?>
                  </td>
								</tr>
                <?php
                  $sub_total = $sub_total + $total;
									$grand_total = $sub_total + TAXRATE;
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
							 &#8358;<?= money($sub_total); ?>
								</span>
							</div>
						</div>

    <?php if(is_logged_in3()):
      $useraddress2 =  $db->query("SELECT * FROM userlogin WHERE id = '$customer_id'");
      $address = mysqli_fetch_assoc($useraddress2);
      $a1 = $address['city'];
      $a2 = $addstate['states'];
      $a3 = $addlga['states'];
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
									 &#8358;<?= money($grand_total); ?>
								</span>
							</div>
						</div>
					<?php if($a1 == '' || $a2 == '' || $a3 == '' || $a4 == '' ): ?>

					<?php else: ?>
						<!-- <button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" data-toggle="modal" data-target=".bd-example-modal-lg">
							Proceed to Checkout
						</button> -->
					<form action="thankYou.php" method="POST" id="payment-form">
						<input type="hidden" name="receiver" id="receiver" value = "<?= $address['receiver']; ?>">
						<input type="hidden" name="email" id="email" value = "<?= $address['email']; ?>">
						<input type="hidden" name="city" id="city" value = "<?= $address['city']; ?>">
						<input type="hidden" name="state" id="state" value = "<?= $addstate['states']; ?>">
						<input type="hidden" name="lga" id="lge" value = "<?= $addlga['states']; ?>">
						<input type="hidden" name="address" id="address" value = "<?= $address['address']; ?>">
						<input type="hidden" name="directions" id="directions" value = "<?= $address['directions']; ?>">
						<input type="hidden" name="number" id="number" value = "<?= $address['number']; ?>">
						<input type="hidden" name="receiver" id="receiver" value = "<?= $address['receiver']; ?>">
						<input type="hidden" name="total" id="total" value = "<?= $sub_total; ?>">
						<input type="hidden" name = "tax" id="tax" value="<?= TAXRATE; ?>">
						<input type="hidden" name = sub_total id="sub_total" value = "<?= $grand_total; ?>">
						<input type="hidden" name = "cart_id" id="cart_id" value="<?= $cart_id; ?>">
						<input type="hidden" name="description" id="description" value="<?= $item_count.' item'.(($item_count > 1)?'s':'').' from Baine Stores.'; ?>">
					<script
							src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="pk_test_fngYd0JyLp0vjfz3TEdj334q"
							data-amount= "<?= $grand_total / 0.01; ?>"
							data-name="Baine"
							data-description="<?= $item_count.' item'.(($item_count > 1)?'s':'').' from Baine Stores.'; ?>"
							data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
							data-locale="auto">
							var email = jQuery('#email').val();
							var city = jQuery('#city').val();
							var state = jQuery('#state').val();
							var lga = jQuery('#lga').val();
							var address = jQuery('#address').val();
							var directions = jQuery('#directions').val();
							var number = jQuery('#number').val();
							var receiver = jQuery('#receiver').val();
							var total = jQuery('#total').val();
							var tax = jQuery('#tax').val();
							var sub_total = jQuery('#sub_total').val();
							var cart_id = jQuery('#cart_id').val();
							var description = jQuery('#description').val();
							var data = jQuery('#payment-form').serialize();
							jQuery.ajax({
						    url : '/Baine/thankYou.php',
						    method : 'post',
						    data : data,
						    success : function(){

						});
						    },
						    error : function(){
						      alert("something went wrong");
						    }
						  });

					</script>
					</form>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>







 <?php
       //include 'includes/modal.php';
       include 'includes/footer.php';

   ?>
