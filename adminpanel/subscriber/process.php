<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        add_data();
        break;
		
	case 'modify' :
        modify_data();
        break;
        
    case 'delete' :
        delete_data();
        break;

	case 'confirm' :
		confirmData();
		break;
		
    
    case 'deleteImage' :
        deleteImage();
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
    Modify Data
*/
function modify_data()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    $id = $_POST['id'];
    
	$fname = mysqli_real_escape_string($link, $_POST['fname']);
	$lname = mysqli_real_escape_string($link, $_POST['lname']);
	$email = $_POST['email'];
	$type = $_POST['type'];
	$uid = $_POST['id'];
	
	$images = uploadimage('fileImage', SRV_ROOT . 'adminpanel/assets/images/client/');

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
	
	$chk = $conn->prepare("SELECT * FROM bs_client WHERE c_fname = '$fname' AND c_lname = '$lname' AND uid != '$uid' AND is_deleted != '1'");
	$chk->execute();
	if($chk->rowCount() > 0)
	{
		header("Location: index.php?view=list&error=Data already exist! Data entry failed.");
	}else{
    
		$sql = $conn->prepare("UPDATE bs_client SET c_fname = '$fname', c_lname = '$lname', email = '$email', sub_type = '$type',
													date_modified = '$today_date1', modified_by = '$userId' WHERE uid = '$id'");
		$sql->execute();

		$log = $conn->prepare("INSERT INTO tr_log (description, log_action_date, action_by) VALUES ('Client $fname $lname modified.', '$today_date1', '$userId')");
		$log->execute();
		
		
		header("Location: index.php?view=list&error=Modified successfully.");
	
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

	$chk = $conn->prepare("SELECT * FROM bs_client WHERE uid = '$id'");
	$chk->execute();
	$chk_data = $chk->fetch();
		$c_fname = $chk_data['c_fname'];
		$email = $chk_data['c_lname'];
		$c_email = $chk_data['email'];
		$c_contact = $chk_data['c_contact'];
		$address = $chk_data['address'];

	
	$deleted = _deleteImage($id);
	
    // delete the category. set is_deleted to 1 as deleted;    
	$sql = $conn->prepare("UPDATE bs_client SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE c_id = '$id'");
	$sql->execute();
	
	$keyword = 'c_fname: ' . $c_fname .  '<br /> c_lname: ' . $c_lname . '<br /> email: ' . $email . '<br /> c_contact: ' . $c_contact;

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('User', 'User Deleted', '$keyword', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Deleted successfully.");
}

/**
 * Confirm user subscription
 *
 * @return void
 */
function confirmData()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];
	
    if(isset($_POST['id']))
	{ $id = $_POST['id']; }else{ $id = $_GET['id']; }	// user ID

    if(isset($_POST['id1']))
	{ $id1 = $_POST['id1']; }else{ $id1 = $_GET['id1']; } // sub ID

	if(isset($_POST['subType']))
	{ $sub = $_POST['subType']; }else{ $sub = $_GET['subType']; }

	$userSel = $conn->prepare("SELECT * FROM bs_user WHERE uid = :uid");
	$userSel->bindParam(':uid', $id, PDO::PARAM_STR);
	$userSel->execute();
	$userSelData = $userSel->fetch();
	$user_id = $userSelData['user_id'];
  
	$sql = $conn->prepare("UPDATE bs_user SET is_sub = :is_sub, subDate = :sub_date, sub_type = :sub_type WHERE uid = :uid");
	$sql->bindValue(':is_sub', '1', PDO::PARAM_INT);
	$sql->bindValue(':sub_date', $today_date2, PDO::PARAM_STR);
	$sql->bindValue(':sub_type', $sub, PDO::PARAM_STR);
	$sql->bindValue(':uid', $id, PDO::PARAM_STR);
	$sql->execute();
	

	$sql1 = $conn->prepare("UPDATE tbl_subscription SET is_done = :is_done, sub_date = :sub_date, sub_by = :sub_by WHERE uid = :uid");
	$sql1->bindValue(':is_done', '1', PDO::PARAM_INT);
	$sql1->bindValue(':sub_date', $today_date2, PDO::PARAM_STR);
	$sql1->bindValue(':sub_by', $userId, PDO::PARAM_STR);
	$sql1->bindValue(':uid', $id1, PDO::PARAM_STR);
	$sql1->execute();

	// Insert a new notification into tbl_notifications
	$notificationMessage = "Your Subscription has been approved.";
	$notificationType = 'success'; // info, success, error , primary
	$notifIcon = 'success'; // icon


	$notificationSQL = $conn->prepare("INSERT INTO tbl_notifications (user_id, notification_message, notification_type, notification_icon, date_created, misc_id)
									VALUES (:userId, :message, :type, :notifIcon, :date_created, :misc_id)");
	$notificationSQL->bindParam(':userId', $user_id);
	$notificationSQL->bindParam(':message', $notificationMessage);
	$notificationSQL->bindParam(':type', $notificationType);
	$notificationSQL->bindParam(':notifIcon', $notifIcon);
	$notificationSQL->bindParam(':date_created', $today_date1);
	$notificationSQL->bindParam(':misc_id', $id1);
	$notificationSQL->execute();
        
	echo '<form id="redirectForm" action="'. ADM_ROOT .'subscriber/" method="POST">
	<input type="hidden" name="subscribe" value="Success">
		</form>
		<script>
			document.getElementById("redirectForm").submit();
		</script>';
	exit;
}

?>