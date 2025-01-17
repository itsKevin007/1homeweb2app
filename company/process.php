<?php

require_once '../global-library/config.php';
require_once '../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        add_data();
        break;

	case 'addService' :
		add_service();
		break;
		
	case 'modify' :
        modify_data();
        break;

	case 'promod' :
		profile_mod();
		break;

	case 'imgprof' :
		image_profile();
		break;
        
    case 'delete' :
        delete_data();
        break;

	case 'delService' :
		delete_service();
		break;

	case 'accept' :
		accept_request();
		break;
		
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}

// accept request
function accept_request()
{
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php?view=dash&status=error&message=Unauthorized');
		exit;
	}

	include '../global-library/database.php';

	$serviceId = filter_input(INPUT_POST, 'serviceId', FILTER_VALIDATE_INT);
	$user_id = $_SESSION['user_id'];
	$aAddress = filter_input(INPUT_POST, 'aAddress', FILTER_SANITIZE_STRING);
	$aContactNo = filter_input(INPUT_POST, 'aContactNo', FILTER_SANITIZE_STRING);
	$aReqServ = filter_input(INPUT_POST, 'aReqServ', FILTER_SANITIZE_STRING);

	if (!$serviceId || !$aAddress || !$aContactNo || !$aReqServ) {
		header('Location: index.php?view=dash&status=error&message=Invalid input');
		exit;
	}

	try {
		// Insert into accepted_services table
		$sql = $conn->prepare("INSERT INTO accepted_services (service_id, user_id, accepted_at, aAddress, aContactNo, aReqServ) 
                                VALUES (:serviceId, :user_id, NOW(), :aAddress, :aContactNo, :aReqServ)");

		$sql->bindParam(':serviceId', $serviceId, PDO::PARAM_INT);
		$sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$sql->bindParam(':aAddress', $aAddress, PDO::PARAM_STR);
		$sql->bindParam(':aContactNo', $aContactNo, PDO::PARAM_STR);
		$sql->bindParam(':aReqServ', $aReqServ, PDO::PARAM_STR);

		if ($sql->execute()) {
			// Get the last inserted ID from accepted_services table
			$id = $conn->lastInsertId();

			// Generate the MD5 hash for the uid
			$uid = md5($id);

			// Update the uid column in the accepted_services table
			$updateUid = $conn->prepare("UPDATE accepted_services SET uid = :uid WHERE id = :id");
			$updateUid->bindParam(':uid', $uid, PDO::PARAM_STR);
			$updateUid->bindParam(':id', $id, PDO::PARAM_INT);
			$updateUid->execute();

			// Update booking status in tbl_bookings
			$updateBooking = $conn->prepare("UPDATE tbl_bookings SET booking_status = 'accepted' WHERE booking_id = :serviceId");
			$updateBooking->bindParam(':serviceId', $serviceId, PDO::PARAM_INT);
			$updateBooking->execute();

			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			header('Location: index.php?view=dash&status=error&message=Failed to execute query');
		}
	} catch (PDOException $e) {
		error_log('Database Error: ' . $e->getMessage());
		header('Location: index.php?view=dash&status=error&message=Database error');
	}

	exit;
}



// end of accept request

function image_profile()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];

	$images = uploadimage('fileImage', SRV_ROOT . 'adminpanel/assets/images/user/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

		$up = $conn->prepare("UPDATE bs_user SET image = :mainImage, thumbnail = :thumbnail WHERE user_id = :userId");
		$up->bindParam(':mainImage', $mainImage);
		$up->bindParam(':thumbnail', $thumbnail);
		$up->bindParam(':userId', $userId);
		$up->execute();

		$log = $conn->prepare("INSERT INTO tr_log (module, description, log_action_date, action_by) VALUES ('Service Provider', 'Edit Profile: $thumbnail', '$today_date1', '$userId')");
		$log->execute();
		
		header('Location: index.php?view=prof&error=Success');

	
}


/*
    Add Data
*/
function add_data()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$type = $_POST['type'];
	
	
	$chk = $conn->prepare("SELECT * FROM bs_client WHERE c_fname = '$c_fname' AND c_lname = '$c_lname' AND email = '$email' AND is_deleted != '1'");
	$chk->execute();
	if($chk->rowCount() > 0)
	{
		header('Location: index.php?view=list&error=Data already exist! Data entry failed.');              
	}else{



		$sql = $conn->prepare("INSERT INTO bs_client (c_fname, c_lname, email, sub_type,
													 date_added, added_by)
											VALUES ('$fname', '$lname', '$email', '$type',
													'$today_date1', '$userId')");
		$sql->execute();

		$id = $conn->lastInsertId();
		$uid = md5($id);

		$up = $conn->prepare("UPDATE bs_client SET uid = '$uid' WHERE c_id = '$id'");
		$up->execute();

		$log = $conn->prepare("INSERT INTO tr_log (description, log_action_date, action_by) VALUES ('Client $fname $lname Added.', '$today_date1', '$userId')");
		$log->execute();
		
		header('Location: index.php?view=list&error=Added successfully.');

	}
}

