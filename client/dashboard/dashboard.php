<link href="<?php echo WEB_ROOT; ?>assets/css/flipped.css" rel="stylesheet">
<link href="<?php echo WEB_ROOT; ?>style/flipped.css" rel="stylesheet">
<link href="<?php echo WEB_ROOT; ?>style/searchSuggestions.css" rel="stylesheet">
<!-- for wizard modal for booking -->
<style>
	.wizard-container {
		margin-top: 50px;
	}

	.wizard-step {
		padding: 20px;
		border-radius: 5px;
		display: none;
	}

	.wizard-step.active {
		display: block;
	}

	.step-indicator {
		display: flex;
		justify-content: space-between;
		margin-bottom: 30px;
		position: relative;
	}

	.step-indicator::before {
		content: '';
		position: absolute;
		top: 24px;
		left: 0;
		width: 100%;
		height: 3px;
		background-color: #e0e0e0;
		z-index: 0;
	}

	.step {
		text-align: center;
		z-index: 1;
		position: relative;
		width: 33.333%;
	}

	.step-circle {
		width: 50px;
		height: 50px;
		border-radius: 50%;
		background-color: #e0e0e0;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 10px;
		font-weight: bold;
		color: #fff;
		transition: background-color 0.3s;
		position: relative;
		z-index: 2;
	}

	/* Line between steps */
	.step-line {
		position: absolute;
		height: 3px;
		top: 24px;
		width: 100%;
		left: -50%;
		z-index: 1;
	}

	.step:first-child .step-line {
		display: none;
	}

	.step.active .step-line,
	.step.completed .step-line {
		background-color: #022c5c;
	}

	.step.completed .step-line {
		background-color: #022c5c;
	}

	.step.completed .step-circle,
	.step.active .step-circle {
		background-color: #022c5c;
	}

	.step.completed .step-circle {
		background-color: #022c5c;
	}

	.navigation-buttons {
		margin-top: 20px;
		display: flex;
		justify-content: space-between;
	}
