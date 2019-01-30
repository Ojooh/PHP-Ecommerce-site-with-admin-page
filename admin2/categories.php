<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //GETTING INFO FROM DATABASE
  $sql = "SELECT * FROM categories WHERE parent = 0";
  $result5 = $db->query($sql);
  $errors = array();
  $category = '';
  $post_parent = '';

  //edit and delete categories
  include 'ecode/cat_deldit.php';

  //process submittedadd_category form
  include 'ecode/cat_form_submitted.php';

  ?>

  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
           <div class="col-lg-12">
             <h3 class="page-header"><i class="icon_piechart"></i> Categories</h3>
             <ol class="breadcrumb">
               <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
               <li><i class="icon_piechart"></i>Categories</li>
             </ol>
           </div>

           <?php
               if(!empty($errors)){
                   echo display_errors($errors);
               }

            ?>
         </div>
      <!-- page start-->
      <div class="row">
          <div class="col-sm-6">
            <form class="form" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
              <legend><?= ((isset($_GET['edit']))?'EDIT':'ADD A'); ?> CATEGORY</legend>
              <div id="errors"></div>
              <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control" name ="parent" id="parent">
                  <option value="0" <?= (($parent_value == 0)?' selected = "selected"':''); ?>>Parent</option>
                  <?php while ($parent = mysqli_fetch_assoc($result5)) : ?>
                    <option value="<?= $parent['id']; ?>"<?= (($parent_value == $parent['id'])?' selected = "selected"':''); ?>><?= $parent['category']; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name ="category" value="<?= $category_value; ?>">
              </div>
              <div class="form-group">
                <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> category" class="btn btn-success">
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
                Category Table
              </header>
              <table class="table">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Edit/Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      //GETTING INFO FROM DATABASE
                      $sql = "SELECT * FROM categories WHERE parent = 0";
                      $result5 = $db->query($sql);
                       while($parent = mysqli_fetch_assoc($result5)):
                        $parent_id = (int)$parent['id'];
                        $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                        $cresult = $db->query($sql2);
                  ?>
                  <tr class="active">
                    <td><?=$parent['category']; ?></td>
                  <td>Parent</td>
                    <td>
                      <a href="categories.php?edit=<?=$parent['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_pencil_alt"></i></a>
                      <a href="categories.php?delete=<?=$parent['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_trash_alt"></i></a>
                    </td>
                  </tr>
                  <?php while($child = mysqli_fetch_assoc($cresult)): ?>
                    <tr>
                      <td><?=$child['category']; ?></td>
                      <td><?=$parent['category']; ?></td>
                      <td>
                        <a href="categories.php?edit=<?=$child['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_pencil_alt"></i></a>
                        <a href="categories.php?delete=<?=$child['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_trash_alt"></i></a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php endwhile; ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">


      <!-- page end-->
         </section>
       </section>
       <!--main content end-->


       <?php include 'includes/footer.php'; ?>
