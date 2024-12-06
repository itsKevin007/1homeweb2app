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
<h6 class="mb-0 text-uppercase">User</h6><br>
					<?php
						if($errorMessage == 'Deleted successfully.')
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
						}else if($errorMessage == 'Added successfully.')
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
						 }else if($errorMessage == 'Data already exist! Data entry failed.')
						{
					?>	
						<div class="alert border-0 alert-dismissible fade show py-2">
								<div class="d-flex align-items-center">
									<div class="font-35 text-white"><i class="fadeIn animated bx bx-trash-alt"></i>
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
		<!-- Button trigger modal -->
										
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
					<div class="mb-3">
						<button type="button"  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-light"><i class='bx bx-user me-0'>+</i>
					</div>
					<?php include 'add.php'; ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Contact Number</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
					
						<tbody>
						<?php
							$sql = $conn->prepare("SELECT * FROM bs_user WHERE is_admin != '1' AND is_deleted != '1' ORDER BY lastname ASC");
							$sql->execute();
							
							if($sql->rowCount() > 0)
							{
								$ctr = 1;
								while($sql_data = $sql->fetch())
								{
									$name = $sql_data['firstname'] . ' ' . $sql_data['lastname'];
									$uid = $sql_data['uid'];
									
									if ($sql_data['thumbnail']) {
										$image = WEB_ROOT . 'adminpanel/assets/images/user/' . $sql_data['thumbnail'];
									} else {
										$image = WEB_ROOT . 'adminpanel/assets/images/user/noimage.png';
									}
									
									if ($sql_data['access_level'] == 1) {
										$disabled = "disabled";
									} else {
										$disabled = "";
									}
						?>
								<tr>
									<td><?php echo $ctr++; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $sql_data['contactno']; ?></td>
									<td><img src="<?php echo $image; ?>" alt="image" class=" bg-primary" width="100px" style="object-fit: cover;" /></td>
									<td>
										<a href="index.php?view=modify&id=<?php echo $uid; ?>">
											<div class="btn-group">                                                                                                      
													<button type="button" class="btn btn-light" aria-expanded="false"><i class="lni lni-pencil-alt"></i></span>
													<button type="button" class="btn btn-light">Modify</button>                                            
											</div>
										</a>
										&nbsp;  
										<a href="process.php?action=delete&id=<?php echo $uid; ?>">
											<div class="btn-group">                                                                                                      
													<button type="button" class="btn btn-danger" aria-expanded="false">	<span><i class="lni lni-trash"></i></span>
													<button type="button" class="btn btn-danger">Delete</button>                                            
											</div>
										</a>										                                            
									</td>
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