</style>
<!-- end -->
<?php
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

	<div class="container">
		<div class="serachbar-homepage2 mt-24" style="margin-bottom: 20px;">
			<div class="search-container" style="width: 100%;">
				<div class="search-input-wrapper">
					<i class="fas fa-search search-icon"></i>
					<input type="text" placeholder="Need to fix something?" id="searchInput">
					<i class="fas fa-times clear-icon" id="clearSearch"></i>
				</div>
				<div class="suggestions-dropdown" id="suggestionsDropdown"></div>
			</div>
			<!-- Modal -->
			<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2 id="modalTitle"></h2>
					<!-- Step Indicators with Lines -->
					<div class="step-indicator">
						<div class="step active" id="step-indicator-1">
							<div class="step-line"></div>
							<div class="step-circle">1</div>
							<p>Personal Information</p>
						</div>
						<div class="step" id="step-indicator-2">
							<div class="step-line"></div>
							<div class="step-circle">2</div>
							<p>Booking Date</p>
						</div>
						<div class="step" id="step-indicator-3">
							<div class="step-line"></div>
							<div class="step-circle">3</div>
							<p>Review</p>
						</div>
					</div>

					<!-- Step 1 Content -->
					<div id="step1" class="wizard-step active">
						<div class="mb-3">
							<label>Select Address</label>
							<select class="form-select" aria-label="Default select example" required>
								<option value="" selected disabled style="width: 90%;" id="address">Select Location</option>
								<?php
								$sql = "SELECT * FROM tbl_location WHERE user_id = :user_id";
								$stmt = $conn->prepare($sql);
								$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
								$stmt->execute();
								$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
								foreach ($locations as $location) {
									echo "<option value=\"{$location['name']}\">{$location['name']}</option>";
								}
								?>
							</select>
						</div>
						<div class="mb-3">
							<label for="contactNumber" class="form-label">Contact Number</label>
							<input type="text" id="contactNumber" placeholder="Optional" class="form-control">
						</div>
						<div class="mb-3">
							<label for="roomNumber" class="form-label">Room Number</label>
							<input type="text" id="roomNumber" class="form-control" placeholder="Optional">
						</div>
					</div>

					<!-- Step 2 Content -->
					<div id="step2" class="wizard-step">

						<div class="mb-3">
							<label for="dateTime" class="form-label">Date and Time</label>
							<input type="date" id="dateTime" class="form-control" placeholder="Enter the date and time">
						</div>
					</div>

					<!-- Step 3 Content -->
					<div id="step3" class="wizard-step">
						<p>Please review your information before submitting:</p>
						<div class="alert alert-info">
							<form action="<?php echo WEB_ROOT; ?>client/dashboard/process.php?action=addBooking" method="POST" id="summaryInfo" class="mt-3">
								<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="hidden" name="requested_service" value="<?php echo isset($subCategor) ? htmlspecialchars($subCategor) : ''; ?>">
								<div class="mb-3">
									<label for="summaryAddress" class="form-label"><strong>Address:</strong></label>
									<input type="text" name="booking_address" id="summaryAddress" class="form-control" readonly>
								</div>
								<div class="mb-3">
									<label for="summaryContact" class="form-label"><strong>Contact Number:</strong></label>
									<input type="text" name="contact_num" id="summaryContact" class="form-control" readonly>
								</div>
								<div class="mb-3">
									<label for="summaryRoomNumber" class="form-label"><strong>Room Number:</strong></label>
									<input type="text" name="roomNo" id="summaryRoomNumber" class="form-control" readonly>
								</div>
								<div class="mb-3">
									<label for="summaryDateTime" class="form-label"><strong>Date and Time:</strong></label>
									<input type="text" name="created_at" id="summaryDateTime" class="form-control" readonly>
								</div>
							</form>
						</div>
						<div class="form-check mt-3">
							<input class="form-check-input" type="checkbox" id="termsCheck">
							<label class="form-check-label" for="termsCheck">
								I confirm all information is correct
							</label>
						</div>
					</div>

					<!-- Navigation Buttons -->
					<div class="navigation-buttons">
						<button id="prevBtn" class="btn btn-secondary" disabled>Previous</button>
						<button id="nextBtn" class="btn btn-primary" style="background-color: #022c5c; border-color: #022c5c;">Next</button>
						<button id="submitBtn" class="btn btn-success" onclick="document.getElementById('summaryInfo').submit()" style="display: none; background-color: #022c5c; border-color: #022c5c;">Submit</button>
					</div>

					<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							const steps = document.querySelectorAll('.wizard-step');
							const stepIndicators = document.querySelectorAll('.step');
							const stepLines = document.querySelectorAll('.step-line');
							const prevBtn = document.getElementById('prevBtn');
							const nextBtn = document.getElementById('nextBtn');
							const submitBtn = document.getElementById('submitBtn');

							let currentStep = 0;

							// Update UI based on current step
							function updateUI() {
								steps.forEach((step, index) => {
									step.classList.remove('active');
									stepIndicators[index].classList.remove('active', 'completed');

									if (index < currentStep) {
										stepIndicators[index].classList.add('completed');
									} else if (index === currentStep) {
										step.classList.add('active');
										stepIndicators[index].classList.add('active');
									}
								});

								// Update button states
								prevBtn.disabled = currentStep === 0;

								if (currentStep === steps.length - 1) {
									nextBtn.style.display = 'none';
									submitBtn.style.display = 'block';

									// Update summary information for review
									updateSummary();
								} else {
									nextBtn.style.display = 'block';
									submitBtn.style.display = 'none';
								}
							}

							function updateSummary() {
								// For the address, get the selected option text
								const addressSelect = document.querySelector('.form-select');
								const selectedAddress = addressSelect.options[addressSelect.selectedIndex]?.text || '-';

								// Set values to input fields (not textContent)
								document.getElementById('summaryAddress').value = selectedAddress;
								document.getElementById('summaryContact').value =
									document.getElementById('contactNumber').value || '-';
								document.getElementById('summaryRoomNumber').value =
									document.getElementById('roomNumber').value || '-';
								document.getElementById('summaryDateTime').value =
									document.getElementById('dateTime').value || '-';
							}

							// Next button handler
							nextBtn.addEventListener('click', function() {
								if (currentStep < steps.length - 1) {
									currentStep++;
									updateUI();
								}
							});

							// Previous button handler
							prevBtn.addEventListener('click', function() {
								if (currentStep > 0) {
									currentStep--;
									updateUI();
								}
							});

							// Submit button handler
							submitBtn.addEventListener('click', function() {
								if (document.getElementById('termsCheck').checked) {
									alert('Registration submitted successfully!');
									// Here you would typically send the data to your server
								} else {
									alert('Please confirm your information is correct');
								}
							});
						});
					</script>
				</div>
			</div>

			<script>
				const searchInput = document.getElementById('searchInput');
				const clearSearch = document.getElementById('clearSearch');
				const suggestionsDropdown = document.getElementById('suggestionsDropdown');
				const modal = document.getElementById('myModal');
				const closeBtn = document.getElementsByClassName('close')[0];

				// Clear search input
				clearSearch.addEventListener('click', () => {
					searchInput.value = '';
					suggestionsDropdown.innerHTML = '';
					suggestionsDropdown.classList.remove('show');
					clearSearch.style.display = 'none';
				});

				// Handle input and focus events
				searchInput.addEventListener('input', debounce(handleSearch, 300));
				searchInput.addEventListener('focus', handleSearch);

				async function handleSearch(e) {
					const searchTerm = searchInput.value.trim();

					// Show/hide clear button
					if (searchTerm) {
						clearSearch.style.display = 'block';
					} else {
						clearSearch.style.display = 'none';
					}

					try {
						// Replace with your actual API endpoint
						const response = await fetch(`<?php echo WEB_ROOT ?>client/dashboard/get_suggestions.php?search=${encodeURIComponent(searchTerm)}`);
						const suggestions = await response.json();

						suggestionsDropdown.innerHTML = '';

						if (suggestions.length > 0) {
							suggestions.forEach(item => {
								const div = document.createElement('div');
								div.className = 'suggestion-item';
								div.innerHTML = `<strong>${highlightMatch(item.sub_categor, searchTerm)}</strong>`;
								div.onclick = () => showModal(item);
								suggestionsDropdown.appendChild(div);
							});
							suggestionsDropdown.classList.add('show');
						} else if (searchTerm) {
							// Show "no results" message
							const noResults = document.createElement('div');
							noResults.className = 'no-results';
							noResults.innerHTML = `No results found for "<strong>${searchTerm}</strong>"`;
							suggestionsDropdown.appendChild(noResults);
							suggestionsDropdown.classList.add('show');
						} else {
							suggestionsDropdown.classList.remove('show');
						}
					} catch (error) {
						console.error('Error fetching suggestions:', error);
						suggestionsDropdown.classList.remove('show');
					}
				}

				// Highlight matching text
				function highlightMatch(text, query) {
					if (!query) return text;

					const regex = new RegExp(query.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'gi');
					return text.replace(regex, match => `<span style="color: var(--primary-color);">${match}</span>`);
				}

				// Debounce function to limit API calls
				function debounce(func, wait) {
					let timeout;
					return function(...args) {
						clearTimeout(timeout);
						timeout = setTimeout(() => func.apply(this, args), wait);
					};
				}

				// Show modal with animation
				function showModal(item) {
					const subCategor = item.sub_categor;
					document.getElementById('modalTitle').textContent = subCategor;
					const requestedServiceInput = document.querySelector('input[name="requested_service"]');
					if (requestedServiceInput) {
						requestedServiceInput.value = subCategor;
					}
					modal.style.display = 'block';
					setTimeout(() => modal.classList.add('show'), 10);
					suggestionsDropdown.classList.remove('show');
				}

				// Close modal with animation
				function closeModal() {
					modal.classList.remove('show');
					setTimeout(() => modal.style.display = 'none', 300);
				}

				// Close handlers
				closeBtn.onclick = closeModal;
				window.onclick = function(event) {
					if (event.target == modal) closeModal();
					if (event.target != searchInput &&
						!suggestionsDropdown.contains(event.target) &&
						event.target != clearSearch) {
						suggestionsDropdown.classList.remove('show');
					}
				}

				// Add focus animation
				searchInput.addEventListener('focus', () => {
					document.querySelector('.search-input-wrapper').style.boxShadow = '0 0 0 3px rgba(67, 97, 238, 0.3), var(--shadow)';
				});

				searchInput.addEventListener('blur', () => {
					document.querySelector('.search-input-wrapper').style.boxShadow = 'var(--shadow)';
				});
			</script>
		</div>
	</div>


</section>
<!--Homepage1 Section End -->

<!-- QR Scanner Modal -->
<div class="modal fade" id="paymentModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="staticBackdropLabel" style="z-index: 1501;">
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