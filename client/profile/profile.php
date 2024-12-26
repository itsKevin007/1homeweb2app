<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/profile-modify.css">

<?php


include('../../phpqrcode/qrlib.php');
$user_uid = $user_data['uid'];
$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['c_fname'];
$mname = $client_data['c_mname'];
$lname = $client_data['c_lname'];
$email = $client_data['email'];
$connum = $client_data['connum'];
$date_added = $client_data['date_added'];
$accnum = $client_data['accnum'];

$region = $client_data['region_text'];
$province = $client_data['province_text'];
$city = $client_data['city_text'];
$barangay = $client_data['barangay_text'];

$mainadd = $region . ", " . $province . ", " . $city . ", " . $barangay;

$subdivision = $client_data['subdivision'];
$street = $client_data['street'];
$unit = $client_data['unit'];
$building = $client_data['building'];
$phase = $client_data['phase'];
$blocklot = $client_data['blocklot'];

$zip = $client_data['zipcode'];

$subadd = $subdivision . " " . $street . ", " . $unit . ", " . $building . ", " . $phase . ", " . $blocklot . ", " . $zip;

$office_add = $client_data['office_add'];

// Home Address 
$address = $mainadd . ", " . $subadd;
// for image
$thumbnail = $user_data['thumbnail'];

if ($user_data['thumbnail']) {
	$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $user_data['thumbnail'];
} else {
	$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
}

$fullname = $fname . " " . $mname . " " . $lname;
?>

<!--Profile Card 3-->

<section id="profile-page-sec">

<div class="card">
		<div class="image">		
			<a href="#" class="add-icon-service main-color" data-bs-toggle="modal" data-bs-target="#addServiceModal">
				<div class="profile-img-sec position-relative">
					<img src="<?php echo $image; ?>" alt="Profile Image">
				
				</div>
			</a>
		</div>
		<div class="card-info">
			<span><h3><b><?php echo $fullname; ?></b></h3></span>
			<b>
				<?php echo $email; ?><br>
				+<?php echo $connum; ?><br>
				Date Registered: <?php echo $date_added; ?><br>
				Account #: <?php echo $accnum; ?>

				<div class="d-none d-sm-block" style="text-align: center; margin-top: 10px;">
					<p class="tap-me-text">Tap me to edit</p>
				</div>
				
			</b>
		</div>
		<a href="index.php?view=modify" class="button" ><img src="../../assets/images/icon/edit-white.svg" width="25px" ></a>

</div>

		<div class="card-info" id="profile-third-sec">
			<div class="container">
				<div class="profile-third-sec-full mt-24">
					<a href="../address/index.php" class="btn btn-pin" >
						<img src="../../assets/images/icon/add-location-alt-white.svg" width="30px" >
					</a>
				</div>
				<div class="profile-third-sec-full mt-24">
					<h3 class="prile3-txt1"><img src="../../assets/images/icon/pin-destination-bold.svg" width="20px" > Address</h3>
					<div class="profile-address-sec mt-16">
						<h4 class="prile3-txt2">Home</h4>
						<h5 class="prile3-txt3"><?php echo $address; ?></h5>
					</div>
					<div class="profile-boder mt-24"></div>
				</div>
			</div>
		</div>

		<div class="card-info">
			<span>
				<h3><b><?php echo $fullname; ?></b></h3>
			</span>
			<b>
				<?php echo $email; ?><br>
				+<?php echo $connum; ?><br>
				Date Registered: <?php echo $date_added; ?><br>
				Account #: <?php echo $accnum; ?>

				<div class="d-none d-sm-block" style="text-align: center; margin-top: 10px;">
					<p class="tap-me-text">Tap me to edit</p>
				</div>

			</b>
		</div>
		<a href="index.php?view=modify" class="button"><img src="../../assets/images/icon/edit-white.svg" width="25px"></a>
	</div>



</section>