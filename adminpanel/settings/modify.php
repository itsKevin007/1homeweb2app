<div class="modal fade" id="modify" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			
				<div class="modal-header">
					<h5 class="modal-title">MODIFY</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="process.php?action=update" enctype="multipart/form-data" name="form" id="form" class="row g-3">
					<div class="modal-body">					
						<div class="col-md-12">
							<label for="ContactNo" class="form-label">Contact Number</label>
							<div class="input-group"> <span class="input-group-text"><i class='lni lni-phone'></i></span>
								<input type="text" name="contactNum" class="form-control border-start-0" id="ContactNo" value="<?php echo $contactNum; ?>" placeholder="Contact number for customer assistance" required/>
							</div>
						</div>							
					</div>
					<div class="modal-footer">
						<button type="submit"  class="btn btn-primary"  onClick="return confirmSubmit()">Save changes</button>
					</div>
				</form>
			</form>
		</div>
	</div>
</div>