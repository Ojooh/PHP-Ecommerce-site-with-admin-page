<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //delete product
  if (isset($_GET['delete'])) {
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
  header('Location: products.php');
  }


  $dbPath = '';
  if(isset($_GET['add']) || isset($_GET['edit'])){
  $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
  $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
  $vendorQuery = $db->query("SELECT * FROM vendors ORDER BY name");
  //instantiate variables
  $title = ((isset($_POST['title']) && $_POST['title'] != '' )?sanitize($_POST['title']):'');
  $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
  $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
  $vendor = ((isset($_POST['name']) && !empty($_POST['name']))?sanitize($_POST['name']):'');
  $price = ((isset($_POST['price']) && $_POST['price'] != '' )?sanitize($_POST['price']):'');
  $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '' )?sanitize($_POST['list_price']):'');
  $description = ((isset($_POST['description']) && $_POST['description'] != '' )?sanitize($_POST['description']):'');
  $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '' )?sanitize($_POST['sizes']):'');
  $sizes = rtrim($sizes,',');
  $saved_image = '';

  //if add form is submitted
  include 'ecode/prods_form_submitted.php';

?>

<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="icon_document_alt"></i> Product</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="icon_document_alt"></i>Product</li>
        </ol>
      </div>
      <?php
          if(!empty($errors)){
              echo display_errors($errors);
          }

       ?>
    </div>
    <!-- page start-->
    <h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit':'Add A New'); ?> Product</h2><hr>
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Product Form
              </header>
              <div class="panel-body">
                <form role="form" action="products.php?<?= ((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="POST" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="title">*Title:</label>
                      <input type="text" class="form-control" name="title" id="title" value="<?= $title; ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="price">Price*:</label>
                      <input type="text" id="price" name="price" class="form-control" value="<?= $price;?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="list_price">List Price:</label>
                      <input type="text" id="list_price" name="list_price" class="form-control" value="<?= $list_price;?>">
                    </div>
                    <div class="form-group col-md-6">
                          <label class="control-label" for="vendor">Vendor*:</label>
                          <div class="">
                            <select class="form-control" id="name" name="name">
                                                      <option value="<?= (($vendor == '')?' selected':''); ?>">- Choose Vendor -</option>
                                                    <?php while($v = mysqli_fetch_assoc($vendorQuery)): ?>
                                                      <option value="<?= $v['id']; ?>"<?= (($vendor == $v['id'])?' selected':''); ?>><?= $v['name']; ?></option>
                                                    <?php endwhile; ?>
                                                  </select>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                          <label class="control-label" for="brands">Brand*:</label>
                          <div class="">
                            <select class="form-control" id="brand" name="brand">

                                                    <option value="<?= (($brand == '')?' selected':''); ?>">- Choose a Brand -</option>
                                                    <option value="N/A">N/A</option>
                                                    <?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
                                                      <option value="<?= $b['id']; ?>"<?= (($brand == $b['id'])?' selected':''); ?>><?= $b['brand']; ?></option>
                                                    <?php endwhile; ?>
                                                  </select>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                          <label class="control-label" for="parent">Parent Category*:</label>
                          <div class="">
                            <select class="form-control" id="parent" name="parent">
                                                    <option value="<?= (($parent == '')?' selected':''); ?>">- Choose Parent Category -</option>
                                                  <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
                                                    <option value="<?= $p['id']; ?>"<?= (($parent == $p['id'])?' selected':''); ?>><?= $p['category']; ?></option>
                                                  <?php endwhile; ?>
                            </select>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                          <label class="control-label" for="child">Child Category*:</label>
                          <div class="">
                            <select id="child" name="child" class="form-control">
                            </select>
                          </div>
                    </div>
                    <div class="form-group col-md-2">
                      <label>*Quantity & Sizes:</label>
                      <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="sizes">Sizes & Qty Preview</label>
                      <input type="text" class="form-control" name="sizes" id="sizes" value="<?= $sizes;?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                       <?php if ($saved_image != ''): ?>
                          <div class="saved-image">
                            <img src="<?= $saved_image; ?>" alt="saved image" width="200px" height="200px"/><br>
                            <a href="products.php?delete_image=1&edit=<?= $edit_id; ?>" class="text-danger">Delete Image</a>
                          </div>
                        <?php else: ?>
                          <label for="photo">Product Image*:</label>
                          <input type="file" name="photo" class="form-control">
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="description">Descritption:</label>
                      <textarea id="description" name="description" class="form-control" rows="6"><?= $description; ?></textarea>
                    </div>
                    <div class="form-group pull-left col-md-12">
                      <a href="products.php" class="btn btn-default">Cancel</a>
                      <input type="submit" value="<?= ((isset($_GET['edit']))?'Edit':'Add'); ?> Product" class="btn btn-success">
                    </div><div class="clearfix"></div>
                  </div>
                  </form>

                </div>
              </section>
            </div>

          <!--sizes modal--->
          <?php  include 'includes/sizesmodal.php'; ?>
    <!-- page end-->
  </section>
</section>


<?php
     }
     else{
      //Dtabase connection
      $sql = "SELECT * FROM products WHERE deleted = 0";
      $presults = $db->query($sql);
      $i = 1;


      //to feature and un-feature products
      if(isset($_GET['featured'])){
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id' AND deleted = 0";
        $db->query($featuredsql);
        header('Location: products.php');
      }
?>
!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="icon_document_alt"></i> PRODUCTS</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="icon_document_alt"></i>Products</li>
        </ol>
      </div>
    </div>

    <a href="products.php?add=1" class="btn btn-success pull-left" id="add-product-btn">Add Product</a><div class="clearfix"></div>
    <hr>
    <!-- page start-->
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Vendors Table
              </header>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Vendor name</th>
                    <th>Featured</th>
                    <th>Sold</th>
                    <th>Edit/Delete</th>
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
                    $vendorID = $product['name'];
                    $vsql = "SELECT * FROM vendors WHERE id = '$vendorID'";
                    $vresult = $db->query($vsql);
                    $vendor_name = mysqli_fetch_assoc($vresult);
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $product['title']; ?></td>
                    <td><?= money($product['price']); ?></td>
                    <td><?= $category; ?></td>
                    <td><?= $vendor_name['name']; ?></td>
                    <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0'); ?>&id=<?=$product['id']; ?>" class="btn btn-xs btn-default">
                    <i class="icon_<?= (($product['featured'] == 1)?'minus_alt2':'plus_alt2'); ?>"></i>
                      </a>
                      &nbsp <?= (($product['featured'] == 1)?'Featured Product':''); ?>
                    </td>
                    <td>0</td>
                    <td>
                      <a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-default"><i class="icon_pencil_alt"></i></a>
                      <a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-default"><i class="icon_trash_alt"></i></a>
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

<?php  } include 'includes/footer.php'; ?>

<script>
  jQuery('document').ready(function(){
    get_child_options('<?= $category; ?>');
  });
</script>
