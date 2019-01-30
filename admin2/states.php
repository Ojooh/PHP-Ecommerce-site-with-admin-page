<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //GETTING INFO FROM DATABASE
  $sql = "SELECT * FROM states WHERE parent = 0";
  $result5 = $db->query($sql);
  $errors = array();
  $state = '';
  $post_state = '';

  //edit and delete states
  include 'ecode/state_deldit.php';

  //process states
  include 'ecode/state_form_submitted.php';

  ?>


    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
             <div class="col-lg-12">
               <h3 class="page-header"><i class="icon_piechart"></i> States and LGA</h3>
               <ol class="breadcrumb">
                 <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                 <li><i class="icon_piechart"></i>States and LGA</li>
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
              <form class="form" action="states.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
                <legend><?= ((isset($_GET['edit']))?'EDIT':'ADD A'); ?> STATE</legend>
                <div id="errors"></div>
                <div class="form-group">
                  <label for="parent">State</label>
                  <select class="form-control" name ="parent" id="parent">
                    <option value="0" <?= (($parent_value == 0)?' selected = "selected"':''); ?>>State</option>
                    <?php while ($state = mysqli_fetch_assoc($result5)) : ?>
                      <option value="<?= $state['id']; ?>"<?= (($parent_value == $state['id'])?' selected = "selected"':''); ?>><?= $state['states']; ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="state">LGA</label>
                  <input type="text" class="form-control" id="state" name ="state" value="<?= $state_value; ?>">
                </div>
                <div class="form-group">
                  <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> State" class="btn btn-success">
                </div>
              </form>
            </div>
            <div class="col-sm-6">
              <section class="panel">
                <header class="panel-heading">
                  States and LGA Table
                </header>
                <table class="table">
                  <thead>
                    <tr>
                      <th>State</th>
                      <th></th>
                      <th>Edit/Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        //GETTING INFO FROM DATABASE
                        $sql = "SELECT * FROM states WHERE parent = 0";
                        $result5 = $db->query($sql);
                         while($state = mysqli_fetch_assoc($result5)):
                          $state_id = (int)$state['id'];
                          $sql2 = "SELECT * FROM states WHERE parent = '$state_id'";
                          $lgaresult = $db->query($sql2);
                    ?>
                    <tr class="active">
                      <td><?=$state['states']; ?></td>
                    <td>state</td>
                      <td>
                        <a href="states.php?edit=<?=$state['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_pencil_alt"></i></a>
                        <a href="states.php?delete=<?=$state['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_trash_alt"></i></a>
                      </td>
                    </tr>
                    <?php while($lga = mysqli_fetch_assoc($lgaresult)): ?>
                      <tr>
                        <td><?=$lga['states']; ?></td>
                        <td><?=$state['states']; ?></td>
                        <td>
                          <a href="states.php?edit=<?=$lga['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_pencil_alt"></i></a>
                          <a href="states.php?delete=<?=$lga['id']; ?>" class="btn btn-xs btn-outline-success"><i class="icon_trash_alt"></i></a>
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
