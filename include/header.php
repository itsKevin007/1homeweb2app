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
			<a href="#offcanvasExample" data-bs-toggle="offcanvas"><img src="<?php echo WEB_ROOT; ?>assets/images/icon/burger-menu.svg" alt="menu-icon"></h3></a>
			</div>
			<div class="brookwood-txt d-flex align-items-center">
				<a href="<?php echo WEB_ROOT; ?>" ><img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" style="width: 150px;" alt="menu-icon"></a>
			</div>
			<div>
				<ul class="homepage-cart-sec">
					
					
					<!-- <?php if($userId != ''){ ?>
						<li class="pf-16 dropdown">
							<span class="dropdown-toggle" id="userDropdown">
								<?php echo $user_data['firstname']; ?> <?php echo $user_data['lastname']; ?>
							</span>
							<ul class="dropdown-menu">
								<li><a href="settings.php">Settings</a></li>
								<li><a href="<?php echo $self; ?>?logout" >Logout</a></li>
							</ul>
						</li>


					<?php } else { ?>	
						<li class="pf-16"><a href="login.php">Log in</a></li>
					<?php } ?> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="navbar-boder"></div>
</header>