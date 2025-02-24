<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';

$errorMessage = '';


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
    <!-- pwa -->

    <link rel="manifest" href="/manifest.json">


    <meta charset="utf-8" />
    <title><?php echo $sett_data['system_title']; ?> - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Lending System - www.tridentechnology.com" name="description" />
    <meta content="Coderthemes" name="author" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_ROOT; ?>assets/images/icons/onehome.png">

    <?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); ?>

    <?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--notification-->
    <link rel="stylesheet" href="adminpanel/assets/plugins/notifications/css/lobibox.min.css" />
    <style>
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/style/log-in.css'); ?>
    </style>

</head>

<body class="loading back-theme authentication-bg authentication-bg-pattern">

    <div class="account-pages my-5">
        <div class="container">
            <script>
                let deferredPrompt;

                window.addEventListener("beforeinstallprompt", (event) => {
                    event.preventDefault();
                    deferredPrompt = event;
                    // Show your custom install button
                });

                document.getElementById("install-button").addEventListener("click", () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.then((choiceResult) => {
                            if (choiceResult.outcome === "accepted") {
                                console.log("User accepted the install prompt");
                            } else {
                                console.log("User dismissed the install prompt");
                            }
                            deferredPrompt = null;
                        });
                    }
                });
            </script>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="#">
                            <!-- <img src="../assets/images/logo-dark.png" alt="" height="22" class="mx-auto"> -->
                            <h1> <img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title="" width="60%"></h1>
                        </a>
                        <!-- <p class="text-muted mt-2 mb-4">Lending</p> -->

                    </div><br><br>
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>
                            <?php
                            if (isset($errorMessage) && $errorMessage != '') {
                            ?>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        // Call the function directly
                                        Lobibox.notify('error', {
                                            pauseDelayOnHover: true,
                                            continueDelayOnInactiveTab: false,
                                            position: 'top right',
                                            icon: 'bx bx-check-circle',
                                            msg: '<?php echo $errorMessage; ?>'
                                        });
                                    });
                                </script>

                            <?php
                            } else {
                            }
                            ?>
                            <form id="loginform" name="frmLogin" method="post">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Username</label>
                                    <input class="form-control" type="rext" name="txtUserName" id="txtUserName" autocomplete=off required="" placeholder="Enter your username">
                                </div>


                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="txtPassword" id="txtPassword" autocomplete=off placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="mb-2 text-end"> <a href="recoverpass.php">Forgot Password ?</a>
                                </div>
                                <div class="mb-3 d-grid text-center">
                                    <button style="background-color:#16405F;border: 1px #16405F solid;" class="btn btn-primary" type="submit"> Log In </button>
                                </div>
                                <div class="col-12">
                                    <div class="text-center ">
                                        <p class="mb-0">Don't have an account yet? <a href="sign-up.php">Sign up here</a>
                                        </p>
                                    </div>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <style>
                        .download-btn {
                            transition: transform 0.3s ease, opacity 0.3s ease;
                        }

                        .download-btn:hover {
                            transform: scale(1.1);
                            /* Slight zoom-in effect */
                            opacity: 0.8;
                            /* Slight transparency */
                        }
                    </style>

                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-6 text-center d-flex justify-content-center">
                            <img width="95%" src="<?php echo WEB_ROOT; ?>assets/images/icons/googleDown.png" class="download-btn" alt="Download Android" onclick="downloadAndroid()" />
                        </div>
                        <div class="col-6 text-center d-flex justify-content-center">
                            <img width="95%" src="<?php echo WEB_ROOT; ?>assets/images/icons/appleDown.png" class="download-btn" alt="Download iOS" />
                        </div>
                    </div>


                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <script>
                function downloadAndroid() {
                    // Replace with your actual APK file URL
                    const apkUrl = '<?php echo WEB_ROOT; ?>assets/oneapk/onehome.apk';
                    window.location.href = apkUrl;
                }

                function downloadiOS() {
                    // Replace with your iOS TestFlight or App Store link
                    const iOSUrl = 'https://testflight.apple.com/join/DGBkG2zd';

                    // Show confirmation dialog
                    if (confirm('iOS installation requires TestFlight. Continue to TestFlight?')) {
                        window.location.href = iOSUrl;
                    }
                }
            </script>
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>

</body>

</html>