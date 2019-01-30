<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';
?>
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
          <li><i class="fa fa-user-md"></i>Profile</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <!-- profile-widget -->
      <div class="col-lg-12">
        <div class="profile-widget profile-widget-info">
          <div class="panel-body">
            <div class="col-lg-2 col-sm-2">
              <h4><?= $user_data['full_name']; ?></h4>
              <div class="follow-ava">
                <img src="<?= $user_data['images']; ?>" alt="">
              </div>
              <h6>Administrator</h6>
            </div>
            <div class="col-lg-4 col-sm-4 follow-info">
              <p>Hello I’m <?= $user_data['full_name']; ?>, a leading expert in interactive and creative web design specializing  as a/an <?= $user_data['Occupation']; ?>.</p>
              <p>email: <?= $user_data['email']; ?></p>
              <p><i class="fa fa-twitter">twitter: jenifertweet</i></p>
              <h6>
                                <span><i class="icon_clock_alt"></i><?= date("H:i:s"); ?></span>
                                <span><i class="icon_calendar"></i><?= date("Y-m-d"); ?></span>
                                <span><i class="icon_pin_alt"></i>ABJ</span>
                            </h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading tab-bg-info">
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#recent-activity">
                                      <i class="icon-home"></i>
                                      Daily Activity
                                  </a>
              </li>
              <li>
                <a data-toggle="tab" href="#profile">
                                      <i class="icon-user"></i>
                                      Profile
                                  </a>
              </li>
              <li class="">
                <a data-toggle="tab" href="#edit-profile">
                                      <i class="icon-envelope"></i>
                                      Edit Profile
                                  </a>
              </li>
            </ul>
          </header>
          <div class="panel-body">
            <div class="tab-content">
              <?php
                    include 'includes/activity.php';
                    include 'includes/display_profile.php';
                    include 'includes/edit_profile.php';
                    include 'includes/footer.php';
              ?>
