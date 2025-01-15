<?php

if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

if (isset($_POST['plan'])) {
	$plan = $_POST['plan'];

	if ($plan == 0) {
		$planP = 'Basic';
	} else if ($plan == 1) {
		$planP = '<span style="color: #bf953f;">Premium</span>';
	}
} else {
	$planP = '';
}



// Fetch balance data
$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE userId = :userId");
$bal->bindParam(':userId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();

if ($bal_data) {
	$balance = $bal_data['balance'];
} else {
	$balance = "0.00";
}

?>

<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/card-subscribe.css">
<section id="sign-up-screen">
	<div class="container text-center card-width">
		<div class="sign-in-screen_full">
			<div class="flex flex-row justify-between items-center">
				<div style="float: left;">
					<span>Balance: ₱<?php echo $balance; ?></span>
				</div>
				<div style="float: right;">
					<span>Balance after: ₱ <span id="balanceAfter"></span></span>
				</div>
			</div>
			<br>
			<hr>
			<div class="sign-in-screen-top">
				<div class="sign-in-screen_full">
					<span class="card__title">Payment</span>
					<p class="card__content">Please fill up your payment details.</p>
					<form action="process.php?action=pay" method="post" enctype="multipart/form-data">
						<div class="card__form"><br>
							<div>
								<label style="float: left;">
									<h6>Referrence No.:</h6>
								</label>
								<input placeholder="Reference Number" name="referenceNo" type="text" required>
								<label style="float: left; margin-top: 5px;">
									<h6>Amount Due:</h6>
								</label>
								<input placeholder="Amount Due" name="transPay" type="text" required id="amountDue">
								<input type="file" class="form-control" name="fileImage" id="formFile" required>
							</div>
							<br>
							<button type="submit" class="sign-up" onClick="return confirmSubmit()">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	document.getElementById('amountDue').addEventListener('input', function() {
		var amountDue = parseFloat(this.value) || 0;
		var balance = <?php echo $balance; ?>;
		var balanceAfter = balance - amountDue;
		document.getElementById('balanceAfter').textContent = balanceAfter.toFixed(2);

		if (amountDue > balance) {
			swal({
				title: "Insufficient Balance",
				text: "You don't have enough balance.",
				icon: "error",
				buttons: false,
				timer: 2000
			}).then(function() {
				document.getElementById('amountDue').value = "";
				document.getElementById('balanceAfter').textContent = "";
			});
		}
	});
</script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="<?php echo WEB_ROOT; ?>assets/js-sub/script.js"></script>