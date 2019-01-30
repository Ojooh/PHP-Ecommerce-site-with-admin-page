<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //Dtabase connection
  $sql = "SELECT * FROM products WHERE deleted = 1";
  $presults = $db->query($sql);
  $i = 1;

  //delete product
if (isset($_GET['undelete'])) {
  $id = sanitize($_GET['undelete']);
  $db->query("UPDATE products SET deleted = 0 WHERE id = '$id'");
  header('Location: products.php');
}

?>

!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="icon_trash_alt"></i> ARCHIVED PRODUCTS</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="icon_trash_alt"></i>Products</li>
        </ol>
      </div>
    </div>

    <!-- page start-->
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Archived Products Table
              </header>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Category</th>
                    <!--<th>Featured</th>-->
                    <th>Sold</th>
                    <th>Restore</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($product = mysqli_fetch_assoc($presults)):
                    $childID = $product['categories'];
                    $catsql = "SELECT * FROM categories WHERE id = '$childID'";
                    $result = $db->query($catsql);
                    $child = mysqli_fetch_assoc($result);
                    $parentID = $child['parent'];
                    $psql = "SELECT * FROM categories WHERE id = '$parentID'";
                    $presult = $db->query($psql);
                    $parent = mysqli_fetch_assoc($presult);
                    $category = $parent['category'].'¬'.$child['category'];
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $product['title']; ?></td>
                    <td><?= money($product['price']); ?></td>
                    <td><?= $category; ?></td>
                    <td>0</td>
                    <td>
                      <a href="archived.php?undelete=<?= $product['id']; ?>" class="btn btn-xs btn-default"><i class="fa fa-recycle"></i></a>
                    </td>
                  </tr>
                  <?php $i++; endwhile; ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
    <!-- page end-->
  </section>
</section>
<!--main content end-->

<?php
  include 'includes/footer.php';
?>
