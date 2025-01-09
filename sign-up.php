<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';

if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

$errorMessage = '&nbsp;';


if (isset($_POST['txtUserNameAdmin'] )) {
	$result = doLoginAdmin();

	if ($result != '') {
		$errorMessage = $result;
	}
}

$sweetAlert = isset($_GET['mail']) ? $_GET['mail'] : '';


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
<title><?php echo $sett_data['system_title']; ?> - Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Lending System - www.tridentechnology.com" name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_ROOT; ?>assets/images/icons/onehome.png">

<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); ?>
<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/misc-js.php'); ?>	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LfaaVkqAAAAAOwKZTEsCxP8Lx6S6D9rPGLuwmPH"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
<?php 

	if ($sweetAlert == 'success') {
		?>
			<script>
			document.addEventListener('DOMContentLoaded', () => {
				Swal.fire({
				title: 'Registered!',
				text: 'You can now login.',
				icon: 'success', // Options: 'success', 'error', 'warning', 'info', 'question'
				showConfirmButton: true,
				confirmButtonText: 'Let\'s Go!',
				timer: 5000, // Auto-dismiss after 5 seconds
				timerProgressBar: true,
				backdrop: 'rgba(0, 0, 0, 0.8)', // Dark semi-transparent backdrop
				background: '#1e1e1e', // Dark background color
				color: '#ffffff', // White text color
				customClass: {
					popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
					confirmButton: 'swal2-confirm-dark' // Custom style for the button
				}
				});
			});
			</script>
		<style>
			<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/sweet-alert-success.css'); ?>
		</style>
	<?php
	} elseif ($sweetAlert == 'exist') {
		?>
			<script>
				document.addEventListener('DOMContentLoaded', () => {
					Swal.fire({
					title: 'Email already Exist',
					text: 'Please try another email.',
					icon: 'error', // Options: 'success', 'error', 'warning', 'info', 'question'
					showConfirmButton: true,
					confirmButtonText: 'OK',
					timer: 5000, // Auto-dismiss after 5 seconds
					timerProgressBar: true,
					backdrop: 'rgba(0, 0, 0, 0.8)', // Dark semi-transparent backdrop
					background: '#1e1e1e', // Dark background color
					color: '#ffffff', // White text color
					customClass: {
						popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
						confirmButton: 'swal2-confirm-dark' // Custom style for the button
					}
					});
				});
			</script>
		
			<style>
				<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/sweet-alert-failed.css'); ?>
			</style>
	<?php
		}elseif ($sweetAlert == 'error') {
	?>
		<script>
			document.addEventListener('DOMContentLoaded', () => {
				Swal.fire({
				title: 'Registered Failed',
				text: 'Please try again and check all the details.',
				icon: 'error', // Options: 'success', 'error', 'warning', 'info', 'question'
				showConfirmButton: true,
				confirmButtonText: 'OK',
				timer: 5000, // Auto-dismiss after 5 seconds
				timerProgressBar: true,
				backdrop: 'rgba(0, 0, 0, 0.8)', // Dark semi-transparent backdrop
				background: '#1e1e1e', // Dark background color
				color: '#ffffff', // White text color
				customClass: {
					popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
					confirmButton: 'swal2-confirm-dark' // Custom style for the button
				}
				});
			});
		</script>

		<style>
			<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/sweet-alert-failed.css'); ?>
		</style>
	<?php
		}else{}
	?>

    <div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="text-center">   
						<a href="#">
						<!-- <img src="../assets/images/logo-dark.png" alt="" height="22" class="mx-auto"> -->
						<h1> <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="300px"></h1>
					</a>
					<!-- <p class="text-muted mt-2 mb-4">Lending</p> -->

				</div><br><br>
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card mb-0">							                                                    
							<a href="#" class="card-body text-center " class="btn btn-light" data-bs-toggle="modal" data-bs-target="#Client">Client</button>
								<!-- Modal -->										
							</a>
							<div class="modal fade" id="Client" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Client</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										
										<div class="modal-body">
											<form method="post" action="sign-folder/client.php" enctype="multipart/form-data" name="form" id="form" class="row g-3">
												<div class="col-md-6">
													<label for="inputFirstName" class="form-label">First Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="firstName" class="form-control border-start-0" id="inputFirstName" placeholder="First Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="inputMiddleName" class="form-label">Middle Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="middleName" class="form-control border-start-0" id="inputMiddleName" placeholder="Middle Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="inputLastName" class="form-label">Last Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="lastName" class="form-control border-start-0" id="inputLastName" placeholder="Last Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="Suffix" class="form-label">Suffix</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="suffix" class="form-control border-start-0" id="Suffix" placeholder="Ex: Jr / Sr (optional)"/>
													</div>
												</div>
												<div class="col-md-12">
													<label for="inputPhoneNo" class="form-label">Contact Number</label>
													<div class="input-group"> <span class="input-group-text"><i class="lni lni-phone"></i></i></span>
														<input type="text" name="conNum" class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No" required/>
													</div>
												</div>
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Email Address</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-message' ></i></span>
														<input type="email" name="emailAdd" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" required/>
													</div>
												</div>												
												<div class="col-6">
													<label for="inputAddress3" class="form-label">Region</label>
													<select name="region" class="form-control form-control-md" id="region"></select>
													<input type="hidden" name="region_text" class="form-control border-start-0" id="region-text" required/>
												</div>
												<div class="col-6">
													<label for="inputAddress3" class="form-label">Province</label>
													<select name="province" class="form-control form-control-md" id="province"></select>
													<input type="hidden" name="province_text" class="form-control border-start-0" id="province-text" required/>
												</div>
												<div class="col-6">
													<label for="inputAddress3" class="form-label">City/Municipality</label>
													<select name="city" class="form-control form-control-md" id="city"></select>
													<input type="hidden" name="city_text" class="form-control border-start-0" id="city-text" required/>
												</div>
												<div class="col-6">
													<label for="inputAddress3" class="form-label">Barangay</label>
													<select name="barangay" class="form-control form-control-md" id="barangay"></select>
													<input type="hidden" name="barangay_text" class="form-control border-start-0" id="barangay-text" required/>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Choose Password</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-lock-open' ></i></span>
														<input type="password" name="password" class="form-control border-start-0" id="inputChoosePassword" placeholder="Choose Password" required />
													</div>
												</div>
												<input type="text" name="recaptcha_response"  class="form-control" id="recaptchaResponse">
												<div class="modal-footer">
													<button type="submit"  class="btn btn-primary"  onClick="return confirmSubmit()">Save changes</button>
												</div>
											</form>
											
										</div>

										
									</div>
								</div>
							</div>																								
						</div><br>

						<div class="card mb-0">							                              
							<a href="#" class="card-body text-center " class="btn btn-light" data-bs-toggle="modal" data-bs-target="#serviceProvider">Independent Service Provider</button>
								<!-- Modal -->										
							</a>
							<div class="modal fade" id="serviceProvider" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Independent Service Provider</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form method="post" action="sign-folder/independent.php" enctype="multipart/form-data" name="form" id="form2" class="row g-3">
												<div class="col-md-6">
													<label for="inputFirstName" class="form-label">First Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="firstName" class="form-control border-start-0" id="inputFirstName" placeholder="First Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="inputMiddleName" class="form-label">Middle Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="middleName" class="form-control border-start-0" id="inputMiddleName" placeholder="Middle Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="inputLastName" class="form-label">Last Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="lastName" class="form-control border-start-0" id="inputLastName" placeholder="Last Name" required/>
													</div>
												</div>
												<div class="col-md-6">
													<label for="Suffix" class="form-label">Suffix</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="suffix" class="form-control border-start-0" id="Suffix" placeholder="Ex: Jr / Sr (optional)"/>
													</div>
												</div>
												<div class="col-md-12">
													<label for="inputPhoneNo" class="form-label">Contact Number</label>
													<div class="input-group"> <span class="input-group-text"><i class="lni lni-phone"></i></i></span>
														<input type="text" name="conNum" class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No" required/>
													</div>
												</div>
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Email Address</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-message' ></i></span>
														<input type="email" name="emailAdd" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" required/>
													</div>
												</div>												
												<div class="col-6">
													<label for="region" class="form-label">Region</label>
													<select name="region" class="form-control form-control-md" id="region2"></select>
													<input type="hidden" name="region_text" class="form-control border-start-0" id="region-text2" required/>
												</div>
												<div class="col-6">
													<label for="province" class="form-label">Province</label>
													<select name="province" class="form-control form-control-md" id="province2"></select>
													<input type="hidden" name="province_text" class="form-control border-start-0" id="province-text2" required/>
												</div>
												<div class="col-6">
													<label for="city" class="form-label">City/Municipality</label>
													<select name="city" class="form-control form-control-md" id="city2"></select>
													<input type="hidden" name="city_text" class="form-control border-start-0" id="city-text2" required/>
												</div>
												<div class="col-6">
													<label for="barangay" class="form-label">Barangay</label>
													<select name="barangay" class="form-control form-control-md" id="barangay2"></select>
													<input type="hidden" name="barangay_text" class="form-control border-start-0" id="barangay-text2" required/>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Choose Password</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-lock-open' ></i></span>
														<input type="password" name="password" class="form-control border-start-0" id="inputChoosePassword" placeholder="Choose Password" required />
													</div>
												</div>
												<input type="text" name="recaptcha_response"  class="form-control" id="recaptchaResponse2">
												<div class="modal-footer">
													<button type="submit"  class="btn btn-primary" onClick="return confirmSubmit()">Save changes</button>
												</div>
											</form>																
										</div>											
									</div>
								</div>
							</div>																								
						</div><br>

						<div class="card mb-0">							                              
							<a href="#" class="card-body text-center " class="btn btn-light" data-bs-toggle="modal" data-bs-target="#serviceCompany">Company Service Provider</button>
								<!-- Modal -->										
							</a>
							<div class="modal fade" id="serviceCompany" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Company Service Provider</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form method="post" action="sign-folder/company.php" enctype="multipart/form-data" name="form" id="form3" class="row g-3">
												<div class="col-md-12">
													<label for="inputFirstName" class="form-label">Company Name</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-user'></i></span>
														<input type="text" name="firstName" class="form-control border-start-0" id="inputFirstName" placeholder="First Name" required/>
													</div>
												</div>
												<div class="col-md-12">
													<label for="inputPhoneNo" class="form-label">Contact Number</label>
													<div class="input-group"> <span class="input-group-text"><i class="lni lni-phone"></i></i></span>
														<input type="text" name="conNum" class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No" required/>
													</div>
												</div>
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Email Address</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-message' ></i></span>
														<input type="email" name="emailAdd" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" required/>
													</div>
												</div>												
												<div class="col-6">
													<label for="region" class="form-label">Region</label>
													<select name="region" class="form-control form-control-md" id="region3"></select>
													<input type="hidden" name="region_text" class="form-control border-start-0" id="region-text3" required/>
												</div>
												<div class="col-6">
													<label for="province" class="form-label">Province</label>
													<select name="province" class="form-control form-control-md" id="province3"></select>
													<input type="hidden" name="province_text" class="form-control border-start-0" id="province-text3" required/>
												</div>
												<div class="col-6">
													<label for="city" class="form-label">City/Municipality</label>
													<select name="city" class="form-control form-control-md" id="city3"></select>
													<input type="hidden" name="city_text" class="form-control border-start-0" id="city-text3" required/>
												</div>
												<div class="col-6">
													<label for="barangay" class="form-label">Barangay</label>
													<select name="barangay" class="form-control form-control-md" id="barangay3"></select>
													<input type="hidden" name="barangay_text" class="form-control border-start-0" id="barangay-text3" required/>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Choose Password</label>
													<div class="input-group"> <span class="input-group-text"><i class='bx bxs-lock-open' ></i></span>
														<input type="password" name="password" class="form-control border-start-0" id="inputChoosePassword" placeholder="Choose Password" required />
													</div>
												</div>
												<input type="text" name="recaptcha_response"  class="form-control" id="recaptchaResponse3">
												<div class="modal-footer">
													<button type="submit"  class="btn btn-primary" onClick="return confirmSubmit()">Save changes</button>
												</div>
											</form>																
										</div>											
									</div>
								</div>
							</div>																								
						</div><br>

						<div class="col-12">
							<div class="text-center ">
								<p class="mb-0">Already have an account? <a href="login.php">Log in here</a>
								</p>
							</div>
						</div>

					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->

	<script>
        // Select all forms
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                grecaptcha.ready(function() {
                    grecaptcha.execute('6LfaaVkqAAAAAOwKZTEsCxP8Lx6S6D9rPGLuwmPH', {action: 'submit'}).then(function(token) {
                        // Find the hidden input with name 'recaptcha_response' within this form
                        const recaptchaInput = form.querySelector('input[name="recaptcha_response"]');

                        // Set the token in the hidden input field if it exists
                        if (recaptchaInput) {
                            recaptchaInput.value = token;
                        }
                        
                        // Submit the form after reCAPTCHA is added
                        form.submit();
                    });
                });
            });
        });
    </script>

	<script src="assets/js/ph-address-selector.js"></script>

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	




        <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
        
</html>