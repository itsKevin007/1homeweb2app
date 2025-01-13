<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/transTable.css">

<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

// Handle cancelBooking action
if (isset($_GET['action']) && $_GET['action'] === 'cancelBooking') {
    // Get the JSON payload
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['booking_id'])) {
        $booking_id = $data['booking_id'];

        // Prepare the SQL statement to delete the booking
        $stmt = $conn->prepare("DELETE FROM tbl_bookings WHERE booking_id = :booking_id");
        $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error occurred']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid booking ID']);
    }
    exit;
}

// Prepare the query to fetch bookings for the current user
$book = $conn->prepare("SELECT * FROM tbl_bookings WHERE user_id = :userId");
$book->bindParam(':userId', $userId, PDO::PARAM_INT);
$book->execute();
?>

<div class="homepage-second-sec">
    <div style="width: 100%;">
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(87deg, rgba(2, 44, 92, 1) 1%, rgba(4,69,117,1) 100%); height: 60px;">
            <h2 style="color: #d7d7df; font-weight: 600;">Transactions</h2>
        </div>
    </div>

    <div style="width: 100%; margin-bottom: 15px;">
        <div class="mt-16">
            <h3 style="margin-left: 5%;">As of <?php echo date('F j, Y'); ?></h3>
        </div>
    </div>

    <div style="background-color: #fff;" >
        <div style="justify-content: center; align-items: center; display: flex; margin-bottom: 20px;">
            <table style="width: 90%; text-align: left; border-collapse: collapse;">
                <thead style="background-color: #ccc;">
                    <tr>
                        <th scope="col">Service Request</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Date of Transactions</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $book->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td data-label="Service Request"><?php echo htmlspecialchars($row['requested_service']); ?></td>
                            <td data-label="Address"><?php echo htmlspecialchars($row['booking_address']); ?></td>
                            <td data-label="Contact Number"><?php echo htmlspecialchars($row['contact_num']); ?></td>
                            <td data-label="Date of Transactions"><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td data-label="Status">
                                <?php
                                switch ($row['booking_status']) {
                                    case 1:
                                        echo 'Accepted';
                                        break;
                                    case 2:
                                        echo 'Pending';
                                        break;
                                    default:
                                        echo 'Pending';
                                        break;
                                }
                                ?>
                            </td>
                            <td data-label="Cancel">
                                <?php
                                if (empty($row['booking_status']) || $row['booking_status'] == 0 || $row['booking_status'] == 2) {
                                    echo '<button type="button" class="btn btn-danger" onclick="cancelBooking(' . $row['booking_id'] . ')">Cancel</button>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function cancelBooking(booking_id) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            fetch("?action=cancelBooking", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        booking_id: booking_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Booking cancelled successfully!");
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert("Failed to cancel booking: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Deleted Successfully");
                });
        }
    }
</script>