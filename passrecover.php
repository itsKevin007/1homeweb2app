<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';
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

<?php
    $id = isset($_POST['id']) ? $_POST['id'] : ''; 
    $ra = isset($_POST['ra']) ? $_POST['ra'] : ''; 


    include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); 
    include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); 
?>	

<?php 
    $sql = $conn->prepare("SELECT * FROM bs_user WHERE uid = '$id'");
    $sql->execute();
    $sql_data = $sql->fetch(PDO::FETCH_ASSOC);

    $user_Id = $sql_data['user_id'];

    if (!empty($sql_data['thumbnail'])) {
        $imageProfile = WEB_ROOT .'adminpanel/assets/images/user/' . $sql_data['thumbnail'];
    } elseif (!empty($sql_data['thumbnail'])) {
        $imageProfile = WEB_ROOT .'adminpanel/assets/images/user/' . $sql_data['thumbnail'];
    } else {
        $imageProfile = WEB_ROOT .'adminpanel/assets/images/user/noimage.png';
    }
?>
    </head>
<style>
    <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/log-in.css'); ?>
</style>
    <body class="loading authentication-bg back-theme authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">
                            <a href="index.html">
                                <img src="<?php echo WEB_ROOT;?>assets/images/human-cap-colored.png" alt="" height="22" class="mx-auto">
                            </a>
                            <a href="#">
                                <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="200px">
                            </a> 
                        </div>
                        <?php
                            if (isset($_GET['error']) && !empty($_GET['error'])) {
                                $error_message = htmlspecialchars($_GET['error']);
                                echo '<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <i class="mdi mdi-check-all me-2"></i> <strong>' . $error_message . '</strong>
                                    </div>';
                            }
                        ?>
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0 mb-4">Welcome Back</h4>

                                    <img src="<?php echo $imageProfile; ?>" width="88" alt="user-image" class="rounded-circle img-thumbnail">
                                    

                                    <p class="text-muted my-4">Change your password to access your portal.</p>

                                </div>

                                
                                <form method="post" action="process-recoverpass.php?action=reset" id="passwordForm" class="needs-validation" novalidate>
            
                                    <div class="mb-3 text-center">
                                        <label for="verification" class="form-label">Verification Code</label>
                                        <input class="form-control" type="text" required id="verification" name="verification" placeholder="Enter verification code">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="hidden" name="ra" value="<?php echo $ra;?>">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password1" class="form-control" name="password" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" type="password" required id="password2" class="form-control" placeholder="Confirm your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="passwordMatchError" class="invalid-feedback">Passwords do not match.</div>

                                    <div class="mb-0 text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Submit </button>
                                    </div>

                                </form>
    
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const password1 = document.getElementById('password1');
                                const password2 = document.getElementById('password2');
                                const passwordMatchError = document.getElementById('passwordMatchError');
                                const submitButton = document.querySelector('button[type="submit"]');

                                // Function to check if passwords match
                                function checkPasswordMatch() {
                                    if (password2.value && password1.value !== password2.value) {
                                        password2.classList.add('is-invalid'); // Mark password2 field as invalid
                                        passwordMatchError.style.display = 'block'; // Show error message
                                        submitButton.disabled = true; // Disable submit button
                                    } else {
                                        password2.classList.remove('is-invalid'); // Clear error state
                                        passwordMatchError.style.display = 'none'; // Hide error message
                                        submitButton.disabled = false; // Enable submit button
                                    }
                                }

                                // Initial check on page load
                                checkPasswordMatch();

                                // Event listeners for input in password fields
                                password1.addEventListener('input', checkPasswordMatch);
                                password2.addEventListener('input', checkPasswordMatch);
                            });
                        </script>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-dark">Not you? return <a href="login.php" class="text-dark ms-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
     <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
    </body>
</html>