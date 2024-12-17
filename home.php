<?php

	if($userId != ''){
		
		if($accesslevel == 0 ){
			include 'client/dashboard/dashboard.php';
		}elseif ($accesslevel == 1 ){
			include 'service-provider/dashboard.php';
		}else{}

	}else{}