<?php
if (!defined('WEB_ROOT')) {
	header('Location: index.php');
	exit;
}
    $sql = $conn->prepare("SELECT * FROM bs_page");
    $sql->execute();
    $sql_data = $sql->fetch();

    $page = $sql_data['page'];

	if ($user_data['thumbnail']) {
		$user_img = WEB_ROOT . 'assets/images/employee/' . $user_data['thumbnail'];
	} else {
		$user_img = WEB_ROOT . 'assets/images/user/noimage.png';
	}

?>	
<!-- Setting Menu Section Start -->
<div class="menu-sidebar details">
			<div class="offcanvas offcanvas-start custom-offcanvas-noti" id="offcanvasExample">
				<div class="offcanvas-header custom-header-offcanva">
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<div class="dropdown mt-3">
						<h2 class="app-setting-title">Account</h2>
						<div class="app-setting-page-full mt-24">
							<div class="app-setting-top">
								<a href="home-page2.html">
									<div class="app-setting-menu-start mt-16">
										<div class="menu-icon">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<mask id="mask0_1_4844" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
													<rect width="24" height="24" fill="white"/>
												</mask>
												<g mask="url(#mask0_1_4844)">
													<path d="M8.12602 14C8.57006 15.7252 10.1362 17 12 17C13.8638 17 15.4299 15.7252 15.874 14M11.0177 2.764L4.23539 8.03912C3.78202 8.39175 3.55534 8.56806 3.39203 8.78886C3.24737 8.98444 3.1396 9.20478 3.07403 9.43905C3 9.70352 3 9.9907 3 10.5651V17.8C3 18.9201 3 19.4801 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4801 21 18.9201 21 17.8V10.5651C21 9.9907 21 9.70352 20.926 9.43905C20.8604 9.20478 20.7526 8.98444 20.608 8.78886C20.4447 8.56806 20.218 8.39175 19.7646 8.03913L12.9823 2.764C12.631 2.49075 12.4553 2.35412 12.2613 2.3016C12.0902 2.25526 11.9098 2.25526 11.7387 2.3016C11.5447 2.35412 11.369 2.49075 11.0177 2.764Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</g>
											</svg>

										</div>
										<div class="menu-txt-app">
											<h3 class="app-txt-title">Homepage2</h3>	
										</div>
									</div>
									<div class="border-bottom-app mt-8"></div>
								</a>
								<a href="new-password-screen.html">
									<div class="app-setting-menu-start mt-16">
										<div class="menu-icon">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<mask id="mask0_1_412" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
													<rect width="24" height="24" fill="white"/>
												</mask>
												<g mask="url(#mask0_1_412)">
													<path d="M22 11V8.2C22 7.0799 22 6.51984 21.782 6.09202C21.5903 5.71569 21.2843 5.40973 20.908 5.21799C20.4802 5 19.9201 5 18.8 5H5.2C4.0799 5 3.51984 5 3.09202 5.21799C2.71569 5.40973 2.40973 5.71569 2.21799 6.09202C2 6.51984 2 7.0799 2 8.2V11.8C2 12.9201 2 13.4802 2.21799 13.908C2.40973 14.2843 2.71569 14.5903 3.09202 14.782C3.51984 15 4.0799 15 5.2 15H11M12 10H12.005M17 10H17.005M7 10H7.005M19.25 17V15.25C19.25 14.2835 18.4665 13.5 17.5 13.5C16.5335 13.5 15.75 14.2835 15.75 15.25V17M12.25 10C12.25 10.1381 12.1381 10.25 12 10.25C11.8619 10.25 11.75 10.1381 11.75 10C11.75 9.86193 11.8619 9.75 12 9.75C12.1381 9.75 12.25 9.86193 12.25 10ZM17.25 10C17.25 10.1381 17.1381 10.25 17 10.25C16.8619 10.25 16.75 10.1381 16.75 10C16.75 9.86193 16.8619 9.75 17 9.75C17.1381 9.75 17.25 9.86193 17.25 10ZM7.25 10C7.25 10.1381 7.13807 10.25 7 10.25C6.86193 10.25 6.75 10.1381 6.75 10C6.75 9.86193 6.86193 9.75 7 9.75C7.13807 9.75 7.25 9.86193 7.25 10ZM15.6 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V18.6C21 18.0399 21 17.7599 20.891 17.546C20.7951 17.3578 20.6422 17.2049 20.454 17.109C20.2401 17 19.9601 17 19.4 17H15.6C15.0399 17 14.7599 17 14.546 17.109C14.3578 17.2049 14.2049 17.3578 14.109 17.546C14 17.7599 14 18.0399 14 18.6V19.4C14 19.9601 14 20.2401 14.109 20.454C14.2049 20.6422 14.3578 20.7951 14.546 20.891C14.7599 21 15.0399 21 15.6 21Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</g>
											</svg>
										</div>
										<div class="menu-txt-app">
											<h3 class="app-txt-title">Change Password</h3>	
										</div>
									</div>
									<div class="border-bottom-app mt-8"></div>
								</a>
								<a href="currency.html">
									<div class="app-setting-menu-start mt-16">
										<div class="menu-icon">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<mask id="mask0_1_403" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
													<rect width="24" height="24" fill="white"/>
												</mask>
												<g mask="url(#mask0_1_403)">
													<path d="M8.5 14.6667C8.5 15.9553 9.54467 17 10.8333 17H13C14.3807 17 15.5 15.8807 15.5 14.5C15.5 13.1193 14.3807 12 13 12H11C9.61929 12 8.5 10.8807 8.5 9.5C8.5 8.11929 9.61929 7 11 7H13.1667C14.4553 7 15.5 8.04467 15.5 9.33333M12 5.5V7M12 17V18.5M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</g>
											</svg>
										</div>
										<div class="menu-txt-app">
											<h3 class="app-txt-title">Currency</h3>	
										</div>
									</div>
									<div class="border-bottom-app mt-8"></div>
								</a>
								<a href="change-language.html">
									<div class="app-setting-menu-start mt-16">
										<div class="menu-icon">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<mask id="mask0_1_394" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
													<rect width="24" height="24" fill="white"/>
												</mask>
												<g mask="url(#mask0_1_394)">
													<path d="M4 7C4 6.06812 4 5.60218 4.15224 5.23463C4.35523 4.74458 4.74458 4.35523 5.23463 4.15224C5.60218 4 6.06812 4 7 4H17C17.9319 4 18.3978 4 18.7654 4.15224C19.2554 4.35523 19.6448 4.74458 19.8478 5.23463C20 5.60218 20 6.06812 20 7M9 20H15M12 4V20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</g>
											</svg>
										</div>
										<div class="menu-txt-app">
											<h3 class="app-txt-title">Change Language</h3>	
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
								<a href="faq.html">
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
								<a href="index.html">
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
							<div class="app-setting-bottom mt-24">
								<div class="app-setting-bottom-full">
									<h2 class="app-bottom-txt">More Options</h2>
									<div class="switch-sec mt-16">
										<div>
											<h3 class="app-switch-txt1">Email Newsletter</h3>
										</div>
										<div class="app-setting-switch">
											<label class="switch app-switch">
												<input type="checkbox" checked="">
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="switch-sec mt-16">
										<div>
											<h3 class="app-switch-txt1">Text Messages</h3>
										</div>
										<div class="app-setting-switch">
											<label class="switch app-switch">
												<input type="checkbox">
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="dark-overlay"></div>
		</div>
		<!-- Setting Menu Section End -->