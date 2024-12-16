<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

$thumbnail = $user_data['thumbnail'];

if ($user_data['thumbnail']) {
	$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $user_data['thumbnail'];
} else {
	$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
}

$fname = $user_data['firstname'] . ' ' . $user_data['lastname'];
?>
<!-- ======= Footer ======= -->
<!-- Profile Details Section Start -->
<div class="menu-sidebar details">
	<div class="offcanvas offcanvas-start custom-offcanvas-noti" id="offcanvasExample">
		<div class="offcanvas-header custom-header-offcanva">
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div class="dropdown mt-3">
				<div class="profile-top-sec">
					<div class="profile-top-sec-full">
							<div class="profile-img-sec">
								<img src="<?php echo $image; ?>" >
								
							</div>
							<div class="profile-details-sec">
								<div class="row">
								
									<h3 class="app-setting-title"><?php echo $fname; ?></h3>
									
								</div>
							</div>
					</div>
				</div>	
				
				<h2 class="app-setting-title">Account</h2>
				<div class="app-setting-page-full mt-24">
					<div class="app-setting-top">
						<a href="<?php echo WEB_ROOT; ?>service-provider/index.php?view=service" >
							<div class="app-setting-menu-start mt-16">
								<div class="menu-icon">
									<img src="<?php echo WEB_ROOT; ?>assets/images/icon/tools-solid-white.svg" width="24">
								</div>
								<div class="menu-txt-app">
									<h3 class="app-txt-title">Service Provider</h3>	
								</div>
							</div>
							<div class="border-bottom-app mt-8"></div>
						</a>								
						<a href="about-us.html">
							<div class="app-setting-menu-start mt-16">
								<div class="menu-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_385" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_385)">
											<path d="M12 16V12M12 8H12.01M2 8.52274V15.4773C2 15.7218 2 15.8441 2.02763 15.9592C2.05213 16.0613 2.09253 16.1588 2.14736 16.2483C2.2092 16.3492 2.29568 16.4357 2.46863 16.6086L7.39137 21.5314C7.56432 21.7043 7.6508 21.7908 7.75172 21.8526C7.84119 21.9075 7.93873 21.9479 8.04077 21.9724C8.15586 22 8.27815 22 8.52274 22H15.4773C15.7218 22 15.8441 22 15.9592 21.9724C16.0613 21.9479 16.1588 21.9075 16.2483 21.8526C16.3492 21.7908 16.4357 21.7043 16.6086 21.5314L21.5314 16.6086C21.7043 16.4357 21.7908 16.3492 21.8526 16.2483C21.9075 16.1588 21.9479 16.0613 21.9724 15.9592C22 15.8441 22 15.7218 22 15.4773V8.52274C22 8.27815 22 8.15586 21.9724 8.04077C21.9479 7.93873 21.9075 7.84119 21.8526 7.75172C21.7908 7.6508 21.7043 7.56432 21.5314 7.39137L16.6086 2.46863C16.4357 2.29568 16.3492 2.2092 16.2483 2.14736C16.1588 2.09253 16.0613 2.05213 15.9592 2.02763C15.8441 2 15.7218 2 15.4773 2H8.52274C8.27815 2 8.15586 2 8.04077 2.02763C7.93873 2.05213 7.84119 2.09253 7.75172 2.14736C7.6508 2.2092 7.56432 2.29568 7.39137 2.46863L2.46863 7.39137C2.29568 7.56432 2.2092 7.6508 2.14736 7.75172C2.09253 7.84119 2.05213 7.93873 2.02763 8.04077C2 8.15586 2 8.27815 2 8.52274Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</div>
								<div class="menu-txt-app">
									<h3 class="app-txt-title">About Us</h3>	
								</div>
							</div>
							<div class="border-bottom-app mt-8"></div>
						</a>
						<a href="faq.html" >
							<div class="app-setting-menu-start mt-16">
								<div class="menu-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_376" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_376)">
											<path d="M9.08997 8.99999C9.32507 8.33166 9.78912 7.7681 10.3999 7.40912C11.0107 7.05015 11.7289 6.91893 12.4271 7.0387C13.1254 7.15848 13.7588 7.52151 14.215 8.06352C14.6713 8.60552 14.921 9.29151 14.92 9.99999C14.92 12 11.92 13 11.92 13M12 17H12.01M2 8.52274V15.4773C2 15.7218 2 15.8441 2.02763 15.9592C2.05213 16.0613 2.09253 16.1588 2.14736 16.2483C2.2092 16.3492 2.29568 16.4357 2.46863 16.6086L7.39137 21.5314C7.56432 21.7043 7.6508 21.7908 7.75172 21.8526C7.84119 21.9075 7.93873 21.9479 8.04077 21.9724C8.15586 22 8.27815 22 8.52274 22H15.4773C15.7218 22 15.8441 22 15.9592 21.9724C16.0613 21.9479 16.1588 21.9075 16.2483 21.8526C16.3492 21.7908 16.4357 21.7043 16.6086 21.5314L21.5314 16.6086C21.7043 16.4357 21.7908 16.3492 21.8526 16.2483C21.9075 16.1588 21.9479 16.0613 21.9724 15.9592C22 15.8441 22 15.7218 22 15.4773V8.52274C22 8.27815 22 8.15586 21.9724 8.04077C21.9479 7.93873 21.9075 7.84119 21.8526 7.75172C21.7908 7.6508 21.7043 7.56432 21.5314 7.39137L16.6086 2.46863C16.4357 2.29568 16.3492 2.2092 16.2483 2.14736C16.1588 2.09253 16.0613 2.05213 15.9592 2.02763C15.8441 2 15.7218 2 15.4773 2H8.52274C8.27815 2 8.15586 2 8.04077 2.02763C7.93873 2.05213 7.84119 2.09253 7.75172 2.14736C7.6508 2.2092 7.56432 2.29568 7.39137 2.46863L2.46863 7.39137C2.29568 7.56432 2.2092 7.6508 2.14736 7.75172C2.09253 7.84119 2.05213 7.93873 2.02763 8.04077C2 8.15586 2 8.27815 2 8.52274Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</div>
								<div class="menu-txt-app">
									<h3 class="app-txt-title">FAQs</h3>	
								</div>
							</div>
							<div class="border-bottom-app mt-8"></div>
						</a>
						<a href="<?php echo $self; ?>?logout">
							<div class="app-setting-menu-start mt-16">
								<div class="menu-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_367" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_367)">
											<path d="M16 17L21 12M21 12L16 7M21 12H9M12 17C12 17.93 12 18.395 11.8978 18.7765C11.6204 19.8117 10.8117 20.6204 9.77646 20.8978C9.39496 21 8.92997 21 8 21H7.5C6.10218 21 5.40326 21 4.85195 20.7716C4.11687 20.4672 3.53284 19.8831 3.22836 19.1481C3 18.5967 3 17.8978 3 16.5V7.5C3 6.10217 3 5.40326 3.22836 4.85195C3.53284 4.11687 4.11687 3.53284 4.85195 3.22836C5.40326 3 6.10218 3 7.5 3H8C8.92997 3 9.39496 3 9.77646 3.10222C10.8117 3.37962 11.6204 4.18827 11.8978 5.22354C12 5.60504 12 6.07003 12 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</div>
								<div class="menu-txt-app">
									<h3 class="app-txt-title">Sign Out</h3>	
								</div>
							</div>
							<div class="border-bottom-app mt-8"></div>
						</a>
					</div>							
				</div>	
			</div>
		</div>
	</div>
	<div class="dark-overlay"></div>
