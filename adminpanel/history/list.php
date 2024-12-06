<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

?>
<style rel="stylesheet">
td
{   
	vertical-align: super;
}
</style>
<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h3>History</h3>
						<form method="post" action="index.php?view=add">
							<button type="submit" class="btn btn-soft-success waves-effect rounded-pill waves-light" style="float: right;" href="index.php?view=add">
								<i class="mdi mdi-plus-thick"></i>
							</button>
						</form>
					<p class="text-muted font-14 mb-3"><br /></p>
					<?php
						if($errorMessage == 'Deleted successfully.')
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
					<table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap" style="width: 100%;">
						<thead>
						<tr>
							<th>Payment</th>
							<th>Name</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Service</th>
							<th>Price</th>
							<th>Appoint Date & Time</th>
							<th>Date</th>
						</tr>
						</thead>
					
						<tbody>
						<?php
							$clt = $conn->prepare("SELECT * FROM bs_client WHERE user_id = '$userId' AND is_deleted != '1'");
							$clt->execute();
							$clt_data = $clt->fetch();
								$cId = $clt_data['c_id'];
						
							$sln = $conn->prepare("SELECT * FROM bs_salon WHERE c_id = '$cId' AND is_deleted != '1'");
							$sln->execute();
							$sln_data = $sln->fetch();
								$sId = $sln_data['s_id'];

							$sql = $conn->prepare("SELECT * FROM bs_checkout WHERE s_id = '$sId' AND is_done = '1'");
							$sql->execute();

							if($sql->rowCount() > 0)
							{
								while($sql_data = $sql->fetch())
								{
									$pay_method = $sql_data['pay_method'];
									$name = $sql_data['name'];
									$email = $sql_data['email'];
									$contactno = $sql_data['contactno'];
									$ser_name = $sql_data['ser_name'];
									$ser_price = $sql_data['ser_price'];
									$date = $sql_data['date'];
									$time = $sql_data['time'];
									$created_at = $sql_data['created_at'];
						?>
							<tr>
								<td><?php echo $pay_method; ?></td>
								<td><?php echo $name; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $contactno; ?></td>
								<td><?php echo $ser_name; ?></td>
								<td><?php echo $ser_price; ?></td>
								<td><?php echo $time; ?> , <?php echo $date; ?></td>
								<td><?php echo $created_at; ?></td>
							</tr>
					<?php
							}
						} else {}
					?>
						</tbody>
					</table>
				</div>
			</div>
		   
		</div>
	</div> <!-- end row -->