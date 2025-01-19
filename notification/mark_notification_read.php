<?php
// mark_notification_read.php
header('Content-Type: application/json');
include '../global-library/database.php';
try {
    if (isset($_POST['notification_id'])) {
        $notificationId = (int)$_POST['notification_id'];
        
        $updateSQL = $conn->prepare("UPDATE tbl_notifications SET is_read = '1' WHERE n_id = :notificationId");
        $updateSQL->bindParam(':notificationId', $notificationId, PDO::PARAM_INT);
        $success = $updateSQL->execute();
        
        echo json_encode(['success' => $success]);  
    } else {
        echo json_encode(['success' => false, 'error' => 'No notification ID provided']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
