<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/transTable.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/transactionsWizard.css">

<style>
    .flatlist-container {
        max-width: 100%;
        /* margin: 20px auto; */
        /* padding: 0 15px; */
    }

    .flatlist-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .flatlist-item:hover {
        transform: translateY(-2px);
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        margin-right: 15px;
        object-fit: cover;
    }

    .item-content {
        flex: 1;
    }

    .item-title {
        margin: 0;
        font-size: 16px;
        color: #333;
        font-weight: bold;
    }

    .item-description {
        margin: 5px 0 0 0;
        font-size: 14px;
        color: #666;
    }

    .item-date {
        font-size: 12px;
        color: #999;
        margin-top: 8px;
    }

    .item-actions {
        margin-left: 15px;
        display: flex;
        gap: 10px;
    }

    .action-button {
        padding: 4px 4px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #f0f0f0;
        color: #333;
        transition: background-color 0.2s ease;
    }

    .action-button:hover {
        background-color: #e0e0e0;
    }
</style>

<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

// Fetch bookings data
$sql = "SELECT * FROM tbl_bookings WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$result = $stmt;

?>

<div class="homepage-second-sec" style="width: 100%;">
    <div style="width: 100%;">
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(87deg, rgba(2, 44, 92, 1) 1%, rgba(4,69,117,1) 100%); height: 60px;">
            <h3 style="color: #d7d7df; font-weight: 600;">Transactions</h3>
        </div>
    </div>
    <!-- 
    <div style="width: 100%;">
        <div class="mt-15">
            <p style="margin-left: 5%;">As of <?php echo date('F j, Y'); ?></p>
        </div>
    </div> -->

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
                    <div class="step-label">Requested</div>
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
                    <div class="step-label">Accepted</div>
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
                    <div class="flatlist-container">
                        <?php
                        if ($result->rowcount() > 0) {
                            foreach ($result as $row) {
                                echo '
                                        <div class="flatlist-item">
                                            <div class="item-content">
                                                <h3 class="item-title">' . htmlspecialchars($row["requested_service"]) . '</h3>
                                                <p class="item-description">' . htmlspecialchars($row["booking_address"]) . '</p>
                                                <div class="item-date">Date Accepted: ' . htmlspecialchars($row["created_at"]) . '</div>
                                            </div>
                                            <div class="item-actions">
                                                <form method="POST" action="process.php?action=delBooking" onsubmit="return confirm(\'Are you sure you want to delete this booking?\');">
                                                    <input type="hidden" name="booking_id" value="' . htmlspecialchars($row['booking_id']) . '">
                                                    <button type="submit" class="action-button">
                                                        <!-- Delete button SVG -->
                                                        <svg fill="none" height="15" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="m19 7-.8673 12.1425c-.0748 1.0466-.9457 1.8575-1.9949 1.8575h-8.27556c-1.04928 0-1.92016-.8109-1.99492-1.8575l-.86732-12.1425m5 4v6m4-6v6m1-10v-3c0-.55228-.4477-1-1-1h-4c-.55228 0-1 .44772-1 1v3m-5 0h16" stroke="#4a5568" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    ';
                            }
                        } else {
                            echo '<p>No bookings found</p>';
                        }
                        ?>
                    </div>
                </div>


                <div class="step-panel" data-step="2">
                    <!-- the php code below is error -->
                  <?php
                        // Fetch accepted services data
                        $sqlAccepted = "SELECT * FROM accepted_services WHERE client_id = :client_id";
                        $stmtAccepted = $conn->prepare($sqlAccepted);
                        $stmtAccepted->bindParam(':client_id', $_SESSION['client_id'], PDO::PARAM_INT);
                        $stmtAccepted->execute();
                        $resultAccepted = $stmtAccepted;

                        if ($resultAccepted->rowCount() > 0) {
                            echo '<div class="flatlist-container">';
                            foreach ($resultAccepted as $row) {
                                echo '
                                    <div class="flatlist-item">
                                        <div class="item-content">
                                            <h3 class="item-title">Service ID: ' . htmlspecialchars($row["service_id"]) . '</h3>
                                            <p class="item-description">Accepted At: ' . htmlspecialchars($row["accepted_at"]) . '</p>
                                            <p class="item-description">Address: ' . htmlspecialchars($row["aAddress"]) . '</p>
                                            <p class="item-description">Contact: ' . htmlspecialchars($row["aContactNo"]) . '</p>
                                            <p class="item-description">Requested Service: ' . htmlspecialchars($row["aReqServ"]) . '</p>
                                            <p class="item-description">Project Cost: $' . htmlspecialchars($row["projectCost"]) . '</p>
                                            <p class="item-description">Status: ' . htmlspecialchars($row["status"]) . '</p>
                                        </div>
                                    </div>
                                ';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No accepted services found</p>';
                        }

                  ?>
                  <!-- end of error -->
                </div>
                <div class="step-panel" data-step="3">
                    <h3>Preferences</h3>
                    <p>Please select your preferences</p>
                </div>
                <div class="step-panel" data-step="4">
                    <h3>Confirmation</h3>
                    <p>Please review and confirm your entries</p>
                </div>


            </div>
        </div>
        <script src="<?php echo WEB_ROOT; ?>script/transactionsWizard.js"></script>
    </div>