<?php
// Include necessary files
require_once '../../global-library/config.php';
require_once '../../include/functions.php';
include '../../global-library/database.php';

$s_id = $_GET['s_id'];

// Update the database
$sql = $conn->prepare("UPDATE bs_checkout SET is_read_notif = '1' WHERE s_id = :s_id");
$sql->bindValue(':s_id', $s_id, PDO::PARAM_INT); // Assuming user_id is an integer, use PDO::PARAM_INT
$sql->execute();

if ($sql->rowCount() > 0) {
    echo "Notification updated successfully";
} else {
    echo "Failed to update notification";
}

// Close database connection
$conn = null;
exit;
?>
