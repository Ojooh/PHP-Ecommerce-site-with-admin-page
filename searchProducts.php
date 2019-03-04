<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navbar.php';
    include 'includes/categorynav.php';

   $search = (($_POST['search'] != '')? sanitize($_POST['search']) : '');

   $searchsql = $db->query("SELECT i.id as 'id', i.title as 'title',
                                   i.price as 'price', i.image as 'image',
                                   i.description as 'description', i.sizes as 'sizes',
   	                               b.id as 'bid', b.brand as 'brand',
   	                               c.id as 'cid', c.category as 'child',
   	                               p.category as 'parent',
                                   v.id as 'vid', v.name as 'vname'
                                   FROM products i
                                   LEFT JOIN brand b ON i.brand = b.id
        	                         LEFT JOIN categories c ON i.categories = c.id
   	                               LEFT JOIN categories p ON c.parent = p.id
                                   LEFT JOIN vendors v  ON i.name = v.id
                                   WHERE i.title LIKE '$search' OR i.title LIKE '$search %' OR i.title LIKE '% $search' OR i.title LIKE '% $search %' OR
   		                                   i.description LIKE '$search' OR i.description LIKE '$search %' OR i.description LIKE '% $search' OR i.description LIKE '% $search %' OR
   		                                   b.brand LIKE '$search' OR b.brand LIKE '$search %' OR b.brand LIKE '% $search' OR b.brand LIKE '% $search %' OR
   		                                   c.category LIKE '$search' OR c.category LIKE '$search %' OR c.category LIKE '% $search' OR c.category LIKE '% $search %' OR
                                         v.name LIKE '$search' OR v.name LIKE '$search %' OR v.name LIKE '% $search' OR v.name LIKE '% $search %'");
?>

<h4 class="text-center"><?= $search ; ?></h4>

<div class="row isotope-grid mt-5">
  <?php while($product = mysqli_fetch_assoc($searchsql)) : ?>
  <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
    <!-- Block2 -->
    <?php  if($search == ''|| $product === NULL): ?>

      <h4 class="text-center">We do not have such!</h4>
    <?php endif; ?>
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





SELECT i.id as 'id', i.title as 'title', i.price as 'price', i.image as 'image', i.description as 'description', i.sizes as 'sizes',
	b.id as 'bid', b.brand as 'brand',
	c.id as 'cid', c.category as 'child',
	p.category as 'parent'
        FROM products i
        LEFT JOIN brand b ON i.brand = b.id
     	LEFT JOIN categories c ON i.categories = c.id
	LEFT JOIN categories p ON c.parent = p.id
        WHERE i.title LIKE '$search' OR i.title LIKE '$search %' OR i.title LIKE '% $search' OR i.title LIKE '% $search %' OR
		i.description LIKE '$search' OR i.description LIKE '$search %' OR i.description LIKE '% $search' OR i.description LIKE '% $search %' OR
		b.brand LIKE '$search' OR b.brand LIKE '$search %' OR b.brand LIKE '% $search' OR b.brand LIKE '% $search %' OR
		c.category LIKE '$search' OR c.category LIKE '$search %' OR c.category LIKE '% $search' OR c.category LIKE '% $search %'
