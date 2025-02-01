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

				echo '
				
				<div class="offcial-partner-home2" data-name="' . $mainCat . '" style="height: auto; padding-bottom: 8px;">
					<a href="" class="card-link" data-bs-toggle="modal" data-bs-target="#transact" data-service-id="<?php echo $service["id"]; ?>
						<div>
							<img src="' . WEB_ROOT . 'assets/images/serviceImg/carpentry.jpg" style="width: 100%; height:auto; border-top-left-radius: 8px; border-top-right-radius: 8px;" alt="furniture-img">
							<p class="offcial-title-home2 text-center" style="font-size: 12px">' . $mainCat . '</p>
						</div>
					</a>
				</div>
			';
			}
			?>
		</div>

		<hr>

		<div class="homepage2-second-sec mt-24">
			<div class="container">
				<div class="product-details">
					<?php
					// Loop through each subcategory and generate a card
					foreach ($subcategories_data as $index => $subcategory) {
						// Escape special characters for the subcategory
						$subCategory = htmlspecialchars($subcategory['sub_categor']);
						$dateAdded = htmlspecialchars($subcategory['date_added']);
						$modalId = 'modal-' . $index; // Unique ID for each modal
						$description = htmlspecialchars($subcategory['description']);


						echo '
							<div class="official-partner-home2" data-name="' . $subCategory . '" style="height: auto; ">
								<a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">
									<div>
										<img src="' . WEB_ROOT . 'assets/images/serviceImg/carpentry.jpg" style="width: 100%; height:auto; border-top-left-radius:8px; border-top-right-radius:8px;" alt="furniture-img">
										<p class="official-title-home2 text-left" style="font-size: 10px;">' . $subCategory . '</p>
									</div>
								</a>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalLabel-' . $index . '" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-fullscreen">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalLabel-' . $index . '">' . $subCategory . ' Details</h5>
											<button type="button" class="btn-close" style="float:right" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<p>' . $description . '</p>
										</div>
									</div>
								</div>
							</div>
						';
					}
					?>

					<script>
						document.querySelectorAll('.card-link').forEach(link => {
							link.addEventListener('click', function() {
								const serviceId = this.getAttribute('data-subcat-id');
								document.getElementById('service-id-input').value = serviceId;
							});
						});
					</script>
				</div>
			</div>

			<!-- -------------------------------- For modal select address------------------------------------------ -->

			<div class="modal fade" id="transact" tabindex="-1" aria-labelledby="transact" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<h5 class="modal-title" id="modal">SELECT ADDRESS</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

						</div>

						<div class="modal-body">

							<div class="container">

								<div>


									<?php

									$location = $conn->prepare("SELECT * FROM tbl_location WHERE user_id = '$userId' AND is_active = '1' AND is_deleted != '1'");

									$location->execute();

									if ($location->rowCount() > 0) {

										while ($locationdata = $location->fetch()) {

											$location_id = $locationdata['l_id'];

											$name = $locationdata['name'];

									?>
											<?php
											$services = $conn->prepare("SELECT * FROM ind_maincat WHERE sercatid = :sercatId");
											$services->bindParam(':sercatId', $sercatId, PDO::PARAM_INT);
											$services->execute();

											$services_data = [];
											if ($services->rowCount() > 0) {
												$services_data = $services->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
											}
											?>

											<div class="mb-3">
												<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectAddress" onClick="locationSubmit('<?php echo $location_id; ?>'),('<?php echo $sercatId; ?>')">
													<?php echo $name; ?>
												</button>

											</div>

											<!-- Modal -->
											<div class="modal fade" id="selectAddress" tabindex="-1" aria-labelledby="selectAddressLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="selectAddressLabel">SELECT ADDRESS</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															Are you sure you want to select this address?
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" onClick="locationSubmit('<?php echo $location_id; ?>'),('<?php echo $sercatId; ?>')">Select Address</button>
														</div>
													</div>
												</div>
											</div>

									<?php

										}
									} else {
									}

									?>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>
			<!-- end of modal -->
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