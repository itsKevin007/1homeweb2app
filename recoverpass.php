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
<style>
    <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/log-in.css'); ?>
</style>
<body class="bg-theme bg-theme9">


                
                          
                           
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

                        <div class="wrapper">
                            <div class="authentication-forgot d-flex align-items-center justify-content-center">
                                <div class="card forgot-box">                                 
                                    <div class="card-body">
                                        <div class="p-3">
                                            <div class="text-center">
                                                <a href="#">
                                                    <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="200px">
                                                </a> 
                                            </div><br>
                                            <div class="text-center">
                                                <img src="adminpanel/assets/images/icons/forgot-2.png" width="80" alt="" />
                                            </div>
                                            <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                                            <p class="mb-0">Enter your registered email ID to reset the password</p>
                                            <form class="needs-validation" novalidate method="post" action="process-recoverpass.php?action=check" enctype="multipart/form-data" name="form" id="form">
                                                <div class="my-4">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" name="email" type="email" id="emailaddress" placeholder="Enter your email" required>
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <input type="hidden" name="recaptcha_response"  class="form-control" id="recaptchaResponse">
                                                    <button type="submit" class="btn btn-white text-center">Save changes</button>
                                                    <a href="index.php" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						

                    
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