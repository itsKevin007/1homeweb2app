<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

?>
		<header id="top-navbar" class="top-navbar"> 
			<div class="container">
				<div class="top-navbar_full">
					<div class="menu-btn d-flex align-items-center">
						<a href="#offcanvasExample" data-bs-toggle="offcanvas"><img src="<?php echo WEB_ROOT; ?>assets/images/profile-page/menu-icon.svg" alt="menu-icon"></a>
					</div>
					<div class="brookwood-txt d-flex align-items-center">
						<p class="brookwood-txt">Brookwood</p>
					</div>
					<div>
						<ul class="homepage-cart-sec">
							<li><a href="search-page.html"><img src="<?php echo WEB_ROOT; ?>assets/images/homepage/search-icon.svg" alt="search-icon"></a></li>
							<li class="pf-16"><a href="shopping-cart.html"><img src="<?php echo WEB_ROOT; ?>assets/images/homepage/cart-icon.svg" alt="cart-icon"><span class="cart-item">2</span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="navbar-boder"></div>
		</header>