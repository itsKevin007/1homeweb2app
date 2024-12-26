<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

?>
<style rel="stylesheet">
td {
    vertical-align: super;
}
</style>
<h6 class="mb-0 text-uppercase">Subscriber / Client</h6><br>
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
						}else if($errorMessage == 'Modified successfully.')
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
                                <th>Subscriber Type</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = $conn->prepare("SELECT * FROM bs_client WHERE is_deleted != :is_deleted AND c_id != :c_id AND sub_type = '1' ORDER BY c_fname ASC");
                            $sql->bindValue(':is_deleted', '1', PDO::PARAM_INT);
                            $sql->bindValue(':c_id', '1', PDO::PARAM_INT);
                            $sql->execute();

                            if ($sql->rowCount() > 0) {
                                $ctr = 1;
                                while ($sql_data = $sql->fetch()) {
                                    if ($sql_data !== false) { // Check if $sql_data is not false
                                        $fname = $sql_data['c_fname'];
                                        $lname = $sql_data['c_lname'];
                                        $name = $fname . ' ' . $lname;
                                        $c_id = $sql_data['c_id'];
                                        $sub = $sql_data['sub_type'];
                                        $email = $sql_data['email'];
                                        $uid = $sql_data['uid'];
                                        if ($sql_data['thumbnail']) {
                                            $image = WEB_ROOT . 'adminpanel/assets/images/client/' . $sql_data['thumbnail'];
                                        } else {
                                            $image = WEB_ROOT . 'adminpanel/assets/images/client/noimage.png';
                                        }

                                        if ($sub == '1') {
                                            $subs = 'Subscriber';
                                        }else{
                                            $subs = 'Contractor';
                                        }

                                        ?>
                                        <tr>
                                            <td><?php echo $ctr++; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $subs; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><img src="<?php echo $image; ?>" alt="image" class=" bg-primary" width="100px" style="object-fit: cover;" /></td>
                                            <td>

                                                    <div class="btn-group">                                                                                                      
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $uid; ?>" class="btn btn-light px-3 radius-30" aria-expanded="false"><i class="lni lni-pencil-alt"></i>
                                                            Modify</button>                                            
                                                    </div>&nbsp;

                                                <a href="process.php?action=delete&id=<?php echo $c_id; ?>"  onClick="return confirmDelete()">
                                                    <div class="btn-group">                                                                                                      
                                                            <button type="button" class="btn btn-danger px-3 radius-30" aria-expanded="false"><span><i class="lni lni-trash"></i></span>
                                                            <button type="button" class="btn btn-danger px-3 radius-30">Delete</button>                                            
                                                    </div>
                                                </a>
                                                <?php include 'modify.php'; ?>
                                                &nbsp;                                              
                                            </td>
                                        </tr>
                            <?php
                                        }else{}
                                    }
                                }else{}

                            ?>
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>