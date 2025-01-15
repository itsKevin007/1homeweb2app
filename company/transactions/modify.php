<!-- Modify Profile Section Start -->
<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';

	if($errorMessage == 'Success')
	{
		?>
			<script>
				Swal.fire({
					title: 'Success!',
					text: '',
					icon: 'success', // Use 'info', 'warning', or 'error' for other types
					showConfirmButton: true,
					confirmButtonText: 'OK',
					confirmButtonColor: '#3085d6',
					background: '#fefefe', // Customize background
					customClass: {
						popup: 'animate__animated animate__fadeInDown' // Add smooth animation
					}
				});
			</script>

		<?php
	}elseif($errorMessage == 'eandc'){
		?>

			<script>
				Swal.fire({
					title: 'Warning!',
					text: 'Email or Contact Number Exist',
					icon: 'warning', // Use 'info', 'warning', or 'error' for other types
					showConfirmButton: true,
					confirmButtonText: 'OK',
					confirmButtonColor: '#FA113D',
					background: '#fefefe', // Customize background
					customClass: {
						popup: 'animate__animated animate__fadeInDown' // Add smooth animation
					}
				});
			</script>

		<?php
	}else{}


	$client = $conn->prepare("SELECT * FROM tbl_company WHERE user_id = :userId");
	$client->bindParam(':userId', $userId, PDO::PARAM_INT);
	$client->execute();
	$client_data = $client->fetch();
	$uid = $client_data['uid'];

	$com_id = $client_data['com_id'];

	$bname = $client_data['bname'];
	$email = $client_data['emailadd'];
	$connum = $client_data['connum'];

	$conPerName = $client_data['conperna'];
	$conPerPos = $client_data['conperpos'];

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

	$tin = $client_data['tin'];

	$subadd = $subdivision." ".$street.", ".$unit.", ".$building.", ".$phase.", ".$blocklot.", ".$zip;

	// Home Address 
	$address = $mainadd.", ".$subadd;

