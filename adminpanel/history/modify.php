<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	$id = $_GET['id'];
	
	$sql = $conn->prepare("SELECT * FROM bs_dep WHERE uid = '$id' AND is_deleted != '1'");
	$sql->execute();
	$sql_data = $sql->fetch();

	$d_name = $sql_data['d_name'];
	$d_description = $sql_data['d_description'];
?>
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<h3>Modify Department</h3>
							<!-- <p class="sub-header"><br /></p> -->
						<?php
							if($errorMessage == 'Modified successfully.')
							{
						?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								<i class="mdi mdi-check-all me-2"></i> <strong><?php echo $errorMessage; ?></strong>
							</div>
						<?php
							}
							else if($errorMessage == 'Data already exist! Data entry failed.')
							{
						?>	
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								<i class="mdi mdi-block-helper me-2"></i> <strong><?php echo $errorMessage; ?></strong>
							</div>
						<?php								
							} else {}
						?>
							<form class="needs-validation" novalidate method="post" action="process.php?action=modify"  enctype="multipart/form-data" name="form" id="form">
								<div class="mb-3">
									<label for="d_name" class="form-label">Name: </label>
									<input type="text" class="form-control" id="d_name" name="d_name" placeholder="Department Name" value="<?php echo $d_name; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a valid Department name.
									</div>
								</div>
								<div class="mb-3">
									<label for="d_description" class="form-label">Description: </label>
									<input type="text" class="form-control" id="d_description" name="d_description" placeholder="Department Description" value="<?php echo $d_description; ?>" autocomplete="off" required />
									<div class="invalid-feedback">
										Please provide a Description.
									</div>
								</div>
								
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<a class="btn btn-outline-dark" style="float: left;" href="index.php">Cancel</a>
								<button class="btn btn-success" type="submit" style="float: right;">Save</button>
							</form>

						</div> <!-- end card-body-->
					</div> <!-- end card-->
				</div> <!-- end col-->
			</div>
			<!-- end row -->
		</div> <!-- container -->
	</div> <!-- content -->