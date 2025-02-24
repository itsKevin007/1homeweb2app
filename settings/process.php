<?php
require_once '../global-library/config.php';
require_once '../global-library/database.php';

header('Content-Type: application/json'); // Set JSON response type
ini_set('display_errors', 0); // Hide errors in response
error_reporting(E_ALL); // Log errors instead

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = delete_data();
    echo json_encode($response);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

function delete_data()
{
    global $conn;

    if (!isset($_SESSION['user_id'])) {
        return ['success' => false, 'message' => 'User not logged in'];
    }

    $userId = $_SESSION['user_id'];
    $today_date1 = date('Y-m-d H:i:s');
	$today_date2 = date('Y-m-d', strtotime('+15 days'));
    try {
        $sql = $conn->prepare("INSERT INTO tbl_accdelete (userId, date_deleted, date_expected, is_confirm) VALUES (:userId, :dateDeleted, :dateExp, 1)");
        $sql->bindParam(':userId', $userId);
        $sql->bindParam(':dateDeleted', $today_date1);
		$sql->bindParam(':dateExp', $today_date2);
        $sql->execute();

        $log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
                               VALUES ('User', 'User Deleted', 'Deletion of account', :userId, :logDate)");
        $log->bindParam(':userId', $userId);
        $log->bindParam(':logDate', $today_date1);
        $log->execute();

        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}
?>
