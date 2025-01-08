<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';

$errorMessage = '&nbsp;';


if (isset($_POST['txtUserName'])) {
	$result = doLogin();

	if ($result != '') {
		$errorMessage = $result;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
<title><?php echo $sett_data['system_title']; ?> - Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Lending System - www.tridentechnology.com" name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_ROOT; ?>assets/images/icons/onehome.png">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LfaaVkqAAAAAOwKZTEsCxP8Lx6S6D9rPGLuwmPH"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); ?>
<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); ?>	

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages my-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">   
                            <a href="#">
                                <!-- <img src="../assets/images/logo-dark.png" alt="" height="22" class="mx-auto"> -->
								<h1> <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="60%"></h1>
                            </a>
                            <!-- <p class="text-muted mt-2 mb-4">Lending</p> -->

                            <?php
                                if (isset($_GET['error']) && !empty($_GET['error'])) {
                                    ?>
                                        <script>
                                                document.addEventListener('DOMContentLoaded', () => {
                                                Swal.fire({
                                                title: 'Error!',
                                                text: '<?php echo $_GET['error']; ?>',
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
                                    <?php 
                                        include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/sweet-alert-failed.css'); 
                                    ?>
                                </style>

                            <?php
                                }
                            ?>

                        </div><br><br>
                        <div class="card">
                            <div class="card-body p-4">
                                
							<?php
								if($errorMessage == 'Updated successfully.')
								{
							?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									<i class="mdi mdi-check-all me-2"></i> <strong><?php echo $errorMessage; ?></strong>
								</div>
							<?php
								}
								else if($errorMessage == 'Incorrect username or password.')
								{
							?>	
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									<i class="mdi mdi-block-helper me-2"></i> <strong><?php echo $errorMessage; ?></strong>
								</div>
							<?php								
								} else {}
							?>
                                <div class="text-center mb-3">
                                    <h4 class="text-uppercase mt-0 mb-3">Reset Password</h4>
                                    <p class=" mb-0 font-13">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                                </div>

                                <form class="needs-validation" novalidate method="post" action="process-recoverpass.php?action=check" enctype="multipart/form-data" name="form" id="form">

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" name="email" type="email" id="emailaddress" placeholder="Enter your email" required>
                                    </div>
                                    <input type="hidden" name="recaptcha_response"  class="form-control" id="recaptchaResponse">
                                    <button type="submit" class="btn btn-primary text-center" onClick="return confirmSubmit()">Save changes</button>
                                    
                                </form>      
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->						

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
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

        <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
        
    </body>
</html>