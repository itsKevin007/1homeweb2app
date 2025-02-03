<?php

require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        add_data();
        break;

	case 'uploadImg' :
		upload_img();
		break;

	case 'addService' :
		add_service();
		break;
		
	case 'modify' :
        modify_data();
        break;

	case 'act' :
		active_data();
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
function add_data()
{

	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    $latitude = mysqli_real_escape_string($link, $_POST['lat']);
    $longitude = mysqli_real_escape_string($link, $_POST['long']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
	$landMark = mysqli_real_escape_string($link, $_POST['landMark']);
	$userType = 0;

	$sql = $conn->prepare("INSERT INTO tbl_location (name, user_id, user_type, area_long, area_lat, landMark, date_added, added_by, is_deleted) 
								VALUES (:address, :userId, :userType, :longitude, :latitude, :landMark, :today_date1, :userId2, :is_deleted)");
	$sql->bindParam(':address', $address);
	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':userType', $userType);
	$sql->bindParam(':longitude', $longitude);
	$sql->bindParam(':latitude', $latitude);
	$sql->bindParam(':landMark', $landMark);
	$sql->bindParam(':today_date1', $today_date1);
	$sql->bindParam(':userId2', $userId); // Alias for clarity, though userId is reused here
	$sql->bindValue(':is_deleted', 0); // Assuming 'is_deleted' is always 0
	$sql->execute();

	$last_id = $conn->lastInsertId();
	$uid = md5($last_id);

	// setting up id into hash
	$sql1 = $conn->prepare("UPDATE tbl_location SET uid = :uid WHERE l_id = :last_id");
    $sql1->bindParam(':uid', $uid);
    $sql1->bindParam(':last_id', $last_id);
    $sql1->execute();
    
    $keyword = 'Address: ' . $name .' Longitude: ' . $longitude . ' Latitude: ' . $latitude;
    
  	// Insert into tr_log
	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date) 
	VALUES (:module, :action, :description, :action_by, :log_action_date)");
	$log->bindValue(':module', 'Profile');
	$log->bindValue(':action', 'Add Location');
	$log->bindParam(':description', $keyword);
	$log->bindParam(':action_by', $userId);
	$log->bindParam(':log_action_date', $today_date1);
	$log->execute();
    
    header("Location: index.php?error=Success");

}

// --------------------------------- For adding Image --------------------------------- //
function upload_img()
{
	include '../global-library/database.php';
	$userId = $_SESSION['user_id'];

	$images = uploadimage('fileImage', SRV_ROOT . 'adminpanel/assets/images/user/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

	$up = $conn->prepare("UPDATE tbl_location SET image = :mainImage, thumbnail = :thumbnail WHERE user_id = :userId");
	$up->bindParam(':mainImage', $mainImage);
	$up->bindParam(':thumbnail', $thumbnail);
	$up->bindParam(':userId', $userId);
	$up->execute();

	$log = $conn->prepare("INSERT INTO tr_log (module, description, log_action_date, action_by) VALUES ('Service Provider', 'Edit Profile: $thumbnail', '$today_date1', '$userId')");
	$log->execute();

	header('Location: index.php?view=prof&error=Success');
}
// --------------------------------- End For adding Image --------------------------------- //

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
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    $areaId = $_POST['areaId'];

    $latitude = mysqli_real_escape_string($link, $_POST['lat']);
    $longitude = mysqli_real_escape_string($link, $_POST['long']);
    $name = mysqli_real_escape_string($link, $_POST['address']);
	$landmark = mysqli_real_escape_string($link, $_POST['landMark']);

	$sql = $conn->prepare("UPDATE tbl_location SET name = :name, area_long = :longitude, area_lat = :latitude, landMark = :landmark,
									date_modified = :today_date1, modified_by = :userId WHERE l_id = :areaId");
	$sql->bindParam(':name', $name);
	$sql->bindParam(':longitude', $longitude);
	$sql->bindParam(':latitude', $latitude);
	$sql->bindParam(':landmark', $landmark);
	$sql->bindParam(':today_date1', $today_date1);
	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':areaId', $areaId);
	$sql->execute();

	$keyword = 'Address: ' . $name .' Longitude: ' . $longitude . ' Latitude: ' . $latitude . ' Landmark: ' . $landmark;


	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
						VALUES ('Location', 'Modify Location', '$keyword', '$userId', '$today_date1')");
	$log->execute();
	
		
		header("Location: ../address/?error=success");
		
}

/*
    Modify Data
*/


/*
    Active or Inactive Location
*/
function active_data()
{
	
	session_start();
	include '../../global-library/database.php';

	if (isset($_POST['action']) && $_POST['action'] == 'act') {
		$userId = $_SESSION['user_id'];
		$id = $_POST['id'];
		$isActive = $_POST['is_active'];
		$today_date1 = date('Y-m-d H:i:s');

		// Update the active status
		$sql = $conn->prepare("UPDATE tbl_location SET is_active = :is_active, date_deleted = :date_deleted, deleted_by = :deleted_by WHERE uid = :id");
		$sql->execute([
			':is_active' => $isActive,
			':date_deleted' => $today_date1,
			':deleted_by' => $userId,
			':id' => $id
		]);

		// Log the action
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
							VALUES ('Location', 'Location Status Updated', :id, :userId, :today_date1)");
		$log->execute([
			':id' => $id,
			':userId' => $userId,
			':today_date1' => $today_date1
		]);

		echo json_encode(['status' => 'success', 'is_active' => $isActive]);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
	}
	
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
	$sql = $conn->prepare("UPDATE tbl_location SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE uid = '$id'");
	$sql->execute();

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('Location', 'Location Deleted', '$id', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Success");
}

function delete_service()
{
	include '../global-library/database.php';

	$userId = $_SESSION['user_id']; // Ensure this session variable is set
	$subcat = isset($_POST['subcat']) ? $_POST['subcat'] : [];
	
	$total_subs = [];
	$logs_action = ''; // Initialize logs_action
	
	foreach ($subcat as $subid) {
		
		if ($subid != '0') { // Only process selected subcategories
			
			// Prepare the DELETE query
			$sql = $conn->prepare("UPDATE ind_subcat 
								   SET is_deleted = :is_deleted, date_deleted = :date_deleted, deleted_by = :deleted_by 
								   WHERE uid = :uid");
			$sql->bindParam(':is_deleted', $is_deleted, PDO::PARAM_INT);
			$sql->bindParam(':date_deleted', $today_date1, PDO::PARAM_STR);
			$sql->bindParam(':deleted_by', $userId, PDO::PARAM_INT);
			$sql->bindParam(':uid', $id, PDO::PARAM_INT);
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
	header("Location: index.php?error=Deleted");
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