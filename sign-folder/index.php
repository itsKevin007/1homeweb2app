<?php


	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';


		switch ($view) {

			default :
				header('Location: ../sign-up.php');
				break;

		}
		



?>
