<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

if (isset($_POST['subscribe'])) {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
            title: 'Success!',
            icon: 'success', // Options: 'success', 'error', 'warning', 'info', 'question'
            showConfirmButton: true,
            confirmButtonText: 'Confirm',
            timer: 5000, // Auto-dismiss after 5 seconds
            timerProgressBar: true,
            backdrop: 'rgba(0, 0, 0, 0.8)', // Dark semi-transparent backdrop
            background: '#1e1e1e', // Dark background color
            color: '#ffffff', // White text color
            customClass: {
                popup: 'swal2-dark swal2-rounded', // Rounded corners and dark style
                confirmButton: 'swal2-confirm-dark' // Custom style for the button
            }
            });
        });
    </script>
    <?php

}

?>
<style rel="stylesheet">
td {
    vertical-align: super;
}
</style>
<di class="row">
    <div class="col-6">
        <h6 class="mb-0 text-uppercase text-left">History</h6>
    </div>
</div>
        <hr/>
<div class="row">
        
        <div class="col-6">
        <h6 class="mb-0 text-uppercase">&nbsp;&nbsp;Client</h6><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <div class="mb-3">
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-light"><i class='bx bx-user me-0'>+</i>
                        </div>
                        -->
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                $sql = $conn->prepare("SELECT * FROM tbl_subscription WHERE is_deleted != :is_deleted AND is_done = :is_done");
                                $sql->bindValue(':is_done', '1', PDO::PARAM_INT);
                                $sql->bindValue(':is_deleted', '1', PDO::PARAM_INT);
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    $ctr = 1;
                                    while ($sql_data = $sql->fetch()) {
                                        if ($sql_data !== false) { // Check if $sql_data is not false

                                            $userIds = $sql_data['userId'];
                                            $refNo = $sql_data['refNo'];
                                            $uid = $sql_data['uid'];
                                            $accessLevelNum = '0';

                                            $user = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId AND access_level = :access_level");
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
                                                <td><?php echo $ctr++; ?></td>
                                                <td><?php echo $accessLevel; ?></td>
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
                                                    <a href="process.php?action=confirm&id=<?php echo $uidUser; ?>&id1=<?php echo $uid; ?>"  onClick="return confirmSubmit()">
                                                        <div class="btn-group">                                                                                                      
                                                                <button type="button" class="btn btn-success px-3 radius-30" aria-expanded="false"><span><i class="lni lni-checkmark"></i></span>                                           
                                                        </div>
                                                    </a>
                                                    <?php include '../modify.php'; ?>
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

        <div class="col-6">
        <h6 class="mb-0 text-uppercase">Service Provider</h6><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <div class="mb-3">
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-light"><i class='bx bx-user me-0'>+</i>
                        </div>
                        -->
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                $sql = $conn->prepare("SELECT * FROM tbl_subscription WHERE is_deleted != :is_deleted AND is_done = :is_done");
                                $sql->bindValue(':is_done', '1', PDO::PARAM_INT);
                                $sql->bindValue(':is_deleted', '1', PDO::PARAM_INT);
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    $ctr = 1;
                                    while ($sql_data = $sql->fetch()) {
                                        if ($sql_data !== false) { // Check if $sql_data is not false

                                            $userIds = $sql_data['userId'];
                                            $refNo = $sql_data['refNo'];
                                            $uid = $sql_data['uid'];
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
                                                <td><?php echo $ctr++; ?></td>
                                                <td><?php echo $accessLevel; ?></td>
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
                                                    <a href="process.php?action=confirm&id=<?php echo $uidUser; ?>&id1=<?php echo $uid; ?>"  onClick="return confirmSubmit()">
                                                        <div class="btn-group">                                                                                                      
                                                                <button type="button" class="btn btn-success px-3 radius-30" aria-expanded="false"><span><i class="lni lni-checkmark"></i></span>                                          
                                                        </div>
                                                    </a>
                                                    <?php include '../modify.php'; ?>
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