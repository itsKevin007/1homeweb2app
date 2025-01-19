<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'topUp' :
        confirmData();
        break;
	   
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


/**
 * Confirm user topup
 *
 * @return void
 */
function confirmData()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    if(isset($_POST['id']))
	{ $id = $_POST['id']; }else{ $id = $_GET['id']; }	// top up ID

	if(isset($_POST['ids']))
	{ $id1 = $_POST['ids']; }else{ $id1 = $_GET['ids']; }	// user ID


	

	$topUP = $conn->prepare("UPDATE tbl_topup SET is_done = :is_done, date_approve = :date_approve, approved_by = :approved_by WHERE uid = :uid");
	$topUP->bindValue(':is_done', '1', PDO::PARAM_INT);
	$topUP->bindValue(':date_approve', $today_date2, PDO::PARAM_STR);
	$topUP->bindValue(':approved_by', $userId, PDO::PARAM_INT);
	$topUP->bindValue(':uid', $id, PDO::PARAM_STR);
	$topUP->execute();

	$selTopup = $conn->prepare("SELECT * FROM tbl_topup WHERE uid = :uid");
	$selTopup->bindParam(':uid', $id, PDO::PARAM_STR);
	$selTopup->execute();
	$data = $selTopup->fetch();
	$amountTopUp = $data['pay_amount'];

	$sql = $conn->prepare("SELECT * FROM tbl_balance WHERE userId = :userId");
	$sql->bindParam(':userId', $id1, PDO::PARAM_INT);
	$sql->execute();
	if($sql->rowCount() > 0){
		$balanceSQL = $conn->prepare("UPDATE tbl_balance SET balance = balance + :topUp WHERE userId = :userId");
		$balanceSQL->bindValue(':topUp', $amountTopUp, PDO::PARAM_INT);
		$balanceSQL->bindValue(':userId', $id1, PDO::PARAM_STR);
		$balanceSQL->execute();
	}else{
		$balanceSQL = $conn->prepare("INSERT INTO tbl_balance (userId, balance) VALUES (:userId, :balance)");
		$balanceSQL->bindParam(':userId', $id1, PDO::PARAM_INT);
		$balanceSQL->bindParam(':balance', $amountTopUp, PDO::PARAM_INT);
		$balanceSQL->execute();
	}

	// Insert a new notification into tbl_notifications
	$notificationMessage = "Your Cash In has been confirmed. Thank you.";
	$notificationType = 'success'; // info, success, error , primary
	$notifIcon = 'success'; // icon


	$notificationSQL = $conn->prepare("INSERT INTO tbl_notifications (user_id, notification_message, notification_type, notification_icon, date_created, misc_id)
									VALUES (:userId, :message, :type, :notifIcon, :date_created, :misc_id)");
	$notificationSQL->bindParam(':userId', $id1);
	$notificationSQL->bindParam(':message', $notificationMessage);
	$notificationSQL->bindParam(':type', $notificationType);
	$notificationSQL->bindParam(':notifIcon', $notifIcon);
	$notificationSQL->bindParam(':date_created', $today_date1);
	$notificationSQL->bindParam(':misc_id', $id);
	$notificationSQL->execute();



	echo '<form id="redirectForm" action="'. ADM_ROOT .'top-up/" method="POST">
			<input type="hidden" name="subscribe" value="Success">
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

?>