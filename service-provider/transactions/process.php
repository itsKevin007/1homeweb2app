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

	case 'markDone':
		markAsDone(); // New case for marking as Done
		break;

	default:
		// if action is not defined or unknown
		// move to main category page
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
		$query = "UPDATE accepted_services SET projectCost = :projectCost, status = 'ongoing' WHERE service_id = :serviceId";
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

/*
    Mark as Done
*/
function markAsDone()
{
	include '../../global-library/database.php';

	// Get data from the POST request
	$serviceId = isset($_POST['service_id']) ? intval($_POST['service_id']) : null;

	// Validate input
	if (!$serviceId) {
		header('Location: index.php?view=transact&error=Invalid input. Please provide a valid service ID.');
		exit();
	}

	try {
		// Prepare the SQL query to update the status to 'done'
		$query = "UPDATE accepted_services SET status = 'done' WHERE service_id = :serviceId";
		$stmt = $conn->prepare($query);

		// Bind parameters to the query
		$stmt->bindParam(':serviceId', $serviceId, PDO::PARAM_INT);

		// Execute the query
		if ($stmt->execute()) {
			header('Location: index.php?view=transact&error=Service successfully marked as done.');
		} else {
			header('Location: index.php?view=transact&error=Failed to mark service as done.');
		}
	} catch (PDOException $e) {
		header('Location: index.php?view=transact&error=Error: ' . $e->getMessage());
	}
}