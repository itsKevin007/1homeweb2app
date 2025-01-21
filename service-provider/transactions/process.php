<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {

	case 'markDone':
		markAsDone(); // New case for marking as Done
		break;

	default:
		// if action is not defined or unknown
		// move to main category page
		header('Location: index.php');
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
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			header('Location: index.php?view=transact&error=Failed to mark service as done.');
		}
	} catch (PDOException $e) {
		header('Location: index.php?view=transact&error=Error: ' . $e->getMessage());
	}
}

?>