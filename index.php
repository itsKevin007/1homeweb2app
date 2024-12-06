<?php
require_once 'global-library/config.php';
require_once 'include/functions.php';

	if(isset($_SESSION['user_id']))
	{ $userId = $_SESSION['user_id']; }else{ /* header('Location: login.php'); exit; */ }
	
	// checkUser();

	
	$content = 'home.php';
	$pageTitle = $sett_data['system_title'];
	$script = array('main.js');

	
	$sql = $conn->prepare("UPDATE tbl_counter SET counter = counter + 1");
	$sql->execute();

	require_once 'include/template.php';
	
?>
<html>
<head>
</head>
<body bgcolor = "#FDE2B8">
</body>
</html>                                    