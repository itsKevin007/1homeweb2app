<!-- Profile Details Section Start -->

<?php
$user_id = $_SESSION['user_id'];

if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

// Query to fetch accepted services only for the logged-in user
$query = "SELECT * FROM accepted_services WHERE user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch all rows
$acceptedServices = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<link href="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />



<!-- tabs -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/tabStyle.css">

<section class="signup-step-container">
    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(87deg, rgba(2, 44, 92, 1) 1%, rgba(4,69,117,1) 100%); height: 60px;">
            <h3 style="color: #d7d7df; font-weight: 600;">Transactions</h3>
        </div>
        <div style="width: 100%; margin-bottom: 15px;">
            <div class="mt-16">
                <h5 style="margin-left: 5%;">As of <?php echo date('F j, Y'); ?></h5>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Pending</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Ongoing</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Done</i></a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab"></span> <i>History</i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="login-box">
                        <div class="tab-content" id="main_form">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h4 class="text-center">Pending/Accepted</h4>
                                <br>
                                <?php
                                // Include database connection
                                include '../global-library/database.php';

                                try {
                                    // Fetch accepted services from the database
                                    $stmt = $conn->prepare("SELECT * FROM accepted_services WHERE user_id = :user_id");
                                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                    $stmt->execute();

                                    // Fetch all results as an associative array
                                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                } catch (Exception $e) {
                                    // Handle exceptions
                                    echo "Error fetching services: " . $e->getMessage();
                                    $services = []; // Default to an empty array to avoid foreach errors
                                }
                                ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Service Request</th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Date Accepted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($services)) : ?>
                                            <?php foreach ($services as $service) : ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($service['aReqServ']) ?></td>
                                                    <td><?= htmlspecialchars($service['aAddress']) ?></td>
                                                    <td><?= htmlspecialchars($service['aContactNo']) ?></td>
                                                    <td><?= htmlspecialchars($service['accepted_at']) ?></td>
                                                    <td>
                                                        <!-- Start Button with Modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?= $service['service_id'] ?>">
                                                            Start
                                                        </button>

                                                        <!-- Modal for Submitting Project Cost -->
                                                        <div class="modal fade" id="modal-<?= $service['service_id'] ?>" tabindex="-1" aria-labelledby="modalLabel-<?= $service['service_id'] ?>" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalLabel-<?= $service['service_id'] ?>">Submit Project Cost</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="process.php?action=submitAmount" method="POST" onsubmit="return confirm('Are you sure you want to submit the project cost?');">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
                                                                            <label for="projectCost-<?= $service['service_id'] ?>" class="form-label">Project Cost</label>
                                                                            <input type="text" id="projectCost-<?= $service['service_id'] ?>" name="projectCost" class="form-control" placeholder="₱ Enter Project Cost" required>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    <script>
                                                                        function confirmation() {
                                                                            Swal.fire({
                                                                                title: 'Success!',
                                                                                text: 'Project cost successfully submitted.',
                                                                                icon: 'success',
                                                                                confirmButtonText: 'Ok'
                                                                            }).then(function() {
                                                                                window.location.href = 'index.php';
                                                                            });
                                                                        }
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">No accepted services found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary" data-toggle="tab" href="#step2">Next</button></li>
                                </ul>
                            </div>
                            <!-- ---------------------------------------------------------------------------------- Tab 2 Ongoing Services End -------------------------------------------------------------------------------- -->
                            <div class="tab-pane" role="tabpanel" id="step2">
                                <h5 class="text-center">Ongoing Projects</h5>
                                <div class="row">
                                    <?php
                                    try {
                                        // Fetch ongoing services from the database
                                        $ongoingStmt = $conn->prepare("SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'ongoing' ");
                                        $ongoingStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                        $ongoingStmt->execute();

                                        // Fetch all results as an associative array
                                        $ongoingServices = $ongoingStmt->fetchAll(PDO::FETCH_ASSOC);
                                    } catch (Exception $e) {
                                        // Handle exceptions
                                        echo "Error fetching ongoing services: " . $e->getMessage();
                                        $ongoingServices = []; // Default to an empty array to avoid foreach errors
                                    }
                                    ?>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Service Request</th>
                                                <th>Address</th>
                                                <th>Contact No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($ongoingServices)) : ?>
                                                <?php foreach ($ongoingServices as $service) : ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($service['aReqServ']) ?></td>
                                                        <td><?= htmlspecialchars($service['aAddress']) ?></td>
                                                        <td><?= htmlspecialchars($service['aContactNo']) ?></td>
                                                        <td><?= htmlspecialchars($service['status']) ?></td>
                                                        <td>
                                                            <!-- Form to mark as Done -->
                                                            <form action="process.php?action=markDone" method="POST" style="display: inline;">
                                                                <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['service_id']) ?>">
                                                                <button type="submit" class="btn btn-primary">Done</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5">No ongoing projects found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary" data-toggle="tab" href="#step1">Back</button></li>
                                    <li><button type="button" class="btn btn-primary" data-toggle="tab" href="#step3">Next</button></li>
                                </ul>
                            </div>

                            <!-- ---------------------------------------------------------------------------------- Tab 3 Done Services Start -------------------------------------------------------------------------------- -->
                            <div class="tab-pane" role="tabpanel" id="step3">
                                <h4 class="text-center">Step 3</h4>
                                <div class="row">
                                    <!--  -->

                                    <?php
                                    try {
                                        // Fetch ongoing services from the database
                                        $ongoingStmt = $conn->prepare("SELECT * FROM accepted_services WHERE user_id = :user_id AND status = 'done'");
                                        $ongoingStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                        $ongoingStmt->execute();

                                        // Fetch all results as an associative array
                                        $ongoingServices = $ongoingStmt->fetchAll(PDO::FETCH_ASSOC);
                                    } catch (Exception $e) {
                                        // Handle exceptions
                                        echo "Error fetching ongoing services: " . $e->getMessage();
                                        $ongoingServices = []; // Default to an empty array to avoid foreach errors
                                    }
                                    ?>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Service Request</th>
                                                <th>Address</th>
                                                <th>Contact No.</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($ongoingServices)) : ?>
                                                <?php foreach ($ongoingServices as $service) : ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($service['aReqServ']) ?></td>
                                                        <td><?= htmlspecialchars($service['aAddress']) ?></td>
                                                        <td><?= htmlspecialchars($service['aContactNo']) ?></td>
                                                        <td><?= htmlspecialchars($service['status']) ?></td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5">No ongoing projects found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>

                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary" data-toggle="tab" href="#step2">Back</button></li>
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo WEB_ROOT; ?>script/tabs.js"></script>
</section>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</div>
<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable()
    });
</script>