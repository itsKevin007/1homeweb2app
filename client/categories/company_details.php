<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/categories.css">
<link href="<?php echo WEB_ROOT; ?>style/searchSuggestions.css" rel="stylesheet">
<style>
    .wizard-container {
        margin-top: 50px;
    }

    .wizard-step {
        padding: 20px;
        border-radius: 5px;
        display: none;
    }

    .wizard-step.active {
        display: block;
    }

    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }

    .step-indicator::before {
        content: '';
        position: absolute;
        top: 24px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #e0e0e0;
        z-index: 0;
    }

    .step {
        text-align: center;
        z-index: 1;
        position: relative;
        width: 33.333%;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        color: #fff;
        transition: background-color 0.3s;
        position: relative;
        z-index: 2;
    }

    /* Line between steps */
    .step-line {
        position: absolute;
        height: 3px;
        top: 24px;
        width: 100%;
        left: -50%;
        z-index: 1;
    }

    .step:first-child .step-line {
        display: none;
    }

    .step.active .step-line,
    .step.completed .step-line {
        background-color: #022c5c;
    }

    .step.completed .step-line {
        background-color: #022c5c;
    }

    .step.completed .step-circle,
    .step.active .step-circle {
        background-color: #022c5c;
    }

    .step.completed .step-circle {
        background-color: #022c5c;
    }

    .navigation-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
</style>
<?php
include_once '../../global-library/database.php';

// Get company ID from URL
$com_id = $_GET['com_id'] ?? 0;

// Fetch company details
$companySql = "SELECT * FROM tbl_company WHERE com_id = ?";
$companyStmt = $conn->prepare($companySql);
$companyStmt->execute([$com_id]);
$company = $companyStmt->fetch(PDO::FETCH_ASSOC);