?>
<section id="profile-page-sec">
	<div id="profile-third-sec">
		<div class="container">
			<div class="profile-third-sec-full mt-24">
				
					<div class="accordion custom-acc" id="accordionPanelsStayOpenExample">
						<h3 class="prile3-txt1">Modify Profile</h3>
							<div class="accordion-item border-0 mt-24">
								<hr>
								<div style="display: flex; justify-content: center; width: 100%;">
									<img src="<?php echo $image; ?>" id="img-preview" style="width: 200px; height: 200px; border-radius: 50%;">
								</div>
								<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
									<a href="#" data-bs-toggle="modal" data-bs-target="#addServiceModal">
										<label for="profile_image" class="icon-container" style="display: flex; align-items: center; cursor: pointer; color: #000000;">
											<i class="fa fa-edit"></i>
											<p style="margin: 0 0 0 5px;">Edit Photo</p>
										</label>
									</a>									
								</div>

							<!------------------------ Modal Profile -------------------------->
							
							<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="addServiceModalLabel">Edit Profile Picture</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="process.php?action=imgprof" method="POST" enctype="multipart/form-data">
												
												<div class="mb-3">
													<input type="file" class="form-control" id="formFile" name="fileImage" />
												</div>
												<hr>
											
												<button type="submit" class="btn btn-primary" onClick="return confirmSubmit()">SUBMIT</button>
												
											</form>
										</div>
									</div>
								</div>
							</div>

							<!------------------------ End Modal Profile -------------------------->

						<form method="POST" action="process.php?action=promod">
							<div class="accordion-item border-0 mt-24">
								<hr>
								<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian1">
									<h5 class="prile3-txt2">Name</h5>
								</button>
								<div id="accordian1" class="accordion-collapse collapse show">
									<div class="row mt-16">
										<div class="col-12">
											<input type="text" name="bname" class="form-control" value="<?php echo $bname; ?>" placeholder="First Name" autocomplete="off" required>
										</div>
										<div class="invalid-feedback">
											Please provide a valid Data.
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
												<input type="text" name="connum" class="form-control" value="<?php echo $connum; ?>" placeholder="Contact Number" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>
											<div class="col-6">
												<input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" required>
											</div>	
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>					
										</div>
										<div class="row mt-16">
											<div class="col-6">
												<input type="text" name="conperna" class="form-control" value="<?php echo $conPerName; ?>" placeholder="Contact Person Name">
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>
											<div class="col-6">
												<input type="text" name="conperpos" class="form-control" value="<?php echo $conPerPos; ?>" placeholder="Contact Person Position">
											</div>	
											<div class="invalid-feedback">
												Please provide a valid Data.
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
												<input type="text" id="region_text" name="region" class="form-control" value="<?php echo $region; ?>" placeholder="Region" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>						
											<div class="col-6">
												<label class="prile3-txt2">Province</label>
												<input type="text" id="province_text" name="prov" class="form-control" value="<?php echo $province; ?>" placeholder="Province" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>						
										</div>
										<div class="row mt-16">						
											<div class="col-6">
											<label class="prile3-txt2">City/Municipality</label>
												<input type="text" id="city_text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="City/Municipality" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>
											<div class="col-6">
											<label class="prile3-txt2">Barangay</label>
												<input type="text" id="barangay_text" name="barangay" class="form-control" value="<?php echo $barangay; ?>" placeholder="Barangay" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>
										</div>
										<div class="row mt-16">						
											<div class="col-6">
											<label class="prile3-txt2">Subdivision</label>
												<input type="text" name="subdivision" class="form-control" value="<?php echo $subdivision; ?>" placeholder="Subdivision">
											</div>
											<div class="invalid-feedback">
												
											</div>
											<div class="col-6">
											<label class="prile3-txt2">Street</label>
												<input type="text" name="street" class="form-control" value="<?php echo $street; ?>" placeholder="Street" required>
											</div>
											<div class="invalid-feedback">
												Please provide a valid Data.
											</div>				
										</div>
										<div class="row mt-16">						
											<div class="col-6">
											<label class="prile3-txt2">Unit</label>
												<input type="text" name="unit" class="form-control" value="<?php echo $unit; ?>" placeholder="Unit">
											</div>
											<div class="invalid-feedback"></div>
											<div class="col-6">
											<label class="prile3-txt2">Building</label>
												<input type="text" name="building" class="form-control" value="<?php echo $building; ?>" placeholder="Building">
											</div>		
											<div class="invalid-feedback"></div>		
										</div>
										<div class="row mt-16">						
											<div class="col-4">
											<label class="prile3-txt2">Phase</label>
												<input type="text" name="phase" class="form-control" value="<?php echo $phase; ?>" placeholder="Phase">
											</div>
											<div class="invalid-feedback"></div>
											<div class="col-4">
											<label class="prile3-txt2">Block & Lot</label>
												<input type="text" name="blocklot" class="form-control" value="<?php echo $blocklot; ?>" placeholder="Block & Lot">
											</div>
											<div class="invalid-feedback"></div>	
											<div class="col-4"> 
											<label class="prile3-txt2">Zip</label>
												<input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>" placeholder="Zip" required>
											</div>
											<div class="invalid-feedback">Please provide a valid ZIP.</div>			
										</div>
									</div>
								</div>
								<div class="faq-bottom-border"></div>
							</div>
							<input type="hidden" name="baddress" class="form-control" value="<?php echo $b_address; ?>">
							<?php 
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
																			
										$comadd_data = $comadd->fetch();
										$cregion = '';
										$cprovince = '';
										$ccity = '';
										$cbarangay = '';
										$csubvil = '';
										$cstreet = '';
										$cunit = '';
										$cbname = '';
										$cphase = '';
										$cbandl = '';
										$czip = '';

									}
							?>
							
							<?php


								$dti = $client_data['dti'];
								$mayorper = $client_data['mayorper'];
								$cor = $client_data['cor'];
							?>
							<div class="accordion-item border-0 mt-24">
								<h2 class="accordion-header">
									<hr>
									<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian5">
										<h5 class="prile3-txt2">Business Permits & Licenses</h5>
									</button>
								</h2>
								<div id="accordian5" class="accordion-collapse collapse">
									<div class="accordion-body faq-answer">
										<div class="row mt-16">
											<div class="col-6">
												<label class="prile3-txt2">DTI #</label>
												<input type="text" name="dtinum" class="form-control" value="<?php echo $dti; ?>" placeholder="DTI #">
												<div class="invalid-feedback">
													Please provide a valid DTI number.
												</div>
											</div>
											<div class="col-6">
												<label class="prile3-txt2">Mayors Permit #</label>
												<input type="text" name="mayornum" class="form-control" value="<?php echo $mayorper; ?>" placeholder="Mayors Permit #">
												<div class="invalid-feedback">
													Please provide a valid Mayors Permit number.
												</div>
											</div>
										</div>	
										<div class="row mt-16">
											<div class="col-6">
												<label class="prile3-txt2">COR / 2303</label>
												<input type="text" name="cor2303" class="form-control" value="<?php echo $cor; ?>" placeholder="COR / 2303">
											</div>	
											<div class="invalid-feedback">
												Please provide a valid COR / 2303.
											</div>				
										</div>
										<?php 
											// $affiliate = $client_data['affiliate'];

											// $in_client = $conn->prepare("SELECT * FROM tbl_client WHERE inid = :inid");
											// $in_client->bindParam(':inid', $inid, PDO::PARAM_INT);
											// $in_client->execute();
											// if($in_client->rowCount() > 0){
											// 	while($in_client_data = $in_client->fetch())
											// 	{

											// 	}																						
											// }else{}
										?>
									</div>
								</div>
								<div class="faq-bottom-border"></div>
							</div>

						<div class="profile-boder mt-24"></div>
						
					</div>

					<input type="hidden" name="id" value="<?php echo $uid; ?>">
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
					<br><br>
				
				
			</div>
		</div>
	</div>
</section>
<!-- Profile Details Section End -->