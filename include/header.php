<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

?>

<?php
if($accesslevel == 0){

	$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
	$client->bindParam(':userId', $userId, PDO::PARAM_INT);
	$client->execute();
	$client_data = $client->fetch();
	$uid = $client_data['uid'];

	$fname = $client_data['c_fname'];
	$mname = $client_data['c_mname'];
	$lname = $client_data['c_lname'];
	$email = $client_data['email'];
	$accnum = $client_data['accnum'];
	$connum = $client_data['connum'];
	$date_added = $client_data['date_added'];

	$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE bal_id = :balId");
	$bal->bindParam(':balId', $userId, PDO::PARAM_INT);
	$bal->execute();
	$bal_data = $bal->fetch();
	if ($bal->rowCount() > 0) {
		$balance = $bal_data['balance'];
	} else {
		$balance = "0.00";
	}

	$name = $fname . " " . $mname . " " . $lname;
}elseif($accesslevel == 1){
	$client = $conn->prepare("SELECT * FROM tbl_independent WHERE user_id = :userId");
	$client->bindParam(':userId', $userId, PDO::PARAM_INT);
	$client->execute();
	$client_data = $client->fetch();
	$uid = $client_data['uid'];

	$inid = $client_data['in_id'];

	$fname = $client_data['fname'];
	$mname = $client_data['mname'];
	$lname = $client_data['lname'];
	$suffix = $client_data['suffix'];
	$email = $client_data['emailadd'];
	$connum = $client_data['connum'];
	$date_added = $client_data['date_added'];
	$accnum = $client_data['accno'];

	$name = $fname . " " . $mname . " " . $lname;
	
	$route = 'service-provider';
}elseif($accesslevel == 2){
	$client = $conn->prepare("SELECT * FROM tbl_company WHERE user_id = :userId");
	$client->bindParam(':userId', $userId, PDO::PARAM_INT);
	$client->execute();
	$client_data = $client->fetch();
	$uid = $client_data['uid'];

	$bname = $client_data['bname'];
	$email = $client_data['emailadd'];
	$connum = $client_data['connum'];
	$date_added = $client_data['date_added'];
	$accnum = $client_data['accno'];

	$name = $bname;

	$route = 'company';
}else{}

	// for image
	$thumbnail = $user_data['thumbnail'];

	if ($user_data['thumbnail']) {
		$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $user_data['thumbnail'];
	} else {
		$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
	}

	if($accesslevel == 0){
		$profileDirect = WEB_ROOT. 'client/profile/index.php?view=profile';
	}elseif($accesslevel == 1){
		$profileDirect =  WEB_ROOT. 'service-provider/profile/index.php?view=prof';
	}else{}
?>
<header id="top-navbar" class="top-navbar">
	<div class="container">
		<div class="top-navbar_full">
			<div class="menu-btn d-flex align-items-center">
				<button class="header-drawer-toggle" style="border: none; background: none;">
					<a href="#offcanvasExample" data-bs-toggle="offcanvas">
						<svg fill="none" height="30" width="30" xmlns="http://www.w3.org/2000/svg">
							<path d="M5 11a1 1 0 1 0 0 2zm14 2a1 1 0 1 0 0-2zM5 6a1 1 0 0 0 0 2zm14 2a1 1 0 1 0 0-2zM5 16a1 1 0 1 0 0 2zm14 2a1 1 0 1 0 0-2zM5 13h14v-2H5zm0-5h14V6H5zm0 10h14v-2H5z" fill="#7D8FAB" />
						</svg>
					</a>
				</button>
			</div>	
			<div class="brookwood-txt d-flex align-items-center">
				<a href="<?php echo WEB_ROOT; ?>">
					<img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="logo" height="40px">
				</a>	
			</div>	
		</div>
	</div>
	<div class="navbar-boder"></div>
</header>

