<!-- Profile Details Section Start -->

<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

// Retrieve accepted bookings
$accepted = $conn->prepare("SELECT * FROM accepted_services WHERE serProvId = :serProvId");
$accepted->bindParam(':serProvId', $userId, PDO::PARAM_INT);
$accepted->execute();
$accepted_data = $accepted->fetchAll(PDO::FETCH_ASSOC);

// Retrieve user info for the modal
include('../../phpqrcode/qrlib.php');

$uid_user = $user_data['uid'];
$client = $conn->prepare("SELECT * FROM tbl_company WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();
$uid = $client_data['uid'];

$bname = $client_data['bname'];
$email = $client_data['emailadd'];
$connum = $client_data['connum'];
$accno = $client_data['accno'];
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

    <div class="container justify-content-center align-items-center d-flex flex-column">
        <?php foreach ($accepted_data as $booking): ?>
            <?php
            $requestedService = htmlspecialchars($booking['aReqServ']);
            $bookingAddress = htmlspecialchars($booking['aAddress']);
            $contactNumber = htmlspecialchars($booking['aContactNo']);
            $bookingId = htmlspecialchars($booking['id']);
            ?>
            <div class="row p-2 rounded mb-2" style="background: linear-gradient(90deg, rgba(10,0,176,1) 0%, rgba(59,68,223,1) 100%); width: 100%;">
                <div class="col-12">
                    <h5 style="color:white;">Requested Service: <?= $requestedService; ?></h5>
                </div>
                <div class="col-12">
                    <h6 style="color: #fff;">Contact Number: <?= $contactNumber; ?></h6>
                </div>
                <div class="col-12">
                    <p style="color: #fff;">Address: <?= $bookingAddress; ?></p>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary">Ongoing</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#doneModal">Done</button>
                    <button
                        class="btn btn-danger cancelBtn"
                        data-booking-id="<?= $bookingId; ?>"
                        data-requested-service="<?= $requestedService; ?>"
                        data-booking-address="<?= $bookingAddress; ?>"
                        data-contact-num="<?= $contactNumber; ?>">
                        Cancel
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- modal for done -->

    <!-- Modal -->
    <div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doneModalLabel">Action Completed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $text = $uid_user;
                    $tempDir = 'temp/'; // Directory to save QR code temporarily

                    // Ensure temp directory exists
                    if (!is_dir($tempDir)) {
                        mkdir($tempDir, 0755, true);
                    }

                    // Generate QR code
                    $fileName = 'qrcode_' . md5($text) . '.png';
                    $filePath = $tempDir . $fileName;
                    QRcode::png($text, $filePath, QR_ECLEVEL_L, 5);

                    ?>
                    <div class="container">
                        <div style="text-align: center">
                            <img src="<?php echo $filePath; ?>">
                        </div>
                    </div>
                    <h3 style="text-align: center; color:#022c5c"><?php echo $bname; ?></h3>
                    <h3 style="text-align: center; color:#022c5c">+<?php echo $connum; ?> </h3>
                    <h3 style="text-align: center; color:#022c5c"><?php echo $email; ?></h3>
                    <h3 style="text-align: center; color:#022c5c">Account #: <?php echo $accno; ?></h3>
                </div>
               
            </div>
        </div>
    </div>
    <!-- end of modal -->
</div>