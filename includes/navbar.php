<!-- Header -->
<div class="header-v4">
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->
		<!--<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					Free shipping for standard order over $100
				</div>
				<div class="right-top-bar flex-w h-full">
					<a href="#" class="flex-c-m trans-04 p-lr-25">
						Help & FAQs
					</a>
					<a href="#" class="flex-c-m trans-04 p-lr-25">
						My Account
					</a>
					<a href="#" class="flex-c-m trans-04 p-lr-25">
						EN
					</a>
					<a href="#" class="flex-c-m trans-04 p-lr-25">
						USD
					</a>
				</div>
			</div>
		</div>-->

		<div class="wrap-menu-desktop">
		<nav class="navbar navbar-expand-lg limiter-menu-desktop container">


				<!-- Logo desktop -->
				<a href="index.php" class="logo">
					<img src="images/icons/logo-01.png" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<!--<li>
							<a href="index.html">Home</a>
							<ul class="sub-menu">
								<li><a href="index.html">Homepage 1</a></li>
								<li><a href="home-02.html">Homepage 2</a></li>
								<li><a href="home-03.html">Homepage 3</a></li>
							</ul>
						</li>-->

						<li class="active-menu">
							<a href="index.php">Home</a>
						</li>

						<li class="label1" data-label1="hot">
							<a href="products.php">Shop</a>
						</li>

						<li>
							<a href="sell.php">Sell</a>
						</li>

						<li>
							<a href="about.php">About Us</a>
						</li>

						<li>
							<a href="contact.php">Contact</a>
						</li>
					</ul>
				</div>

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
						<i class="zmdi zmdi-search"></i>
					</div>

					<?php if ($cart_id != ''): ?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $i; ?>">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
					<?php else: ?>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					<?php endif; ?>

					<?php if ($wish_id != ''): ?>
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wish-list" data-notify="<?= $m; ?>">
								<i class="zmdi zmdi-favorite-outline"></i>
							</div>
					<?php else: ?>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wish-list" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</div>
					<?php endif; ?>
					<?php if(!is_logged_in3()): ?>
						<ul class="main-menu">
							<li>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 js-show-profile">
									<i class="zmdi zmdi-account-o zmdi-hc-lg"></i>
								</div>
								<ul class="sub-menu">
									<li><a href="login.php" class=""><i class="zmdi zmdi-account-o zmdi-hc-lg p-r-20"></i>Sign In</a></li>
									<li><a href="Signup.php"><i class="zmdi zmdi-blur-linear zmdi-hc-lg p-r-20"></i>Join Us</a></li>
								</ul>
							</li>
						</ul>
				  <?php else: ?>
						<ul class="main-menu">
							<li>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22">
										<i class="zmdi zmdi-account-o zmdi-hc-lg"></i>
								</div>
								<ul class="sub-menu">
									<li><a href="account.php" class=""><i class="zmdi zmdi-account-o zmdi-hc-lg p-r-20"></i>My Account</a></li>
									<li><a href="#"><i class="zmdi zmdi-blur-linear zmdi-hc-lg p-r-20"></i>My Orders</a></li>
									<li><a href="#"><i class="zmdi zmdi-pin-drop zmdi-hc-lg p-r-20"></i>Track My Order</a></li>
									<li><a href="logout.php"><i class="zmdi zmdi-key zmdi-hc-lg p-r-20"></i>Log-Out</a></li>
								</ul>
							</li>
							<li><a href="#">Hi  <?= $customer_data['first']; ?></a></li>
						</ul>
				<?php endif; ?>
				</div>
			</nav>
		</div>
	</div>


	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->
		<div class="logo-mobile">
			<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
				<i class="zmdi zmdi-search"></i>
			</div>

			<?php if ($cart_id != ''): ?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $i; ?>">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
			<?php else: ?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="0">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
			<?php endif; ?>

			<?php if ($wish_id != ''): ?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-wish-list" data-notify="<?= $m; ?>">
						<i class="zmdi zmdi-favorite-outline"></i>
					</div>
			<?php else: ?>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-wish-list" data-notify="0">
						<i class="zmdi zmdi-favorite-outline"></i>
					</div>
			<?php endif; ?>

			<?php if(!is_logged_in3()): ?>
				<ul class="main-menu">
					<li>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 js-show-profile">
							<i class="zmdi zmdi-account-o zmdi-hc-lg"></i>
						</div>
						<ul class="sub-menu">
							<li><a href="login.php" class=""><i class="zmdi zmdi-account-o zmdi-hc-lg p-r-20"></i>Sign In</a></li>
							<li><a href="Signup.php"><i class="zmdi zmdi-blur-linear zmdi-hc-lg p-r-20"></i>Join Us</a></li>
						</ul>
					</li>
				</ul>
			<?php else: ?>



			<ul class="main-menu">
				<li>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22">
							<i class="zmdi zmdi-account-o zmdi-hc-lg"></i>
						</div>
					<ul class="sub-menu">
						<li><a href="account.php" class=""><i class="zmdi zmdi-account-o zmdi-hc-lg p-r-20"></i>My Account</a></li>
						<li><a href="#"><i class="zmdi zmdi-blur-linear zmdi-hc-lg p-r-20"></i>My Orders</a></li>
						<li><a href="#"><i class="zmdi zmdi-pin-drop zmdi-hc-lg p-r-20"></i>Track My Order</a></li>
						<li><a href="logout.php"><i class="zmdi zmdi-key zmdi-hc-lg p-r-20"></i>Log-Out</a></li>
					</ul>
				</li>
				<li><a href="#">Hi  <?= $customer_data['first']; ?></a></li>
			</ul>
		<?php endif; ?>
		</div>


		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<!--<ul class="topbar-mobile">
			<li>
				<div class="left-top-bar">
					Free shipping for standard order over $100
				</div>
			</li>
			<li>
				<div class="right-top-bar flex-w h-full">
					<a href="#" class="flex-c-m p-lr-10 trans-04">
						Help & FAQs
					</a>
					<a href="#" class="flex-c-m p-lr-10 trans-04">
						My Account
					</a>
					<a href="#" class="flex-c-m p-lr-10 trans-04">
						EN
					</a>
					<a href="#" class="flex-c-m p-lr-10 trans-04">
						USD
					</a>
				</div>
			</li>
		</ul>-->

		<ul class="main-menu-m">
			<!--<li>
				<a href="index.html">Home</a>
				<ul class="sub-menu-m">
					<li><a href="index.html">Homepage 1</a></li>
					<li><a href="home-02.html">Homepage 2</a></li>
					<li><a href="home-03.html">Homepage 3</a></li>
				</ul>
				<span class="arrow-main-menu-m">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</span>
			</li>-->
			<li>
				<a href="index.php">Home</a>
			</li>

			<li>
				<a href="products.php" class="label1 rs1" data-label1="hot">Shop</a>
			</li>

			<li>
				<a href="sell.php">Sell</a>
			</li>

			<li>
				<a href="about.php">About</a>
			</li>

			<li>
				<a href="contact.php">Contact Us</a>
			</li>
		</ul>
	</div>

	<!-- Modal Search -->
	<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
		<div class="container-search-header">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<img src="images/icons/icon-close2.png" alt="CLOSE">
			</button>
<?php $search = ((isset($_REQUEST['search']))? sanitize($_REQUEST['search']): ''); ?>
			<form action="searchProducts.php" method="POST" class="wrap-search-header flex-w p-l-15">
				<button class="flex-c-m trans-04">
					<i class="zmdi zmdi-search"></i>
				</button>
				<input class="plh3" type="text" name="search" value="<?= $search; ?>"placeholder="What are you Looking for...?" required>
			</form>
		</div>
	</div>
</div>