function add_service()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
	$mainservice = isset($_POST['mainservice']) ? $_POST['mainservice'] : '';
	$subcat = isset($_POST['subcat']) ? $_POST['subcat'] : '';

	$subtotal_array = [];
	foreach ($mainservice as $key => $mainservices) {
			$subcats = $subcat[$key];
	
			// Fetch matching records from the database
			$chk = $conn->prepare("SELECT * FROM ind_subcat 
								WHERE main_id = :mainid 
									AND sub_categor = :subcat 
									AND user_id = :userid 
									AND is_deleted != '1'");
			$chk->bindParam(':mainid', $mainservices, PDO::PARAM_INT);
			$chk->bindParam(':subcat', $subcats, PDO::PARAM_STR);
			$chk->bindParam(':userid', $userId, PDO::PARAM_INT);
			$chk->execute();

			// Check if any record exists
		if ($chk->rowCount() > 0) {
			// Fetch all matching records
			$results = $chk->fetchAll(PDO::FETCH_COLUMN, 0); // Get `sub_categor` values
			$subtotal_array = array_merge($subtotal_array, $results); // Accumulate results
		}


		// If there are existing records, redirect with query string
		if (!empty($subtotal_array)) {
			$resulta = implode(',', $subtotal_array); // Concatenate with commas
			header('Location: index.php?view=service&exist=' . urlencode($resulta));
			exit; // Stop further processing

		} else {

			// Handle case where no existing records are found
			$sql = $conn->prepare("INSERT INTO ind_subcat (main_id, sub_categor, user_id, date_added, added_by)
								VALUES (:mainid, :subcat, :userid, :todaydate, :userid)");
			$sql->bindParam(':mainid', $mainservices, PDO::PARAM_INT);
			$sql->bindParam(':subcat', $subcats, PDO::PARAM_STR);
			$sql->bindParam(':userid', $userId, PDO::PARAM_INT);
			$sql->bindParam(':todaydate', $today_date1, PDO::PARAM_STR);
			$sql->execute();


			// activity logs
			$keyword = 'Sub Category Name: ' . $subcats ;
			
			$module = 'Service Category';
			$action = 'Service Added';
			
			$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
								   VALUES (:module, :action, :description, :userid, :todaydate)");
			$log->bindParam(':module', $module, PDO::PARAM_STR);
			$log->bindParam(':action', $action, PDO::PARAM_STR);
			$log->bindParam(':description', $keyword, PDO::PARAM_STR);
			$log->bindParam(':userid', $userId, PDO::PARAM_INT);
			$log->bindParam(':todaydate', $today_date1, PDO::PARAM_STR);
			$log->execute();
			


		}
	}
			header('Location: index.php?view=service&error=Success');
			exit; // Stop further processing
	
}


/*
	Upload an image and return the uploaded image name
*/
function uploadimage($inputName, $uploadDir)
{
    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Check if the file input exists in the $_FILES array
    if (!isset($_FILES[$inputName]) || empty($_FILES[$inputName]['tmp_name'])) {
        return array('image' => '', 'thumbnail' => '');
    }

    $image = $_FILES[$inputName];
    $imagePath = '';
    $thumbnailPath = '';

    // Validate the uploaded file
    if ($image['error'] !== UPLOAD_ERR_OK) {
        return array('image' => '', 'thumbnail' => '');
    }

    // Check file extension
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowedExtensions)) {
        return array('image' => '', 'thumbnail' => '');
    }

    // Generate a random new file name to avoid name conflict
    $imagePath = md5(rand() * time()) . ".$ext";

    // Get image size
    list($width, $height) = getimagesize($image['tmp_name']);

    // Check and resize if necessary
    if (defined('LIMIT_IMAGE_WIDTH') && LIMIT_IMAGE_WIDTH && $width > MAX_IMAGE_WIDTH) {
        $result = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_IMAGE_WIDTH);
        $imagePath = $result ? $imagePath : '';
    } else {
        $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
    }

    // If the main image upload succeeded
    if ($result) {
        // Create thumbnail
        $thumbnailPath = md5(rand() * time()) . ".$ext";
        $result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);

        // If thumbnail creation failed, delete the uploaded image
        if (!$result) {
            unlink($uploadDir . $imagePath);
            $imagePath = $thumbnailPath = '';
        } else {
            $thumbnailPath = $result;
        }
    } else {
        $imagePath = $thumbnailPath = '';
    }

    return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}


