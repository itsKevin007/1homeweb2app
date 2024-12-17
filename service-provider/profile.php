<!-- Profile Details Section Start -->
	<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/profile-modify.css">
<?php 
	
	include('../phpqrcode/qrlib.php');

	$uid_user = $user_data['uid'];
	$client = $conn->prepare("SELECT * FROM tbl_independent WHERE user_id = :userId");
	$client->bindParam(':userId', $userId, PDO::PARAM_INT);
	$client->execute();
	$client_data = $client->fetch();
	$uid = $client_data['uid'];

	$fname = $client_data['fname'];
	$mname = $client_data['mname'];
	$lname = $client_data['lname'];
	$email = $client_data['emailadd'];
	$connum = $client_data['connum'];
	$date_added = $client_data['date_added'];
	$accno = $client_data['accno'];

	$region = $client_data['in_region'];
	$province = $client_data['in_prov'];
	$city = $client_data['in_city'];
	$barangay = $client_data['in_barangay'];

	$mainadd = $region.", ".$province.", ".$city.", ".$barangay;
	
	$subdivision = $client_data['in_subdi'];
	$street = $client_data['str'];
	$unit = $client_data['in_unit'];
	$building = $client_data['in_build'];
	$phase = $client_data['phase'];
	$blocklot = $client_data['blocklot'];

	$zip = $client_data['zipc'];

	$subadd = $subdivision." ".$street.", ".$unit.", ".$building.", ".$phase.", ".$blocklot.", ".$zip;
	
	// Home Address 
	$address = $mainadd.", ".$subadd;

	$b_address = $client_data['b_address'];

	$comadd = $conn->prepare("SELECT * FROM tbl_comadd WHERE ca_id = :addId");
	$comadd->bindParam(':addId', $b_address, PDO::PARAM_INT);
	$comadd->execute();
		if($comadd->rowCount() > 0)
		{
			$comadd_data = $comadd->fetch();
			$cregion = $comadd_data['cregion'];
			$cprovince = $comadd_data['cprovince'];
			$ccity = $comadd_data['ccity'];
			$cbarangay = $comadd_data['cbarangay'];
			$csubvil = $comadd_data['csubvil'];
			$cstreet = $comadd_data['cstreet'];
			$cunit = $comadd_data['cunit'];
			$cbname = $comadd_data['cbname'];
			$cphase = $comadd_data['cphase'];
			$cbandl = $comadd_data['cbandl'];
			$czip = $comadd_data['czip'];


		$mainoff = $cregion.", ".$cprovince.", ".$ccity.", ".$cbarangay;

		$suboff = $csubvil.", ".$cstreet.", ".$cunit.", ".$cbname.", ".$cphase.", ".$cbandl.", ".$czip;

		$officeadd = $mainoff.", ".$suboff;

		}else{
			$officeadd = "No Office Address";
		}

		$thumbnail = $user_data['thumbnail'];

		if ($user_data['thumbnail']) {
			$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $user_data['thumbnail'];
		} else {
			$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
		}

		$fullname = $fname." ".$mname." ".$lname;
?>
		<section id="profile-page-sec">
			<div class="profile-top-sec">
				<div class="profile-top-sec-full">
					<h1 class="d-none">Profile</h1>
					<h2 class="d-none">ProfilePage</h2>

							<a href="#" class="add-icon-service main-color" data-bs-toggle="modal" data-bs-target="#addServiceModal">
								<div class="profile-img-sec position-relative">
									<img src="<?php echo $image; ?>" alt="Profile Image">
									<span class="hover-text"><img src="../assets/images/icon/edit.svg" > Edit</span>
								</div>
							</a>

							<?php include 'modal/edit-profile.php'; ?>

						<div class="profile-details-sec">
							<div class="row">
								<div class="col-6">
									<h3 class="pro-txt1"><?php echo $fullname; ?></h3>
								</div>
								<div class="col-6">
									<a href="index.php?view=modify"><h3 class="pro-txt1"><img src="../assets/images/icon/edit.svg" ></h3></a>
								</div>
							</div>
							<h4 class="pro-txt2"><?php echo $email; ?></h4>
							<h5 class="pro-txt3">+<?php echo $connum; ?></h5>
							<h5 class="pro-txt3">Date Registered: <?php echo $date_added; ?></h5>
							<h5 class="pro-txt3">Account #: <?php echo $accno; ?></h5>
						</div>
				</div>
			</div>
			
			
			<div id="profile-third-sec">
				<div class="container">
					<div class="profile-third-sec-full mt-24">
						<h3 class="prile3-txt1">Address</h3>
						<div class="profile-address-sec mt-16">
							<h4 class="prile3-txt2">Home</h4>
							<h5 class="prile3-txt3"><?php echo $address; ?></h5>
						</div>
						<div class="profile-address-sec mt-16">
							<h4 class="prile3-txt2">Office</h4>
							<h5 class="prile3-txt3"><?php echo $officeadd; ?></h5>
						</div>
						<div class="profile-boder mt-24"></div>
					</div>
				</div>
			</div>	
			<?php 
				$text = $uid_user;
				$tempDir = 'temp/'; // Directory to save QR code temporarily
	
				// Ensure temp directory exists
				if (!is_dir($tempDir)) {
					mkdir($tempDir, 0755, true);
				}
	
				// Generate QR code
				$fileName = 'qrcode_' . md5($text) . '.png';
				$filePath = $tempDir . $fileName;
				QRcode::png($text, $filePath, QR_ECLEVEL_L, 5);
	
			?>
			<div class="container">
				<div style="text-align: center">
					<img src="<?php echo $filePath; ?>">
				</div>
			</div>
		</section>
		<!-- Profile Details Section End -->