</div>
<div id="bottom-navigation" style="width: 1520px !important;">
	<div class="container">
		<div class="home-navigation-menu" >
			<div class="row">
				<div class="col-12">
					<div class="bottom-panel nagivation-menu-wrap">
						<ul class="sc-bottom-bar furniture-bottom-nav" id="furniture_navbar">
							<li class="nav-menu-icon active">
								<a href="<?php echo WEB_ROOT; ?>" class="home-icon navigation-icons active">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_798" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_798)">
											<path d="M8.12602 14C8.57006 15.7252 10.1362 17 12 17C13.8638 17 15.4299 15.7252 15.874 14M11.0177 2.764L4.23539 8.03912C3.78202 8.39175 3.55534 8.56806 3.39203 8.78886C3.24737 8.98444 3.1396 9.20478 3.07403 9.43905C3 9.70352 3 9.9907 3 10.5651V17.8C3 18.9201 3 19.4801 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4801 21 18.9201 21 17.8V10.5651C21 9.9907 21 9.70352 20.926 9.43905C20.8604 9.20478 20.7526 8.98444 20.608 8.78886C20.4447 8.56806 20.218 8.39175 19.7646 8.03913L12.9823 2.764C12.631 2.49075 12.4553 2.35412 12.2613 2.3016C12.0902 2.25526 11.9098 2.25526 11.7387 2.3016C11.5447 2.35412 11.369 2.49075 11.0177 2.764Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</a>
							</li>
							<li class="nav-menu-icon">
								<a href="favourite.html" class="event-icon navigation-icons">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_793" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_793)">
											<path d="M16.1111 3C19.6333 3 22 6.3525 22 9.48C22 15.8138 12.1778 21 12 21C11.8222 21 2 15.8138 2 9.48C2 6.3525 4.36667 3 7.88889 3C9.91111 3 11.2333 4.02375 12 4.92375C12.7667 4.02375 14.0889 3 16.1111 3Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</a>
							</li>
							<li class="nav-menu-icon nav-account-icon">
								<a href="notification.html" class="notification-icon navigation-icons left-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_778" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_778)">
											<path d="M12 6.43994V9.76994" stroke="#666666" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
											<path d="M12.0199 2C8.3399 2 5.3599 4.98 5.3599 8.66V10.76C5.3599 11.44 5.0799 12.46 4.7299 13.04L3.4599 15.16C2.6799 16.47 3.2199 17.93 4.6599 18.41C9.4399 20 14.6099 20 19.3899 18.41C20.7399 17.96 21.3199 16.38 20.5899 15.16L19.3199 13.04C18.9699 12.46 18.6899 11.43 18.6899 10.76V8.66C18.6799 5 15.6799 2 12.0199 2Z" stroke="#666666" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
											<path d="M15.3299 18.8201C15.3299 20.6501 13.8299 22.1501 11.9999 22.1501C11.0899 22.1501 10.2499 21.7701 9.64992 21.1701C9.04992 20.5701 8.66992 19.7301 8.66992 18.8201" stroke="#666666" stroke-width="2" stroke-miterlimit="10"/>
										</g>
									</svg>
								</a>
							</li>
							<li class="nav-menu-icon nav-notifi-icon">
								<a href="<?php echo WEB_ROOT; ?>service-provider/index.php?view=prof" class="account-icon navigation-icons">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_772" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white"/>
										</mask>
										<g mask="url(#mask0_1_772)">
											<path d="M20 21C20 19.6044 20 18.9067 19.8278 18.3389C19.44 17.0605 18.4395 16.06 17.1611 15.6722C16.5933 15.5 15.8956 15.5 14.5 15.5H9.5C8.10444 15.5 7.40665 15.5 6.83886 15.6722C5.56045 16.06 4.56004 17.0605 4.17224 18.3389C4 18.9067 4 19.6044 4 21M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
									</svg>
								</a>
							</li>
						</ul>
						<a class="sc-nav-indicator" href="<?php echo WEB_ROOT; ?>client/?view=add">
							<svg width="20px" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<mask id="mask0_1_786" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
									<rect width="24" height="24" fill="white"/>
								</mask>
								<g mask="url(#mask0_1_786)">
									<path d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M9 8H21" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<!-- Profile Details Section End -->