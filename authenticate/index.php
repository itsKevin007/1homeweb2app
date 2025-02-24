<?php
require_once '../global-library/config.php';
require_once '../include/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
<title><?php echo $sett_data['system_title']; ?> - Authentication</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Lending System - www.tridentechnology.com" name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<?php
	// user verification
	$verification = isset($_GET['verification']) ? trim($_GET['verification']) : (isset($_POST['verification']) ? trim($_POST['verification']) : '');
	// registered id
    $id = isset($_GET['id']) ? trim($_GET['id']) : (isset($_POST['id']) ? trim($_POST['id']) : ''); 
	// otp id
    $ra = isset($_GET['ra']) ? trim($_GET['ra']) : (isset($_POST['ra']) ? trim($_POST['ra']) : ''); 

	if($id == '' || $ra == '' || $verification == '') {
		header("Location: ../index.php?mail=Failed Registration!");
	}else{}

    include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); 
    include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); 
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
								<div class="text-center">
									<a href="<?php echo WEB_ROOT; ?>">
										<img src="<?php echo WEB_ROOT; ?>assets/images/icons/silverlogoh.png" alt="user-img" title=""  width="200px">
									</a>
								</div><br>
								<div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0 mb-4">Congratualutions!</h4>
                                </div>
								<div class="text-center">
									<p class="mb-0">Your account has been verified successfully.</p>                                                   
								</div><br>
								<div class="d-grid gap-2">
									<a href="<?php echo WEB_ROOT; ?>" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
								</div>
    
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

						<!-- PROCESS FOR VERIFICATION -->

						<?php

								include '../global-library/database.php';
								

								$chk = $conn->prepare("SELECT verification, ra_id FROM tr_otp WHERE verification = '$verification' AND ra_id = '$ra' ORDER BY ra_id DESC LIMIT 1");
								$chk->execute();
								if($chk->rowCount() > 0)
								{

									$chk1 = $conn->prepare("SELECT * FROM tbl_registration WHERE uid = :id");
									$chk1->bindParam(':id', $id, PDO::PARAM_STR);
									$chk1->execute();
									$chk_result1 = $chk1->fetch(PDO::FETCH_ASSOC);
									// Personal Information
									$fname = isset($chk_result1['fname']) ? $chk_result1['fname'] : '';
									$mname = isset($chk_result1['mname']) ? $chk_result1['mname'] : '';
									$lname = isset($chk_result1['lname']) ? $chk_result1['lname'] : '';
									$suffix = isset($chk_result1['suffix']) ? $chk_result1['suffix'] : '';

									$name = $fname . ' ' . $mname . ' ' . $lname . ' ' . $suffix;

									// Contact Information
									$email = $chk_result1['email'];
									$contact = $chk_result1['connum'];

									// Address Information
									$region = $chk_result1['region'];
									$province = $chk_result1['province'];
									$city = $chk_result1['city'];
									$barangay = $chk_result1['barangay'];
									$password = $chk_result1['password'];

									// 0 = client, 1 = independent, 2 = company
									$user_type = $chk_result1['user_type'];

									$accountCheck = $conn->prepare("SELECT * FROM bs_user WHERE email = :email AND is_deleted != 1");
									$accountCheck->bindParam(':email', $email, PDO::PARAM_STR);
									$accountCheck->execute();

									if ($accountCheck->rowCount() > 0) {
										// Account with this email already exists
										header('Location: ../sign-up.php?mail=exist');
										exit();
									}

									$bsUser = $conn->prepare("INSERT INTO bs_user (firstname, middlename, lastname, email, username, contactno, password, access_level) 
																			VALUES (:fname, :mname, :lname, :emailadd, :emailadd, :connum, md5(:password), :user_type)");
									$bsUser->bindParam(':fname', $fname, PDO::PARAM_STR);
									$bsUser->bindParam(':mname', $mname, PDO::PARAM_STR);
									$bsUser->bindParam(':lname', $lname, PDO::PARAM_STR);
									$bsUser->bindParam(':emailadd', $email, PDO::PARAM_STR);
									$bsUser->bindParam(':connum', $connum, PDO::PARAM_STR);
									$bsUser->bindParam(':password', $password, PDO::PARAM_STR);
									$bsUser->bindParam(':user_type', $user_type, PDO::PARAM_STR);
									$bsUser->execute();

									$userId = $conn->lastInsertId();
									$uid = md5($userId);

									// Update the unique id in the database
									$uidUpdate = $conn->prepare("UPDATE bs_user SET uid = ? WHERE user_id = ?");
									$uidUpdate->execute([$uid, $userId]);

									// insertion data in respective table if its client, independent or company
									if($user_type == 0){
										
										$bsClient = $conn->prepare("INSERT INTO bs_client (user_id, c_fname, c_mname, c_lname, c_suffix, email, connum, region_text, province_text, city_text, barangay_text) values 
																		(:userId, :fname, :mname, :lname, :suffix, :email, :connum, :region, :province, :city, :barangay)");
										$bsClient->bindParam(':userId', $userId, PDO::PARAM_INT);
										$bsClient->bindParam(':fname', $fname, PDO::PARAM_STR);
										$bsClient->bindParam(':mname', $mname, PDO::PARAM_STR);
										$bsClient->bindParam(':lname', $lname, PDO::PARAM_STR);
										$bsClient->bindParam(':suffix', $suffix, PDO::PARAM_STR);
										$bsClient->bindParam(':email', $email, PDO::PARAM_STR);
										$bsClient->bindParam(':connum', $contact, PDO::PARAM_STR);
										$bsClient->bindParam(':region', $region, PDO::PARAM_STR);
										$bsClient->bindParam(':province', $province, PDO::PARAM_STR);
										$bsClient->bindParam(':city', $city, PDO::PARAM_STR);
										$bsClient->bindParam(':barangay', $barangay, PDO::PARAM_STR);
										$bsClient->execute();

										$clientId = $conn->lastInsertId();
										$cuid = md5($clientId);

										// Update the unique id in the database
										$uidUpdate = $conn->prepare("UPDATE bs_client SET uid = ? WHERE c_id = ?");
										$uidUpdate->execute([$cuid, $clientId]);


									}elseif ($user_type == 1){

										$bsIndependent = $conn->prepare("INSERT INTO tbl_independent (user_id, fname, mname, lname, suffix, emailadd, connum, in_region, in_prov, in_city, in_barangay) values 
																		(:userId, :fname, :mname, :lname, :suffix, :email, :connum, :region, :province, :city, :barangay)");
										$bsIndependent->bindParam(':userId', $userId, PDO::PARAM_INT);
										$bsIndependent->bindParam(':fname', $fname, PDO::PARAM_STR);
										$bsIndependent->bindParam(':mname', $mname, PDO::PARAM_STR);
										$bsIndependent->bindParam(':lname', $lname, PDO::PARAM_STR);
										$bsIndependent->bindParam(':suffix', $suffix, PDO::PARAM_STR);
										$bsIndependent->bindParam(':email', $email, PDO::PARAM_STR);
										$bsIndependent->bindParam(':connum', $contact, PDO::PARAM_STR);
										$bsIndependent->bindParam(':region', $region, PDO::PARAM_STR);
										$bsIndependent->bindParam(':province', $province, PDO::PARAM_STR);
										$bsIndependent->bindParam(':city', $city, PDO::PARAM_STR);
										$bsIndependent->bindParam(':barangay', $barangay, PDO::PARAM_STR);
										$bsIndependent->execute();

										$indId = $conn->lastInsertId();
										$iuid = md5($indId);

										// Update the unique id in the database
										$uidUpdate = $conn->prepare("UPDATE tbl_independent SET uid = ? WHERE in_id = ?");
										$uidUpdate->execute([$iuid, $indId]);

									}elseif ($user_type == 2){

										$bsCompany = $conn->prepare("INSERT INTO tbl_company (user_id, bname, emailadd, connum, in_region, in_prov, in_city, in_barangay) values 
																		(:userId, :bname, :email, :connum, :region, :province, :city, :barangay)");
										$bsCompany->bindParam(':userId', $userId, PDO::PARAM_INT);
										$bsCompany->bindParam(':bname', $fname, PDO::PARAM_STR);
										$bsCompany->bindParam(':email', $email, PDO::PARAM_STR);
										$bsCompany->bindParam(':connum', $contact, PDO::PARAM_STR);
										$bsCompany->bindParam(':region', $region, PDO::PARAM_STR);
										$bsCompany->bindParam(':province', $province, PDO::PARAM_STR);
										$bsCompany->bindParam(':city', $city, PDO::PARAM_STR);
										$bsCompany->bindParam(':barangay', $barangay, PDO::PARAM_STR);
										$bsCompany->execute();

										$cndId = $conn->lastInsertId();
										$cuid = md5($cndId);

										// Update the unique id in the database
										$uidUpdate = $conn->prepare("UPDATE tbl_independent SET uid = ? WHERE in_id = ?");
										$uidUpdate->execute([$cuid, $cndId]);

									}else{}
								
									$keyword = 'Subscriber: ' . $name . '<br /> has been registered!';
									
									$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
																			VALUES ('Registration', 'Confirm Registration', '$keyword', '$userId', '$today_date1')");
									$log->execute();

								}else{
									
									header("Location: passrecover.php?error=Failed Registration!");
								
								}
							

						?>


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