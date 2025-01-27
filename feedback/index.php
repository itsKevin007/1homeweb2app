<?php
	require_once '../global-library/config.php';
	require_once '../include/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();

	$pg = $conn->prepare("UPDATE bs_page SET page = 'Profile' WHERE is_deleted != '1'");
	$pg->execute();

	$userId = $_SESSION['user_id'];

	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	if($user_data['is_sub'] != 1){


		switch ($view) {
			case 'feedback' :
				$content 	= 'feedback.php';		
				$pageTitle 	= $sett_data['system_title'];
				break;

			default :
				$content 	= 'feedback.php';		
				$pageTitle 	= $sett_data['system_title'];
		}
		
	}else{
		header("location: ../index.php");
	}


$script    = array('category.js');

require_once '../include/template.php';
?>
