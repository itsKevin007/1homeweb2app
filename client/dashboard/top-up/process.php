<?php
require_once '../../../global-library/config.php';
require_once '../../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'topUp' :
        top_up();
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
function top_up()
{
	include '../../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
	$amountDue = isset($_POST['amountDue']) ? $_POST['amountDue'] : '';
	
	$images = uploadimage('fileImage', SRV_ROOT . 'assets/images/top-up/');
	
	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	
		$sql = $conn->prepare("INSERT INTO tbl_topup (userId, pay_amount, image, thumbnail,
													 date_added, added_by)
											VALUES (:userId, :pay_amount, :image, :thumbnail,
													:today_date1, :userId)");
		$sql->bindParam(':userId', $userId, PDO::PARAM_INT);
		$sql->bindParam(':pay_amount', $amountDue, PDO::PARAM_STR);
		$sql->bindParam(':image', $mainImage, PDO::PARAM_STR);
		$sql->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
		$sql->bindParam(':today_date1', $today_date1, PDO::PARAM_STR);
		$sql->execute();

		$id = $conn->lastInsertId();
		$uid = md5($id);

		$up = $conn->prepare("UPDATE tbl_topup SET uid = :uid WHERE cashId = :id");
		$up->bindParam(':uid', $uid, PDO::PARAM_STR);
		$up->bindParam(':id', $id, PDO::PARAM_INT);
		$up->execute();

		// Insert a new notification into tbl_notifications
		$notificationMessage = "User has topped up " . $amountDue;
		$notificationType = 'info'; // Assuming 'success' is a valid type
		$notifIcon = 'info'; // icon

		$user_id = '0';


		$notificationSQL = $conn->prepare("INSERT INTO tbl_notifications (user_id, notification_message, notification_type, notification_icon, date_created, misc_id)
										VALUES (:userId, :message, :type, :notifIcon, :date_created, :misc_id)");
		$notificationSQL->bindParam(':userId', $user_id);
		$notificationSQL->bindParam(':message', $notificationMessage);
		$notificationSQL->bindParam(':type', $notificationType);
		$notificationSQL->bindParam(':notifIcon', $notifIcon);
		$notificationSQL->bindParam(':date_created', $today_date1);
		$notificationSQL->bindParam(':misc_id', $id);
		$notificationSQL->execute();

		$description = 'Top up ' . $amountDue . ' by ' . $uid;

		$log = $conn->prepare("INSERT INTO tr_log (description, log_action_date, action_by) VALUES (:description, :log_action_date, :action_by)");
		$log->bindParam(':description', $description, PDO::PARAM_STR);
		$log->bindParam(':log_action_date', $today_date1, PDO::PARAM_STR);
		$log->bindParam(':action_by', $userId, PDO::PARAM_INT);
		$log->execute();
		
		echo '<form id="redirectForm" action="'. WEB_ROOT .'" method="POST">
					<input type="hidden" name="subscribe" value="true">
				</form>
				<script>
					document.getElementById("redirectForm").submit();
				</script>';
		exit;
	
}


/*
	Upload an image and return the uploaded image name
*/
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
			$deleted = @unlink(SRV_ROOT . "adminpanel/assets/images/client/$sql_data[image]");
			$deleted = @unlink(SRV_ROOT . "adminpanel/assets/images/client/$sql_data[thumbnail]");
		}
	}

	return $deleted;
}


// Example usage
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 	$senderId = $_POST['sender_id']; // Sender's ID from the UI
// 	$receiverId = $_POST['receiver_id']; // Receiver's ID from the UI
// 	$amount = $_POST['amount']; // Amount from the UI

// 	$result = transferMoney($senderId, $receiverId, $amount);
// 	echo $result;
// }

// $conn->close();
?>