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
<?php $email = isset($_GET['email']) ? $_GET['email'] : ''; ?>
<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); ?>
<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); ?>	
    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">
                            <a href="index.html">
                                <img src="<?php echo WEB_ROOT;?>assets/images/human-cap-colored.png" alt="" height="22" class="mx-auto">
                            </a>
                            <p class="text-muted mt-2 mb-4">Human Capital</p>
                        </div>
                        <div class="card text-center">

                            <div class="card-body p-4">
                                
                                <div class="mb-4">
                                    <h4 class="text-uppercase mt-0">Confirm Email</h4>
                                </div>
                                <p class="text-muted font-14 mt-2"> A email has been send to <b><?php echo $email;?></b>.
                                    Please check for an email from company and click on the included link to
                                    reset your password. </p>

                                <a href="login.php" class="btn d-block btn-primary waves-effect waves-light mt-3">Back to Login</a>

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

    <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
    </body>
</html>