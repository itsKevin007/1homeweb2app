<!-- Modify Profile Section Start -->
<?php

$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$fname = $client_data['c_fname'];
$mname = $client_data['c_mname'];
$lname = $client_data['c_lname'];
$suffix = $client_data['c_suffix'];
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
$image = $thumbnail ? WEB_ROOT . 'adminpanel/assets/images/user/' . $thumbnail : WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';

?>
<section id="profile-page-sec">
	<div id="profile-third-sec">
		<div class="container">
			<div class="profile-third-sec-full mt-24">
				<div class="accordion custom-acc" id="accordionPanelsStayOpenExample">
					<h3 class="prile3-txt1">Modify Profile</h3>
					<form method="POST" enctype="multipart/form-data" action="process.php?action=modify" name="form" id="form">
						<div class="accordion-item border-0 mt-24">
							<hr>
							<div style="display: flex; justify-content: center; width: 100%;">
								<img src="<?php echo $image; ?>" id="img-preview" style="width: 200px; height: 200px; border-radius: 50%;">
							</div>
							<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
								<label for="profile_image" class="icon-container" style="display: flex; align-items: center; cursor: pointer;">
									<i class="fa fa-edit"></i>
									<p style="margin: 0 0 0 5px;">Edit Photo</p>
								</label>
								<input type="file" name="fileImage" accept="image/*" id="profile_image" style="display: none;" onchange="showImagePreview(this)">
							</div>
							<script>
								function showImagePreview(input) {
									if (input.files && input.files[0]) {
										var reader = new FileReader();
										
										reader.onload = function(e) {
											$('#img-preview').attr('src', e.target.result);
										}
										reader.readAsDataURL(input.files[0]);
									}
								}
							</script>
							<!-- <button type="submit" class="btn btn-primary mt-16">Upload Image</button> -->
						</div>

						<div class="accordion-item border-0 mt-24">
							<hr>
							<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian1">
								<h5 class="prile3-txt2">Name</h5>
							</button>
							<div id="accordian1" class="accordion-collapse collapse show">
								<div class="row mt-16">
									<div class="col-6">
										<input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" placeholder="First Name">
									</div>
									<div class="col-6">
										<input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>" placeholder="Middle Name">
									</div>
								</div>
								<div class="row mt-16">
									<div class="col-6">
										<input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>" placeholder="Last Name">
									</div>
									<div class="col-6">
										<input type="text" name="suffix" class="form-control" value="<?php echo $suffix; ?>" placeholder="Suffix">
									</div>
								</div>
							</div>
							<div class="faq-bottom-border"></div>
						</div>
						<div class="accordion-item border-0 mt-24">
							<h2 class="accordion-header">
								<hr>
								<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian2">
									<h5 class="prile3-txt2">Contact Details</h5>
								</button>
							</h2>
							<div id="accordian2" class="accordion-collapse collapse">
								<div class="accordion-body faq-answer">
									<div class="row mt-16">
										<div class="col-6">
											<input type="text" name="connum" class="form-control" value="<?php echo $connum; ?>" placeholder="Contact Number">
										</div>
										<div class="col-6">
											<input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
										</div>
									</div>
								</div>
							</div>
							<div class="faq-bottom-border"></div>
						</div>
						<div class="accordion-item border-0 mt-24">
							<h2 class="accordion-header">
								<hr>
								<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian3">
									<h5 class="prile3-txt2">Home Address</h5>
								</button>
							</h2>
							<div id="accordian3" class="accordion-collapse collapse">
								<div class="accordion-body faq-answer">
									<div class="row mt-16">
										<div class="col-6">
											<label class="prile3-txt2">Region</label>
											<input type="text" name="region" class="form-control" value="<?php echo $region; ?>" placeholder="Region">
										</div>
										<div class="col-6">
											<label class="prile3-txt2">Province</label>
											<input type="text" name="province" class="form-control" value="<?php echo $province; ?>" placeholder="Province">
										</div>
									</div>
									<div class="row mt-16">
										<div class="col-6">
											<label class="prile3-txt2">City/Municipality</label>
											<input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="City/Municipality">
										</div>
										<div class="col-6">
											<label class="prile3-txt2">Barangay</label>
											<input type="text" name="barangay" class="form-control" value="<?php echo $barangay; ?>" placeholder="Barangay">
										</div>
									</div>
									<div class="row mt-16">
										<div class="col-6">
											<label class="prile3-txt2">Subdivision</label>
											<input type="text" name="subdivision" class="form-control" value="<?php echo $subdivision; ?>" placeholder="Subdivision">
										</div>
										<div class="col-6">
											<label class="prile3-txt2">Street</label>
											<input type="text" name="street" class="form-control" value="<?php echo $street; ?>" placeholder="Street">
										</div>
									</div>
									<div class="row mt-16">
										<div class="col-6">
											<label class="prile3-txt2">Unit</label>
											<input type="text" name="unit" class="form-control" value="<?php echo $unit; ?>" placeholder="Unit">
										</div>
										<div class="col-6">
											<label class="prile3-txt2">Building</label>
											<input type="text" name="building" class="form-control" value="<?php echo $building; ?>" placeholder="Building">
										</div>
									</div>
									<div class="row mt-16">
										<div class="col-4">
											<label class="prile3-txt2">Phase</label>
											<input type="text" name="phase" class="form-control" value="<?php echo $phase; ?>" placeholder="Phase">
										</div>
										<div class="col-4">
											<label class="prile3-txt2">Block & Lot</label>
											<input type="text" name="blocklot" class="form-control" value="<?php echo $blocklot; ?>" placeholder="Block & Lot">
										</div>
										<div class="col-4">
											<label class="prile3-txt2">Zip</label>
											<input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>" placeholder="Zip">
											<input type="hidden" name="id" value="<?php echo $uid; ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="faq-bottom-border"></div>
						</div>
						<div style="justify-content: center; display: flex; width: 100%;">
							<button type="submit" style="float: right;" class="btn btn-primary">Save</button>
						</div>
					</form>
					<div class="profile-boder mt-24"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Profile Details Section End -->