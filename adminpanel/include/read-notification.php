<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';
include '../../global-library/database.php';

$s_id = $_GET['s_id'];
$checkout_id = $_GET['checkout_id'];

$sql = $conn->prepare("UPDATE bs_checkout SET is_notification = '1', is_view_notif = '1' WHERE s_id = :s_id AND checkout_id = :checkout_id");
$sql->bindValue(':s_id', $s_id, PDO::PARAM_STR);
$sql->bindValue(':checkout_id', $checkout_id, PDO::PARAM_INT);
$sql->execute();

// Add error handling if necessary

header("Location: " . WEB_ROOT . "adminpanel/sent_appointment/index.php?view=list&s_id=$s_id");

// Close database connection
$conn = null;
?>
