<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/services.css">

<?php
// Prepare the query to fetch all rows where sercatid is not archived or deleted
$services = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted = 0 AND is_archive = 0");
$services->execute();

// Check if there are any results
$services_data = [];
if ($services->rowCount() > 0) {
	$services_data = $services->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
}


// for subcat
// Prepare the query to fetch all rows where is_deleted is 0
$subcategories = $conn->prepare("SELECT * FROM ind_subcat WHERE is_deleted = 0");
$subcategories->execute();

// Fetch all results
$subcategories_data = [];
if ($subcategories->rowCount() > 0) {
	$subcategories_data = $subcategories->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
}
?>


<!-- all categories carousel -->
<div class="homepage-first-sec" style="background-color: #fff; width: 100%; height: 100%;">
	<!-- search input -->
	<div class="container mb-24">
		<div class="serachbar-homepage2 mt-24">
			<div class="input-group search-page-searchbar ">
				<span class="input-group-text search-iconn">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z" fill="#7D8FAB"></path>
					</svg>
				</span>
				<input type="text" placeholder="Search" class="form-control search-text" id="search-input">
			</div>
			<button class="close-btn d-none">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_1_3462" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
						<rect width="24" height="24" fill="white" />
					</mask>
					<g mask="url(#mask0_1_3462)">
						<path d="M17 7L7 17M7 7L17 17" stroke="#1E293B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</g>
				</svg>
			</button>
		</div>
	</div>
	<!-- end of search input -->

	<div class="container mt-24">
		<div class="tranding-item-sec">
			<div class="home-tranding-first">
				<h6 class="home-cate-title" style="font-size: 14px;">All Categories</h6>
			</div>
			<div class="home-tranding-second">
				<a href="index.php?view=all_services">
					<p class="see-all-txt"></p><span><svg width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 6L15 12L9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
						</svg></span></p>
				</a>
			</div>
		</div>
		<div class="offcial-partner-home2-featured mt-16">
			<?php
			// Loop through each service and generate a card
			foreach ($services_data as $service) {
				// Escape special characters for the main category
				$mainCat = htmlspecialchars($service['main_cat']);
				$serviceId = htmlspecialchars($service['sercatid']);

				echo '
				<div class="offcial-partner-home2 mt-8" data-name="' . $mainCat . '" style="height: auto; margin-bottom: 8px; padding-bottom: 8px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 3px 16px 0 rgba(0,0,0,0.19);">
					<a href="' . WEB_ROOT . 'client/services/index.php?view=viewsub&main_id=' . $serviceId . '" class="card-link">
						<div style=" height: 110px; padding-bottom: 8px; text-overflow: ellipsis; overflow: hidden;">
							<img src="' . WEB_ROOT . 'assets/images/serviceImg/carpentry.jpg" style="width: 100%; height:auto; border-top-left-radius: 8px; border-top-right-radius: 8px;" alt="furniture-img">
							<p class="offcial-title-home2" style="font-size: 12px; margin-left: 8px; text-overflow: ellipsis; overflow: hidden;">' . $mainCat . '</p>
						</div>
					</a>
				</div>

			';
			}
			?>

		</div>
		<!-- script for modal -->

		<!-- Modal for Subcategories -->
		<!-- Modal for Subcategories -->
		<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="subcategoryModalLabel">Subcategories</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Subcategory cards container -->
						<div id="subcategoryList" class="d-flex flex-wrap justify-content-start">
							<!-- Subcategory cards will be dynamically added here -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Add event listener for main category clicks
				document.querySelectorAll('.card-link').forEach(card => {
					card.addEventListener('click', function() {
						const serviceId = this.getAttribute('data-service-id'); // Get the main category ID

						// Fetch subcategories via AJAX
						fetch(`<?php echo WEB_ROOT; ?>client/services/getSubcategories.php?main_id=${serviceId}`)
							.then(response => response.json())
							.then(data => {
								const subcategoryList = document.getElementById('subcategoryList');
								subcategoryList.innerHTML = ''; // Clear previous entries

								// Populate the subcategories as cards
								if (data.length > 0) {
									data.forEach(subcat => {
										// Create a card for each subcategory
										const card = document.createElement('div');
										card.className = 'offcial-partner-home2';
										card.style = 'height: auto; padding-bottom: 8px; width: calc(33% - 10px); margin: 5px;';

										card.innerHTML = `
										
											<a href="javascript:void(0)" class="card-link" data-subcatid="${subcat.subcatid}">
												<div class="offcial-partner-home2">
													<div>
														<img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" style="width: 100%; height:auto; alt="subcategory-img">
														<p class="offcial-title-home2 text-center" style="font-size: 12px; font-style: bold ">${subcat.sub_category}</p>
													</div>
												</div>
											</a>

                                `;

										subcategoryList.appendChild(card);
									});
								} else {
									// If no subcategories are available, show a message
									const noSubcategoryMessage = document.createElement('p');
									noSubcategoryMessage.className = 'text-center text-muted';
									noSubcategoryMessage.textContent = 'No subcategories available.';
									subcategoryList.appendChild(noSubcategoryMessage);
								}
							})
							.catch(error => {
								console.error('Error fetching subcategories:', error);
							});
					});
				});
			});
		</script>

		<!-- script for modal -->

		<hr>
		<h6 class="home-cate-title" style="font-size: 14px;">All Services</h6>
		<div class="homepage2-second-sec mt-24" style="margin-bottom: 100px;">
			<div class="container" style="overflow: hidden;">
				<div class="product-details" style="margin-bottom: 10px;">

					<?php
					foreach ($subcategories_data as $subcategory) {
						$subCategory = htmlspecialchars($subcategory['sub_categor']);
						$description = htmlspecialchars($subcategory['description']);
						$subcatId = htmlspecialchars($subcategory['subcatid']);

						echo '
							<div class="official-partner-home2" data-name="' . $subCategory . '" style="height: auto; background-color: #fff; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 3px 16px 0 rgba(0,0,0,0.19); border-radius: 8px;">
								<a href="#" class="card-link"
									data-bs-toggle="modal" 
									data-bs-target="#dynamicModal"
									data-subcatid="' . $subcatId . '"
									data-title="' . $subCategory . '"
									data-description="' . $description . '">
									<div>
										<img src="' . WEB_ROOT . 'assets/images/serviceImg/carpentry.jpg" style="width: 100%; border-top-left-radius: 8px; border-top-right-radius: 8px;" alt="service-img">
										<p class="official-title-home2 mt-2 mb-2" style="margin-left: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
											' . (strlen($subCategory) > 10 ? substr($subCategory, 0, 10) . '...' : $subCategory) . '
										</p>
									</div>
								</a>
							</div>
						';
					}
					?>

				</div>
			</div>

			<!-- Single Dynamic Modal (Outside PHP Loop) -->
			<!-- Fullscreen Modal Structure -->
			<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/wizard.css">
			<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
			<!-- Single Dynamic Modal (Outside PHP Loop) -->
			<div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-fullscreen">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="dynamicModalLabel">Service Details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form method="POST" action="">
								<div class="container">
									<div id="app">
										<step-navigation :steps="steps" :currentstep="currentstep">
										</step-navigation>

										<div v-show="currentstep == 1">
											<select class="form-select" name="bookingAddress" aria-label="Default select example" required>
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
											<br>
											<div class="mb-3">
												<label for="contact" class="form-label">Contact Number</label>
												<input type="number" class="form-control" name="contactNum" id="contact" required>
											</div>
											<div class="mb-3">
												<label for="roomNo" class="form-label">Room Number</label>
												<input type="number" class="form-control" name="roomNo" id="roomNo">
											</div>
										</div>

										<div v-show="currentstep == 2">
											<div class="mb-3">
												<label for="date" class="form-label">Booking Date</label>
												<input type="date" class="form-control" name="created_at" id="date" required>
											</div>
											<div class="mb-3">
												<label for="photoUpload" class="form-label">Reference Photo</label>
												<input type="file" class="form-control" id="photoUpload" name="photo" accept="image/*" onchange="previewImage(event)">
											</div>

											<div class="mb-3">
												<label for="photoPreview" class="form-label"></label>
												<img id="photoPreview" class="img-fluid border" alt="Uploaded photo will appear here" style="display: none; max-height: 300px;">
											</div>

											<script>
												function previewImage(event) {
													const [file] = event.target.files;
													if (file) {
														const preview = document.getElementById('photoPreview');
														preview.src = URL.createObjectURL(file);
														preview.style.display = 'block';
													}
												}
											</script>
										</div>

										<div v-show="currentstep == 3">

											<form action="process.php?action=addBooking" method="POST">
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
												<div class="mb-3">
													<h6 class="service-title"></h6>
													<p class="service-description"></p>

												</div>
												<div class="mb-3">
													<label for="modalAddress" class="form-label">Location</label>
													<input type="text" name="booking_address" class="form-control" id="modalAddress" readonly>
												</div>
												<div>
													<label for="modalContact" class="form-label">Contact Number</label>
													<input type="text" name="contact_num" class="form-control" id="modalContact" readonly>
												</div>
												<div>
													<label for="modalRoomNo" class="form-label">Room Number</label>
													<input type="text" name="roomNo" class="form-control" id="modalRoomNo" readonly>
												</div>
												<div>
													<label for="modalDate" class="form-label">Booking Date</label>
													<input type="text" name="created_at" class="form-control" id="modalDate" readonly>
												</div>
												<div class="mb-3">
													<label for="photoPreview" class="form-label"></label>
													<img id="photoPreview" class="img-fluid border" alt="Uploaded photo will appear here" style="display: none; max-height: 300px;">
												</div>
												<button type="submit" class="btn btn-primary">Submit</button>
											</form>

										</div>

										<step v-for="step in steps" :currentstep="currentstep" :key="step.id" :step="step" :stepcount="steps.length" @step-change="stepChanged">
										</step>

										<script type="x-template" id="step-navigation-template">
											<ol class="step-indicator">
													<li v-for="step in steps" is="step-navigation-step" :key="step.id" :step="step" :currentstep="currentstep">
													</li>
												</ol>
											</script>

										<script type="x-template" id="step-navigation-step-template">
											<li :class="indicatorclass">
													<div class="step"><i :class="step.icon_class"></i></div>
													<div class="caption hidden-xs hidden-sm">Step <span v-text="step.id"></span>: <span v-text="step.title"></span></div>
												</li>
											</script>

										<script type="x-template" id="step-template">
											<div class="step-wrapper" :class="stepWrapperClass">
													<button type="button" class="btn btn-primary" @click="lastStep" :disabled="firststep">
														Back
													</button>
													<button type="button" class="btn btn-primary" @click="nextStep" :disabled="laststep">
														Next
													</button>
													<button type="submit" class="btn btn-primary" v-if="laststep">
														Submit
													</button>
												</div>
											</script>
									</div>
								</div>
							</form>
							<h6 class="service-title"></h6>
							<p class="service-description"></p>
						</div>
					</div>
				</div>
			</div>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.4/vue.js'></script>
			<script src="<?php echo WEB_ROOT; ?>script/wizard.js"></script>
			<script>
				const dynamicModal = document.getElementById('dynamicModal');
				dynamicModal.addEventListener('shown.bs.modal', function(event) {
					// Get the service ID from the button that triggered the modal
					const button = event.relatedTarget;
					const subcatid = button.getAttribute('data-subcatid');
					const title = button.getAttribute('data-title');
					const description = button.getAttribute('data-description');

					// Update the modal content with the service details
					document.querySelector('.service-title').innerText = title;
					document.querySelector('.service-description').innerText = description;
				});
			</script>
			<!-- END OF MODAL -->

		</div>



	</div>
</div>

<!-- end of carousel -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const searchInput = document.getElementById("search-input");
		const cards = document.querySelectorAll(".official-partner-home2");

		searchInput.addEventListener("input", function() {
			const searchValue = searchInput.value.toLowerCase();

			cards.forEach((card) => {
				const cardName = card.getAttribute("data-name").toLowerCase();

				if (cardName.includes(searchValue)) {
					card.style.display = "block"; // Show card
				} else {
					card.style.display = "none"; // Hide card
				}
			});
		});
	});
</script>

</div>