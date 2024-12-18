<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

$self = WEB_ROOT . 'index.php';

function word_split($str, $words = 15)
{
	$arr = preg_split("/[\s]+/", $str, $words + 1);
	$arr = array_slice($arr, 0, $words);
	return join(' ', $arr);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_ROOT; ?>assets/images/icons/onehome.png">
	<title>One Home</title>
	<!-- <title>BrookWood</title> -->


	<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/global-css.php'); ?>
	<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/misc-js.php'); ?>
</head>

<body>
	<div class="site_content">
		<!-- Preloader Start -->
		<div class="loader-mask">
			<div class="loader">
				<div></div>
				<div></div>
			</div>
		</div>

		<!-- header -->
		<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/header.php'); ?>
		<!-- /header -->
		<!-- Content -->
		<?php require_once $content; ?>
		<!-- /Content -->

		<!-- footer -->
		<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/footer.php'); ?>
		<!--/footer-->
	</div>
	<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $sett_data['directory'] . '/include/global-js.php'); ?>
</body>

</html>