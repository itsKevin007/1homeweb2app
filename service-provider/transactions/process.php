<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	case 'add':
		add_data();
		break;

	case 'submitAmount':
		submitProjectCost();
		break;

	case 'setPrice':
		set_price(); // New case for marking as Done
		break;

	case 'setPercentage':
		set_percentage(); // New case for marking as Done
		break;
	
	case 'startProject':
		startProject();
		break;

	case 'markDone':
		markDone();
		break;

	default:
		header('Location: index.php');
}

/*
    Add Data
*/
function add_data()
{
	include '../../global-library/database.php';
	$userId = $_SESSION['user_id'];

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$type = $_POST['type'];

	$chk = $conn->prepare("SELECT * FROM bs_client WHERE c_fname = '$c_fname' AND c_lname = '$c_lname' AND email = '$email' AND is_deleted != '1'");
	$chk->execute();
	if ($chk->rowCount() > 0) {
		header('Location: index.php?view=list&error=Data already exist! Data entry failed.');
	} else {
		$sql = $conn->prepare("INSERT INTO bs_client (c_fname, c_lname, email, sub_type,
                                                     date_added, added_by)
                                          VALUES ('$fname', '$lname', '$email', '$type',
                                                  '$today_date1', '$userId')");
		$sql->execute();

		$id = $conn->lastInsertId();
		$uid = md5($id);

		$up = $conn->prepare("UPDATE bs_client SET uid = '$uid' WHERE c_id = '$id'");
		$up->execute();

		$log = $conn->prepare("INSERT INTO tr_log (description, log_action_date, action_by) VALUES ('Client $fname $lname Added.', '$today_date1', '$userId')");
		$log->execute();

		header('Location: index.php?view=list&error=Added successfully.');
	}
}

/*
    Submit Project Cost
*/
function submitProjectCost()
{
	include '../../global-library/database.php';

	// Get data from the POST request
	$serviceId = isset($_POST['service_id']) ? intval($_POST['service_id']) : null;
	$projectCost = isset($_POST['projectCost']) ? floatval($_POST['projectCost']) : null;

	// Validate inputs
	if (!$serviceId || !$projectCost) {
		header('Location: index.php?view=transact&error=Invalid input. Please fill in all required fields.');
		exit();
	}

	try {
		// Prepare the SQL query to update the projectCost
		$query = "UPDATE accepted_services SET projectCost = :projectCost, status = 'ongoing'  WHERE service_id = :serviceId";
		$stmt = $conn->prepare($query);

		// Bind parameters to the query
		$stmt->bindParam(':projectCost', $projectCost, PDO::PARAM_STR);
		$stmt->bindParam(':serviceId', $serviceId, PDO::PARAM_INT);

		// Execute the query
		if ($stmt->execute()) {
			header('Location: index.php?view=transact&error=Project cost successfully updated.');
	
		} else {
			header('Location: index.php?view=transact&error=Failed to update project cost.');
		}
	} catch (PDOException $e) {
		header('Location: index.php?view=transact&error=Error: ' . $e->getMessage());
	}
}

function set_price()
{
include '../../global-library/database.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$serviceId = $_POST['serviceId'];
		$projectCost = $_POST['projectCost'];

		// Validate inputs
		if (empty($serviceId) || empty($projectCost) || !is_numeric($projectCost)) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			exit;
		}

		try {
			$stmt = $conn->prepare("UPDATE accepted_services SET projectCost = :projectCost, status = 'ongoing' WHERE id = :serviceId");
			$stmt->execute([':projectCost' => $projectCost, ':serviceId' => $serviceId]);

			if ($stmt->rowCount() > 0) {
				header('Location: ' . WEB_ROOT . 'service-provider/index.php?view=transact');
				
			} else {
				echo json_encode(['status' => 'error', 'message' => 'No changes made']);
			}
		} catch (PDOException $e) {
			echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
		}
	}
}

function set_percentage()
{
	include '../../global-library/database.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
		$percentage = isset($_POST['percentage']) ? intval($_POST['percentage']) : null;

		// Validate inputs
		if ($serviceId <= 0 || !is_numeric($percentage) || $percentage < 0 || $percentage > 100) {
			error_log("Invalid Input Detected: Service ID = $serviceId, Percentage = $percentage");
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			exit;
		}

		try {
			$stmt = $conn->prepare("UPDATE accepted_services SET percentage = :percentage WHERE service_id = :serviceId");

			$stmt->execute([':percentage' => $percentage, ':serviceId' => $serviceId]);

			if ($stmt->rowCount() > 0) {
				header('Location: ' . WEB_ROOT . 'service-provider/index.php?view=transact');
			} else {
				echo json_encode(['status' => 'error', 'message' => 'No changes made']);
			}
		} catch (PDOException $e) {
			echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
		}
	}
}

function startProject()
{
	include '../../global-library/database.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
		$date_started = isset($_POST['date_started']) ? $_POST['date_started'] : null;

		// Validate inputs
		if ($serviceId <= 0 || empty($date_started)) {
			error_log("Invalid Input Detected: Service ID = $serviceId, Date Started = $date_started");
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			exit;
		}

		try {
			$stmt = $conn->prepare("UPDATE accepted_services SET date_started = :date_started WHERE service_id = :serviceId");

			$stmt->execute([':date_started' => $date_started, ':serviceId' => $serviceId]);

			if ($stmt->rowCount() > 0) {
				header('Location: ' . WEB_ROOT . 'service-provider/index.php?view=transact');
			} else {
				echo json_encode(['status' => 'error', 'message' => 'No changes made']);
			}
		} catch (PDOException $e) {
			echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
		}
	}
}

function markDone()
{
	include '../../global-library/database.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
		$date_finish = isset($_POST['date_finish']) ? $_POST['date_finish'] : null;

		// Validate inputs
		if ($serviceId <= 0 || empty($date_finish)) {
			error_log("Invalid Input Detected: Service ID = $serviceId, Date Started = $date_started");
			echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
			exit;
		}

		try {
			$stmt = $conn->prepare("UPDATE accepted_services SET date_finish = :date_finish, status = 'done' WHERE service_id = :serviceId");

			$stmt->execute([':date_finish' => $date_finish, ':serviceId' => $serviceId]);

			if ($stmt->rowCount() > 0) {
				header('Location: ' . WEB_ROOT . 'service-provider/index.php?view=transact');
			} else {
				echo json_encode(['status' => 'error', 'message' => 'No changes made']);
			}
		} catch (PDOException $e) {
			echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
		}
	}
}
?>