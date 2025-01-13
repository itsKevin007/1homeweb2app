<?php

	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}

	if (isset($_POST['plan'])) {
		$plan = $_POST['plan'];

		if($plan == 0){
			$planP = 'Basic';
		}else if($plan == 1){
			$planP = '<span style="color: #bf953f;">Premium</span>';
		}

	} else {
		$planP = '';
	}

?>

<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/card-subscribe.css">

<section id="sign-up-screen">
			<div class="container text-center card-width">
				<div class="sign-in-screen_full">
					<div class="sign-in-screen-top">
						<div class="sign-in-screen_full">
							
							<span class="card__title"><?php echo $planP; ?> Subscription</span>
								<p class="card__content">Please fill up your payment details.
								</p>
								<form action="process.php?action=reg" method="post"  enctype="multipart/form-data">
									<div class="card__form"><br>
										
											<div>
												<label style="float: left;"><h6>Referrence No.:</h6></label>
												<input placeholder="Reference Number:" name="refNo" type="text" required>
												<input type="file" class="form-control" name="fileImage" id="formFile" required>
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
