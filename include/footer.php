<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}


$PAGE = $conn->prepare("SELECT page FROM bs_page WHERE p_id = '1'");
$PAGE->execute();
$PAGEDATA = $PAGE->fetchColumn();


if ($accesslevel == 0) {
	$profileDirect = WEB_ROOT . 'client/profile/index.php?view=profile';
	$transactDirect = WEB_ROOT . 'client/transactions';
} elseif ($accesslevel == 1) {
	$profileDirect =  WEB_ROOT . 'service-provider/profile/index.php?view=prof';
	$transactDirect =  WEB_ROOT . 'service-provider/transactions';
} elseif ($accesslevel == 2) {
	$profileDirect =  WEB_ROOT . 'company/profile/index.php?view=prof';
	$transactDirect =  WEB_ROOT . 'company/transactions/index.php?view=transact';
}

?>
<!-- ======= Footer ======= -->
<link href="<?php echo WEB_ROOT; ?>style/notif-dot.css" rel="stylesheet">

<!-- Profile Details Section Start -->
<div id="bottom-navigation">
	<div class="container">
		<div class="home-navigation-menu-wrap">
			<div class="row">
				<div class="col-12">
					<div class="bottom-panel nagivation-menu">
						<ul class="sc-bottom-bar furniture-bottom-nav" id="furniture_navbar">
							<li class="nav-menu-icon <?php echo $active; ?>">
								<a href="<?php echo WEB_ROOT; ?>" class="home-icon navigation-icons <?php echo ($PAGEDATA === 'Dashboard') ? 'active' : ''; ?>">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_798" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white" />
										</mask>
										<g mask="url(#mask0_1_798)">
											<path d="M8.12602 14C8.57006 15.7252 10.1362 17 12 17C13.8638 17 15.4299 15.7252 15.874 14M11.0177 2.764L4.23539 8.03912C3.78202 8.39175 3.55534 8.56806 3.39203 8.78886C3.24737 8.98444 3.1396 9.20478 3.07403 9.43905C3 9.70352 3 9.9907 3 10.5651V17.8C3 18.9201 3 19.4801 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4801 21 18.9201 21 17.8V10.5651C21 9.9907 21 9.70352 20.926 9.43905C20.8604 9.20478 20.7526 8.98444 20.608 8.78886C20.4447 8.56806 20.218 8.39175 19.7646 8.03913L12.9823 2.764C12.631 2.49075 12.4553 2.35412 12.2613 2.3016C12.0902 2.25526 11.9098 2.25526 11.7387 2.3016C11.5447 2.35412 11.369 2.49075 11.0177 2.764Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</g>
									</svg>
								</a>
							</li>
							<li class="history-icon nav-menu-icon">
								<a href="<?php echo $transactDirect; ?>" class="event-icon navigation-icons <?php echo ($PAGEDATA === 'Transactions') ? 'active' : ''; ?>">
									<img class="history-icon" src="<?php echo WEB_ROOT; ?>/assets/images/icons/history.png" alt="favourite-icon" height="24px" width="24px">
								</a>
							</li>
							<li class="nav-menu-icon nav-account-icon" style="position: relative;">
								<a href="<?php echo WEB_ROOT; ?>notification/" class="notification-icon navigation-icons left-icon <?php echo ($PAGEDATA === 'notification') ? 'active' : ''; ?>">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_778" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white" />
										</mask>
										<g mask="url(#mask0_1_778)">
											<path d="M12 6.43994V9.76994" stroke="#666666" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
											<path d="M12.0199 2C8.3399 2 5.3599 4.98 5.3599 8.66V10.76C5.3599 11.44 5.0799 12.46 4.7299 13.04L3.4599 15.16C2.6799 16.47 3.2199 17.93 4.6599 18.41C9.4399 20 14.6099 20 19.3899 18.41C20.7399 17.96 21.3199 16.38 20.5899 15.16L19.3199 13.04C18.9699 12.46 18.6899 11.43 18.6899 10.76V8.66C18.6799 5 15.6799 2 12.0199 2Z" stroke="#666666" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
											<path d="M15.3299 18.8201C15.3299 20.6501 13.8299 22.1501 11.9999 22.1501C11.0899 22.1501 10.2499 21.7701 9.64992 21.1701C9.04992 20.5701 8.66992 19.7301 8.66992 18.8201" stroke="#666666" stroke-width="2" stroke-miterlimit="10" />
										</g>
									</svg>
									<?php
									// Add PHP logic to display the dot based on rowCount
									$notificationsSQL = $conn->prepare("SELECT * FROM tbl_notifications WHERE user_id = :userId AND is_read = '0'");
									$notificationsSQL->bindParam(':userId', $userId, PDO::PARAM_INT);
									$notificationsSQL->execute();

									$unreadCount = $notificationsSQL->rowCount();

									if ($unreadCount > 0) {
										echo '<span class="notification-dot"></span>';
									}
									
									?>
								</a>
							</li>

							<li class="nav-menu-icon nav-notifi-icon">


								<a href="<?php echo $profileDirect; ?>" class="account-icon navigation-icons <?php echo ($PAGEDATA === 'Profile') ? 'active' : ''; ?>">


									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_772" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white" />
										</mask>
										<g mask="url(#mask0_1_772)">
											<path d="M20 21C20 19.6044 20 18.9067 19.8278 18.3389C19.44 17.0605 18.4395 16.06 17.1611 15.6722C16.5933 15.5 15.8956 15.5 14.5 15.5H9.5C8.10444 15.5 7.40665 15.5 6.83886 15.6722C5.56045 16.06 4.56004 17.0605 4.17224 18.3389C4 18.9067 4 19.6044 4 21M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />

										</g>
									</svg>
								</a>
							</li>
						</ul>


						<a href="<?php echo WEB_ROOT; ?>client/services/index.php?view=services">
							<div class="sc-nav-indicator">
								<label class="circle">
									<img style="object-fit: contain; margin:10px 0 0 -5px;" src="<?php echo WEB_ROOT; ?>assets/images/icons/ohlogo1.png" alt="user-img" title="" height="60%" width="60%">
								</label>

							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>