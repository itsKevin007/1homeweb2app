<!-- Profile Details Section Start -->
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
	<div class="container" style="margin-top: 20px;">
		<div class="card profile-card-3">
			<div class="background-block" style="background-color: #022c5c;">

			</div>
			<div style="margin-top: -50px;">
				<img src="<?php echo $image; ?>" class="profile" alt="profile" style="width: 120px; height: 100px;">
			</div>
			<div class="card-content" style="z-index: 0;">
				<div>
					<h3 class="pro-txt1"><?php echo $fullname; ?></h3>
					<a href="index.php?view=modify">
						<button class="btn profile-settings-btn">
							<p><i class="fas fa-cog" aria-hidden="true"></i>Edit Profile</p>
						</button>
					</a>
				</div>

				<div class="col">
					<h4 class="pro-txt2"><b>Home</b></h4>
					<h4 class="pro-txt2"><?php echo $address; ?></h4>
					<h4 class="pro-txt2"><strong>Office</strong></h4>
					<h5 class="prile3-txt3"><?php echo $office_add; ?></h5>
				</div>

			</div>
		</div>
	</div>

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
		QRcode::png($text, $filePath, QR_ECLEVEL_L, 5);

		?>
		<div class="container">
			<div style="text-align: center">
				<img src="<?php echo $filePath; ?>">
			</div>
		</div>
	</div>
	<div>
		<a href="<?php echo WEB_ROOT; ?>client/dashboard/index.php?view=payment">
			<p style="color: #022c5c;">to payment</p>
		</a>
		<a href="<?php echo WEB_ROOT; ?>client/FAQ/index.php?view=FAQ">
			<p style="color: #022c5c;">To FAQ</p>
		</a>
	</div>
</section>