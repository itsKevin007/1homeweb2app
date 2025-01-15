<?php
	require_once '../global-library/config.php';
	require_once '../include/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();

	$userId = $_SESSION['user_id'];

	if($accesslevel == 2 ){

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
				
			case'dash' :
				$content 	= 'dashboard.php';
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

			case 'transact':
				$content 	= 'transaction.php';
				$pageTitle 	= $sett_data['system_title'];
				break;

			default :
				$content 	= 'list.php';		
				$pageTitle 	= $sett_data['system_title'];
		}
	}else{
		header("location: ../index.php");
	}


$script    = array('category.js');

require_once '../include/template.php';
?>
