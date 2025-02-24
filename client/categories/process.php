<?php

require_once '../../global-library/config.php';
require_once '../../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {

	case 'addBooking':
		add_booking();
		break;

    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


function add_booking()
{
	global $conn;

	$userId = $_SESSION['user_id'];
	$requested_service = $_POST['requested_service'] ?? '';
	$booking_address   = $_POST['booking_address'] ?? '';
	$contact_num       = $_POST['contact_num'] ?? '';
	$roomNo            = $_POST['roomNo'] ?? '';
	$created_at        = $_POST['created_at'] ?? '';

	// echo "userId: $userId, requested_service: $requested_service, booking_address: $booking_address, contact_num: $contact_num, roomNo: $roomNo, created_at: $created_at <br>";

	try {
		$stmt = $conn->prepare("INSERT INTO tbl_bookings (user_id, requested_service, booking_address, contact_num, roomNo, created_at)
        VALUES (:user_id, :requested_service, :booking_address, :contact_num, :roomNo, :created_at)");

		$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':requested_service', $requested_service, PDO::PARAM_STR);
		$stmt->bindParam(':booking_address', $booking_address, PDO::PARAM_STR);
		$stmt->bindParam(':contact_num', $contact_num, PDO::PARAM_STR);
		$stmt->bindParam(':roomNo', $roomNo, PDO::PARAM_STR);
		$stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

		$stmt->execute();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	} catch (PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}
}

?>