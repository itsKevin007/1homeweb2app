<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	$id = $_GET['id'];
	
	$sql = $conn->prepare("SELECT * FROM bs_user WHERE uid = '$id' AND is_deleted != '1'");
	$sql->execute();
	$sql_data = $sql->fetch();

?>
	
						<?php
							if($errorMessage == 'Modified successfully.')
							{
						?>							
							<div class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white"><?php echo $errorMessage; ?></h6>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div><div class="col">
							</div>
						<?php
							}
							else if($errorMessage == 'Data already exist! Data entry failed.')
							{
						?>	
							<div class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white"><?php echo $errorMessage; ?></h6>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div><div class="col">
							</div>
						<?php								
							} else {}
						?>
				<div class="row">
					<div class="col-xl-7 mx-auto">
						<h6 class="mb-0 text-uppercase">Modify User</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-white">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<?php
										if ($sql_data['image']) {
											$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $sql_data['image'];
										} else {
											$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
										}	
									?>
									<img src="<?php echo $image; ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								</div><hr>
							<form class="needs-validation" novalidate method="post" action="process.php?action=modify"  enctype="multipart/form-data" name="form" id="form">
								<div class="mb-3">
									<label for="validationCustom01" class="form-label">First name: </label>
									<input type="text" class="form-control" id="validationCustom01" name="fname" placeholder="First name" value="<?php echo $sql_data['firstname']; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a valid first name.
									</div>
								</div>
								<div class="mb-3">
									<label for="validationCustom03" class="form-label">Last name: </label>
									<input type="text" class="form-control" id="validationCustom03" name="lname" placeholder="Last name" value="<?php echo $sql_data['lastname']; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a valid last name.
									</div>
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Email: </label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $sql_data['email']; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a valid contact number.
									</div>
								</div>
								<div class="mb-3">
									<label for="validationCustom04" class="form-label">Contact number: </label>
									<input type="text" class="form-control" id="validationCustom04" name="contactnum" placeholder="Contact number" value="<?php echo $sql_data['contactno']; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a valid contact number.
									</div>
								</div>
								<div class="mb-3">
									<label for="validationCustom05" class="form-label">Address</label>
									<textarea type="text" class="form-control" id="validationCustom05" name="address" placeholder="Address" required ><?php echo $sql_data['address']; ?></textarea>
									<div class="invalid-feedback">
										Please provide a valid address.
									</div>
								</div>
								<div class="mb-3">
									<label for="formFile" class="form-label">Upload profile picture</label>
									<input type="file" class="form-control" id="formFile" data-height="300" name="fileImage" />
								</div>

							
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<a class="btn btn-light" style="float: left;" href="index.php">Cancel</a>
								<button class="btn btn-success" type="submit" style="float: right;">Save</button>
							</form>

						</div> <!-- end card-body-->
					</div> <!-- end card-->
				</div> <!-- end col-->
			</div>
			<!-- end row -->
		</div> <!-- container -->
	</div> <!-- content -->