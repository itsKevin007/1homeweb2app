<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../global-library/database.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if booking_id is passed via POST
if (isset($_POST['booking_id'])) {
    $bookingId = htmlspecialchars($_POST['booking_id']);

    if (!is_numeric($bookingId)) {
        die("Invalid booking ID.");
    }

    // Fetch booking details from tbl_bookings using the booking ID
    $query = "SELECT requested_service, booking_address, contact_num FROM tbl_bookings WHERE booking_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($requestedService, $bookingAddress, $contactNumber);

        if ($stmt->fetch()) {
            $service_id = 123;  // Example value
            $serProvId = 456;   // Example value

            $insertQuery = "INSERT INTO accepted_services (service_id, serProvId, accepted_at, aAddress, aContactNo, aReqServ)
                VALUES (?, ?, NOW(), ?, ?, ?)";

            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("iisss", $service_id, $serProvId, $bookingAddress, $contactNumber, $requestedService);

                if ($insertStmt->execute()) {
                    echo "Booking accepted successfully!";
                } else {
                    echo "Error accepting booking: " . $insertStmt->error;
                }
                $insertStmt->close();
            } else {
                echo "Error preparing the insert query: " . $conn->error;
            }
        } else {
            echo "Booking not found.";
        }
        $stmt->close();
    } else {
        die("Error preparing the select query: " . $conn->error);
    }
} else {
    echo "Booking ID not provided.";
}