/*
    Modify Data
*/
function modify_data()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];

	$id = $_POST['id'];
	$subcategory = isset($_POST['subcategory']) ? $_POST['subcategory'] : '';
	
	foreach ($id as $key => $ids) {
		// Ensure subcategory is indexed correctly
		$subcategorys = isset($subcategory[$key]) ? $subcategory[$key] : '';
	
		// Prepare SQL with placeholders
		$sql = $conn->prepare("UPDATE ind_subcat 
							   SET sub_categor = :subcategorys,
								   date_modified = :today_date1, 
								   modified_by = :userId 
							   WHERE subcatid = :ids");
	
		// Bind parameters securely
		$sql->bindParam(':subcategorys', $subcategorys);
		$sql->bindParam(':today_date1', $today_date1);
		$sql->bindParam(':userId', $userId);
		$sql->bindParam(':ids', $ids, PDO::PARAM_INT);
	
		// Execute the query
		$sql->execute();
	}
	
		
		header("Location: index.php?view=service&error=Success");
		
}

/*
    Modify Data
*/
function profile_mod()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];

	$id = $_POST['id'];

	// Full Name
	$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
	$mname = isset($_POST['mname']) ? $_POST['mname'] : '';
	$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
	$suffix = isset($_POST['suffix']) ? $_POST['suffix'] : null;
	
	// Prepare SQL with placeholders
	$sql1 = $conn->prepare("UPDATE tbl_independent 
							SET fname = :fname, 
								mname = :mname, 
								lname = :lname, 
								suffix = :suffix 
							WHERE uid = :uid");
	
	// Bind parameters securely
	$sql1->bindParam(':fname', $fname);
	$sql1->bindParam(':mname', $mname);
	$sql1->bindParam(':lname', $lname);
	$sql1->bindParam(':suffix', $suffix);
	$sql1->bindParam(':uid', $id);
	
	// Execute the query
	$sql1->execute();
	
		
	

	// Main Address
	$region = isset($_POST['region']) ? $_POST['region'] : '';
	$prov = isset($_POST['prov']) ? $_POST['prov'] : '';
	$city = isset($_POST['city']) ? $_POST['city'] : '';
	$barangay = isset($_POST['barangay']) ? $_POST['barangay'] : '';
	$zip = isset($_POST['zip']) ? $_POST['zip'] : '';

		// Prepare SQL with placeholders
		$sql2 = $conn->prepare("UPDATE tbl_independent SET in_region = :region, in_prov = :prov, in_city = :city, in_barangay = :barangay , 
								zipc = :zip WHERE uid = :uid");

		// Bind parameters securely
		$sql2->bindParam(':region', $region);
		$sql2->bindParam(':prov', $prov);
		$sql2->bindParam(':city', $city);
		$sql2->bindParam(':barangay', $barangay);
		$sql2->bindParam(':zip', $zip);
		$sql2->bindParam(':uid', $id);
		$sql2->execute();

	// Sub Address
	$subdivision = isset($_POST['subdivision']) ? $_POST['subdivision'] : '';
	$street = isset($_POST['street']) ? $_POST['street'] : '';
	$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
	$building = isset($_POST['building']) ? $_POST['building'] : '';
	$phase = isset($_POST['phase']) ? $_POST['phase'] : '';
	$blocklot = isset($_POST['blocklot']) ? $_POST['blocklot'] : '';

		// Sub Address
		$subdivision = isset($_POST['subdivision']) ? $_POST['subdivision'] : '';
		$street = isset($_POST['street']) ? $_POST['street'] : '';
		$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
		$building = isset($_POST['building']) ? $_POST['building'] : '';
		$phase = isset($_POST['phase']) ? $_POST['phase'] : '';
		$blocklot = isset($_POST['blocklot']) ? $_POST['blocklot'] : '';

		// Prepare SQL with placeholders
		$sql3 = $conn->prepare("UPDATE tbl_independent SET in_subdi = :subdivision, str = :street, in_unit = :unit, in_build = :building, phase = :phase,
		 blocklot = :blocklot WHERE uid = :uid");

		// Bind parameters securely
		$sql3->bindParam(':subdivision', $subdivision);
		$sql3->bindParam(':street', $street);
		$sql3->bindParam(':unit', $unit);
		$sql3->bindParam(':building', $building);
		$sql3->bindParam(':phase', $phase);
		$sql3->bindParam(':blocklot', $blocklot);
		$sql3->bindParam(':uid', $id);
		$sql3->execute();

	// Business Main Address	
	// ID of the tbl_comadd
	$baddress = isset($_POST['baddress']) ? $_POST['baddress'] : '';

	$cregion = isset($_POST['cregion']) ? $_POST['cregion'] : '';
	$cprov = isset($_POST['cprov']) ? $_POST['cprov'] : '';
	$ccity = isset($_POST['ccity']) ? $_POST['ccity'] : '';
	$cbarangay = isset($_POST['cbarangay']) ? $_POST['cbarangay'] : '';

	// Sub business Address
	$csubdivision = isset($_POST['csubdivision']) ? $_POST['csubdivision'] : '';
	$cstreet = isset($_POST['cstreet']) ? $_POST['cstreet'] : '';
	$cunit = isset($_POST['cunit']) ? $_POST['cunit'] : '';
	$cbuilding = isset($_POST['cbuilding']) ? $_POST['cbuilding'] : '';
	$cphase = isset($_POST['cphase']) ? $_POST['cphase'] : '';
	$cblocklot = isset($_POST['cblocklot']) ? $_POST['cblocklot'] : '';

		// ID of the tbl_comadd
		$baddress = isset($_POST['baddress']) ? $_POST['baddress'] : '';

		// Business Main Address
		$cregion = isset($_POST['cregion']) ? $_POST['cregion'] : '';
		$cprov = isset($_POST['cprov']) ? $_POST['cprov'] : '';
		$ccity = isset($_POST['ccity']) ? $_POST['ccity'] : '';
		$cbarangay = isset($_POST['cbarangay']) ? $_POST['cbarangay'] : '';
		$czip = isset($_POST['czip']) ? $_POST['czip'] : '';

		// Sub business Address
		$csubdivision = isset($_POST['csubdivision']) ? $_POST['csubdivision'] : '';
		$cstreet = isset($_POST['cstreet']) ? $_POST['cstreet'] : '';
		$cunit = isset($_POST['cunit']) ? $_POST['cunit'] : '';
		$cbuilding = isset($_POST['cbuilding']) ? $_POST['cbuilding'] : '';
		$cphase = isset($_POST['cphase']) ? $_POST['cphase'] : '';
		$cblocklot = isset($_POST['cblocklot']) ? $_POST['cblocklot'] : '';

		// Prepare SQL with placeholders
		$sql4 = $conn->prepare("UPDATE tbl_comadd SET cregion = :region, cprovince = :prov, ccity = :city, cbarangay = :barangay , czip = :czip,
			csubvil = :csubdivision, cstreet = :cstreet, cunit = :cunit, cbname = :cbuilding, cphase = :cphase, cbandl = :cblocklot, date_added = :tdate WHERE ca_id = :uid");

		// Bind parameters securely
		$sql4->bindParam(':region', $cregion);
		$sql4->bindParam(':prov', $cprov);
		$sql4->bindParam(':city', $ccity);
		$sql4->bindParam(':barangay', $cbarangay);
		$sql4->bindParam(':czip', $czip);
		$sql4->bindParam(':csubdivision', $csubdivision);
		$sql4->bindParam(':cstreet', $cstreet);
		$sql4->bindParam(':cunit', $cunit);
		$sql4->bindParam(':cbuilding', $cbuilding);
		$sql4->bindParam(':cphase', $cphase);
		$sql4->bindParam(':cblocklot', $cblocklot);
		$sql4->bindParam(':tdate', $today_date1);
		$sql4->bindParam(':uid', $baddress);
		$sql4->execute();
	
	$tin = isset($_POST['tin']) ? $_POST['tin'] : '';

	// Business Permits & Licenses
	$dtinum = isset($_POST['dtinum']) ? $_POST['dtinum'] : '';
	$mayornum = isset($_POST['mayornum']) ? $_POST['mayornum'] : '';
	$cor2303 = isset($_POST['cor2303']) ? $_POST['cor2303'] : '';

		// Prepare SQL with placeholders
		$sql5 = $conn->prepare("UPDATE tbl_independent SET tin = :tin, dti = :dtinum, mayorper = :mayornum, cor = :cor WHERE uid = :uid");

		// Bind parameters securely
		$sql5->bindParam(':tin', $tin);
		$sql5->bindParam(':dtinum', $dtinum);
		$sql5->bindParam(':mayornum', $mayornum);
		$sql5->bindParam(':cor', $cor2303);
		$sql5->bindParam(':uid', $id);
		$sql5->execute();

	// Contact Number
	$connum = isset($_POST['connum']) ? $_POST['connum'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';

	$chk = $conn->prepare("SELECT emailadd, connum, uid, is_deleted FROM tbl_independent WHERE emailadd = :email OR connum = :connum AND uid != :uid AND is_deleted != '1'");
	$chk->bindParam(':email', $email);
	$chk->bindParam(':connum', $connum);
	$chk->bindParam(':uid', $id);
	$chk->execute();
	if($chk->rowCount() > 0)
	{

		header('Location: index.php?view=modify&error=eandc');     

	}else{

		// Prepare SQL with placeholders
		$sql = $conn->prepare("UPDATE tbl_independent SET emailadd = :email,  connum = :connum
								WHERE uid = :uid");
		// Bind parameters securely
		$sql->bindParam(':email', $email);
		$sql->bindParam(':connum', $connum);
		$sql->bindParam(':uid', $id);
		$sql->execute();

	}
		
		header("Location: index.php?view=modify&error=Success");
		
}

/*
    Remove Data
*/
function delete_data()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    if(isset($_POST['id']))
	{ $id = $_POST['id']; }else{ $id = $_GET['id']; }
	
    // delete the category. set is_deleted to 1 as deleted;    
	$sql = $conn->prepare("UPDATE bs_client SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE uid = '$id'");
	$sql->execute();

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('User', 'User Deleted', '$id', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Deleted successfully.");
}

function delete_service()
{
	include '../global-library/database.php';

	$userId = $_SESSION['user_id']; // Ensure this session variable is set
	$subcat = isset($_POST['subcat']) ? $_POST['subcat'] : [];
	
	$total_subs = [];
	$logs_action = ''; // Initialize logs_action
	$is_deleted = 1; // Set is_deleted to 1 for deletion
	
	foreach ($subcat as $subid) {
		
		if ($subid != '0') { // Only process selected subcategories
			echo $subid;
			// Prepare the DELETE query
			$sql = $conn->prepare("UPDATE ind_subcat 
								   SET is_deleted = :is_deleted, date_deleted = :date_deleted, deleted_by = :deleted_by 
								   WHERE subcatid = :id");
			$sql->bindParam(':is_deleted', $is_deleted, PDO::PARAM_INT);
			$sql->bindParam(':date_deleted', $today_date1, PDO::PARAM_STR);
			$sql->bindParam(':deleted_by', $userId, PDO::PARAM_INT);
			$sql->bindParam(':id', $subid, PDO::PARAM_INT);
			$sql->execute();
	
			// Add this subcategory ID to the logs action string
			$logs_action .= $subid . ', ';
			$total_subs[] = $subid; // Save the ID for additional processing if needed
		}
	}
	
	// Trim the trailing comma and space from $logs_action
	$logs_action = rtrim($logs_action, ', ');

	// Insert the log entry if any subcategories were deleted
	if (!empty($total_subs)) {
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
							   VALUES (:module, :action, :description, :action_by, :log_action_date)");
		$log->bindParam(':module', $module, PDO::PARAM_STR);
		$log->bindParam(':action', $action, PDO::PARAM_STR);
		$log->bindParam(':description', $logs_action, PDO::PARAM_STR);
		$log->bindParam(':action_by', $userId, PDO::PARAM_INT);
		$log->bindParam(':log_action_date', $today_date1, PDO::PARAM_STR);
	
		$module = 'User';
		$action = 'User Deleted';
		$log->execute();
	}
	
	// Redirect after processing
	header("Location: index.php?view=service&error=Deleted");
	exit;
	

}


function _deleteImage($id)
{
	include '../../global-library/database.php';
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = $conn->prepare("SELECT image, thumbnail FROM bs_client WHERE uid = '$id'");
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql_data = $sql->fetch();		

		if ($sql_data['image'] && $sql_data['thumbnail']) {
			// remove the image file
			$deleted = @unlink(SRV_ROOT . "adminpanel/assets/images/client/$sql_data[image]");
			$deleted = @unlink(SRV_ROOT . "adminpanel/assets/images/client/$sql_data[thumbnail]");
		}
	}

	return $deleted;
}

?>