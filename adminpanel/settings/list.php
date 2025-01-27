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
					msg: 'Update Successful.'
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
        <h6 class="mb-0 text-uppercase text-left">Content Management</h6>
    </div>
</div>
        <hr/>
<div class="row">
    <div class="col-12">
        <h6 class="mb-0 text-uppercase">&nbsp;&nbsp;WEBSITE/APP CONTENTS</h6><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-3">
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#modify" class="btn btn-light"><i class="lni lni-cogs"></i>
                        </div>
                       
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                         
                                    <th>Contact No.</th> 
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM tbl_management");
                                $sql->execute();

                                if ($sql->rowCount() > 0) {
                                    $ctr = 1;
                                    while ($sql_data = $sql->fetch()) {
                                        if ($sql_data !== false) { // Check if $sql_data is not false

                                            $contactNum = $sql_data['contactNum'];

                                

                                            ?>
                                            
                                            <tr>
                                
                                                <td><?php echo $contactNum; ?></td>
                              
                                                    <?php include 'modify.php'; ?>
                                                 
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
        </div>
        
</div>

<script>
	  
	  $(document).ready(function() {
	  $('#service').DataTable()
	});
	  
</script>