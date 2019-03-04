<?php
    require_once '../core/init.php';
    // include 'head.php';
    $id = $_POST['id'];
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
    $vendor_name = mysqli_fetch_assoc($result2);
    $sizestring = $product['sizes'];
    $sizestring = rtrim($sizestring,',');
    $size_array = explode(',', $sizestring);
?>
<!-- Modal1 -->
<?php
ob_start();

?>
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">

<div id="modal1" class="wrap-modal1 js-modal1 p-t-60 p-b-20">
  <div class="overlay-modal1 js-hide-modal1" onclick="closeModal()"></div>

  <div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
      <button class="how-pos3 hov3 trans-04 js-hide-modal1" onclick="closeModal()">
        <img src="images/icons/icon-close.png" alt="CLOSE">
      </button>

      <div class="row">

        <div class="col-md-6 col-lg-7 p-b-30">
          <div class="p-l-25 p-r-30 p-lr-0-lg">
            <div class="wrap-slick3 flex-sb flex-w">
              <div class="wrap-slick3-dots"></div>
              <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

              <div class="slick3 gallery-lb">
                <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                  <div class="wrap-pic-w pos-relative">
                    <img src="<?= $product['image']; ?>" alt="IMG-PRODUCT">

                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                      <i class="fa fa-expand"></i>
                    </a>
                  </div>
                </div>

                <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                  <div class="wrap-pic-w pos-relative">
                    <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                      <i class="fa fa-expand"></i>
                    </a>
                  </div>
                </div>

                <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                  <div class="wrap-pic-w pos-relative">
                    <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
                      <i class="fa fa-expand"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-5 p-b-30">
          <div class="p-r-50 p-t-5 p-lr-0-lg">

            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
              <?= $product['title']; ?>
            </h4>

            <p class="p-t-5">Brand: <?= $brand['brand']; ?></p>

            <span class="mtext-106 cl2">
              &#8358;<?= money($product['price']); ?>
            </span>

            <p class="stext-102 cl3 p-t-23">
              <?= nl2br($product['description']); ?>
            </p>

            <span id="modal_errors" class="text-danger p-t-24 col-lg-12"></span>

            <!--  -->
            <form class="p-t-33" action="add_cart.php" id="add_product_form" method="post">
             <input type="hidden" name="product_id" value="<?= $id; ?>">
             <input type="hidden" name="available" id="available" value="">
              <div class="flex-w flex-r-m p-b-10">
                <div class="size-203 flex-c-m respon6">
                  Size
                </div>

                <div class="size-204 respon6-next">
                  <div class="rs1-select2 bor8 bg0">
                    <select class="js-select2" name="size" id="size">
                      <option>Choose an option</option>
                      <?php foreach($size_array as $string) {
                         $string_array = explode(':', $string);

                         $size = $string_array[0];
                         $available = $string_array[1];
                         echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
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
                <div class="size-204 flex-w flex-m respon6-next">
                  <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                      <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>

                    <input class="mtext-104 cl3 txt-center num-product" type="number" id="quantity" name="quantity" placeholder="0" min="0">

                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                      <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                  </div>

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
            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
              <div class="flex-m bor9 p-r-10 m-r-11">
                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                  <i class="zmdi zmdi-favorite"></i>
                </a>
              </div>

              <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                <i class="fa fa-facebook"></i>
              </a>

              <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                <i class="fa fa-twitter"></i>
              </a>

              <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                <i class="fa fa-google-plus"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



    <?php
      include 'ecode.php';
      echo ob_get_clean();
      ?>
