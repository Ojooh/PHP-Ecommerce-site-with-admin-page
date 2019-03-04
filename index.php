<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';
    //include 'includes/cart2.php';
    include 'includes/slider.php';
    include 'includes/categories.php';

    $sql = "SELECT * FROM products WHERE featured = 1";
    $result4 = $db->query($sql);

    if ($cart_id != ''){
      $cartQ2 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart2 = mysqli_fetch_assoc($cartQ2);
      $items = json_decode($cart2['items'], true);
      $i = 1;
      $sub_total = 0;
      $item_count = 0;
    }

 ?>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					New Arrivals
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
				</div>
			</div>

      <div class="row isotope-grid mt-5">
          <?php while($product = mysqli_fetch_assoc($result4)) :  $name = $product['title']; ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
          <!-- Block2 -->
          <div class="block2">
            <?php $photos = explode(',',$product['image']); ?>
            <div class="block2-pic hov-img0">
              <a href="product-detail.php?id=<?= $product['id']; ?>">
                <img src="<?= $photos[0]; ?>" alt="IMG-PRODUCT">
              </a>

              <!-- <button type="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                Quick View
              </button> -->
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
              <div class="block2-txt-child1 flex-col-l ">
              <input type="hidden" name="product_name" id = "product_name" value="<?= $product['title']; ?>">
                  <button type="submit" id="button">
                    <a href="product-detail.php?id=<?= $product['id']; ?>"class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" id="name" data-available="<?= $name; ?>">
                      <?= $product['title']; ?>
                    </a>
                  </button>

                <span class="stext-105 cl3">
                   &#8358;<?= money($product['price']); ?>
                </span>
              </div>

              <form class="block2-txt-child2 flex-r p-t-3" action="add_wish-list.php">
                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" onclick="add_to_wish_list('<?= $product['id']; ?>', '<?= $product['sizes']; ?>'); return false">
                  <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                  <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                </a>
              </form>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
        </div>


			<!-- Load more -->
			<!--<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		</div>-->
	</section>


  <?php
        //include 'includes/modal.php';
        include 'includes/footer.php';

    ?>
