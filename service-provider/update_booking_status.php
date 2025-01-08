<?php
require_once '../global-library/config.php'; // Include your database connection file
include '../global-library/database.php'; // Include database file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = intval($_POST['booking_id']);
    $status = intval($_POST['status']);

    if ($bookingId && in_array($status, [1, 2])) { // Accept or Decline
        try {
            // Check if booking ID exists
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM tbl_bookings WHERE booking_id = :booking_id");
            $checkStmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
            $checkStmt->execute();

            if ($checkStmt->fetchColumn() == 0) {
                echo json_encode(['success' => false, 'message' => 'Invalid booking ID']);
                exit; // Stop further execution
            }

            // Update the booking status
            $stmt = $conn->prepare("UPDATE tbl_bookings SET booking_status = :status WHERE booking_id = :booking_id");
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Booking status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update booking status']);
            }
        } catch (Exception $e) {
            error_log($e->getMessage()); // Log error for debugging
            echo json_encode(['success' => false, 'message' => 'An error occurred while updating the booking']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>