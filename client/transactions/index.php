<?php
	session_start();
	require_once '../../global-library/config.php';
	require_once '../../include/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	checkUser();

	$pg = $conn->prepare("UPDATE bs_page SET page = 'Transactions' WHERE is_deleted != '1'");
	$pg->execute();

	$userId = $_SESSION['user_id'];

	if($accesslevel == 0 ){

		$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
			

		switch ($view) {

			case 'add' :
				$content 	= 'add.php';		
				$pageTitle 	= $sett_data['system_title'];
				break;

			case 'dash' :
				$content 	= 'dashboard.php';		
				$pageTitle 	= $sett_data['system_title'];
				break;

			case 'transaction' :
				$content 	= 'transaction.php';
				$pageTitle 	= $sett_data['system_title'];
				break;

			default:
				$content = 'profile.php';  // Optionally, add a default view
				$pageTitle = $sett_data['system_title'];
				break;
		}
	}else{
		header("location: ../../index.php");
	}


$script    = array('category.js');

require_once '../../include/template.php';
?>
