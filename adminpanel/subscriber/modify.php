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
										
										<div style="width: 100%; height: 0; padding-bottom: 75%; position: relative;">
											<img src="<?php echo $image; ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-position: center;" />
										</div>  

                                        <input type="hidden" name="id" value="<?php echo $uid; ?>" />
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