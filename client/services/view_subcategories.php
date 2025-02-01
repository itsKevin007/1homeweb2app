<?php
// Include database connection
include_once '../../global-library/database.php'; // Replace with your actual database connection file

// Get main_id from the URL query string
$main_id = isset($_GET['main_id']) ? intval($_GET['main_id']) : 0;

if ($main_id === 0) {
    echo "Invalid main category.";
    exit;
}

// Query to fetch subcategories based on main_id
$sql = "SELECT subcatid, sub_categor AS sub_category FROM ind_subcat WHERE main_id = :main_id AND is_deleted = 0";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':main_id', $main_id, PDO::PARAM_INT);
$stmt->execute();

$subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="homepage2-seventh-sec mt-24">
    <div class="container">
        <!-- <h5>Subcategories</h5> -->
        <div class="favourite-bottom-sec mt-24">
            <div class="favourite-bottom-sec-wrapper">
                <?php if (count($subcategories) > 0): ?>
                    <?php foreach ($subcategories as $subcategory): ?>
                        <div class="related-item">
                            <div class="related-item-img related-item-img1">
                                <a href="javascript:void(0)" data-subcatid="<?= $subcategory['subcatid'] ?>" data-subcategor="<?= $subcategory['sub_category'] ?>" onclick=" openModal(this)">
                                    <img src="<?php echo WEB_ROOT; ?>assets/images/serviceImg/carpentry.jpg" class="img-fluid" alt="subcategory-img">
                                </a>
                                <div class="img-bottom-content">
                                    <div class="img-first-content"></div>
                                    <div class="favourite-sec">
                                        <a href="javascript:void(0)" data-subcatid="<?= $subcategory['subcatid'] ?>" data-subcategor="<?= $subcategory['sub_category'] ?>" onclick=" openModal(this)">
                                            <button class="btn btn-primary" style="background-color: #fff; border: none; color: #000; transition: all .3s ease-in-out;" onmouseover="this.style.backgroundColor='#e5e5e5'" onmouseout="this.style.backgroundColor='#fff'">Book</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="related-item-content">
                                <h5 class="rel-txt1"><?= htmlspecialchars($subcategory['sub_category']) ?></h5>
                                <div class="related-item-content-rating-sec">
                                    <div class="related-item-first">
                                        <!-- <h6 class="rel-txt2">$60</h6> You can replace this with dynamic data if needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                title: "No Services Found",
                                icon: "warning",
                            })
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal Structure -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/wizard.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <input type="text" name="sub_categor" id="modalSubcategor"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Form inside the modal -->
                    <div>
                        <div class="container">
                            <div id="app">
                                <step-navigation :steps="steps" :currentstep="currentstep">
                                </step-navigation>

                                <div v-show="currentstep == 1">
                                    <h3>Step 1</h3>
                                    <br>
                                    <input type="hidden" name="subcatid" id="modalSubcatId">
                                    <label for="location" class="form-label">Select Location</label>
                                    <select class="form-select" name="bookingAddress" aria-label="Default select example" required>
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
                                    <br>
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="number" class="form-control" name="contactNum" id="contact" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roomNo" class="form-label">Room Number</label>
                                        <input type="number" class="form-control" name="roomNo" id="roomNo">
                                    </div>

                                    <!-- 1 -->
                                </div>
                                <!-- 2 -->
                                <div v-show="currentstep == 2">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Booking Date</label>
                                        <input type="date" class="form-control" name="created_at" id="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photoUpload" class="form-label">Reference Photo</label>
                                        <input type="file" class="form-control" id="photoUpload" name="photo" accept="image/*" onchange="previewImage(event)">
                                    </div>

                                    <div class="mb-3">
                                        <label for="photoPreview" class="form-label"></label>
                                        <img id="photoPreview" class="img-fluid border" alt="Uploaded photo will appear here" style="display: none; max-height: 300px;">
                                    </div>

                                    <script>
                                        function previewImage(event) {
                                            const [file] = event.target.files;
                                            if (file) {
                                                const preview = document.getElementById('photoPreview');
                                                preview.src = URL.createObjectURL(file);
                                                preview.style.display = 'block';
                                            }
                                        }
                                    </script>
                                </div>

                                <div v-show="currentstep == 3">
                                    <h3>Please review before submitting</h3>
                                    <form action="process.php?action=addBooking" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                        <div class="mb-3">
                                            <label for="modalSubcategoryTitle" class="form-label">Service</label>
                                            <input type="text" name="requestedService" class="form-control" id="modalSubcategoryTitle">
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalAddress" class="form-label">Location</label>
                                            <input type="text" name="booking_address" class="form-control" id="modalAddress" readonly>
                                        </div>
                                        <div>
                                            <label for="modalContact" class="form-label">Contact Number</label>
                                            <input type="text" name="contact_num" class="form-control" id="modalContact" readonly>
                                        </div>
                                        <div>
                                            <label for="modalRoomNo" class="form-label">Room Number</label>
                                            <input type="text" name="roomNo" class="form-control" id="modalRoomNo" readonly>
                                        </div>
                                        <div>
                                            <label for="modalDate" class="form-label">Booking Date</label>
                                            <input type="text" name="created_at" class="form-control" id="modalDate" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="photoPreview" class="form-label"></label>
                                            <img id="photoPreview" class="img-fluid border" alt="Uploaded photo will appear here" style="display: none; max-height: 300px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>


                                    <script>
                                        function previewImage(event) {
                                            const [file] = event.target.files;
                                            if (file) {
                                                const preview = document.getElementById('photoPreview');
                                                preview.src = URL.createObjectURL(file);
                                                preview.style.display = 'block';
                                            }
                                        }
                                    </script>
                                </div>
                                <!-- reflect script -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Step 1 fields
                                        const address = document.querySelector('select[name="bookingAddress"]');
                                        const contact = document.getElementById('contact');
                                        const roomNo = document.getElementById('roomNo');

                                        // Step 2 fields
                                        const date = document.getElementById('date');

                                        // Step 3 (Review) fields
                                        const modalSubcategoryTitle = document.getElementById('modalSubcategoryTitle');
                                        const modalAddress = document.getElementById('modalAddress');
                                        const modalContact = document.getElementById('modalContact');
                                        const modalRoomNo = document.getElementById('modalRoomNo');
                                        const modalDate = document.getElementById('modalDate');

                                        // Reflect subcategory title
                                        const modalSubcategor = document.getElementById('modalSubcategor');
                                        modalSubcategor.addEventListener('input', function() {
                                            modalSubcategoryTitle.value = modalSubcategor.value;
                                        });

                                        // Reflect location
                                        address.addEventListener('change', function() {
                                            modalAddress.value = address.value;
                                        });

                                        // Reflect contact number
                                        contact.addEventListener('input', function() {
                                            modalContact.value = contact.value;
                                        });

                                        // Reflect room number
                                        roomNo.addEventListener('input', function() {
                                            modalRoomNo.value = roomNo.value;
                                        });

                                        // Reflect date
                                        date.addEventListener('input', function() {
                                            modalDate.value = date.value;
                                        });
                                    });
                                </script>


                                <step v-for="step in steps" :currentstep="currentstep" :key="step.id" :step="step" :stepcount="steps.length" @step-change="stepChanged">
                                </step>

                                <script type="x-template" id="step-navigation-template">
                                    <ol class="step-indicator">
                                        <li v-for="step in steps" is="step-navigation-step" :key="step.id" :step="step" :currentstep="currentstep">
                                        </li>
                                    </ol>
                                </script>

                                <script type="x-template" id="step-navigation-step-template">
                                    <li :class="indicatorclass">
                                        <div class="step"><i :class="step.icon_class"></i></div>
                                        <div class="caption hidden-xs hidden-sm">Step <span v-text="step.id"></span>: <span v-text="step.title"></span></div>
                                    </li>
                                </script>

                                <script type="x-template" id="step-template">
                                    <div class="step-wrapper" :class="stepWrapperClass">
                                        <button type="button" class="btn btn-primary" @click="lastStep" :disabled="firststep">
                                            Back
                                        </button>
                                        <button type="button" class="btn btn-primary" @click="nextStep" :disabled="laststep">
                                            Next
                                        </button>
                                    </div>
                                </script>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.4/vue.js'></script>
        <script src="<?php echo WEB_ROOT; ?>script/wizard.js"></script>
        <!-- JavaScript to handle modal opening -->
        <script>
            function openModal(element) {
                // Get the subcatid and subcategory name from the clicked element
                const subcatid = element.getAttribute('data-subcatid');
                const subcategor = element.getAttribute('data-subcategor');

                // Set it in the hidden input and modal title
                document.getElementById('modalSubcatId').value = subcatid;
                document.getElementById('modalSubcategor').value = subcategor;

                // Reflect the subcategory title in the review section
                document.getElementById('modalSubcategoryTitle').value = subcategor;

                // Open the modal (Bootstrap 5)
                const modal = new bootstrap.Modal(document.getElementById('subcategoryModal'));
                modal.show();
            }
        </script>
        <!-- end of modal -->
    </div>