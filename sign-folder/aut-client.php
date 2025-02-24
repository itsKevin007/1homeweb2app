<?php
require_once '../global-library/config.php';
require_once '../include/functions.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'check' :
        check_data();
        break;
		
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: ../index.php');
}


/*
    Add Data
*/
function check_data()
{
	include '../global-library/database.php';
	
	$today_date = date('Y-m-d');

    // Personal Information
    $fname = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $mname = isset($_POST['middleName']) ? trim($_POST['middleName']) : '';
    $lname = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $suffix = isset($_POST['suffix']) ? trim($_POST['suffix']) : '';

    // Contact Information
    $email = isset($_POST['emailAdd']) ? trim($_POST['emailAdd']) : '';
    $connum = isset($_POST['conNum']) ? trim($_POST['conNum']) : '';

    // Address Information
    $region = isset($_POST['region_text']) ? trim($_POST['region_text']) : '';
    $province = isset($_POST['province_text']) ? trim($_POST['province_text']) : '';
    $city = isset($_POST['city_text']) ? trim($_POST['city_text']) : '';
    $barangay = isset($_POST['barangay_text']) ? trim($_POST['barangay_text']) : '';

    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    
    $chk = $conn->prepare("SELECT * FROM bs_user WHERE email = :emailadd AND is_deleted != '1'");
    $chk->bindParam(':emailadd', $email, PDO::PARAM_STR);
    $chk->execute();
    if($chk->rowCount() > 0)
    {
        header('Location: ../sign-up.php?mail=exist');              
        exit;
    }

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
        $chk_count = $conn->prepare("SELECT COUNT(*) as request_count FROM tr_otp WHERE email = :email AND DATE(date_request) = :today_date");
        $chk_count->execute([':email' => $email, ':today_date' => $today_date]);
        $count_result = $chk_count->fetch(PDO::FETCH_ASSOC);

        if ($count_result['request_count'] >= 3) {
            header('Location: ../login.php?mail=exceeded');
            exit();
            
        }

        $sql4 = $conn->prepare("UPDATE tr_otp SET verification = '' WHERE email = '$email'");
        $sql4->execute();


        // check if email is already existing
        $sqlreg = $conn->prepare("SELECT * FROM tbl_registration WHERE email = :email");
        $sqlreg->bindParam(':email', $email);
        $sqlreg->execute();
        if($sqlreg->rowCount() > 0)
        {
            $delSql = $conn->prepare("UPDATE tbl_registration SET is_deleted = '1' WHERE email = :email");
            $delSql->bindParam(':email', $email);
            $delSql->execute();

            $sqlreg = $conn->prepare("INSERT INTO tbl_registration (fname, mname, lname, suffix, email, connum, region, province, city, barangay, password, user_type, date_added)
            VALUES (:fname, :mname, :lname, :suffix, :email, :connum, :region, :province, :city, :barangay, :password, '0', :today_date)");
           $sqlreg->bindParam(':fname', $fname);
           $sqlreg->bindParam(':mname', $mname);
           $sqlreg->bindParam(':lname', $lname);
           $sqlreg->bindParam(':suffix', $suffix);
           $sqlreg->bindParam(':email', $email);
           $sqlreg->bindParam(':connum', $connum);
           $sqlreg->bindParam(':region', $region);
           $sqlreg->bindParam(':province', $province);
           $sqlreg->bindParam(':city', $city);
           $sqlreg->bindParam(':barangay', $barangay);
           $sqlreg->bindParam(':password', $password);
           $sqlreg->bindParam(':today_date', $today_date);
           $sqlreg->execute();
   
           // Table Insert ID
           $lastInsertId = $conn->lastInsertId();
           $uid = md5($lastInsertId);
   
           // Update the unique id in the database
           $sql4 = $conn->prepare("UPDATE tbl_registration SET uid = :uid WHERE regId = :lastInsertId");
           $sql4->bindParam(':uid', $uid);
           $sql4->bindParam(':lastInsertId', $lastInsertId);
           $sql4->execute();


        }else{

            $sqlreg = $conn->prepare("INSERT INTO tbl_registration (fname, mname, lname, suffix, email, connum, region, province, city, barangay, password, user_type, date_added)
            VALUES (:fname, :mname, :lname, :suffix, :email, :connum, :region, :province, :city, :barangay, :password, '0', :today_date)");
           $sqlreg->bindParam(':fname', $fname);
           $sqlreg->bindParam(':mname', $mname);
           $sqlreg->bindParam(':lname', $lname);
           $sqlreg->bindParam(':suffix', $suffix);
           $sqlreg->bindParam(':email', $email);
           $sqlreg->bindParam(':connum', $connum);
           $sqlreg->bindParam(':region', $region);
           $sqlreg->bindParam(':province', $province);
           $sqlreg->bindParam(':city', $city);
           $sqlreg->bindParam(':barangay', $barangay);
           $sqlreg->bindParam(':password', $password);
           $sqlreg->bindParam(':today_date', $today_date);
           $sqlreg->execute();
   
           // Table Insert ID
           $lastInsertId = $conn->lastInsertId();
           $uid = md5($lastInsertId);
   
           // Update the unique id in the database
           $sql4 = $conn->prepare("UPDATE tbl_registration SET uid = :uid WHERE regId = :lastInsertId");
           $sql4->bindParam(':uid', $uid);
           $sql4->bindParam(':lastInsertId', $lastInsertId);
           $sql4->execute();

        }


        $chk1 = $conn->prepare("SELECT * FROM tbl_registration WHERE email = '$email' AND is_deleted != '1'");
        $chk1->execute();
        $chk_result = $chk1->fetch(PDO::FETCH_ASSOC);

        $name = $fname . ' ' . $mname. ' ' . $lname;

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
            $mail->Username = 'onehomesolph@gmail.com'; // SMTP username
            $mail->Password = 'uhee yamx irpd gkbw'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('onehomesolph@gmail.com', 'One Home PH');
            $mail->addAddress($email); // Add a recipient


            $sql = $conn->prepare("INSERT INTO tr_otp (reg_id, email, verification, date_request)
                                                VALUES (:reg_id, :email, :verification, :date_request)");
            $sql->bindParam(':reg_id', $lastInsertId, PDO::PARAM_INT);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':verification', $verification_code, PDO::PARAM_STR);
            $sql->bindParam(':date_request', $today_date1, PDO::PARAM_STR);
            $sql->execute();

            $id = $conn->lastInsertId();
            
            $keyword = 'Email: ' . $email;
            
            $log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
                                                VALUES ('Recover Account', 'Change Password', '$keyword', '$eId', '$today_date1')");
            $log->execute();
            
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Register Authentication Code';
            $mail->Body = "<p>Dear {$name},</p>
                <p>To register your account please click the link below:</p>
                <a href='https://mock-up.onehomeph.com/authenticate/?id={$uid}&ra={$id}&verification={$verification_code}' style='background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; font-size: 16px; border-radius: 10px;'>Click to Verify</a>
                <p>This is your verification code:<b>{$verification_code}</b></p>
                <p>If you didn't make this request, you can ignore this message.</p>
                <p>Best regards,<br>One Home Team<br>Admin<br>subscribe@onehomeph.com</p>";



            $mail->send();

            header("Location: authemail.php?email=$email");
        } catch (Exception $e) {
            header("Location: ../sign-up.php?error=Error occured, please try again.");
        }


    }else{

        header('Location: ../index.php');

    }
}

/*
    Add Data
*/
function add_data()
{
	
}


?>