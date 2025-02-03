<?php

	include '../../global-library/database.php';	
	require_once '../../global-library/config.php';

	if (isset($_POST['id']) && isset($_POST['is_active'])) {
		$id = $_POST['id'];
		$isActive = $_POST['is_active'];
		$today_date1 = date('Y-m-d H:i:s');

		// Update the active status
		$sql = $conn->prepare("UPDATE tbl_location SET is_active = :is_active, date_deleted = :date_deleted, deleted_by = :deleted_by WHERE uid = :id");
		$sql->execute([
			':is_active' => $isActive,
			':date_deleted' => $today_date1,
			':deleted_by' => $userId,
			':id' => $id
		]);

		// Log the action
		$log = $conn->prepare("INSERT INTO tr_log (module, action, description, action_by, log_action_date)
							VALUES ('Location', 'Location Status Updated', :id, :userId, :today_date1)");
		$log->execute([
			':id' => $id,
			':userId' => $userId,
			':today_date1' => $today_date1
		]);

		echo json_encode(['status' => 'success', 'is_active' => $isActive]);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
	}

?>