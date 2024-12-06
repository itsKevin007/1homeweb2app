<?php
require_once '../global-library/config.php';
require_once '../include/functions.php';
include '../global-library/database.php';


    $notif = $conn->prepare("SELECT * FROM bs_checkout WHERE user_id = '$userId' AND is_approved != '0' AND is_deleted != '1'");
    $notif->execute();
    if($notif->rowCount() > 0)
	{
?>
<b><span class="badge bg-danger rounded-circle noti-icon-badge count" style="position: relative; top: -45px; right: -15px;"><?php echo $notif->rowCount(); ?></span></b>
<?php
	}else{
?>
    <span class="badge bg-danger rounded-circle noti-icon-badge count"></span> 
<?php
    }
?>