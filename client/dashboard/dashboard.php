<?php

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
		<div class="wallet card" style="height: auto;">
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
					<img data-bs-toggle="modal" data-bs-target="#paymentModal" src="<?php echo WEB_ROOT; ?>assets/images/homepage/qr-code.png" alt="qr-code" style="width: 30px; height: 30px; color: #c9c9d2; margin-top:10px;" />
					<button style="height: 40px;">Pay</button>
				</div>
			</div>


			<div class="back">
				<div>
					<div class="content">
						<h3 class="cardTitle">ronald balbalero</h3>
					</div>
				</div>
			</div>

		</div>
		<!-- end of card -->
		<!-- services -->
		<section id=homepage2-sec class="container-fluid">
			<div class="container">
				<div class="serachbar-homepage2 mt-24">
					<div class="input-group ">
						<span class="input-group-text search-iconn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z" fill="#7D8FAB"></path>
							</svg>
						</span>
						<input type="text" placeholder="Search Products" class="form-control search-text">
					</div>
				</div>
			</div>
			<div class="homepage2-second-sec mt-24">
				<div class="container">
					<div class="product-details">
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/sofas.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Sofa</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/chairs.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Chairs</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/dining.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Dining</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/storage.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Storage</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/lighting.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Lighting</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/lamps.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Lamps</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/decor.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Decor</h3>
						</div>
						<div class="product-sec">
							<div class="product-img-sec">
								<img src="assets/images/homepage2/mirror.svg" alt="furniture-img">
							</div>
							<h3 class="proct-title-hp-2">Mirrors</h3>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Div to display QR code reader -->
		<div id="qr-reader" style="width: 70%; height:70%;"></div>


		<!-- Modal to display user info
		<div id="userModal">
			<p>User Information:</p>
			<div id="userInfo"></div>
			<button onclick="closeModal()">Close</button>
		</div> -->

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