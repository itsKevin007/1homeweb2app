<?php
if (!defined('WEB_ROOT')) {
	header('Location: index.php');
	exit;
}
    $sql = $conn->prepare("SELECT * FROM bs_page");
    $sql->execute();
    $sql_data = $sql->fetch();

    $page = $sql_data['page'];

	if ($user_data['thumbnail']) {
		$user_img = WEB_ROOT . 'assets/images/employee/' . $user_data['thumbnail'];
	} else {
		$user_img = WEB_ROOT . 'assets/images/user/noimage.png';
	}

?>	