<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  if(!has_permission('admin')){
    permission_error_redirect('index.php');
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  //to delete a visitor user
    if((isset($_GET['delete']))){
      $delete_id = sanitize($_GET['delete']);
      $db->query("DELETE FROM users where id = '$delete_id'");
      $_SESSION['success_flash'] = 'Visitor User has been deleted';
      header('Location: users.php');
    }

  $dbPath = '';
  //to add new users
    if(isset($_GET['add']) || isset($_GET['edit'])){
      $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
      $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
      $occ = ((isset($_POST['occ']))?sanitize($_POST['occ']):'');
      $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
      $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
      $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
      $number = ((isset($_POST['number']))?sanitize($_POST['number']):'');
      $saved_image = '';
      $errors = array();
      //if add form is submitted
      include 'ecode/users_form_submitted.php';

      ?>


      <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="icon_piechart"></i> USERS</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_piechart"></i>users</li>
            </ol>
          </div>
          <?php
              if(!empty($errors)){
                  echo display_errors($errors);
              }

           ?>
        </div>
        <!-- page start-->
        <h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit':'Add A New'); ?> User</h2><hr>
        <div class="col-lg-12">
                <section class="panel">
                  <header class="panel-heading">
                    Vendor Form
                  </header>
                  <div class="panel-body">
                    <form class="container" action="users.php?add=1" method="POST" enctype="multipart/form-data">
                      <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="name"> Full Name: </label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $name; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email"> Emai Address: </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="number"> Phone Number: </label>
                        <input type="text" name="number" id="number" class="form-control" value="<?= $number; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="occ"> Occupation: </label>
                        <select class="form-control" name="occ">
                          <option value=""<?= (($occ == '')?' selected': ''); ?>></option>
                          <option value="Web Designer"<?= (($occ == 'Web Designer')?' selected': ''); ?>>Web Designer</option>
                          <option value="Front-End Developer"<?= (($occ == 'Front-End Developer')?' selected': ''); ?>>Front-End Developer</option>
                          <option value="UI Designer"<?= (($occ == 'UI Designer')?' selected': ''); ?>>UI Designer</option>
                          <option value="UX Designer"<?= (($occ == 'UX Designer')?' selected': ''); ?>>UX Designer</option>
                          <option value="Interaction Designer"<?= (($occ == 'Interaction Designer')?' selected': ''); ?>>Interaction Designer</option>
                          <option value="Art Director"<?= (($occ == 'Art Director')?' selected': ''); ?>>Art Director</option>
                          <option value="Web Developer"<?= (($occ == 'Web Developer')?' selected': ''); ?>>Web Developer</option>
                          <option value="Full stack Developer"<?= (($occ == 'Full stack Developer')?' selected': ''); ?>>Full stack Developer</option>
                          <option value="Web Adminstrator"<?= (($occ == 'Web Adminstrator')?' selected': ''); ?>>Web Adminstrator</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="password"> Password: </label>
                        <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="confirm"> Confirm Password: </label>
                        <input type="password" name="confirm" id="confirm" class="form-control" value="<?= $confirm; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="name"> Permissions: </label>
                        <select class="form-control" name="permissions">
                          <option value=""<?= (($permissions == '')?' selected': ''); ?>></option>
                          <option value="editor"<?= (($permissions == 'editor')?' selected': ''); ?>>Editor</option>
                          <option value="admin,editor"<?= (($permissions == 'admin,editor')?' selected': ''); ?>>Admin</option>
                        </select>
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
                      <div class="form-group col-md-6 text-right vida" >
                        <a href="users.php" class="btn btn-default">Cancel</a>
                        <input type="submit" value="<?= ((isset($_GET['edit']))?'Edit':'Add'); ?> User" class="btn btn-primary">
                      </div>
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
    $userQuery = $db->query("SELECT * FROM users ORDER BY full_name");
    $i = 1;
  ?>


  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="icon_piechart"></i> USERS</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
            <li><i class="icon_piechart"></i>users</li>
          </ol>
        </div>
      </div>

      <a href="users.php?add=1" class="btn btn-success pull-left" id="add-product-btn">Add New User</a>
      <hr>
      <!-- page start-->
      <div class="col-lg-12">
              <section class="panel">
                <header class="panel-heading">
                  Users Table
                </header>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Join Date</th>
                      <th>Last Login</th>
                      <th>Permissions</th>
                      <th>Edit/Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php while($user = mysqli_fetch_assoc($userQuery)):  ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $user['full_name']; ?></td>
                      <td><?= $user['email']; ?></td>
                      <td><?= pretty_date($user['join_date']); ?></td>
                      <td><?= (($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login'])); ?></td>
                      <td><?= $user['permissions']; ?></td>
                      <td>
                        <?php if($user['id'] != 2): ?>
                          <a href="users.php?edit=<?= $user['id']; ?>" class="btn btn-default btn-xs"><i class="icon_pencil_alt"></i></a>
                        <?php endif; ?>
                        <?php if($user['id'] != $user_data['id'] && $user['id'] != 2): ?>
                          <a href="users.php?delete=<?= $user['id']; ?>" class="btn btn-default btn-xs"><i class="icon_trash_alt"></i></a>
                        <?php endif; ?>
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
