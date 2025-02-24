<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
		
	case 'register' :
        register_data();
        break;
	   
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}

/*
    Modify Data
*/
function register_data()
{
	include 'global-library/database.php';
	
    $verification = $_POST['verification'];
	// this is the uid of the registered user
    $id = $_POST['id'];
	// ra is the OTP ID
    $ra = $_POST['ra'];
	

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
		$contact = $chk_result1['contact'];

		// Address Information
		$region = $chk_result1['region'];
		$province = $chk_result1['province'];
		$city = $chk_result1['city'];
		$barangay = $chk_result1['barangay'];
		$password = $chk_result1['password'];

		// 0 = client, 1 = independent, 2 = company
		$user_type = $chk_result1['user_type'];

		$bsUser = $conn->prepare("INSERT INTO bs_user (firstname, middlename, lastname, email, username, contactno, password, access_level) 
												VALUES (:fname, :mname, :lname, :emailadd, :emailadd, :connum, md5(:password), :user_type)");
		$bsUser->bindParam(':fname', $fname, PDO::PARAM_STR);
		$bsUser->bindParam(':mname', $mname, PDO::PARAM_STR);
		$bsUser->bindParam(':lname', $lname, PDO::PARAM_STR);
		$bsUser->bindParam(':emailadd', $emailadd, PDO::PARAM_STR);
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

		}else{}
       
		$keyword = 'Subscriber: ' . $name . '<br /> has been registered!';
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Registration', 'Confirm Registration', '$keyword', '$userId', '$today_date1')");
		$log->execute();

		header("Location: ../login.php?error=Successfully registered.");
	}else{

        $chk1 = $conn->prepare("SELECT * FROM bs_user WHERE uid = '$id'");
        $chk1->execute();
        $chk_result1 = $chk1->fetch(PDO::FETCH_ASSOC);
        $name = $chk_result1['firstname'] . '' . $chk_result1['middlename'] . '' . $chk_result1['lastname'];

        $userId = $chk_result1['user_id'];
		$keyword = 'Subscriber: ' . $name . '<br /> Failed Registration!';
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Registration', 'Failed Registration', '$keyword', '$userId', '$today_date1')");
		$log->execute();
		
		header("Location: passrecover.php?error=Failed Registration!");
	
	}
}


?>