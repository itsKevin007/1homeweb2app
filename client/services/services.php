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
?>

<div class="homepage-second-sec mt-24">
	<div class="container">
		<div class="Homepage-top-sec">
			<div class="home-top-first">
				<h2 class="home-cate-title">Services</h2>
			</div>

		</div>
	</div>
	<div class="homepage-category-sec mt-16">
		<h3 class="d-none">Categories Details</h3>

		<?php
		// Loop through each service and generate a card
		foreach ($services_data as $service) {
			// Escape special characters for the main category
			$mainCat = htmlspecialchars($service['main_cat']);

			// Create the HTML structure for the card
			echo '<div class="homepage-category-details" style="margin-left: 16px;">
            <div class="home-cate-shape">
                <img src="' . WEB_ROOT . 'assets/images/icons/onehomesol.png" class="img-fluid" alt="furniture-img">
            </div>
            <div class="cate">
                <h4 class="cate-title">' . $mainCat . '</h4>
                <h5 class="cate-subtitle"></h5>
            </div>
          </div>';
		}
		?>

	</div>
</div>

<!-- -------------------------------- view All ------------------------------------------ -->
<div class="mt-24" style="margin-left: 16px;">
	<h4 class="text-secondary">All Categories</h4>
</div>
<div class="card-container">
	
<?php
// Loop through each service and generate a card
foreach ($services_data as $service) {
	$mainCat = htmlspecialchars($service['main_cat']);
	$description = htmlspecialchars($service['descript']);
	
	echo 
	'<div class="card card-1">
		<div class="card-img"></div>
		<a href="" class="card-link">
			<div class="card-img-hovered"></div>
		</a>
		<div class="card-info">
			<div class="card-about">
				<a class="card-tag tag-news">' . $mainCat . '</a>
				<div class="card-time">6/11/2018</div>
			</div>
			<h1 class="card-title">' . $description . '</h1>
			<div class="card-creator"><a href="">Company Name</a></div>
		</div>
	</div>';
}
?>
	
</div>