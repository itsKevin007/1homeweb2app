<?php

require_once '../../global-library/config.php';
require_once '../../include/functions.php';

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
	$userType = 1;
	
	$sql = $conn->prepare("INSERT INTO tbl_location (name, user_id, user_type, area_long, area_lat, date_added, added_by, is_deleted) 
								VALUES (:address, :userId, :userType, :longitude, :latitude, :today_date1, :userId2, :is_deleted)");
	$sql->bindParam(':address', $address);
	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':userType', $userType);
	$sql->bindParam(':longitude', $longitude);
	$sql->bindParam(':latitude', $latitude);
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
	

	$sql = $conn->prepare("UPDATE tbl_location SET name = :name, area_long = :longitude, area_lat = :latitude,
									date_modified = :today_date1, modified_by = :userId WHERE l_id = :areaId");
	$sql->bindParam(':name', $name);
	$sql->bindParam(':longitude', $longitude);
	$sql->bindParam(':latitude', $latitude);
	$sql->bindParam(':today_date1', $today_date1);
	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':areaId', $areaId);
	$sql->execute();

	$keyword = 'Address: ' . $name .' Longitude: ' . $longitude . ' Latitude: ' . $latitude;


	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
						VALUES ('Location', 'Modify Location', '$keyword', '$userId', '$today_date1')");
	$log->execute();
	
		
		header("Location: index.php?view=service&error=Success");
		
}

/*
    Modify Data
*/


/*
    Active or Inactive Location
*/
function active_data()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    if(isset($_POST['id']))
	{ $id = $_POST['id']; }else{ $id = $_GET['id']; }

	$sql1 = $conn->prepare("SELECT is_active FROM tbl_location WHERE uid = '$id'");
	$sql1->execute();
	$result = $sql1->fetch(PDO::FETCH_ASSOC);
	$outcome = $result['is_active'];

	if($outcome == 1){
		$active = 0;
	}else{
		$active = 1;
	}
	
    // delete the category. set is_deleted to 1 as deleted;    
	$sql = $conn->prepare("UPDATE tbl_location SET is_active = :active, date_deleted = :date, deleted_by = :userId WHERE uid = :id");
	$sql->bindParam(':active', $active);
	$sql->bindParam(':date', $today_date1);
	$sql->bindParam(':userId', $userId);
	$sql->bindParam(':id', $id);
	$sql->execute();

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('Location', 'Location Deleted', '$id', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Success");
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