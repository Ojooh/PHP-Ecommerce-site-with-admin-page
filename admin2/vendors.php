<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //Delete and Edit a vendor
  if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  $db->query("DELETE FROM vendors where id = '$delete_id'");
  header('Location: vendors.php');
  }

  if(isset($_GET['add']) || isset($_GET['edit'])){
    $fname = ((isset($_POST['fname']))?sanitize($_POST['fname']):'');
    $lname = ((isset($_POST['lname']))?sanitize($_POST['lname']):'');
    $name = $fname. " ".$lname;
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $number = ((isset($_POST['number']))?sanitize($_POST['number']):'');
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $facebook = ((isset($_POST['facebook']))?sanitize($_POST['facebook']):'');
    $twitter = ((isset($_POST['twitter']))?sanitize($_POST['twitter']):'');
    $instagram = ((isset($_POST['instagram']))?sanitize($_POST['instagram']):'');
    $snapchat = ((isset($_POST['snapchat']))?sanitize($_POST['snapchat']):'');


  //if add form is submitted
  include 'ecode/vendor_form_submitted.php';

?>


<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user-md"></i> Vendors</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="fa fa-user-md"></i>Vendors</li>
        </ol>
      </div>
      <?php
          if(!empty($errors)){
              echo display_errors($errors);
          }

       ?>
    </div>
    <!-- page start-->
    <h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit':'Add A New'); ?> Vendor</h2><hr>
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Vendor Form
              </header>
              <div class="panel-body">
                <form role="form" action="vendors.php?add=1" method="POST">
                  <div class="form-group col-lg-6">
                    <label for="fname">*First Name</label>
                      <input type="text" class="form-control" name="fname" id="fname" value="<?= $fname; ?>">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="lname">*Last Name</label>
                      <input type="text" class="form-control" name="lname" id="lname" value="<?= $lname; ?>">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="email">*Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="number">*phone Number</label>
                    <input type="text" class="form-control" name="number" id="number" value="<?= $number; ?>">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="password">*Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="confirm">*Confirm Password</label>
                    <input type="password" class="form-control" name="confirm" id="confirm" value="<?= $confirm; ?>">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="facebook">*Facebook</label>
                      <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $facebook; ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="instagram">*Instagram</label>
                      <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $instagram; ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="snapchat">*SnapChat</label>
                      <input type="text" class="form-control" name="snapchat" id="snapchat" value="<?= $snapchat; ?>">
                    </div>
                  </div>
                  <div class="form-group pull-right">
                    <?php if(isset($_GET['edit'])): ?>
                      <a href="vendors.php" class="btn btn-default">Cancel</a>
                    <?php endif; ?>
                    <input type="submit" name="add_submit" value="<?= ((isset($_GET['edit']))?'Edit':'Add'); ?> Vendor" class="btn btn-success">
                  </div><div class="clearfix"></div>
                </div>
                </form>

              </div>
            </section>
          </div>
    <!-- page end-->
  </section>
</section>

<?php
  }
  else{
  //Dtabase connection
  $sql = "SELECT * FROM vendors ORDER BY name";
  $vresults = $db->query($sql);
  $i = 1;
?>


<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user-md"></i> Vendors</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="fa fa-user-md"></i>Vendors</li>
        </ol>
      </div>
    </div>

    <a href="vendors.php?add=1" class="btn btn-success pull-left" id="add-product-btn">ADD A VENDOR</a><div class="clearfix"></div>
    <hr>
    <!-- page start-->
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Vendors Table
              </header>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Edit/Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($vendor = mysqli_fetch_assoc($vresults)): ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $vendor['name']; ?></td>
                    <td><?= $vendor['email']; ?></td>
                    <td><?= $vendor['number']; ?></td>
                    <td>
                      <a href="vendors.php?edit=<?= $vendor['id']; ?>" class="btn btn-xs btn-default"><i class="icon_pencil_alt"></i></a>
                      <a href="vendors.php?delete=<?= $vendor['id']; ?>" class="btn btn-xs btn-default"><i class="icon_trash_alt"></i></a>
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
