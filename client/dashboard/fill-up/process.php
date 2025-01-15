<?php

require_once '../../../global-library/config.php';
require_once '../../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'pay' :
        trans_pay();
        break;
		
	case 'modify' :
        modify_data();
        break;
        
    case 'delete' :
        delete_data();
        break;

	case 'delService' :
		delete_service();
		break;
		
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


/*
    Add Data
*/
function trans_pay()
{
	include '../../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	$referenceNo = isset($_POST['referenceNo']) ? $_POST['referenceNo'] : ''; // Corrected name
	$transPay = isset($_POST['transPay']) ? $_POST['transPay'] : '';         // Corrected name

	$images = uploadimage('fileImage', SRV_ROOT . 'assets/images/subscription/');
	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	$today_date1 = date('Y-m-d H:i:s');

	$sql = $conn->prepare("INSERT INTO tbl_payment (userId, referenceNo, transPay, thumbnail, image, date_added, added_by, confirmation)
                           VALUES (:userId, :referenceNo, :transPay, :thumbnail, :mainImage, :today_date1, :confirmation, :userId)");

	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':referenceNo', $referenceNo);
	$sql->bindParam(':transPay', $transPay);
	$sql->bindParam(':thumbnail', $thumbnail);
	$sql->bindParam(':mainImage', $mainImage);
	$sql->bindParam(':today_date1', $today_date1);
	$sql->bindParam(':confirmation', $confirmation);
	$sql->execute();

	$id = $conn->lastInsertId();
	$uid = md5($id);

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
                           VALUES (:module, :action, :description, :action_by, :log_action_date)");
	$log->bindParam(':module', $module);
	$log->bindParam(':action', $actionParam);
	$log->bindParam(':description', $referenceNo);
	$log->bindParam(':action_by', $userId);
	$log->bindParam(':log_action_date', $today_date1);

	$module = 'Payment';
	$actionParam = 'Payment';
	$log->execute();

	header('Location: index.php?view=pay&error=Success');
	exit;
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
	include '../../../global-library/database.php';
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


function _deleteImage($id)
{
	include '../../../global-library/database.php';
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