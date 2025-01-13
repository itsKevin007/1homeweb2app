<?php
	if (isset($_POST['subscribe'])) {
		?>
			<script>
				document.addEventListener('DOMContentLoaded', () => {
					Swal.fire({
					title: 'Success!',
					text: 'Thank you for your payment! It will be validated within 24-48 hours. You\'ll receive a confirmation once the process is complete.',
					icon: 'success', // Options: 'success', 'error', 'warning', 'info', 'question'
					showConfirmButton: true,
					confirmButtonText: 'Confirm',
					timer: 10000, // Auto-dismiss after 5 seconds
					timerProgressBar: true,
					backdrop: 'rgba(0, 0, 0, 0.8)', // Dark semi-transparent backdrop
					background: '#1e1e1e', // Dark background color
					color: '#ffffff', // White text color
					customClass: {
						popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
						confirmButton: 'swal2-confirm-dark' // Custom style for the button
					}
					});
				});
			</script>
		<?php

	}

	$pg = $conn->prepare("UPDATE bs_page SET page = 'Dashboard' WHERE is_deleted != '1'");
	$pg->execute();
	
	if ($userId != '') {
		$access_level = $user_data['access_level'];
		if ($access_level == 0) {
			include 'client/dashboard/dashboard.php';
	} elseif ($accesslevel == 1) {
			include 'service-provider/dashboard.php';
		} 
	}elseif ($accesslevel == 2) {
			include 'company/dashboard.php';
	}else{}

	if($user_data['is_sub'] == 0){
		include 'pop-up/subscription/subscribe-offcanvas.php';
	}else{}
	
	
?>