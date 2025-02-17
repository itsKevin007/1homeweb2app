<!-- Profile Details Section Start -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/transactionsWizard.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/transactionBox.css">
<?php
include('../phpqrcode/qrlib.php');

$user_id = $_SESSION['user_id'];

if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}


// for QR
include('../../phpqrcode/qrlib.php');

// Temporary directory for QR codes
$tempDir = 'temp/';
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0755, true);
}


// Query to fetch accepted services only for the logged-in user
$query = "SELECT * FROM accepted_services WHERE user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $accepted_by, PDO::PARAM_INT);
$stmt->execute();

// Fetch all rows
$acceptedServices = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- tabs -->

<section class="signup-step-container">
    <div class="col-md-12 col-lg-12 col-sm-12 mb-12">
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(87deg, rgba(2, 44, 92, 1) 1%, rgba(4,69,117,1) 100%); height: 60px;">
            <h3 style="color: #d7d7df; font-weight: 600;">Transactions</h3>
        </div>
        <div style="width: 100%; margin-bottom: 20px;">
            <div class="mt-16">
                <!-- <h5 style="margin-left: 5%;">As of <?php echo date('F j, Y'); ?></h5> -->
            </div>
        </div>
    </div>

    <div style="background-color: #fff; margin-top: -30px;">
        <div class="wizard-container" style="width: 100%;">
            <div class="progress-steps">
                <div class="step active" data-step="1">
                    <div class="step-circle">
                        <svg enable-background="new 0 0 20 20" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="m0 0h20v20h-20z" fill="none" />
                            <path d="m7 4v.73c-.68-.32-1.4-.5-2.13-.5-1.28 0-2.56.49-3.54 1.46l2.12 2.12h1.41l-.1 1.32c.62.62 1.42.92 2.23.92h.01v1.95h-2v2.5c0 .83.67 1.5 1.5 1.5h7.5c1.1 0 2-.9 2-2v-10zm-.01 5.05c-.43 0-.84-.12-1.19-.36l.15-1.87h-2.08l-1.03-1.03c.61-.36 1.31-.55 2.03-.55 1.07 0 2.07.42 2.83 1.17l1.41 1.41-.6.6c-.41.4-.95.63-1.52.63zm8.01 4.95c0 .55-.45 1-1 1s-1-.45-1-1v-2h-5v-2.13c.44-.15.86-.39 1.22-.74l.6-.6 2.47 2.47h.71v-.71l-4.6-4.59c-.12-.13-.26-.22-.4-.33v-.37h7z" fill="white" />
                        </svg>
                    </div>
                    <div class="step-label">Accepted</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-circle">
                        <svg fill="white" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <g fill="white">
                                <path d="m11.5 2c1.3807 0 2.5 1.11929 2.5 2.5v1.75716c-.9509-.78534-2.1704-1.25716-3.5-1.25716h2.5v-.5c0-.82843-.6716-1.5-1.5-1.5h-7c-.82843 0-1.5.67157-1.5 1.5v.5h7.5c-1.17741 0-2.26841.36997-3.16308 1h-4.33692v5.5c0 .8284.67157 1.5 1.5 1.5h1.09971c.1829.3578.40382.6929.65745 1h-1.75716c-1.38071 0-2.5-1.1193-2.5-2.5v-7c0-1.38071 1.11929-2.5 2.5-2.5z" />
                                <path d="m15 10.5c0 2.4853-2.0147 4.5-4.5 4.5-2.48528 0-4.5-2.0147-4.5-4.5 0-2.48528 2.01472-4.5 4.5-4.5 2.4853 0 4.5 2.01472 4.5 4.5zm-2.1464-1.85355c-.1953-.19527-.5119-.19527-.7072 0l-2.6464 2.64645-.64645-.6465c-.19526-.1952-.51184-.1952-.7071 0-.19527.1953-.19527.5119 0 .7072l1 1c.19526.1952.51184.1952.7071 0l3.00005-3.00005c.1952-.19526.1952-.51184 0-.7071z" />
                            </g>
                        </svg>
                    </div>
                    <div class="step-label">Pending</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-circle">
                        <svg height="56" viewBox="0 0 56 56" width="56" xmlns="http://www.w3.org/2000/svg">
                            <path d="m1.9205 50.6968 3.4482 3.4482c1.8986 1.855 4.0592 1.7022 5.9797-.4147l22.8497-24.8792c.9384.6547 1.8113.6329 2.8807.4147l2.3352-.4802 1.5496 1.5495-.1091 1.1567c-.1528 1.2003.1963 2.1169 1.3092 3.2299l1.8334 1.8114c1.1129 1.1348 2.5968 1.2003 3.6663.1309l7.2675-7.2673c1.0691-1.0694 1.0038-2.5316-.1091-3.6664l-1.8334-1.8332c-1.1129-1.1131-2.0515-1.5059-3.2301-1.3313l-1.1782.1309-1.4843-1.484.6548-2.5534c.3057-1.2657-.0219-2.2915-1.3967-3.6446l-5.3903-5.3686c-7.9222-7.8784-18.0703-7.6384-25.0104-.6329-.9602.9602-1.0475 2.2697-.4364 3.2299.5019.8293 1.5713 1.3313 3.0335.9603 3.3827-.8512 6.7654-.5893 10.0827 1.6586l-1.3968 3.5355c-.5238 1.3094-.4801 2.3787.0437 3.3608l-24.9447 22.9588c-2.0951 1.9423-2.3352 4.0592-.4147 5.9797zm17.5028-40.8107c5.9579-4.452 13.378-3.7319 18.7467 1.6368l5.8704 5.827c.5239.5238.5896.9384.4367 1.5932l-.8291 3.4918 3.5135 3.5136 2.1387-.1964c.6329-.0655.8291-.0218 1.3529.4801l1.3753 1.3968-6.1327 6.1543-1.3967-1.3967c-.5019-.502-.5457-.6984-.48-1.3313l.1962-2.1606-3.4916-3.4918-3.623.6984c-.6329.1309-.9602.1309-1.5058-.4147l-4.8449-4.8667c-.5238-.5238-.5893-.8293-.3056-1.5277l2.1388-5.1067c-3.5791-3.4264-8.3149-5.3251-12.8761-3.8629-.1964.0655-.3274.0218-.3928-.0655-.0655-.1091-.0655-.2182.1091-.371zm-14.6657 39.2394c-1.113-1.113-.7202-1.7896.0218-2.4661l24.5083-22.6095 2.7279 2.7497-22.675 24.421c-.6765.742-1.5276.9602-2.4442.0655z" fill="white" />
                        </svg>
                    </div>
                    <div class="step-label">Ongoing</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-circle">
                        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <g style="stroke:#fff;stroke-width:2;fill:none;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round" transform="translate(-2 -2)">
                                <path d="m12 3c4.9705627 0 9 4.02943725 9 9 0 4.9705627-4.0294373 9-9 9-4.97056275 0-9-4.0294373-9-9 0-4.97056275 4.02943725-9 9-9z" />
                                <path d="m7.71428571 11.6223394 3.52941139 3.3776606 5.0420172-6" />
                            </g>
                        </svg>
                    </div>
                    <div class="step-label">Done</div>
                </div>
            </div>


            <div class="step-content">
                <div class="navigation-buttons">
                    <button id="prevBtn" onclick="previousStep()" disabled>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 6L9 12L15 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button id="nextBtn" onclick="nextStep()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L15 12L9 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="step-panel active" data-step="1">
                    <?php
                    // Fetch data from accepted_services table
                    $sql = "SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'accepted' AND projectCost IS NULL";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt;
                    ?>
                    <div class="flatlist">
                        <?php
                        if ($result->rowCount() > 0) {
                            foreach ($result as $row) {
                        ?>
                                <div class="list-item">
                                    <div class="content">
                                        <h3 class="title"><?= htmlspecialchars($row['aReqServ']); ?></h3>
                                        <p class="subtitle">Address: <?= htmlspecialchars($row['aAddress']); ?></p>
                                        <p class="subtitle">Contact Number: <?= htmlspecialchars($row['aContactNo']); ?></p>
                                        <p class="meta">Accepted At: <?= htmlspecialchars($row['accepted_at']); ?></p>
                                        <span class="meta" style="float: right;">
                                            <a href="#" style="font-size: 10px;" class="btn btn-primary set-price-btn" data-id="<?= $row['id']; ?>" data-service="<?= htmlspecialchars($row['aReqServ']); ?>" data-toggle="modal" data-target="#setPriceModal">Set price</a>
                                        </span>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<div class="list-item"><p>No records found</p></div>';
                        }
                        ?>
                    </div>
                </div>


                <div class="step-panel" data-step="2">
                    <?php
                    // Fetch data from accepted_services table
                    $sql = "SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'ongoing' AND projectCost IS NOT NULL AND date_started IS NULL";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt;
                    ?>
                    <div class="flatlist">
                        <?php if ($result->rowCount() > 0): ?>
                            <?php foreach ($result as $row): ?>
                                <?php $modalId = "modal_" . $row['id']; ?>
                                <div class="list-item">
                                    <div class="content">
                                        <h3 class="title"><?php echo htmlspecialchars($row['aReqServ']); ?></h3>
                                        <p class="subtitle">Address: <?php echo htmlspecialchars($row['aAddress']); ?></p>
                                        <p class="subtitle">Contact: <?php echo htmlspecialchars($row['aContactNo']); ?></p>
                                        <p class="subtitle">Project Cost: ₱ <?php echo htmlspecialchars($row['projectCost']); ?></p>
                                        <p class="meta">Accepted on: <?php echo htmlspecialchars($row['accepted_at']); ?></p>
                                        <button class="btn btn-primary" style="float: right; font-size: 10px;" data-toggle="modal" data-target="#<?php echo $modalId; ?>">Start</button>
                                    </div>
                                </div>
                                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="<?php echo WEB_ROOT ?>service-provider/transactions/process.php?action=startProject">
                                                <input type="hidden" name="serviceId" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="date_started" value="<?php echo date('Y-m-d'); ?>">
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure you want to start this project?</h5>
                                                    <p class="modal-title" id="exampleModalLabel"><?php echo htmlspecialchars($row['aReqServ']); ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No records found</p>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="step-panel" data-step="3">
                    <?php
                    $sql = "SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'ongoing' AND date_started IS NOT NULL";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt;
                    ?>
                    <div class="flatlist">
                        <?php if ($result->rowCount() > 0): ?>
                            <?php foreach ($result as $row): ?>
                                <?php $modalId = "percentageModal_" . $row['id'];
                                $qrModalId = "qrCodeModal_" . $row['id'];
                                ?>
                                <div class="list-item">
                                    <div class="content">
                                        <h3 class="title"><?php echo htmlspecialchars($row['aReqServ']); ?> <span style="float: right;"><i class="fas fa-qrcode" data-toggle="modal" data-target="#<?php echo $qrModalId; ?>"></i></span></h3>
                                        <p class="subtitle">Address: <?php echo htmlspecialchars($row['aAddress']); ?></p>
                                        <p class="subtitle">Contact: <?php echo htmlspecialchars($row['aContactNo']); ?></p>
                                        <p class="subtitle">Project cost: ₱ <?php echo htmlspecialchars($row['projectCost']); ?></p>
                                        <p class="meta">Date started: <?php echo htmlspecialchars($row['date_started']); ?></p>
                                        <p class="meta">Work done: <?= htmlspecialchars($row['percentage']); ?>%</p>
                                        <span class="meta flex-col">
                                            <?php if ($row['percentage'] < 100): ?>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $modalId; ?>" style="float:right; font-size: 10px;">Set Percentage</button>
                                                <style>
                                                    #markDoneBtn_<?php echo $modalId; ?> {
                                                        display: none;
                                                    }
                                                </style>
                                            <?php else: ?>
                                                <style>
                                                    #setPercentageBtn_<?php echo $modalId; ?> {
                                                        display: none;
                                                    }
                                                </style>
                                                <form method='post' action='<?php echo WEB_ROOT ?>service-provider/transactions/process.php?action=markDone' style="float: right;">
                                                    <input type='hidden' name='serviceId' value='<?php echo $row['id']; ?>'>
                                                    <input type='hidden' name='date_finish' value='<?php echo date('Y-m-d'); ?>'>
                                                    <button type='submit' class='btn btn-success' id='markDoneBtn_<?php echo $modalId; ?>' style="font-size: 10px;">Done</button>
                                                </form>

                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>


                                <!-- Modal for Percentage -->
                                <div class='modal fade' id='<?php echo $modalId; ?>' tabindex='-1' role='dialog' aria-labelledby='modalTitle_<?php echo $modalId; ?>' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='modalTitle_<?php echo $modalId; ?>'><?php echo htmlspecialchars($row['aReqServ']); ?></h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <form method='post' action='<?php echo WEB_ROOT ?>service-provider/transactions/process.php?action=setPercentage'>
                                                    <input type='hidden' name='serviceId' value='<?php echo $row['id']; ?>'>
                                                    <div class='mb-3'>
                                                        <label for='customRange_<?php echo $modalId; ?>' class='form-label'>Select Value:</label>
                                                        <input type='range' class='form-range' id='customRange_<?php echo $modalId; ?>' name='percentage' min='0' max='100' step='1' value='<?php echo htmlspecialchars($row['percentage']); ?>'>
                                                        <div class='d-flex justify-content-between'>
                                                            <small>0%</small>
                                                            <small>100%</small>
                                                        </div>
                                                        <h4>Current Value: <span id='rangeValue_<?php echo $modalId; ?>' class='fw-bold text-primary'><?php echo htmlspecialchars($row['percentage']); ?>%</span></h4>
                                                    </div>
                                                    <button type='submit' class='btn btn-primary col-12 mb-3'>Save</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for QR Code -->
                                <div class='modal fade' id='<?php echo $qrModalId; ?>' tabindex='-1' role='dialog' aria-labelledby='modalTitle_<?php echo $qrModalId; ?>' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='modalTitle_<?php echo $qrModalId; ?>'><?php echo htmlspecialchars($row['aReqServ']); ?></h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <?php
                                                $text = $row['id'] . ',' . $row['aReqServ'] . ',' . $row['projectCost'] . ',' . $row['user_id'];
                                                $tempDir = 'temp/'; 

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
                                                <p class="subtitle ">Project cost: ₱ <?php echo htmlspecialchars($row['projectCost']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No records found</p>
                        <?php endif; ?>
                    </div>
                    <!-- JavaScript for range slider -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.querySelectorAll("input[type='range']").forEach(range => {
                                range.addEventListener("input", function() {
                                    let rangeValueSpan = document.getElementById("rangeValue_" + this.id.replace("customRange_", ""));
                                    if (rangeValueSpan) {
                                        rangeValueSpan.textContent = this.value + "%";
                                    }
                                });
                            });
                        });
                    </script>
                </div>

                <div class="step-panel" data-step="4">
                    <?php
                    $sql = "SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'done'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt;
                    ?>
                    <div class="flatlist">
                        <?php if ($result->rowCount() > 0): ?>
                            <?php foreach ($result as $row): ?>
                                <?php $modalId = "modal_" . $row['id']; ?>
                                <div class="list-item">
                                    <div class="content">
                                        <h3 class="title"><?php echo htmlspecialchars($row['aReqServ']); ?></h3>
                                        <p class="subtitle">Address: <?php echo htmlspecialchars($row['aAddress']); ?></p>
                                        <p class="subtitle">Contact: <?php echo htmlspecialchars($row['aContactNo']); ?></p>
                                        <p class="subtitle">Project cost: ₱ <?php echo htmlspecialchars($row['projectCost']); ?></p>
                                        <p class="meta">Date done: <?php echo htmlspecialchars($row['date_finish']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No records found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo WEB_ROOT; ?>script/transactionsWizard.js"></script>
    </div>

</section>

<!-- modal for setting price  -->
<!-- Modal -->
<div class="modal fade" id="setPriceModal" tabindex="-1" aria-labelledby="setPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setPriceModalLabel">Set Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="priceForm" method="post" enctype="multipart/form-data" action="<?php echo WEB_ROOT ?>service-provider/transactions/process.php?action=setPrice">
                    <input type="hidden" id="serviceId" name="serviceId">
                    <div class="form-group">
                        <label for="serviceName">Service</label>
                        <input type="text" class="form-control" id="serviceName" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="servicePrice">Price</label>
                        <input type="number" class="form-control" id="servicePrice" name="projectCost" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary col-12">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Script to Handle Modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.set-price-btn').click(function() {
            var id = $(this).data('id');
            var service = $(this).data('service');

            $('#serviceId').val(id);
            $('#serviceName').val(service);
        });
    });
</script>