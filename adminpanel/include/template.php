<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

$self = WEB_ROOT . 'adminpanel/login.php';

	function word_split($str,$words=15) {
		$arr = preg_split("/[\s]+/", $str,$words+1);
		$arr = array_slice($arr,0,$words);
		return join(' ',$arr);
	}		
		
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-css.php'); ?>
		
		<title>One Home</title>
    </head>
	<body class="bg-theme bg-theme9">
		<!--wrapper-->
		<div class="wrapper">
			<!--sidebar wrapper -->
			<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/left-menu.php'); ?>
			<!--start header -->
			<header>
			<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/header.php'); ?>
			</header>
			<!--end header -->
			<!--start page wrapper -->
			<div class="page-wrapper">
				<div class="page-content">
					<?php require_once $content; ?>
				</div>
			</div>
			<!--end page wrapper -->
			<!--start overlay-->
			<div class="overlay toggle-icon"></div>
			<!--end overlay-->
			<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
			<!--End Back To Top Button-->
			<footer class="page-footer">
			<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/footer.php'); ?>
			</footer>
		</div>
		<!--end wrapper-->
		<!--start switcher-->
		<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/right-menu.php'); ?>
		<!--end switcher-->
		<?php include ($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['admin_dir'] . '/include/global-js.php'); ?>
    </body>

</html>