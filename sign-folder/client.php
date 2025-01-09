<?php

include '../global-library/database.php';
include '../global-library/config.php';


$fname = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$mname = isset($_POST['middleName']) ? trim($_POST['middleName']) : '';
$lname = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$suffix = isset($_POST['suffix']) ? trim($_POST['suffix']) : '';

// Contact Information
$emailadd = isset($_POST['emailAdd']) ? trim($_POST['emailAdd']) : '';
$connum = isset($_POST['conNum']) ? trim($_POST['conNum']) : '';

// Address Information
$region = isset($_POST['region_text']) ? trim($_POST['region_text']) : '';
$province = isset($_POST['province_text']) ? trim($_POST['province_text']) : '';
$city = isset($_POST['city_text']) ? trim($_POST['city_text']) : '';
$barangay = isset($_POST['barangay_text']) ? trim($_POST['barangay_text']) : '';

$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$recaptcha_response = $_POST['recaptcha_response'];



    // Verify the reCAPTCHA response
    $recaptcha_secret = '6LfaaVkqAAAAAGK1t3Txr8M9HnMOBoBRytwSWQ-V'; // Replace with your actual reCAPTCHA secret key
    $recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    
    // Prepare the verification request
    $response = file_get_contents($recaptcha_verify_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $responseKeys = json_decode($response, true);
if ($responseKeys["success"]) {

$chk = $conn->prepare("SELECT * FROM bs_user WHERE email = :emailadd AND is_deleted != '1'");
$chk->bindParam(':emailadd', $emailadd, PDO::PARAM_STR);
$chk->execute();
if($chk->rowCount() > 0)
{
    header('Location: ../sign-up.php?mail=exist');               
}else{

		$bsUser = $conn->prepare("INSERT INTO bs_user (firstname, middlename, lastname, email, username, contactno, password, access_level) 
												VALUES (:fname, :mname, :lname, :emailadd, :emailadd, :connum, md5(:password), '0')");
		$bsUser->bindParam(':fname', $fname, PDO::PARAM_STR);
		$bsUser->bindParam(':mname', $mname, PDO::PARAM_STR);
		$bsUser->bindParam(':lname', $lname, PDO::PARAM_STR);
		$bsUser->bindParam(':emailadd', $emailadd, PDO::PARAM_STR);
		$bsUser->bindParam(':connum', $connum, PDO::PARAM_STR);
		$bsUser->bindParam(':password', $password, PDO::PARAM_STR);
		$bsUser->execute();

		$userId = $conn->lastInsertId();
		$uid = md5($userId);

		// Update the unique id in the database
		$uidUpdate = $conn->prepare("UPDATE bs_user SET uid = ? WHERE user_id = ?");
		$uidUpdate->execute([$uid, $userId]);
  
        // reCAPTCHA verified, proceed to insert the data into the database
        $today_date = date("Y-m-d");

		$sql = $conn->prepare("INSERT INTO bs_client (user_id, c_fname, c_mname, c_lname, c_suffix, email, connum,
								 region_text, province_text, city_text, barangay_text, date_added, added_by) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the collected values
        $sql->execute([
			$userId, $fname, $mname, $lname, $suffix, $emailadd, $connum, 
            $region, $province, $city, $barangay, $password,
            $today_date
        ]);

        $id1 = $conn->lastInsertId();
		$uid1 = md5($id1);

        // Update the unique id in the database
        $sql1 = $conn->prepare("UPDATE bs_client SET uid = ? WHERE c_id = ?");
        $sql1->execute([$uid1, $id1]);

        // Send auto-reply email to the client
        $to = $emailadd;
        $subject = "One Home Solutions PH - Client";
        $txt = "
        Dear <b>$lname</b>,<br /><br />
        Thank you for Subscribing to One Home as a Client. This is to confirm that we have received your email.
        Our team is currently reviewing your message, and we will respond to your inquiry at the earliest opportunity.<br /><br />
        For urgent matters, please contact us directly at <b>subscribe@onehomeph.com</b> or <b>onehomesolutionsph@gmail.com</b>.<br /><br />
        Best regards,<br /><br />
        <b>One Home Team</b><br />
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: subscribe@onehomeph.com" . "\r\n";

        mail($to, $subject, $txt, $headers);

		$date=date_create($today_date1);
		date_add($date,date_interval_create_from_date_string("1 days"));
		$d_format = date_format($date,"d-m-Y");
	
	
		// ADMIN
		$to1 = "subscribe@onehomeph.com";
		$subject1 = "Notification - New Client";
		$txt1 = "
		".$today_date1." <br />
		<br />
		Subject: New Client<br /> <br />
	
		Client Name: <b>" . $lname . " " . $fname . ".</b><br />
		<b>Contact Information: <b>" . $emailadd . ".</b><br />
		<b>Contact Number:<b> " . $connum . ". </b><br /> <br />
		<b>Subscription Type:<b> Client </b><br />
	
		Please review the inquiry and respond accordingly. If you require additional details, let me know.<br /> <br />
	
		Tridentechnology <br />
		";
		
		$headers1 = "MIME-Version: 1.0" . "\r\n";
		$headers1 .= "Content-type: text/html; charset=UTF-8" . "\r\n";
		$headers1 .= "From:". $emailadd . "\r\n" . "CC:  subscribe@onehomeph.com";
	
		mail($to1,$subject1,$txt1,$headers1);

        // Redirect on success
        header('Location: ../sign-up.php?mail=success');
    } 
}else {
	// reCAPTCHA failed, redirect to an error page
	header('Location: ../sign-up.php?mail=failed');
}


?>