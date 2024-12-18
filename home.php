<?php

if ($userId != '') {
	$access_level = $user_data['access_level'];
	if ($access_level == 0) {
		include 'client/dashboard/dashboard.php';
 } elseif ($accesslevel == 1) {
		include 'service-provider/dashboard.php';
	 } 
}else{}
?>