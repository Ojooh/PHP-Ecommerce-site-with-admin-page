<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';
    include 'includes/categorynav.php';

    $sql = "SELECT * FROM products";
    $cat_id =(($_POST['cat'] != '')? sanitize($_POST['cat']) : '');
    if ($cat_id == ''){
      $sql .= " WHERE deleted = 0";
    }else{
      $sql .= " WHERE categories = '{$cat_id}' AND deleted = 0" ;
    }
    $sort = (($_POST['sort'] != '')? sanitize($_POST['sort']): '');
    $min_price = (($_POST['min_price'] != '')? sanitize($_POST['min_price']): '');
    $max_price = (($_POST['max_price'] != '')? sanitize($_POST['max_price']): '');
    $brand = (($_POST['brand'] != '')? sanitize($_POST['brand']): '');

    if ($min_price != ''){
      $sql .= " AND price >= '{$min_price}'";
    }

    if ($max_price != ''){
      $sql .= " AND price <= '{$max_price}'";
    }

    if ($brand != ''){
      $sql .= " AND brand = '{$brand}'";
    }

    if ($sort == 'low'){
      $sql .= " ORDER BY price";
    }

    if ($sort == 'high'){
      $sql .= " ORDER BY price DESC";
    }

    if ($sort == 'rating'){
      $sql .= " ORDER BY description";
    }

    if ($sort == 'new'){
      $sql .= " ORDER BY id DESC LIMIT 1";
    }

    if ($sort == 'popularity'){
      $sql .= " ORDER BY id DESC LIMIT 1";
    }
    $productQ = $db->query($sql);
    $category = get_category($cat_id);
?>

<?php if($cat_id != ''): ?>
    <h4 class="text-center"><?= $category['parent']; ?>:<?= ' '. $category['child']; ?></h4>
<?php else: ?>
  <h4 class="text-center">Products</h4>
<?php endif; ?>
<div class="row isotope-grid mt-5">
  <?php while($product = mysqli_fetch_assoc($productQ)) : ?>
  <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
    <!-- Block2 -->
    <div class="block2">
      <?php $photos = explode(',',$product['image']); ?>
      <div class="block2-pic hov-img0">
        <a href="product-detail.php?id=<?= $product['id']; ?>">
          <img src="<?= $photos[0]; ?>" alt="IMG-PRODUCT">
        </a>
        <button type="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" onclick="detailsmodal(<?= $product['id']; ?>)">
          Quick View
        </button>
      </div>

      <div class="block2-txt flex-w flex-t p-t-14">
        <div class="block2-txt-child1 flex-col-l ">
          <form action="product-detail.php" method="POST">
            <input type="hidden" name="product_name" id = "product_name" value="<?= $product['title']; ?>">
            <button type="submit" id="button">
              <a href="product-detail.php?id=<?= $product['id']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                <?= $product['title']; ?>
              </a>
            </button>
          </form>

          <span class="stext-105 cl3">
            &#8358;<?= money($product['price']); ?>
          </span>
        </div>

        <form class="block2-txt-child2 flex-r p-t-3" action="add_wish-list.php">
          <a href="#" class="btn-addwish-b2 dis-block pos-relative" onclick="add_to_wish_list('<?= $product['id']; ?>', '<?= $product['sizes']; ?>'); return false">
            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
          </a>
        </form>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
  </div>

  <div class="flex-c-m flex-w w-full p-t-45">
    <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
      Load More
    </a>
  </div>
  </div>
</div>

<?php
    //include 'includes/modal.php';
    include 'includes/footer.php';

?>
