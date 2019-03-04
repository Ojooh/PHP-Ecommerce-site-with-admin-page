<?php
    $sql = "SELECT * FROM categories WHERE parent = 0";
    $pquery = $db->query($sql);

    $cat_id = ((isset($_REQUEST['cat']))? sanitize($_REQUEST['cat']): '');
    $sort = ((isset($_REQUEST['sort']))? sanitize($_REQUEST['sort']): '');
    $min_price = ((isset($_REQUEST['min_price']))? sanitize($_REQUEST['min_price']): '');
    $max_price = ((isset($_REQUEST['max_price']))? sanitize($_REQUEST['max_price']): '');
    $b = ((isset($_REQUEST['brand']))? sanitize($_REQUEST['brand']): '');
    $brandQ= $db->query("SELECT * FROM brand ORDER BY brand");
 ?>


<div class="">
  <nav class="limiter-menu-desktop container">

    <!-- Menu desktop -->
    <div class="menu-desktop flex-w flex-l-m category-tope-group m-t-2 m-b-10">
      <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-category">
        <i class="icon-category cl2 m-r-6 fs-15 trans-04"></i>
        <i class="icon-close-category cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
         Categories
      </div>

    </div>

  <div class="wrap-icon-header flex-w flex-r-m">
      <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
         Filter
      </div>

      <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Search
      </div>
    </div>
  </nav>
</div>
</div>

<div class="bg0 m-t-23 p-b-140">
  <div class="container">
    <div class="flex-w flex-sb-m p-b-52">

      <!-- Search product -->
      <form action="searchProducts.php" method="POST" class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
          <?php $search = ((isset($_REQUEST['search']))? sanitize($_REQUEST['search']): ''); ?>

          <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
            <i class="zmdi zmdi-search"></i>
          </button>

          <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" value="<?= $search; ?>" placeholder="What are you Looking for...?" required>
        </div>
      </form>

      <!-- Categories -->
      <div class="dis-none panel-category w-full p-t-10">
        <div class="wrap-category flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
          <?php while($parent = mysqli_fetch_assoc($pquery)):
      					$parent_id = $parent['id'];
      					$sql2 = "SELECT *FROM categories WHERE parent = '$parent_id'";
      					$cquery = $db->query($sql2);
                $i = 1;
      		?>
          <div class="filter-col<?= $i; ?> p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              <?= $parent['category']; ?>
            </div>

            <ul>
              <?php while($child = mysqli_fetch_assoc($cquery)): ?>
              <li class="p-b-6">
                <a href="category.php?cat=<?= $child['id']; ?>" class="filter-link stext-106 trans-04">
                  <?= $child['category']; ?>
                </a>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php $i++; endwhile; ?>

        </div>
      </div>

      <!-- Filter -->
      <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
          <div class="filter-col1 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Sort By
            </div>
            <form action="search.php" method="POST">
                <input type="hidden" name="cat" value="<?= $cat_id; ?>">
                <input type="hidden" name="sort" value="0">
                <div class="flex-w p-t-4 m-r--5">
                  <div class="flex-c-m stext-107 cl6 size-301 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  <input type="radio" class="filter-link stext-106 trans-04" name="sort" value="popularity"<?= (($sort == 'popularity')?' checked' : ''); ?>> Popularity
                </div>

                  <div class="flex-c-m stext-107 cl6 size-301 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    <input type="radio" class="filter-link stext-106 trans-04" name="sort" value="rating"<?= (($sort == 'rating')?' checked' : ''); ?>> Average rating
                  </div>

                  <div class="flex-c-m stext-107 cl6 size-301 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    <input type="radio" class="filter-link stext-106 trans-04" name="sort" value="new"<?= (($sort == 'new')?' checked' : ''); ?>> Newness
                  </div>

                  <div class="flex-c-m stext-107 cl6 size-301 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    <input type="radio" class="filter-link stext-106 trans-04" name="sort" value="low"<?= (($sort == 'low')?' checked' : ''); ?>>  Price: Low To High
                  </div>

                  <div class="flex-c-m stext-107 cl6 size-301 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    <input type="radio" class="filter-link stext-106 trans-04" name="sort" value="high"<?= (($sort == 'high')?' checked' : ''); ?>> Price: High To Low
                  </div>
                </div>
              </div>

              <div class="filter-col2 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  Price
                </div>

                <input type="text" name="min_price" class="price-range" placeholder="Min &#8358;" value="<?= $min_price ?>">To
                <input type="text" name="max_price" class="price-range" placeholder="Max &#8358;" value="<?= $max_price ?>">
              </div>


              <div class="filter-col3 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  Brands
                </div>

                <div class="flex-w p-t-4 m-r--5">
                  <div class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  <input type="radio" class="filter-link stext-106 trans-04" name="brand" value=""<?= (($b == '')?' checked' : ''); ?>>All
                </div>

                  <?php while($brand = mysqli_fetch_assoc($brandQ)): ?>
                    <div  class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                      <input type="radio" class="filter-link stext-106 trans-04" name="brand" value="<?= $brand['id']; ?>"<?= (($b == $brand['id'])?' checked' : ''); ?>><?= $brand['brand']; ?>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>



              <div class="filter-col4 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  Price
                </div>

                <!-- <input type="text" name="min_price" class="price-range" placeholder="Min &#8358;" value="">To
                <input type="text" name="max_price" class="price-range" placeholder="Max &#8358;" value=" -->
              </div>

              <input type="submit" value="search" class="pull-right flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4">
            </form>




          <!-- <div class="filter-col6 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Color
            </div>

            <ul>
              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04">
                  Black
                </a>
              </li>

              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                  Blue
                </a>
              </li>

              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04">
                  Grey
                </a>
              </li>

              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04">
                  Green
                </a>
              </li>

              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04">
                  Red
                </a>
              </li>

              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
                  <i class="zmdi zmdi-circle-o"></i>
                </span>

                <a href="#" class="filter-link stext-106 trans-04">
                  White
                </a>
              </li>
            </ul>
          </div> -->


        </div>
      </div>
    </div>
