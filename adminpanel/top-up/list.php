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
        <h6 class="mb-0 text-uppercase text-left">Top Up / Cash In</h6>
    </div>

    <div class="col-6">
        <a href="history/"  style="float: right;" class="btn btn-light"><i class="fadeIn animated bx bx-history"></i></a>
    </div>
</div>
        <hr/>
<div class="row">
        
    <div class="col-lg-12">
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
                                    <th>Name</th>    
                                    <th>Amount</th>                                                                                     
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM tbl_topup WHERE is_done != :is_done");
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
                                            $pay_amount = $sql_data['pay_amount'];

                                            $user = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :userId");
                                            $user->bindParam(':userId', $userIds, PDO::PARAM_INT);
                                            $user->execute();
                                            if($user->rowCount() > 0){
                                            $user_data = $user->fetch();
                                            $uidUser = $user_data['uid'];
                                            $name = $user_data['firstname'] . ' ' . $user_data['lastname'];


                                            if ($sql_data['thumbnail']) {
                                                $image = WEB_ROOT . 'assets/images/top-up/' . $sql_data['thumbnail'];
                                            } else {
                                                $image = WEB_ROOT . 'adminpanel/assets/images/client/noimage.png';
                                            }

                                            ?>
                                            
                                            <tr>
                                
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $pay_amount; ?></td>                                     
                                                <td>
                                                   <div class="btn-group">                                                                                                      
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $uid; ?>" class="btn btn-light px-3 radius-30" aria-expanded="false"><i class="lni lni-eye"></i>
                                                            </button>                                            
                                                    </div>&nbsp;

                                                </td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-success px-3 radius-30 confirm-topup" 
                                                            data-uid="<?php echo $uid; ?>" 
                                                            data-user-id="<?php echo $userIds; ?>">
                                                        <span><i class="lni lni-checkmark"></i></span>
                                                    </button>
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle top-up confirmation clicks
    document.querySelectorAll('.confirm-topup').forEach(button => {
        button.addEventListener('click', function() {
            if (!confirm('Are you sure you want to confirm this top-up?')) {
                return;
            }

            const uid = this.dataset.uid;
            const userId = this.dataset.userId;
            const button = this;

            // Disable the button while processing
            button.disabled = true;

            // Create FormData object
            const formData = new FormData();
            formData.append('action', 'topUp');
            formData.append('id', uid);
            formData.append('ids', userId);

            // Send AJAX request
            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-check-circle',
                        msg: 'Top-up confirmed successfully'
                    });

                    // Remove the row from the table
                    button.closest('tr').remove();

                    // Optionally refresh the table if using DataTables
                    if (typeof $('#example').DataTable === 'function') {
                        $('#example').DataTable().ajax.reload();
                    }
                } else {
                    throw new Error(data.message || 'Failed to process top-up');
                }
            })
            .catch(error => {
                // Show error notification
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-x-circle',
                    msg: error.message
                });
                
                // Re-enable the button
                button.disabled = false;
            });
        });
    });
});
</script>

<script>
	  
	  $(document).ready(function() {
	  $('#service').DataTable()
	});
	  
</script>