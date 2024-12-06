<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$pg = $conn->prepare("UPDATE bs_page SET page = '1' WHERE is_deleted != '1'");
$pg->execute();

$userId = $_SESSION['user_id'];

$chk = $conn->prepare("SELECT * FROM bs_user WHERE user_id = '$userId' AND is_deleted != '1'");
$chk->execute();
while($chk_data = $chk->fetch()){
$is_user = $chk_data["is_user"];

if($is_user  == "1"){

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	
	switch ($view) {
		case 'list' :
			$content 	= 'list.php';		
			$pageTitle 	= $sett_data['system_title'];
			break;

		case 'add' :
			$content 	= 'add.php';		
			$pageTitle 	= $sett_data['system_title'];
			break;

		case 'modify' :
			$content 	= 'modify.php';		
			$pageTitle 	= $sett_data['system_title'];
			break;
			
		case 'modify_account' :
			$content 	= 'modify_account.php';		
			$pageTitle 	= $sett_data['system_title'];
			break;

		default :
			$content 	= 'list.php';		
			$pageTitle 	= $sett_data['system_title'];
	}

}else{
	header("location: ../index.php");
}
}
$script    = array('category.js');

require_once '../include/template.php';
?>
