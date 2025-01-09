<!-- Modal -->
<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addServiceModalLabel">Edit Profile Picture</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="../profile/process.php?action=imgprof" method="POST" enctype="multipart/form-data">
					
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