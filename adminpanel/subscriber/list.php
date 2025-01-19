<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

if (isset($_POST['subscribe'])) {
	?>
		<script>
			document.addEventListener("DOMContentLoaded", () => {
				// Call the function directly
				Lobibox.notify('success', {
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					icon: 'bx bx-check-circle',
					msg: 'Subscription confirm.'
				});
			});
		</script>
	<?php
		}else{}
	?>
    
<style rel="stylesheet">
td {
    vertical-align: super;
}
</style>
<div class="row">
    <div class="col-6">
        <h6 class="mb-0 text-uppercase text-left">Subscriber</h6>
    </div>

    <div class="col-6">
        <a href="history/"  style="float: right;" class="btn btn-light"><i class="fadeIn animated bx bx-history"></i></a>
    </div>
</div>
        <hr/>
<div class="row">
        
    <div class="col-lg-6">
        <h6 class="mb-0 text-uppercase">&nbsp;&nbsp;Client</h6><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <div class="mb-3">
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-light"><i class='bx bx-user me-0'>+</i>
                        </div> -->
                       
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                         
                                    <th>Sub Type</th> 
                                    <th>Sub Level</th>
                                    <th>Name</th>                          
                                    <th>Email</th>                                
                                    <th>Reference No</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM tbl_subscription WHERE is_done != :is_done");
                                $sql->bindValue(':is_done', '1', PDO::PARAM_INT);
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    $ctr = 1;
                                    while ($sql_data = $sql->fetch()) {
                                        if ($sql_data !== false) { // Check if $sql_data is not false

                                            $userIds = $sql_data['userId'];
                                            $refNo = $sql_data['refNo'];
                                            $uid = $sql_data['uid'];
                                            $accessLevelNum = '0';
                                            $subType = $sql_data['subType'];

                                            if ($subType == '0') {
                                                $subTypeName = 'Basic';
                                            }else{
                                                $subTypeName = 'Premium';
                                            }

                                            $user = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId AND access_level = :access_level");
                                            $user->bindParam(':userId', $userIds, PDO::PARAM_INT);
                                            $user->bindParam(':access_level', $accessLevelNum, PDO::PARAM_INT);
                                            $user->execute();
                                            if($user->rowCount() > 0){
                                            $user_data = $user->fetch();
                                            $accessLevel1 = $user_data['access_level'];
                                            $uidUser = $user_data['uid'];

                                            if($accessLevel1 == '0'){
                                                $accessLevel = 'Client';
                                            }elseif($accessLevel1 == '1'){
                                                $accessLevel = 'Independent';
                                            }elseif($accessLevel1 == '2'){
                                                $accessLevel = 'Company';
                                            }else{
                                                $accessLevel = '';
                                            }

                                            $name = $user_data['firstname'] . ' ' . $user_data['lastname'];
                                            $email = $user_data['email'];

                                            if ($sql_data['thumbnail']) {
                                                $image = WEB_ROOT . 'assets/images/subscription/' . $sql_data['thumbnail'];
                                            } else {
                                                $image = WEB_ROOT . 'adminpanel/assets/images/client/noimage.png';
                                            }

                                            ?>
                                            
                                            <tr>
                                
                                                <td><?php echo $accessLevel; ?></td>
                                                <td><?php echo $subTypeName; ?></td>
                                                <td><?php echo $name; ?></td>                                        
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $refNo; ?></td>
                                                <td>

                                                        <div class="btn-group">                                                                                                      
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $uid; ?>" class="btn btn-light px-3 radius-30" aria-expanded="false"><i class="lni lni-eye"></i>
                                                                </button>                                            
                                                        </div>&nbsp;

                                                </td>
                                                <td>
                                                    <a href="process.php?action=confirm&id=<?php echo $uidUser; ?>&id1=<?php echo $uid; ?>&subType=<?php echo $subType; ?>"  onClick="return confirmSubmit()">
                                                        <div class="btn-group">                                                                                                      
                                                                <button type="button" class="btn btn-success px-3 radius-30" aria-expanded="false"><span><i class="lni lni-checkmark"></i></span>                                           
                                                        </div>
                                                    </a>
                                                    <?php include 'modify.php'; ?>
                                                    &nbsp;                                              
                                                </td>
                                            </tr>
                                <?php
                                                }else{}
                                            }else{}
                                        }
                                    }else{}

                                ?>
                            </tbody>
                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
        <h6 class="mb-0 text-uppercase">Service Provider</h6><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <div class="mb-3">
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-light"><i class='bx bx-user me-0'>+</i>
                        </div>
                        -->
                        <table id="service" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                    <th>Sub Type</th> 
                                    <th>Name</th>                          
                                    <th>Email</th>                                
                                    <th>Reference No</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM tbl_subscription WHERE is_done != :is_done");
                                $sql->bindValue(':is_done', '1', PDO::PARAM_INT);
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    $ctr = 1;
                                    while ($sql_data = $sql->fetch()) {
                                        if ($sql_data !== false) { // Check if $sql_data is not false

                                            $userIds = $sql_data['userId'];
                                            $refNo = $sql_data['refNo'];
                                            $uid1 = $sql_data['uid'];
                                            $accessLevelNum = '0';
                                            
                                            $user = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId AND access_level != :access_level");
                                            $user->bindParam(':userId', $userIds, PDO::PARAM_INT);
                                            $user->bindParam(':access_level', $accessLevelNum, PDO::PARAM_INT);
                                            $user->execute();
                                            $user_data = $user->fetch();
                                            if($user->rowCount() > 0){

                                            
                                            $accessLevel1 = $user_data['access_level'];
                                            $uidUser = $user_data['uid'];

                                            if($accessLevel1 == '0'){
                                                $accessLevel = 'Client';
                                            }elseif($accessLevel1 == '1'){
                                                $accessLevel = 'Independent';
                                            }elseif($accessLevel1 == '2'){
                                                $accessLevel = 'Company';
                                            }else{
                                                $accessLevel = '';
                                            }

                                            $name = $user_data['firstname'] . ' ' . $user_data['lastname'];
                                            $email = $user_data['email'];

                                            if ($sql_data['thumbnail']) {
                                                $image = WEB_ROOT . 'assets/images/subscription/' . $sql_data['thumbnail'];
                                            } else {
                                                $image = WEB_ROOT . 'adminpanel/assets/images/client/noimage.png';
                                            }

                                            ?>
                                            
                                            <tr>
                                              
                                                <td><?php echo $accessLevel; ?></td>
                                                <td><?php echo $name; ?></td>                                        
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $refNo; ?></td>
                                                <td>

                                                    <div class="btn-group">                                                                                                      
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $uid1; ?>" class="btn btn-light px-3 radius-30" aria-expanded="false"><i class="lni lni-eye"></i>
                                                            </button>                                            
                                                    </div>&nbsp;

                                                </td>
                                                <td>
                                                    <a href="process.php?action=confirm&id=<?php echo $uidUser; ?>&id1=<?php echo $uid1; ?>"  onClick="return confirmSubmit()">
                                                        <div class="btn-group">                                                                                                      
                                                                <button type="button" class="btn btn-success px-3 radius-30" aria-expanded="false"><span><i class="lni lni-checkmark"></i></span>                                          
                                                        </div>
                                                    </a>
                                                    <?php include 'modify.php'; ?>
                                                    &nbsp;                                      
                                                </td>
                                            </tr>
                                <?php
                                                }else{} // rowcount for user    
                                            }else{}
                                        }
                                    }else{}

                                ?>
                            </tbody>
                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
	  
	  $(document).ready(function() {
	  $('#service').DataTable()
	});
	  
</script>