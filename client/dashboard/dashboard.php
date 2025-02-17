<link href="<?php echo WEB_ROOT; ?>assets/css/flipped.css" rel="stylesheet">
<link href="<?php echo WEB_ROOT; ?>style/flipped.css" rel="stylesheet">


<?php
// // -------------------------------------------------- PHP for services ----------------------------------------------- //
// $services = $conn->prepare("SELECT * FROM ind_maincat WHERE sercatid = :sercatId");
// $services->bindParam(':sercatId', $sercatId, PDO::PARAM_INT);
// $services->execute();
// $services_data = $services->fetch();
// if (isset($services_data['sercatid'])) {
// 	$sercatId = $services_data['sercatid'];
// 	$mainCategory = $services_data['main_cat'];
// 	$description = $services_data['descript'];
// 	$thumbnail = $services_data['thumbnail'];
// 	$image = $services_data['image'];
// } else {
// 	$sercatId = null;
// 	$mainCategory = null;
// 	$description = null;
// 	$thumbnail = null;
// 	$image = null;
// }
// // -------------------------------------------------- end of services ----------------------------------------------- //
include('phpqrcode/qrlib.php');

$user_uid = $user_data['uid'];
$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['c_fname'];
$accnum = $client_data['accnum'];

$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE userId = :userId");
$bal->bindParam(':userId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();
if ($bal->rowCount() > 0) {
	$balance = $bal_data['balance'];
} else {
	$balance = "0.00";
}


//------------------------------ for searching services ---------------------------------//
// Prepare the query to fetch all rows where sercatid is not archived or deleted
// $services = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted = 0 AND is_archive = 0");
// $services->execute();

// // Check if there are any results
// $services_data = [];
// if ($services->rowCount() > 0) {
// 	$services_data = $services->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
// }
?>

<script src="<?php echo WEB_ROOT; ?>libraries/html5-qrscanner.js"></script>

<section id="homepage1-sec">


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
				<a href="<?php echo WEB_ROOT; ?>client/dashboard/top-up/"><button style="height: 40px;">Cash In</button></a>
				<img data-bs-toggle="modal" data-bs-target="#paymentModal" src="<?php echo WEB_ROOT; ?>assets/images/homepage/qrScanner.png" alt="qr-code" style="width: 30px; height: 30px; color: #c9c9d2; margin-top:10px;" />
				<a href="<?php echo WEB_ROOT; ?>client/dashboard/fill-up/">
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
	<!-- serach input -->
	<style>
		.suggestions {
			position: absolute;
			top: 100%;
			left: 0;
			width: 100%;
			background: white;
			border: 1px solid #ccc;
			border-top: none;
			border-radius: 0 0 5px 5px;
			display: none;
		}

		.suggestions div {
			padding: 10px;
			cursor: pointer;
		}

		.suggestions div:hover {
			background: #f0f0f0;
		}

		input:focus+.suggestions {
			display: block;
		}
	</style>

	<div class="container">
		<div class="serachbar-homepage2 mt-24" style="margin-bottom: 20px;">
			<div class="input-group search-page-searchbar">
				<span class="input-group-text search-iconn">
					<!-- SVG Icon here -->
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z" fill="#7D8FAB"></path>
					</svg>
				</span>
				<input type="text" placeholder="Need to fix something?" class="form-control search-text" id="search-input" style="border-top-right-radius:10px; border-bottom-right-radius:10px;">
				<div class="suggestions">
					<?php
					// Query main categories
					$sql = "SELECT * FROM ind_maincat WHERE is_deleted = 0 AND is_archive = 0";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$main_id = $row['sercatid'];
						$main_name = $row['main_cat'];
					?>
						<!-- Each suggestion now carries data attributes for ID and Name -->
						<div>
							<?php echo $main_name; ?>
						</div>
					<?php } ?>
				</div>
			</div>
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
				<div id="reader"></div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		let qrCodeDetected = false;
		let html5QrCode = null;

		// Start video stream and scanning using html5-qrcode
		function startVideo() {
			qrCodeDetected = false;
			// "reader" is the container element where the scanner UI will be rendered
			html5QrCode = new Html5Qrcode("reader");

			const config = {
				fps: 10,
				qrbox: {
					width: 250,
					height: 250
				},
			};

			html5QrCode
				.start({
					facingMode: "environment"
				}, config, qrCodeSuccessCallback)
				.catch((error) => {
					console.error("Error starting html5QrCode:", error);
				});
		}

		// Stop video stream and scanning
		function stopVideo() {
			if (html5QrCode) {
				html5QrCode
					.stop()
					.then(() => {
						html5QrCode.clear();
					})
					.catch((error) => {
						console.error("Error stopping html5QrCode:", error);
					});
			}
		}

		// Callback function when a QR code is successfully scanned
		function qrCodeSuccessCallback(decodedText, decodedResult) {
			if (!qrCodeDetected) {
				qrCodeDetected = true;
				const decodedQR = decodedText; // Decoded QR code data
				if (decodedQR) {
					sendQRCode(decodedQR);

					// Stop the video stream
					stopVideo();

					// Trigger the close button's click event to close the modal
					const closeButton = document.querySelector(
						"#paymentModal .btn-close"
					);
					if (closeButton) {
						closeButton.click();
					}
				}
			}
		}

		// Send the QR code data to the server or process it
		function sendQRCode(decodedQR) {
			fetch("<?php echo WEB_ROOT; ?>client/dashboard/scanned.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
					},
					body: JSON.stringify({
						qrCode: decodedQR
					}),
				})
				.then((response) => {
					if (!response.ok) {
						throw new Error("Failed to send QR code to the server.");
					}
					return response.json();
				})
				.then((data) => {
					if (data.success) {
						console.log("QR Code processed successfully:", data.message);
						if (data.redirect) {
							window.location.href = data.redirect; // Redirect if necessary
						}
					} else {
						console.error("Server error:", data.message);
						alert(data.message);
					}
				})
				.catch((error) => {
					console.error("Error:", error.message);
					alert("An error occurred. Please try again.");
				});
		}

		// Event listeners for modal open and close
		const paymentModal = document.getElementById("paymentModal");
		paymentModal.addEventListener("shown.bs.modal", () => {
			startVideo(); // Start the scanner when the modal is shown
		});

		paymentModal.addEventListener("hidden.bs.modal", () => {
			stopVideo(); // Stop the scanner when the modal is hidden
		});
	});
</script>

<script src="<?php echo WEB_ROOT; ?>script/filter.js"></script>