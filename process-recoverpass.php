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
	
    case 'check' :
        check_data();
        break;
		
	case 'reset' :
        reset_data();
        break;

    case 'add' :
        add_data();
        break;
        
    case 'delete' :
        delete_data();
        break;
	   
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


/*
    Add Data
*/
function check_data()
{
	include 'global-library/database.php';
	
    $email =  $_POST['email'];
	$today_date = date('Y-m-d');

    $recaptcha_response = $_POST['recaptcha_response'];

    // Verify the reCAPTCHA response
    $recaptcha_secret = '6LfaaVkqAAAAAGK1t3Txr8M9HnMOBoBRytwSWQ-V'; // Replace with your actual reCAPTCHA secret key
    $recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    
    // Prepare the verification request
    $response = file_get_contents($recaptcha_verify_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) 
    {

        // Check how many times the user has requested a password reset today
        $chk_count = $conn->prepare("SELECT COUNT(*) as request_count FROM tr_recover_account WHERE email = :email AND DATE(date_request) = :today_date");
        $chk_count->execute([':email' => $email, ':today_date' => $today_date]);
        $count_result = $chk_count->fetch(PDO::FETCH_ASSOC);

        if ($count_result['request_count'] >= 3) {
            header('Location: recoverpass.php?error=You have exceeded the limit of password reset requests for today. Please try again tomorrow.');
            exit();
            
        }

        $sql4 = $conn->prepare("UPDATE tr_recover_account SET verification = '' WHERE email = '$email'");
        $sql4->execute();

        $chk = $conn->prepare("SELECT * FROM bs_user WHERE email = '$email' AND is_deleted != '1'");
        $chk->execute();
        if($chk->rowCount() > 0)
        {

        $chk1 = $conn->prepare("SELECT * FROM bs_user WHERE email = '$email' AND is_deleted != '1'");
        $chk1->execute();
        $chk_result = $chk1->fetch(PDO::FETCH_ASSOC);

        $name = $chk_result['fname'] . ' ' . $chk_result['mname']. ' ' . $chk_result['lname'];
        $eId = $chk_result['user_id'];
        $uId = $chk_result['uid'];

            // Generate a random verification code
            $length = 6; // Random length between 6 and 10
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $verification_code = '';
            $characters_length = strlen($characters);

            for ($i = 0; $i < $length; $i++) {
                $verification_code .= $characters[rand(0, $characters_length - 1)];
            }

            $verification_code = strtoupper($verification_code); // Convert to uppercase

        // Create a new PHPMailer object
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'subscribe@onehomeph.com'; // SMTP username
            $mail->Password = 'lnab mmun qvzw vpge'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('subscribe@onehomeph.com', 'One Home PH');
            $mail->addAddress($email); // Add a recipient


            $sql = $conn->prepare("INSERT INTO tr_recover_account (e_id, email, verification, request_by, date_request)
                                                VALUES ('$eId', '$email', '$verification_code', '$userId', '$today_date1')");
            $sql->execute();

            $id = $conn->lastInsertId();
            
            $keyword = 'Email: ' . $email;
            
            $log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
                                                VALUES ('Recover Account', 'Change Password', '$keyword', '$userId', '$today_date1')");
            $log->execute();
            
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Recover Password';
            $mail->Body = '<p>Dear ' . $name . '</p>
            <p>You recently requested to reset your password. Please click the button below to reset it:</p>
            <form action="https://onehomeph.com/passrecover.php" method="post" target="_blank">
                <input type="hidden" name="id" value="' . $uId . '">
                <input type="hidden" name="ra" value="' . $id . '">
                <button type="submit" style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; cursor: pointer; text-decoration: none; font-size: 16px;">Reset Password</button>
            </form>
            <p>This is your verification code:<b>' . $verification_code . '</b></p>
            <p>If you didn\'t make this request, you can ignore this message.</p>
            <p>Best regards,<br>One Home Team<br>Admin<br>subscribe@onehomeph.com</p>';

            $mail->send();
        // insert in users table
            header("Location: authemail.php?success=Verification code sent to email address successfully sent, please check your email&email=$email");
        } catch (Exception $e) {
            header("Location: recoverpass.php?error=Error occured, please try again.");
        }
        }else{
            header('Location: recoverpass.php?error=Email address not found.'); 
        }

    }else{

        header('Location: index.php');

    }
}

/*
    Add Data
*/
function add_data()
{
	
}
/*
    Modify Data
*/
function reset_data()
{
	include 'global-library/database.php';
	
    $verification = $_POST['verification'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $ra = $_POST['ra'];
    
	
	$chk = $conn->prepare("SELECT * FROM tr_recover_account WHERE verification = '$verification' AND ra_id = '$ra' ORDER BY ra_id DESC LIMIT 1");
	$chk->execute();
	if($chk->rowCount() > 0)
	{

        $chk1 = $conn->prepare("SELECT * FROM bs_employee WHERE uid = '$id'");
        $chk1->execute();
        $chk_result1 = $chk1->fetch(PDO::FETCH_ASSOC);

        $eId = $chk_result1['e_id'];
        $name = $chk_result1['e_fname'] . '' . $chk_result1['e_mname'] . '' . $chk_result1['e_lname'] . '' . $chk_result1['suffix'];

        $sql = $conn->prepare("UPDATE bs_user SET password = md5('$password'), pass_text = '$password' WHERE e_id = '$eId'");
        $sql->execute();

        $sql = $conn->prepare("UPDATE tr_recover_account SET verification = '' WHERE e_id = '$eId'");
        $sql->execute();

        $chk2 = $conn->prepare("SELECT * FROM bs_user WHERE e_id = '$eId'");
        $chk2->execute();
        $chk_result2 = $chk2->fetch(PDO::FETCH_ASSOC);

        $userId = $chk_result2['user_id'];

        $keyword = 'Employee Named: ' . $name . '<br /> successfully changed password!';
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Request Change Password', 'Change Password', '$keyword', '$userId', '$today_date1')");
		$log->execute();

		header("Location: login.php?error=Sucessfully changed the password, please login your portal.");
	}else{
    
		$keyword = 'Employee Named: ' . $name . '<br /> attempt to change password but failed, verification code did not matched!';
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Request Change Password', 'Change Password', '$keyword', '$userId', '$today_date1')");
		$log->execute();
		
		header("Location: passrecover.php?error=Verification code did not match or has expired. Please double-check the verification code..&id=$id&ra=$ra");
	
	}
}

/*
    Remove Data
*/
function delete_data()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    if(isset($_POST['id']))
	{ $id = $_POST['id']; }else{ $id = $_GET['id']; }	

	$chk = $conn->prepare("SELECT * FROM bs_position WHERE p_id = '$id'");
	$chk->execute();
	$chk_data = $chk->fetch();
		$p_name = mysqli_real_escape_string($link, $chk_data['p_name']);
		$d_name = mysqli_real_escape_string($link, $chk_data['d_name']);
		$p_description = mysqli_real_escape_string($link, $chk_data['p_description']);
	
    // delete the category. set is_deleted to 1 as deleted;    
	$sql = $conn->prepare("UPDATE bs_position SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE p_id = '$id'");
	$sql->execute();
	
	$keyword = 'Name: ' . $p_name . '<br /> Department: ' . $d_name  . '<br /> Description: ' . $p_description;

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('Department', 'Department Deleted', '$keyword', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Deleted successfully.");
}

?>