<?php

	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}

	if (isset($_POST['feed'])) {
		?>
			<script>
				document.addEventListener('DOMContentLoaded', () => {
					Swal.fire({
					title: 'Success!',
					text: 'Thank you for your feedback! We will check this and take appropriate action. Thank you for using our service.',
					icon: 'success', // Options: 'success', 'error', 'warning', 'info', 'question'
					showConfirmButton: true,
					confirmButtonText: 'Confirm',
					timer: 10000, // Auto-dismiss after 5 seconds
					timerProgressBar: true,
					backdrop: 'rgba(255, 255, 255, 0.8)', // Light semi-transparent backdrop
					background: '#1e1e1e', // Dark background color
					color: '#ffffff', // White text color
					customClass: {
						popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
						confirmButton: 'swal2-confirm-dark', // Custom style for the button
						container: 'swal2-container-bg' // Custom style for the container
					},
					style: {
						'.swal2-container-bg': {
							backgroundColor: '#022c5c'
						}
					}
					});
				});
			</script>
		<?php

	}
?>


<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/card-subscribe.css">

<section id="sign-up-screen">
			<div class="container text-center card-width">
				<div class="sign-in-screen_full">
					<div class="sign-in-screen-top">
						<div class="sign-in-screen_full">
							<br><br>
							<span class="card__title"> Feedback</span>
								<p class="card__content">Kindly share your feedback with us.
								</p>
								<form action="process.php?action=feed" method="post"  enctype="multipart/form-data">
									<div class="card__form"><br>
										
											<div>
												<textarea type="text" rows="2" class="form-control" name="feedBack" placeholder="We value your input!" autocomplete="off" required></textarea>
												<input type="hidden" name="plan" value="<?php echo $plan; ?>">
											</div>
											<br>
											
											<button class="sign-up" onClick="return confirmSubmit()"> Submit</button>
										
									</div>
								</form>								
						</div>
					</div>
				</div>
			</div>
		</section>

		
		

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script><script  src="<?php echo WEB_ROOT; ?>assets/js-sub/script.js"></script>
