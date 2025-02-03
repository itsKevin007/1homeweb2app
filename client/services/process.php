<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {

	case 'modify' :
        modify_data();
        break;
        
    case 'delete' :
        delete_data();
        break;
    
    case 'addBooking' :
        add_booking();
        break;
	
	default :
		// if action is not defined or unknown
		// move to main category page
		header('Location: index.php');
}

function add_booking()
{
    global $conn;

	$userId = $_SESSION['user_id'];
    $requestedService = $_POST['requestedService'] ?? '';
    $booking_address = $_POST['booking_address'] ?? '';
    $contact_num = $_POST['contact_num'] ?? '';
    $roomNo = $_POST['roomNo'] ?? '';
    $createdAt = $_POST['created_at'] ?? '';

// echo "Requested Service: " . htmlspecialchars($requestedService) . "<br>";
// echo "Booking Address: " . htmlspecialchars($booking_address) . "<br>";
// echo "Contact Number: " . htmlspecialchars($contact_num) . "<br>";
// echo "Room Number: " . htmlspecialchars($roomNo) . "<br>";
// echo "Created At: " . htmlspecialchars($createdAt) . "<br>";

    try {
        $stmt = $conn->prepare("INSERT INTO tbl_bookings (user_id,requested_service, booking_address, contact_num, roomNo, created_at)
                            VALUES (:user_id, :requested_service, :booking_address, :contact_num, :roomNo, :created_at )");
		$stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':requested_service', $requestedService, PDO::PARAM_STR);
        $stmt->bindParam(':booking_address', $booking_address, PDO::PARAM_STR);
        $stmt->bindParam(':contact_num', $contact_num, PDO::PARAM_STR);
        $stmt->bindParam(':roomNo', $roomNo, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $createdAt, PDO::PARAM_STR);

        $stmt->execute();

        // Redirect to previous page with success message
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=Booking+successfully+added');
        exit;
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log error to the server logs
        // Prepare the form to redirect with error message
        echo '<form id="redirectForm" action="index.php?view=viewsub" method="POST">
            <input type="hidden" name="error" value="Error processing booking">
        </form>';
        echo '<script>document.getElementById("redirectForm").submit();</script>';
        exit;
    }
}

// /*
// 	Upload an image and return the uploaded image name
// */
function uploadimage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';

	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";

		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']);

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_IMAGE_WIDTH && $width > MAX_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}

		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);

			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}
		} else {
			// the image cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}

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
	
    $id = $_POST['id'];
    
	$fname = mysqli_real_escape_string($link, $_POST['fname']);
	$mname = mysqli_real_escape_string($link, $_POST['mname']);
	$lname = mysqli_real_escape_string($link, $_POST['lname']);
	$suffix = mysqli_real_escape_string($link, $_POST['suffix']);
	$connum = mysqli_real_escape_string($link, $_POST['connum']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$region = mysqli_real_escape_string($link, $_POST['region']);
	$province = mysqli_real_escape_string($link, $_POST['province']);
	$city = mysqli_real_escape_string($link, $_POST['city']);
	$barangay = mysqli_real_escape_string($link, $_POST['barangay']);
	$subdivision = mysqli_real_escape_string($link, $_POST['subdivision']);
	$street = mysqli_real_escape_string($link, $_POST['street']);
	$unit = mysqli_real_escape_string($link, $_POST['unit']);
	$building = mysqli_real_escape_string($link, $_POST['building']);
	$phase = mysqli_real_escape_string($link, $_POST['phase']);
	$blocklot = mysqli_real_escape_string($link, $_POST['blocklot']);
	$zip = mysqli_real_escape_string($link, $_POST['zip']);
	$email = $_POST['email'];
	
	$images = uploadimage('fileImage', SRV_ROOT . 'adminpanel/assets/images/user/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	
	// if uploading a new image
	// remove old image
	if ($mainImage != '') {
		_deleteImage($id);

		$mainImage = "'$mainImage'";
		$thumbnail = "'$thumbnail'";
	} else {
		// if we're not updating the image
		// make sure the old path remain the same
		// in the database
		$mainImage = 'image';
		$thumbnail = 'thumbnail';
	}
	$chk = $conn->prepare("SELECT * FROM bs_client WHERE connum = :connum AND email = :email AND uid != :uid AND is_deleted != '1'");
	$chk->bindParam(':connum', $connum, PDO::PARAM_STR);
	$chk->bindParam(':email', $email, PDO::PARAM_STR);
	$chk->bindParam(':uid', $uid, PDO::PARAM_STR);
	$chk->execute();
	if ($chk->rowCount() > 0)
	{
		// header("Location: index.php?view=modify&error=Data already exist! Data entry failed.");
	}else{
    
		$sql = $conn->prepare("UPDATE bs_client SET c_fname = '$fname', c_mname = '$mname', c_lname = '$lname', c_suffix = '$suffix', connum = '$connum', email = '$email', region_text = '$region', province_text = '$province', city_text = '$city', barangay_text = '$barangay', subdivision = '$subdivision', street = '$street', unit = '$unit', building = '$building', phase = '$phase', blocklot = '$blocklot', zipcode = '$zip',
													date_modified = '$today_date1', modified_by = '$userId' WHERE uid = '$id'");
		$sql->execute();

		$sql1 = $conn->prepare("UPDATE bs_user SET image = $mainImage, thumbnail = $thumbnail,
													date_modified = '$today_date1', modified_by = '$userId' WHERE user_id = '$userId'");
		$sql1->execute();

		$keyword = 'First Name: ' . mysqli_real_escape_string($link, $_POST['fname']) . '<br /> Middle Name: ' . mysqli_real_escape_string($link, $_POST['mname']) . '<br /> Last Name: ' . mysqli_real_escape_string($link, $_POST['lname']) . '<br /> Suffix: ' . mysqli_real_escape_string($link, $_POST['suffix']) . '<br /> Contact Number: ' . mysqli_real_escape_string($link, $_POST['connum']) . '<br /> Email: ' . mysqli_real_escape_string($link, $_POST['email']) . '<br /> Address: ' . mysqli_real_escape_string($link, $_POST['region']) . ', ' . mysqli_real_escape_string($link, $_POST['province']) . ', ' . mysqli_real_escape_string($link, $_POST['city']) . ', ' . mysqli_real_escape_string($link, $_POST['barangay']) . ', ' . mysqli_real_escape_string($link, $_POST['subdivision']) . ', ' . mysqli_real_escape_string($link, $_POST['street']) . ', ' . mysqli_real_escape_string($link, $_POST['unit']) . ', ' . mysqli_real_escape_string($link, $_POST['building']) . ', ' . mysqli_real_escape_string($link, $_POST['phase']) . ', ' . mysqli_real_escape_string($link, $_POST['blocklot']) . ', ' . mysqli_real_escape_string($link, $_POST['zip']);

		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Client', 'Profile Edit', '$keyword', '$userId', '$today_date1')");
		$log->execute();
		
		header("Location: index.php?view=prof&error=Modified successfully.");
	
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
	$sql = $conn->prepare("UPDATE bs_client SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE uid = '$id'");
	$sql->execute();

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('User', 'User Deleted', '$id', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Deleted successfully.");
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
			$deleted = @unlink(SRV_ROOT . "../../adminpanel/assets/images/user/$sql_data[image]");
			$deleted = @unlink(SRV_ROOT . "../../adminpanel/assets/images/user/$sql_data[thumbnail]");
		}
	}

	return $deleted;
}

?>