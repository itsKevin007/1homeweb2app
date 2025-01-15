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
	if(($dfrom != '') && ($dto != '')){ $datefilter = "AND sub_date BETWEEN '$newfrom' and '$newto'"; }


}else{ $dfrom = ""; $dto = ""; $fromto = ""; $datefilter = "AND sub_date = '$today_date2'"; }

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
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="lni lni-user"></i>
                                </div>
                                <div class="tab-title">&nbsp;Client</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="lni lni-users"></i>
                                </div>
                                <div class="tab-title">&nbsp;Service Provider</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                        <?php include 'client.php'; ?>
                    </div>
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <?php include 'service-provider.php'; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
				
