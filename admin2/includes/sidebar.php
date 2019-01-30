<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu">
      <li class="">
        <a class="" href="index.php">
                      <i class="icon_house_alt"></i>
                      <span>Dashboard</span>
                  </a>
      </li>
      <li>
        <a class="" href="brands.php">
                      <i class="icon_documents_alt"></i>
                      <span>Brands</span>
                  </a>
      </li>
      <li>
        <a class="" href="categories.php">
                      <i class="icon_piechart"></i>
                      <span>Categories</span>
                  </a>
      </li>
      <li>
        <a class="" href="states.php">
                      <i class="icon_piechart"></i>
                      <span>States and LGA</span>
                  </a>
      </li>
      <li>
        <a class="" href="vendors.php">
                      <i class="fa fa-user-md"></i>
                      <span>Vendors</span>
                  </a>
      </li>

      <li class="sub-menu">
        <a href="javascript:;" class="">
                      <i class="icon_document_alt"></i>
                      <span>Products</span>
                      <span class="menu-arrow arrow_carrot-right"></span>
                  </a>
        <ul class="sub">
          <li><a class="" href="products.php">Products</a></li>
          <li><a class="" href="archived.php">Archived Products</a></li>
        </ul>
      </li>
      <?php if(has_permission('admin')): ?>
      <li>
        <a class="" href="users.php">
                      <i class="icon_piechart"></i>
                      <span>Users</span>
                  </a>
      </li>
      <?php endif; ?>

    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->
