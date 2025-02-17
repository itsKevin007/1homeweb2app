<link href="<?php echo WEB_ROOT; ?>style/flipped.css" rel="stylesheet">

<?php
// for QR code
include('phpqrcode/qrlib.php');

$user_uid = $user_data['uid'];
$client = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['firstname'];
$id = $client_data['user_id'];

// for balance
$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE bal_id = :balId");
$bal->bindParam(':balId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();
if ($bal->rowCount() > 0) {
	$balance = $bal_data['balance'];
} else {
	$balance = "0.00";
}

// $bookings = $conn->prepare("SELECT * FROM tbl_bookings");
// $bookings->execute();
// $bookings_data = $bookings->fetchAll(PDO::FETCH_ASSOC);

// Assuming $conn is your PDO connection

$bookings = $conn->prepare("SELECT b.* 
FROM tbl_bookings b
INNER JOIN bs_user u ON b.user_id = u.user_id
WHERE NOT (b.booking_status = 'accepted' AND u.access_level IN (1, 2))
");
$bookings->execute();
$bookings_data = $bookings->fetchAll(PDO::FETCH_ASSOC);
// Debugging output (optional)
// print_r($bookings_data);
?>

<section id="homepage1-sec" style="height: auto; background-color: #fff;">
	<div class="homepage-first-sec" style="height:auto; background-color: #fff;">
		<!-- wallet card -->
		<div class="wallet card " style="height: auto; width: 350px;">
			<div class="title-logo">
				<img src="<?php echo WEB_ROOT; ?>assets/images/icons/ohlogo1.png" alt="wallet-icon" style=" height: 60px;">
				<div class="wallet-title">
					<h5>My Wallet</h5>
					<div class="wallet-balance">
						<h3 id="balance">₱ <?php echo $balance ?></h3>
						<i id="toggle-eye" class="fa fa-eye" style="font-size:24px; cursor: pointer;"></i>
					</div>

					<script>
						// Get references to the elements
						const balance = document.getElementById('balance');
						const toggleEye = document.getElementById('toggle-eye');

						// Track the visibility state
						let isHidden = false;

						// Add a click event listener to the eye icon
						toggleEye.addEventListener('click', () => {
							if (isHidden) {
								// Show the balance
								balance.textContent = 'P <?php echo $balance ?>';
								toggleEye.classList.remove('fa-eye-slash');
								toggleEye.classList.add('fa-eye');
							} else {
								// Hide the balance as bullets
								balance.textContent = 'P ●●●●';
								toggleEye.classList.remove('fa-eye');
								toggleEye.classList.add('fa-eye-slash');
							}
							isHidden = !isHidden;
						});
					</script>
				</div>
			</div>
			<div>
				<div style="margin-top: -10;">
					<p class="account-number" style="font-size: 10px; color: #c9c9d2;">Account ID</p>
					<p class="account-number-details" style="color: #c9c9d2;"><?php echo $id; ?></p>
				</div>
				<div class="wallet-btn-sec">
					<button style="height: 40px;">Cash In</button>
					<img data-bs-toggle="modal" data-bs-target="#paymentModal" src="<?php echo WEB_ROOT; ?>assets/images/homepage/qrScanner.png" alt="qr-code" style="width: 30px; height: 30px; color: #c9c9d2; margin-top:10px;" />
					<a href="<?php echo WEB_ROOT; ?>client/dashboard/index.php?view=payment">
						<button style="height: 40px;">Pay</button>
					</a>
				</div>
			</div>
			<!-- back -->
			<div class="back" style="width: 94%; border-radius: 10px; ">
				<div>
					<div class="col-12">
						<?php
						$text = $user_uid;
						$tempDir = 'temp/'; // Directory to save QR code temporarily

						// Ensure temp directory exists
						if (!is_dir($tempDir)) {
							mkdir($tempDir, 0755, true);
						}

						// Generate QR code
						$fileName = 'qrcode_' . md5($text) . '.png';
						$filePath = $tempDir . $fileName;


						// Set error correction level and size
						$eccLevel = QR_ECLEVEL_L;
						$size = 5;

						// Generate QR code matrix
						$matrix = QRcode::text($text, false, $eccLevel);

						// Generate QR code image with custom colors
						$qrWidth = count($matrix);
						$imageSize = $size * $qrWidth;

						$image = imagecreate($imageSize, $imageSize);

						// Allocate colors
						$backgroundColor = imagecolorallocate($image, 2, 34, 170); // Linear gradient start color
						$foregroundColor = imagecolorallocate($image, 255, 255, 255); // White foreground

						// Draw the QR code
						for ($y = 0; $y < $qrWidth; $y++) {
							for ($x = 0; $x < $qrWidth; $x++) {
								$color = $matrix[$y][$x] ? $foregroundColor : $backgroundColor;
								imagefilledrectangle(
									$image,
									$x * $size,
									$y * $size,
									($x + 1) * $size - 1,
									($y + 1) * $size - 1,
									$color
								);
							}
						}

						// Save the QR code image
						imagepng($image, $filePath);

						// Clean up resources
						imagedestroy($image);
						?>
						<div class="container">
							<div style="text-align: center">
								<img src="<?php echo $filePath; ?>" alt="QR Code">
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- end of card -->

		<!-- display of request -->
		<?php foreach ($bookings_data as $booking): ?>
			<?php
			if ($booking['booking_status'] !== 'accepted') {
				$requestedService = htmlspecialchars($booking['requested_service']);
				$bookingAddress = htmlspecialchars($booking['booking_address']);
				$contactNumber = htmlspecialchars($booking['contact_num']);
				$bookingId = htmlspecialchars($booking['booking_id']);
				$userId = htmlspecialchars($booking['user_id']);
			?>
				<div class="row p-2 rounded mb-2" style="background: linear-gradient(90deg, rgba(10,0,176,1) 0%, rgba(59,68,223,1) 100%); width: 80%;">
					<div class="col-sm-8 row" style="margin-left: 2px;">
						<h5 style="color:white;"><?= $requestedService; ?></h5>
						<h6 style="color: #fff;">Contact Number: <?= $contactNumber; ?></h6>
						<p style="color: #fff;"><?= $bookingAddress; ?></p>
					</div>
					<div class="col-sm-4">
						<button
							style="float: right;"
							class="btn btn-primary acceptBtn"
							data-booking-id="<?= $bookingId; ?>"
							data-requested-service="<?= $requestedService; ?>"
							data-booking-address="<?= $bookingAddress; ?>"
							data-contact-num="<?= $contactNumber; ?>"
							data-user-id="<?= $userId; ?>">
							Accept
						</button>
					</div>
				</div>
			<?php } ?>
		<?php endforeach; ?>
		<!-- Accept Modal -->
		<div class="modal" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="acceptModalLabel">Confirm Service Acceptance</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#acceptModal').modal('hide');">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="company/process.php?action=accept" id="acceptForm">
							<input type="hidden" name="service_id" id="booking-id-hidden">
							<input type="hidden" name="client_id" id="client-id-hidden">
							<input type="hidden" name="accepted_by" id="accepted-by-hidden">
							<input type="hidden" name="aReqServ" id="requested-service-hidden">
							<input type="hidden" name="aAddress" id="booking-address-hidden">
							<input type="hidden" name="aContactNo" id="contact-num-hidden">
							<p>Are you sure you want to accept this service?</p>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Confirm</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>

		<script>
			document.querySelectorAll('.acceptBtn').forEach(button => {
				button.addEventListener('click', function() {
					const bookingId = this.getAttribute('data-booking-id');
					const requestedService = this.getAttribute('data-requested-service');
					const bookingAddress = this.getAttribute('data-booking-address');
					const contactNum = this.getAttribute('data-contact-num');
					const userId = this.getAttribute('data-user-id');

					// Populate modal fields
					document.getElementById('booking-id-hidden').value = bookingId;
					document.getElementById('requested-service-hidden').value = requestedService;
					document.getElementById('booking-address-hidden').value = bookingAddress;
					document.getElementById('contact-num-hidden').value = contactNum;
					document.getElementById('client-id-hidden').value = userId;

					// Show the modal
					$('#acceptModal').modal('show');
				});
			});
		</script>

	</div>
</section>