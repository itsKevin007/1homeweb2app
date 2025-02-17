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
	
	$chk = $conn->prepare("SELECT * FROM bs_client WHERE c_fname = :fname AND c_lname = :lname AND email = :email AND is_deleted != '1'");
	$chk->bindParam(':fname', $fname, PDO::PARAM_STR);
	$chk->bindParam(':lname', $lname, PDO::PARAM_STR);
	$chk->bindParam(':email', $email, PDO::PARAM_STR);
	$chk->execute();
	if($chk->rowCount() > 0)
	{
		header('Location: index.php?view=modify&error=Data already exist! Data entry failed.');              
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
		
		header('Location: index.php?view=modify&error=Added successfully.');

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

	//bank details
	$accname = isset($_POST['accname']) ? mysqli_real_escape_string($link, $_POST['accname']) : '';
	$accnum = isset($_POST['accnum']) ? mysqli_real_escape_string($link, $_POST['accnum']) : '';
	$bank = isset($_POST['bank']) ? mysqli_real_escape_string($link, $_POST['bank']) : '';
	$branch = isset($_POST['branch']) ? mysqli_real_escape_string($link, $_POST['branch']) : '';


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
		header("Location: index.php?view=modify&error=Data already exist! Data entry failed.");
	}else{
    
		$sql = $conn->prepare("UPDATE bs_client SET  c_fname = '$fname', c_mname = '$mname', c_lname = '$lname', c_suffix = '$suffix', connum = '$connum', email = '$email', region_text = '$region', province_text = '$province', city_text = '$city', barangay_text = '$barangay', subdivision = '$subdivision', street = '$street', unit = '$unit', building = '$building', phase = '$phase', blocklot = '$blocklot', zipcode = '$zip', bank = '$bank', branch = '$branch', accname = '$accname', accnum = '$accnum',
													date_modified = '$today_date1', modified_by = '$userId' WHERE uid = '$id'");
		$sql->execute();

		$sql1 = $conn->prepare("UPDATE bs_user SET image = $mainImage, thumbnail = $thumbnail,
													date_modified = '$today_date1', modified_by = '$userId' WHERE user_id = '$userId'");
		$sql1->execute();

		$keyword = 'First Name: ' . mysqli_real_escape_string($link, $_POST['fname']) . '<br /> Middle Name: ' . mysqli_real_escape_string($link, $_POST['mname']) . '<br /> Last Name: ' . mysqli_real_escape_string($link, $_POST['lname']) . '<br /> Suffix: ' . mysqli_real_escape_string($link, $_POST['suffix']) . '<br /> Contact Number: ' . mysqli_real_escape_string($link, $_POST['connum']) . '<br /> Email: ' . mysqli_real_escape_string($link, $_POST['email']) . '<br /> Address: ' . mysqli_real_escape_string($link, $_POST['region']) . ', ' . mysqli_real_escape_string($link, $_POST['province']) . ', ' . mysqli_real_escape_string($link, $_POST['city']) . ', ' . mysqli_real_escape_string($link, $_POST['barangay']) . ', ' . mysqli_real_escape_string($link, $_POST['subdivision']) . ', ' . mysqli_real_escape_string($link, $_POST['street']) . ', ' . mysqli_real_escape_string($link, $_POST['unit']) . ', ' . mysqli_real_escape_string($link, $_POST['building']) . ', ' . mysqli_real_escape_string($link, $_POST['phase']) . ', ' . mysqli_real_escape_string($link, $_POST['blocklot']) . ', ' . mysqli_real_escape_string($link, $_POST['zip']);

		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('Client', 'Profile Edit', '$keyword', '$userId', '$today_date1')");
		$log->execute();
		
		header("Location: index.php?view=modify&error=Modified successfully.");
	
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