<div class="modal fade" id="<?php echo $uid; ?>" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			
				<div class="modal-header">
					<h5 class="modal-title">ADD SUBSCRIBER</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xl-12 mx-auto">
								<div class="card border-top border-0 border-4 border-white">
									<div class="card-body p-5">		
									<form class="needs-validation" novalidate method="post" action="process.php?action=modify" enctype="multipart/form-data" name="form" id="form">					
										<div class="mb-3">
											<label for="fname" class="form-label">First name: </label>
											<input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $fname; ?>" autocomplete="off" required />
											<div class="invalid-feedback">
												Please provide a valid first name.
											</div>
										</div>
										<div class="mb-3">
											<label for="lname" class="form-label">Last name: </label>
											<input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $lname; ?>" autocomplete="off" required />
											<div class="invalid-feedback">
												Please provide a valid last name.
											</div>
										</div>
										<div class="mb-3">
											<label for="email" class="form-label">Email: </label>
											<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" autocomplete="off" required />
											<div class="invalid-feedback">
												Please provide a valid contact number.
											</div>
										</div>                                        
										<div class="mb-3">
											<label for="lname" class="form-label">Subscriber Type: </label>&nbsp;&nbsp;&nbsp;
											<div class="form-check form-check-inline">
												<input class="form-check-input" <?php echo ($sub == 1) ? 'checked' : ''; ?> name="type" type="radio" id="<?php echo $uid; ?>1" value="1">
												<label class="form-check-label" for="<?php echo $uid; ?>1">Subscriber</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" <?php echo ($sub == 2) ? 'checked' : ''; ?> name="type" type="radio" id="<?php echo $uid; ?>2" value="2">
												<label class="form-check-label" for="<?php echo $uid; ?>2">Service Provider</label>
											</div>
										</div>
                                        <input type="hidden" name="id" value="<?php echo $uid; ?>" />
										<button type="button" style="float: left;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="submit" style="float: right;" class="btn btn-primary">Save</button>
									</form>									

								</div> <!-- end card-body-->
							</div> <!-- end card-->
						</div> <!-- end col-->
					</div>
				</div>
			
			</form>
		</div>
	</div>
</div>