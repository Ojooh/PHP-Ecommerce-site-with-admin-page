<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';
?>


    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>
        <!-- page start-->
        Page content goes here
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->

<?php
      include 'includes/footer.php';
?>
