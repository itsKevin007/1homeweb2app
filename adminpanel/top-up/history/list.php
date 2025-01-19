<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';


if(isset($_POST['submit']))
{
	$dfrom = (isset($_POST['fromDate']) ? $_POST['fromDate'] : (isset($_GET['fromDate']) ? $_GET['fromDate'] : ''));
	$dto = (isset($_POST['toDate']) ? $_POST['toDate'] : (isset($_GET['toDate']) ? $_GET['toDate'] : '')); 
	$newfrom = date("Y-m-d", strtotime($dfrom));
	$newto = date("Y-m-d", strtotime($dto));
	$fromto = "&from=$newfrom&to=$newto";
	if(($dfrom != '') && ($dto != '')){ $datefilter = "AND date_approve BETWEEN '$newfrom' and '$newto'"; }


}else{ $dfrom = ""; $dto = ""; $fromto = ""; $datefilter = "AND date_approve = '$today_date2'"; }

?>
<style rel="stylesheet">
    td {
        vertical-align: super;
    }
</style>

<h6 class="mb-0 text-uppercase">history</h6><br>
    <div class="col">
        <div class="row">   
            <div class="col-lg-6">                
                <div class="card-body">
                    <form method="post" action="<?php echo ADM_ROOT; ?>top-up/history/ ?>">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">From:</span>
                                    <input type="date" name="fromDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">To:</span>
                                    <input type="date" name="toDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" name="submit" class="btn btn-light px-3 radius-30">Search</button>  
                            </div> 
                        </div>
                    </form>
                </div>      
            </div>
        </div>
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
                                    <th>Reference No.</th>
                                    <th>Image</th>
                                    <th>Approved By</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = $conn->prepare("SELECT * FROM tbl_topup WHERE is_done = :is_done $datefilter ");
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
                                            $approvedBy = $sql_data['approved_by'];

                                            $userBy = $conn->prepare("SELECT * FROM bs_user WHERE user_id = :approved_by");
                                            $userBy->bindParam(':approved_by', $approvedBy, PDO::PARAM_INT);
                                            $userBy->execute();
                                            $userByData = $userBy->fetch();
                                            $nameBy = $userByData['firstname'] . ' ' . $userByData['lastname'];


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
                                                <td><?php echo $refNo; ?></td>                                        
                                                <td>
                                                   <div class="btn-group">                                                                                                      
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $uid; ?>" class="btn btn-light px-3 radius-30" aria-expanded="false"><i class="lni lni-eye"></i>
                                                            </button>                                            
                                                    </div>&nbsp;

                                                </td>
                                        
                                                    <?php include '../modify.php'; ?>
                                                    &nbsp;                                              
                                                
                                                <td><?php echo $nameBy; ?></td> 
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
				
