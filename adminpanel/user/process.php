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
	
    $fname = mysqli_real_escape_string($link, $_POST['fname']);	
	$lname = mysqli_real_escape_string($link, $_POST['lname']);
	$email = mysqli_real_escape_string($link, $_POST['email']); 
	$contactnum = $_POST['contactnum'];
	$address = mysqli_real_escape_string($link, $_POST['address']);
	
	$username = strtolower($fname);
	
	$images = uploadimage('fileImage', SRV_ROOT . 'adminpanel/assets/images/user/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	
	$chk = $conn->prepare("SELECT * FROM bs_user WHERE firstname = '$fname' AND lastname = '$lname' AND is_deleted != '1'");
	$chk->execute();
	if($chk->rowCount() > 0)
	{
		header('Location: index.php?view=add&error=Data already exist! Data entry failed.');              
	}else{
		
		$sql = $conn->prepare("INSERT INTO bs_user (firstname, lastname, email, username, password, pass_text, contactno, address,
													image, thumbnail, 
													access_level, date_added, added_by, is_deleted)
											VALUES ('$fname', '$lname', '$email', '$username', md5('1234'), '1234', '$contactnum', '$address',
													'$mainImage', '$thumbnail', 
													'0', '$today_date1', '$userId', '0')");
		$sql->execute();
		
		$id = $conn->lastInsertId();
		$uid = md5($id);
		
		$up = $conn->prepare("UPDATE bs_user SET uid = '$uid' WHERE user_id = '$id'");
		$up->execute();
		
		/*
		$sql7_live = $conn_live->prepare("INSERT INTO tbl_employee (e_rfid_num, e_hire_date, e_branch, e_id_num, e_first_name, e_middle_name, e_last_name, e_username, e_contact_num, e_address, e_caddress, 
														e_salary, e_hrperday, e_secperminute, 
														e_image, e_thumbnail, 
														e_access_level, is_deleted, e_date_added, e_added_by, uid)
												VALUES ('$rfidnum', '$hdate', '$branch', '$idnum', '$fname', '$mname', '$lname', '$idnum', '$contactno', '$address', '$caddress', 
														'$salary', '$hrperday', '$secperminute', 
														'$mainImage', '$thumbnail', 
														'2', '0', '$today_date1', '$userId', '$uid')");
		$sql7_live->execute();
		*/
		
		$keyword = 'First Name: ' . $fname . '<br /> Middle Name: ' . $mname . '<br /> Last Name: ' . $lname . '<br /> Contact Number: ' . $contactnum . '<br /> Address: ' . $address;
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('User', 'User Added', '$keyword', '$userId', '$today_date1')");
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

	if(isset($_POST['my_multi_select1']))
	{		
			
		$op_access = $_POST['my_multi_select1']; 
		foreach ($op_access as $access)
		{
			$acs7 = $conn->prepare("UPDATE bs_user SET $access = '1' WHERE uid = '$id'");
			$acs7->execute();
		}
			
						
	}	
    
	$fname = mysqli_real_escape_string($link, $_POST['fname']);	
	$lname = mysqli_real_escape_string($link, $_POST['lname']);
	$email = mysqli_real_escape_string($link, $_POST['email']); 
	$contactnum = $_POST['contactnum'];
	$address = mysqli_real_escape_string($link, $_POST['address']);
	
	$username = strtolower($fname);
	
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
	
	$chk = $conn->prepare("SELECT * FROM bs_user WHERE firstname = '$fname' AND lastname = '$lname' AND uid != '$id' AND is_deleted != '1'");
	$chk->execute();
	if($chk->rowCount() > 0)
	{
		header("Location: index.php?view=modify&id=$id&error=Data already exist! Data entry failed.");
	}else{
    
		$sql = $conn->prepare("UPDATE bs_user SET firstname = '$fname', middlename = '$mname', lastname = '$lname', email = '$email', username = '$username', password = md5('1234'), pass_text = '1234', contactno = '$contactnum', address = '$address',
													image = $mainImage, thumbnail = $thumbnail, date_modified = '$today_date1', modified_by = '$userId' WHERE uid = '$id'");
		$sql->execute();
		
		$keyword = 'First Name: ' . $fname . '<br /> Middle Name: ' . $mname . '<br /> Last Name: ' . $lname . '<br /> Contact Number: ' . $contactnum . '<br /> Address: ' . $address;
		
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
												VALUES ('User', 'User Modified', '$keyword', '$userId', '$today_date1')");
		$log->execute();
		
		header("Location: index.php?view=modify&id=$id&error=Modified successfully.");
	
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

	$chk = $conn->prepare("SELECT * FROM bs_user WHERE uid = '$id'");
	$chk->execute();
	$chk_data = $chk->fetch();
		$fname = $chk_data['firstname'];
		$mname = $chk_data['middlename'];
		$lname = $chk_data['lastname'];
		$contactnum = $chk_data['contactno'];
		$address = $chk_data['address'];
	
	$deleted = _deleteImage($id);
	
    // delete the category. set is_deleted to 1 as deleted;    
	$sql = $conn->prepare("UPDATE bs_user SET is_deleted = '1', date_deleted = '$today_date1', deleted_by = '$userId' WHERE uid = '$id'");
	$sql->execute();
	
	$keyword = 'First Name: ' . $fname . '<br /> Middle Name: ' . $mname . '<br /> Last Name: ' . $lname . '<br /> Contact Number: ' . $contactnum . '<br /> Address: ' . $address;

	$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
											VALUES ('User', 'User Deleted', '$keyword', '$userId', '$today_date1')");
	$log->execute();	
        
	header("Location: index.php?error=Deleted successfully.");
}

function _deleteImage($id)
{
	include '../../global-library/database.php';
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = $conn->prepare("SELECT image, thumbnail FROM bs_user WHERE uid = '$id'");
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