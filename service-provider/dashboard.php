<!-- <link href="<?php echo WEB_ROOT; ?>assets/css/flipped.css" rel="stylesheet"> -->
<link href="<?php echo WEB_ROOT; ?>style/flipped.css" rel="stylesheet">
<!-- ----------------------------------------------------- for service request css---------------------------------------------------------------- -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/reqServ.css">

<!-- for tabs request and approved -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/twoTabs.css">



<?php
// -------------------------------------------------- PHP for services ----------------------------------------------- //
$services = $conn->prepare("SELECT * FROM ind_maincat WHERE sercatid = :sercatId");
$services->bindParam(':sercatId', $sercatId, PDO::PARAM_INT);
$services->execute();
$services_data = $services->fetch();
if (isset($services_data['sercatid'])) {
	$sercatId = $services_data['sercatid'];
	$mainCategory = $services_data['main_cat'];
	$description = $services_data['descript'];
	$thumbnail = $services_data['thumbnail'];
	$image = $services_data['image'];
} else {
	$sercatId = null;
	$mainCategory = null;
	$description = null;
	$thumbnail = null;
	$image = null;
}
// -------------------------------------------------- end of services ----------------------------------------------- //

include('phpqrcode/qrlib.php');

$user_uid = $user_data['uid'];
$client = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['firstname'];
$id = $client_data['user_id'];

$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE bal_id = :balId");
$bal->bindParam(':balId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();
if ($bal->rowCount() > 0) {
	$balance = $bal_data['balance'];
} else {
	$balance = "0.00";
}

//---------------------------------------------------------------- for notifications ----------------------------------------------------//
// $bookings = $conn->prepare("SELECT * FROM tbl_bookings WHERE booking_status = 0");
// $bookings->execute();
// $bookings_data = $bookings->fetchAll(PDO::FETCH_ASSOC);

// // Fetch only accepted bookings (for the Approved tab)
// $approvedBookings = $conn->prepare("SELECT * FROM tbl_bookings WHERE booking_status = 1");
// $approvedBookings->execute();
// $approvedBookingsData = $approvedBookings->fetchAll(PDO::FETCH_ASSOC);

// Fetch all pending bookings (for the Service Requests tab)

// Fetch all pending bookings (for the Service Requests tab)
$bookings = $conn->prepare("SELECT * FROM tbl_bookings WHERE booking_status = 0 OR booking_status IS NULL");
$bookings->execute();
$bookings_data = $bookings->fetchAll(PDO::FETCH_ASSOC);

// Fetch only accepted bookings (for the Approved tab)
$approvedBookings = $conn->prepare("SELECT * FROM tbl_bookings WHERE booking_status = 1");
$approvedBookings->execute();
$approvedBookingsData = $approvedBookings->fetchAll(PDO::FETCH_ASSOC);
// ------------------------------------ end -----------------------------------------------------//

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

		<!-- --------------------------------------------------------------------- for notif ------------------------------------------------ -->


		<div class="tabs">
			<!-- Service Requests Tab -->
			<div class="tab-2">
				<label for="tab2-1">
					<h6>Requests</h6>
				</label>
				<input id="tab2-1" name="tabs-two" type="radio" checked="checked">
				<div>
					<?php
					foreach ($bookings_data as $booking) {
						$requestedService = htmlspecialchars($booking['requested_service']);
						$bookingAddress = htmlspecialchars($booking['booking_address']);
						$contactNumber = htmlspecialchars($booking['contact_num']);
						$bookingId = htmlspecialchars($booking['booking_id']);
						echo "
                <div class='rqCard flex-row p-2 justify-content-between' style='background: linear-gradient(90deg, rgba(10,0,176,1) 0%, rgba(59,68,223,1) 100%); width: 60%; margin: 10px 0; '>

					<div style='margin-left: 10px;'>
						<h4 style='color:white;'>$requestedService</h4>
						<h5 style='color: #fff;'><span style='color:white;'>Contact Number:</span> $contactNumber</h5>
						<p style='color: #fff;'>$bookingAddress</p>
					</div>
					<div style='margin-right: 10px; margin-left: 10px;'>
					📍
					</div>
					<div style='text-align: center;'>
						<p class='read-more'>
							<button style='margin-bottom: 10px;' class='btn btn-primary'>Accept</button>
							<br>
							<button class='btn btn-danger'>Decline</button>
						</p>
					</div>
				</div>";
					}
					?>
				</div>
			</div>

			<!-- Approved Requests Tab -->
			<div class="tab-2">
				<label for="tab2-2">
					<h6>Approved</h6>
				</label>
				<input id="tab2-2" name="tabs-two" type="radio">
				<div id="pending-tasks">
					<?php
					foreach ($approvedBookingsData as $approved) {
						$requestedService = htmlspecialchars($approved['requested_service']);
						$bookingAddress = htmlspecialchars($approved['booking_address']);
						$contactNumber = htmlspecialchars($approved['contact_num']);
						echo "
                <div class='blog-card'>
                    <div class='meta'>
                        <div class='photo' style='background-image: url(\"" . htmlspecialchars(WEB_ROOT) . "assets/images/icons/hotel1.jpg\")'></div>
                    </div>
                    <div class='description'>
                        <h5>$requestedService</h5>
                        <h2><span style='color:black;'>Contact Number:</span> $contactNumber</h2>
                        <p>$bookingAddress</p>
                    </div>
                </div>";
					}
					?>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', () => {
				document.querySelectorAll('.btn-primary, .btn-danger').forEach(button => {
					button.addEventListener('click', function() {
						const bookingId = this.getAttribute('data-booking-id');
						const status = this.classList.contains('btn-primary') ? 1 : 2;

						fetch('<?php echo WEB_ROOT; ?>service-provider/update_booking_status.php', {
								method: 'POST',
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded'
								},
								body: `booking_id=${bookingId}&status=${status}`,
							})
							.then(response => response.json())
							.then(data => {
								if (data.success) {
									const card = this.closest('.blog-card');
									if (status === 1) {
										document.getElementById('pending-tasks').appendChild(card);
									} else if (status === 2) {
										card.remove();
									}
									alert(data.message);
								} else {
									alert('Error: ' + data.message);
								}
							})
							.catch(error => {
								console.error('Error:', error);
								alert('An error occurred. Please try again.');
							});
					});
				});
			});
		</script>
		<!-- end here -->




	</div>



	</div>


</section>
<!--Homepage1 Section End -->
<!-- insert here -->