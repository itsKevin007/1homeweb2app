<?php
require_once '../global-library/config.php';
require_once '../include/functions.php';
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
<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/misc-js.php'); ?>	
    </head>

    <body class="bg-theme bg-theme9">
                           
                            <!-- <p class="text-muted mt-2 mb-4">Lending</p> -->

                            <?php
                                if (isset($_GET['error']) && !empty($_GET['error'])) {
                                    ?>
                                        <script>
                                                document.addEventListener('DOMContentLoaded', () => {
                                                Swal.fire({
                                                title: 'Success!',
                                                text: '<?php echo $_GET['error']; ?>',
                                                icon: 'success', // Options: 'success', 'error', 'warning', 'info', 'question'
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
                                                <a href="<?php echo WEB_ROOT; ?>">
                                                    <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="200px">
                                                </a>
                                            </div><br>
                                            <div class="text-center">
                                                <p class="mb-0">A email has been send to <b><?php echo $email; ?></b>.<br> Please check for an email from Onehome.<br>Click the link to verify your account.</p>                                                   
                                            </div><br>
                                            <div class="d-grid gap-2">
                                                <a href="<?php echo WEB_ROOT; ?>" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						

        <?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
        
    </body>
</html>