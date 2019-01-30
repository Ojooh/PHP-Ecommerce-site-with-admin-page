<?php
    $sql8 = "SELECT * FROM categories WHERE parent = 0";
    $pquery8 = $db->query($sql8);
?>
<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
  <div class="container">
    <div class="row">
<?php while($parent = mysqli_fetch_assoc($pquery8)): 	?>
      <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
        <!-- Block1 -->
        <div class="block1 wrap-pic-w">
          <img src="<?= $parent['image']; ?>"  height="250" width="321" alt="IMG-BANNER">

          <a href="products.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <div class="block1-txt-child1 flex-col-l">
              <span class="block1-name ltext-102 trans-04 p-b-8">
              <?= $parent['category']; ?>
              </span>

              <span class="block1-info stext-102 trans-04">

              </span>
            </div>

            <div class="block1-txt-child2 p-b-4 trans-05">
              <div class="block1-link stext-101 cl0 trans-09">
                Shop Now
              </div>
            </div>
          </a>
        </div>
      </div>
  <?php endwhile; ?>


    </div>
  </div>
</div>
