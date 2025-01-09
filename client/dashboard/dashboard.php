<link href="<?php echo WEB_ROOT; ?>assets/css/flipped.css" rel="stylesheet">
<link href="<?php echo WEB_ROOT; ?>style/flipped.css" rel="stylesheet">



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
$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['c_fname'];
$accnum = $client_data['accnum'];

$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE bal_id = :balId");
$bal->bindParam(':balId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();
if ($bal->rowCount() > 0) {
	$balance = $bal_data['balance'];
} else {
	$balance = "0.00";
}
?>

<section id="homepage1-sec">
	<div class="homepage-first-sec">

		<!-- wallet card -->
		<div class="wallet card" style="height: auto; width: 350px;">
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
								balance.textContent = '<?php echo $balance ?>';
								toggleEye.classList.remove('fa-eye-slash');
								toggleEye.classList.add('fa-eye');
							} else {
								// Hide the balance as bullets
								balance.textContent = '●●●●●●●';
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
					<p class="account-number-details" style="color: #c9c9d2;"><?php echo $accnum; ?></p>
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
		<!-- Div to display QR code reader -->
		<div id="qr-reader" style="width: 70%; height:70%;"></div>
		<!-- Modal to display user info
		<div id="userModal">
			<p>User Information:</p>
			<div id="userInfo"></div>
			<button onclick="closeModal()">Close</button>
		</div> -->

		<!-- ------------------------------------------ filters ---------------------------------------------- -->


	</div>



	</div>

</section>
<!--Homepage1 Section End -->
						
<!-- QR Scanner Modal -->
<div class="modal fade" id="paymentModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="staticBackdropLabel">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content glass">
			<div class="modal-header bg-light">
				<h4 class="modal-title" id="staticBackdropLabel"><i class="mdi mdi-qrcode me-1"></i>QR Code Detected</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<video id="video" style="width: 100%; height: auto;"></video>
			</div>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
<script>
	let qrCodeDetected = false;
	let video = null;
	let stream = null;

	// Start video stream and scanning
	function startVideo() {
		video = document.getElementById('video');
		navigator.mediaDevices.getUserMedia({
				video: {
					facingMode: 'environment'
				}
			})
			.then(streamObj => {
				stream = streamObj; // Store the stream to stop later
				video.srcObject = stream;
				video.setAttribute('playsinline', true); // Required to avoid fullscreen on iOS
				video.play();
				qrCodeDetected = false; // Reset detection flag
				requestAnimationFrame(tick);
			})
			.catch(error => {
				console.error('Error accessing camera:', error);
			});
	}

	// Stop video stream and scanning
	function stopVideo() {
		if (video) {
			video.pause();
			video.srcObject = null;
		}
		if (stream) {
			stream.getTracks().forEach(track => track.stop()); // Stop all tracks
		}
	}

	// QR scanning logic
	function tick() {
		if (video.readyState === video.HAVE_ENOUGH_DATA) {
			const canvas = document.createElement('canvas');
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			const ctx = canvas.getContext('2d');
			ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
			const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
			const code = jsQR(imageData.data, imageData.width, imageData.height, {
				inversionAttempts: 'dontInvert',
			});

			if (code && !qrCodeDetected) {
				qrCodeDetected = true;
				const decodedQR = code.data; // Decoded QR code data
				if (decodedQR) {
					sendQRCode(decodedQR);

					// Stop the video stream
					stopVideo();

					// Trigger the close button's click event
					const closeButton = document.querySelector('#paymentModal .btn-close');
					if (closeButton) {
						closeButton.click(); // Simulate a click to close the modal
					}
				}
			}
		}
		if (!qrCodeDetected) {
			requestAnimationFrame(tick); // Continue scanning
		}
	}

	// Send the QR code data to the server or process it
	function sendQRCode(decodedQR) {
		fetch('scanned.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					qrCode: decodedQR
				})
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Failed to send QR code to the server.');
				}
				return response.json();
			})
			.then(data => {
				if (data.success) {
					console.log('QR Code processed successfully:', data.message);
					if (data.redirect) {
						window.location.href = data.redirect; // Redirect to payment page
					}
				} else {
					console.error('Server error:', data.message);
					alert(data.message); // Notify the user about the error
				}
			})
			.catch(error => {
				console.error('Error:', error.message);
				alert('An error occurred. Please try again.');
			});
	}


	// Event listeners for modal open and close
	document.getElementById('paymentModal').addEventListener('shown.bs.modal', () => {
		startVideo(); // Start the scanner when modal is shown
	});

	document.getElementById('paymentModal').addEventListener('hidden.bs.modal', () => {
		stopVideo(); // Stop the scanner when modal is hidden
	});
</script>

<script src="<?php echo WEB_ROOT; ?>script/filter.js"></script>