if (!$company) {
    die('Company not found');
}
?>
<div class="container mt-4 ">
    <h5 class="text-start"><?= htmlspecialchars($company['bname']) ?></h5>
    <p class="text-start"><?= htmlspecialchars($company['com_description'] ?? 'No description available') ?></p>
    <hr />
    <h5 class="text-start mb-3">Services</h5>
    <div class="p-2" style="background-color: #fff; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 3px 16px 0 rgba(0,0,0,0.19); border-radius: 10px;">
        <div style="display: flex; gap: 20px; flex-direction: row;">
            <?php
            $serviceSql = "SELECT * FROM ind_subcat WHERE user_id = ?";
            $serviceStmt = $conn->prepare($serviceSql);
            $serviceStmt->execute([$company['user_id']]);
            $services = $serviceStmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($services) > 0) {
                foreach ($services as $service) {
            ?>
                    <div class="service-card"
                        data-bs-toggle="modal"
                        data-bs-target="#serviceModal"
                        data-title="<?= htmlspecialchars($service['sub_categor']) ?>"
                        data-description="<?= htmlspecialchars($service['description'] ?? 'No description available') ?>">
                        <img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" class="card-img-top" alt="Service">
                        <p class="card-text text-truncate" style="margin-top: -5px;"><?= htmlspecialchars($service['sub_categor']) ?></p>
                    </div>
            <?php
                }
            } else {
                echo '<p>No services available</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true" style="z-index: 1501;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle" style="color: #022c5c;">Service Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Step Indicators with Lines -->
                <div class="step-indicator">
                    <div class="step active" id="step-indicator-1">
                        <div class="step-line"></div>
                        <div class="step-circle">1</div>
                        <p>Personal Information</p>
                    </div>
                    <div class="step" id="step-indicator-2">
                        <div class="step-line"></div>
                        <div class="step-circle">2</div>
                        <p>Booking Date</p>
                    </div>
                    <div class="step" id="step-indicator-3">
                        <div class="step-line"></div>
                        <div class="step-circle">3</div>
                        <p>Review</p>
                    </div>
                </div>

                <!-- Step 1 Content -->
                <div id="step1" class="wizard-step active">
                    <div class="mb-3">
                        <label>Select Address</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option value="" selected disabled style="width: 90%;" id="address">Select Location</option>
                            <?php
                            $sql = "SELECT * FROM tbl_location WHERE user_id = :user_id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                            $stmt->execute();
                            $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($locations as $location) {
                                echo "<option value=\"{$location['name']}\">{$location['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number</label>
                        <input type="text" id="contactNumber" placeholder="Optional" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="roomNumber" class="form-label">Room Number</label>
                        <input type="text" id="roomNumber" class="form-control" placeholder="Optional">
                    </div>
                </div>

                <!-- Step 2 Content -->
                <div id="step2" class="wizard-step">

                    <div class="mb-3">
                        <label for="dateTime" class="form-label">Date and Time</label>
                        <input type="date" id="dateTime" class="form-control" placeholder="Enter the date and time">
                    </div>
                </div>

                <!-- Step 3 Content -->
                <div id="step3" class="wizard-step">
                    <p>Please review your information before submitting:</p>
                    <div class="alert alert-info">
                        <form action="process.php?action=addBooking" method="POST" id="summaryInfo" class="mt-3">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" name="requested_service" value="Service Title">
                            <div class="mb-3">
                                <label for="summaryAddress" class="form-label"><strong>Address:</strong></label>
                                <input type="text" name="booking_address" id="summaryAddress" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="summaryContact" class="form-label"><strong>Contact Number:</strong></label>
                                <input type="text" name="contact_num" id="summaryContact" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="summaryRoomNumber" class="form-label"><strong>Room Number:</strong></label>
                                <input type="text" name="roomNo" id="summaryRoomNumber" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="summaryDateTime" class="form-label"><strong>Date and Time:</strong></label>
                                <input type="text" name="created_at" id="summaryDateTime" class="form-control" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="termsCheck">
                        <label class="form-check-label" for="termsCheck">
                            I confirm all information is correct
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="navigation-buttons">
                    <button id="prevBtn" class="btn btn-secondary" disabled>Previous</button>
                    <button id="nextBtn" class="btn btn-primary" style="background-color: #022c5c; border-color: #022c5c;">Next</button>
                    <button id="submitBtn" class="btn btn-success" onclick="document.getElementById('summaryInfo').submit()" style="display: none; background-color: #022c5c; border-color: #022c5c;">Submit</button>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const steps = document.querySelectorAll('.wizard-step');
                        const stepIndicators = document.querySelectorAll('.step');
                        const stepLines = document.querySelectorAll('.step-line');
                        const prevBtn = document.getElementById('prevBtn');
                        const nextBtn = document.getElementById('nextBtn');
                        const submitBtn = document.getElementById('submitBtn');

                        let currentStep = 0;

                        // Update UI based on current step
                        function updateUI() {
                            steps.forEach((step, index) => {
                                step.classList.remove('active');
                                stepIndicators[index].classList.remove('active', 'completed');

                                if (index < currentStep) {
                                    stepIndicators[index].classList.add('completed');
                                } else if (index === currentStep) {
                                    step.classList.add('active');
                                    stepIndicators[index].classList.add('active');
                                }
                            });

                            // Update button states
                            prevBtn.disabled = currentStep === 0;

                            if (currentStep === steps.length - 1) {
                                nextBtn.style.display = 'none';
                                submitBtn.style.display = 'block';

                                // Update summary information for review
                                updateSummary();
                            } else {
                                nextBtn.style.display = 'block';
                                submitBtn.style.display = 'none';
                            }
                        }

                        function updateSummary() {
                            // For the address, get the selected option text
                            const addressSelect = document.querySelector('.form-select');
                            const selectedAddress = addressSelect.options[addressSelect.selectedIndex]?.text || '-';

                            // Set values to input fields (not textContent)
                            document.getElementById('summaryAddress').value = selectedAddress;
                            document.getElementById('summaryContact').value =
                                document.getElementById('contactNumber').value || '-';
                            document.getElementById('summaryRoomNumber').value =
                                document.getElementById('roomNumber').value || '-';
                            document.getElementById('summaryDateTime').value =
                                document.getElementById('dateTime').value || '-';
                        }

                        // Next button handler
                        nextBtn.addEventListener('click', function() {
                            if (currentStep < steps.length - 1) {
                                currentStep++;
                                updateUI();
                            }
                        });

                        // Previous button handler
                        prevBtn.addEventListener('click', function() {
                            if (currentStep > 0) {
                                currentStep--;
                                updateUI();
                            }
                        });

                        // Submit button handler
                        submitBtn.addEventListener('click', function() {
                            if (document.getElementById('termsCheck').checked) {
                                alert('Registration submitted successfully!');
                                // Here you would typically send the data to your server
                            } else {
                                alert('Please confirm your information is correct');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const serviceModal = document.getElementById('serviceModal');

        serviceModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let title = button.getAttribute('data-title');
            let description = button.getAttribute('data-description');

            document.getElementById("modalTitle").textContent = title;
            document.getElementById("modalDescription").textContent = description;
        });
    });
</script>