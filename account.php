<?php
    require_once 'core/init.php';
    if(!is_logged_in3()){
      login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navbar.php';
    //include 'includes/cart.php';
?>

<!-- breadcrumb -->
<div class="container">
  <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
      Home
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
      Men
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4">
      My Account
    </span><br>
  </div>
  <div class="flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <h2 class="page-header">Account Information</h2>
  </div>
</div>

<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="flex-w flex-tr">
      <div class="border border-dark col-lg-3">
        <div class="border-bottom">
          <h5 class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-account-circle m-r-10"></i>      My Profile</h5>
          <ul class="nav">
            <li class="active">
              <a data-toggle="tab" href="#account-information" class="stext-109 cl8 hov-cl1 trans-04 p-l-21 m-l-21">
                Account Information.
              </a><br>
            </li>
            <li>
              <a data-toggle="tab" href="#delivery-address" class="stext-109 cl8 hov-cl1 trans-04 p-l-21 m-l-21">
                Delivery Address.
              </a>
            </li>
          </ul>
          <hr>
        </div>
        <div class="border-bottom">
          <h5 class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-blur-linear m-r-10"></i>      My Orders</h5>
          <ul class="nav">
            <li>
              <a data-toggle="tab" href="#Orders" class="stext-109 cl8 hov-cl1 trans-04 p-l-21 m-l-21">
                   Orders.
              </a><br>
            </li>
          </ul>
          <hr>
        </div>
        <div class="border-bottom m-b-50">
          <h5 class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-balance-wallet"></i>      My Wallet</h5>
          <ul class="nav">
            <li class="active">
              <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04 p-l-21 m-l-21">
                Wallet.
              </a><br>
            </li>
          </ul>

        </div>

      </div>
      <div class="col-lg-1">

      </div>
      <div class="border border-dark col-lg-8">
        <div class="panel-body">
          <div class="tab-content">
            <?php
                  include 'includes/account-information.php';
                  include 'includes/delivery-address.php';
                  include 'includes/footer.php';

            ?>
