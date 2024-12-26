<!-- Modal -->
<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal">Add Service Product</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="card">
					<div class="container">
						<div id="profile-third-sec">
							<div class="container">
								<div class="profile-third-sec-full mt-24">
									<form method="POST" action="process.php?action=add">
							
																				
												<div class="accordion-item border-0 mt-24">

														<div class="row mt-16">     
															<div id="map1" style="height: 300px; width: 100%;"></div> <!-- Adjust height as needed -->
															<input type="hidden" class="form-control form-control-sm" id="long" name="long" placeholder="Long" autocomplete="off" required />
															<input type="hidden" class="form-control form-control-sm" id="lat" name="lat" placeholder="Lat" autocomplete="off" required />
														</div> 											

														<div class="mt-16">
															<center><label class="mt-16"><b>Address</b></label></center>
															<textarea type="text" rows="2" class="form-control" id="address" name="address" placeholder="Area Address" autocomplete="off" readonly required></textarea>
														</div>
																				
													<div class="faq-bottom-border"></div>
												</div>						

											<div class="profile-boder mt-24"></div>
							
										<div style="text-align: center;">
											<button type="submit" class="btn btn-primary"   onClick="return confirmSubmit()">SUBMIT</button>
										</div>
										<br><br>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

