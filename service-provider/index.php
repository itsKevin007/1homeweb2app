<?php
	require_once '../global-library/config.php';
	require_once '../include/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();

	$pg = $conn->prepare("UPDATE bs_page SET page = '6' WHERE is_deleted != '1'");
	$pg->execute();

	$userId = $_SESSION['user_id'];


	if($accesslevel == 1 ){

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

			case 'prof' :
				$content 	= 'profile.php';		
				$pageTitle 	= $sett_data['system_title'];
				break;

			case 'service' :
				$content 	= 'services.php';		
				$pageTitle 	= $sett_data['system_title'];
				break;

			case'transact' :
				$content = 'transactions/transactions.php';
				$pageTitle = $sett_data['system_title'];
				break;

			case 'dash' :
				$content 	= 'dashboard.php';
				$pageTitle 	= $sett_data['system_title'];
				break;

			

			default :
				$content 	= 'dashboard.php';		
				$pageTitle 	= $sett_data['system_title'];
		}
	}else{
		header("location: ../index.php");
	}


$script    = array('category.js');

require_once '../include/template.php';
?>
