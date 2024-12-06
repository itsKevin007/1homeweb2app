<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';
include '../../global-library/database.php';

$s_id = $_GET['s_id'];

    $notif = $conn->prepare("SELECT * FROM bs_checkout WHERE s_id = '$s_id' AND is_approved != '1' AND is_read_notif != '1' AND is_deleted != '1'");
    $notif->execute();
    if($notif->rowCount() > 0)
	{
?>
	<span class="badge bg-danger rounded-circle noti-icon-badge count"><?php echo $notif->rowCount(); ?></span> 
<?php
	}else{
?>
    <span class="rounded-circle noti-icon-badge count"></span> 
<?php
    }
?>