<!-- Setting Menu Section Start -->
<!-- Navigation Drawer -->
<div class="layout-drawer is-open">
	<div class="drawer-header drawer-header-cover" >
		<!-- Blurred background image -->
		
			
	
		<a href="<?php echo $profileDirect ?>">
		<!-- Content on top -->
			<div class="drawer-user" style="position: relative; z-index: 1;">
				<div class="drawer-avatar">
					<img src="<?php echo $image; ?>" alt="avatar">
				</div>
				<div class="drawer-meta">
					<span class="drawer-name"><?php echo $name; ?></span>
				</div>
			</div>
		</a>
	</div>

	<nav class="drawer-navigation">
		<a class="drawer-list-item drawer-icon-right" href="javascript:">
			<span>Email:</span><i class="material-icons"><?php echo $email ?></i>
		</a>
		<a class="drawer-list-item drawer-icon-right" href="javascript:">
			<span>Contact Number:</span><i class="material-icons">+<?php echo $connum ?></i>
		</a>
		<a class="drawer-list-item drawer-icon-right" href="javascript:">
			<span>Registered:</span><i class="material-icons"><?php echo $date_added ?></i>
		</a>
		<a class="drawer-list-item drawer-icon-right" href="javascript:">
			<span>Contact Number:</span><i class="material-icons"><?php echo $accnum ?></i>
		</a>
	</nav>
	<hr>
	<nav class="drawer-navigation drawer-border">

	<?php if($accesslevel != 0){ ?>
		<a href="<?php echo WEB_ROOT; ?><?php echo $route; ?>/index.php?view=service">
			<div class="app-setting-menu-start mt-16">
				<div class="menu-icon">
					<img src="<?php echo WEB_ROOT; ?>assets/images/icon/tools-solid-white.svg" alt="logo" height="23px">
				</div>
				<div class="menu-txt-app">
					<h3 class="app-txt-title">Service Offer</h3>
				</div>
			</div>
			<div class="border-bottom-app mt-8"></div>
		</a>
	<?php }else{} ?>
		<a href="about-us.html">
			<div class="app-setting-menu-start mt-16">
				<div class="menu-icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_1_385" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="white" />
						</mask>
						<g mask="url(#mask0_1_385)">
							<path d="M12 16V12M12 8H12.01M2 8.52274V15.4773C2 15.7218 2 15.8441 2.02763 15.9592C2.05213 16.0613 2.09253 16.1588 2.14736 16.2483C2.2092 16.3492 2.29568 16.4357 2.46863 16.6086L7.39137 21.5314C7.56432 21.7043 7.6508 21.7908 7.75172 21.8526C7.84119 21.9075 7.93873 21.9479 8.04077 21.9724C8.15586 22 8.27815 22 8.52274 22H15.4773C15.7218 22 15.8441 22 15.9592 21.9724C16.0613 21.9479 16.1588 21.9075 16.2483 21.8526C16.3492 21.7908 16.4357 21.7043 16.6086 21.5314L21.5314 16.6086C21.7043 16.4357 21.7908 16.3492 21.8526 16.2483C21.9075 16.1588 21.9479 16.0613 21.9724 15.9592C22 15.8441 22 15.7218 22 15.4773V8.52274C22 8.27815 22 8.15586 21.9724 8.04077C21.9479 7.93873 21.9075 7.84119 21.8526 7.75172C21.7908 7.6508 21.7043 7.56432 21.5314 7.39137L16.6086 2.46863C16.4357 2.29568 16.3492 2.2092 16.2483 2.14736C16.1588 2.09253 16.0613 2.05213 15.9592 2.02763C15.8441 2 15.7218 2 15.4773 2H8.52274C8.27815 2 8.15586 2 8.04077 2.02763C7.93873 2.05213 7.84119 2.09253 7.75172 2.14736C7.6508 2.2092 7.56432 2.29568 7.39137 2.46863L2.46863 7.39137C2.29568 7.56432 2.2092 7.6508 2.14736 7.75172C2.09253 7.84119 2.05213 7.93873 2.02763 8.04077C2 8.15586 2 8.27815 2 8.52274Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</g>
					</svg>
				</div>
				<div class="menu-txt-app">
					<h3 class="app-txt-title">About Us</h3>
				</div>
			</div>
			<div class="border-bottom-app mt-8"></div>
		</a>
		<a href="<?php echo WEB_ROOT; ?>FAQ/">
			<div class="app-setting-menu-start mt-16">
				<div class="menu-icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_1_376" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="white" />
						</mask>
						<g mask="url(#mask0_1_376)">
							<path d="M9.08997 8.99999C9.32507 8.33166 9.78912 7.7681 10.3999 7.40912C11.0107 7.05015 11.7289 6.91893 12.4271 7.0387C13.1254 7.15848 13.7588 7.52151 14.215 8.06352C14.6713 8.60552 14.921 9.29151 14.92 9.99999C14.92 12 11.92 13 11.92 13M12 17H12.01M2 8.52274V15.4773C2 15.7218 2 15.8441 2.02763 15.9592C2.05213 16.0613 2.09253 16.1588 2.14736 16.2483C2.2092 16.3492 2.29568 16.4357 2.46863 16.6086L7.39137 21.5314C7.56432 21.7043 7.6508 21.7908 7.75172 21.8526C7.84119 21.9075 7.93873 21.9479 8.04077 21.9724C8.15586 22 8.27815 22 8.52274 22H15.4773C15.7218 22 15.8441 22 15.9592 21.9724C16.0613 21.9479 16.1588 21.9075 16.2483 21.8526C16.3492 21.7908 16.4357 21.7043 16.6086 21.5314L21.5314 16.6086C21.7043 16.4357 21.7908 16.3492 21.8526 16.2483C21.9075 16.1588 21.9479 16.0613 21.9724 15.9592C22 15.8441 22 15.7218 22 15.4773V8.52274C22 8.27815 22 8.15586 21.9724 8.04077C21.9479 7.93873 21.9075 7.84119 21.8526 7.75172C21.7908 7.6508 21.7043 7.56432 21.5314 7.39137L16.6086 2.46863C16.4357 2.29568 16.3492 2.2092 16.2483 2.14736C16.1588 2.09253 16.0613 2.05213 15.9592 2.02763C15.8441 2 15.7218 2 15.4773 2H8.52274C8.27815 2 8.15586 2 8.04077 2.02763C7.93873 2.05213 7.84119 2.09253 7.75172 2.14736C7.6508 2.2092 7.56432 2.29568 7.39137 2.46863L2.46863 7.39137C2.29568 7.56432 2.2092 7.6508 2.14736 7.75172C2.09253 7.84119 2.05213 7.93873 2.02763 8.04077C2 8.15586 2 8.27815 2 8.52274Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</g>
					</svg>
				</div>
				<div class="menu-txt-app">
					<h3 class="app-txt-title">FAQs</h3>
				</div>
			</div>
			<div class="border-bottom-app mt-8"></div>
		</a>
		<a href="<?php echo WEB_ROOT; ?>feedback/">
			<div class="app-setting-menu-start mt-16">
				<div class="menu-icon">
				<img src="<?php echo WEB_ROOT; ?>assets/images/icon/feedback.svg" iewBox="0 0 24 24" alt="logo" width="26" height="26">

				</div>
				<div class="menu-txt-app">
					<h3 class="app-txt-title">Feedback</h3>
				</div>
			</div>
			<div class="border-bottom-app mt-8"></div>
		</a>
		<a href="<?php echo $self; ?>?logout">
			<div class="app-setting-menu-start mt-16">
				<div class="menu-icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_1_367" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="white" />
						</mask>
						<g mask="url(#mask0_1_367)">
							<path d="M16 17L21 12M21 12L16 7M21 12H9M12 17C12 17.93 12 18.395 11.8978 18.7765C11.6204 19.8117 10.8117 20.6204 9.77646 20.8978C9.39496 21 8.92997 21 8 21H7.5C6.10218 21 5.40326 21 4.85195 20.7716C4.11687 20.4672 3.53284 19.8831 3.22836 19.1481C3 18.5967 3 17.8978 3 16.5V7.5C3 6.10217 3 5.40326 3.22836 4.85195C3.53284 4.11687 4.11687 3.53284 4.85195 3.22836C5.40326 3 6.10218 3 7.5 3H8C8.92997 3 9.39496 3 9.77646 3.10222C10.8117 3.37962 11.6204 4.18827 11.8978 5.22354C12 5.60504 12 6.07003 12 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</g>
					</svg>
				</div>
				<div class="menu-txt-app">
					<h3 class="app-txt-title">Sign Out</h3>
				</div>
			</div>
			<div class="border-bottom-app mt-8"></div>
		</a>

	</nav>
</div>
<!-- Setting Menu Section End -->
