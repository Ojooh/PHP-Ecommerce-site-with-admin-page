<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //get brands from database
  $sql = "SELECT * FROM brand ORDER BY brand";
  $result = $db->query($sql);
  $errors = array();
  $i = 1;

  //Delete and Edit a brand
  include 'ecode/brands_deldit.php';

  //if add form is submitted
  include 'ecode/brands_form_submitted.php';
 ?>

 <!--main content start-->
 <section id="main-content">
   <section class="wrapper">
     <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="icon_documents_alt"></i> Brands</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_documents_alt"></i>Brands</li>
            </ol>
          </div>

          <?php
              if(!empty($errors)){
                  echo display_errors($errors);
              }

           ?>
        </div>
     <!-- page start-->

      <div class="col-lg-3"></div>

      <div class="col-lg-6">
        <form action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" class="form-horizontal" method="post">
          <?php
              $brand_value = '';
              if(isset($_GET['edit'])){
                $brand_value = $ebrand['brand'];
              }
              else{
                if(isset($_POST ['brand'])){
                  $brand_value = sanitize($_POST['brand']);
                }
              }
          ?>
            <div class="form-group">
               <label class="col-sm-3 control-label"><?=((isset($_GET['edit']))?'EDIT':'ADD A'); ?> BRAND:</label>
               <div class="col-sm-6">
                 <input type="text" class="form-control round-input"  name="brand" id="brand" value="<?=$brand_value; ?>">
               </div>
               <div class="col-sm-3">
                 <?php if(isset($_GET['edit'])): ?>
                   <a href="brands.php" class="btn btn-default">Cancel</a>
                 <?php endif; ?>
                 <input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> Brand" class="btn btn-success">
               </div>
             </div>
         </form>

        <hr>
          <section class="panel">
             <header class="panel-heading">
               Brand Table
             </header>
             <table class="table table-hover">
               <thead>
                 <tr>
                   <th>S/N</th>
                   <th>Brand</th>
                   <th>Edit/Delete</th>
                 </tr>
               </thead>
               <tbody>
                 <?php while($brand = mysqli_fetch_assoc($result)): ?>
                 <tr>
                   <td><?= $i ?></td>
                   <td><?= $brand['brand']; ?></td>
                   <td>
                     <a href="brands.php?edit=<?= $brand['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_pencil_alt"></i></a>
                     <a href="brands.php?delete=<?= $brand['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_trash_alt"></i></a>
                   </td>
                 </tr>
                <?php
                  $i++;
                  endwhile;
                ?>
               </tbody>
             </table>
         </section>
       </div>

       <div class="col-lg-3"></div>

     <!-- page end-->
   </section>
 </section>
 <!--main content end-->


 <?php include 'includes/footer.php'; ?>
