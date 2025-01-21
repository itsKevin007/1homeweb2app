<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/services.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- dropdown -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/dropdown.css">
<?php

require_once '../../global-library/config.php';
require_once '../../include/functions.php';

if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$location_id = $_POST['location_id'] ?? null;
if (!$location_id) {
    echo "Error: Location ID is missing.";
    exit;
}

$nowLocation = $conn->prepare("SELECT * FROM tbl_location WHERE l_id = :locId");
$nowLocation->bindParam(':locId', $location_id, PDO::PARAM_INT);
$nowLocation->execute();

if ($nowLocation->rowCount() > 0) {
    $nowLocationData = $nowLocation->fetch(PDO::FETCH_ASSOC);

    $address = $nowLocationData['name'];
    $user_lon = $nowLocationData['area_long'];
    $user_lat = $nowLocationData['area_lat'];

    $standardScope = 10; // Default value 10km

    if (isset($_POST['scope']) && in_array($_POST['scope'], [10, 15, 20, 10000])) {
        $standardScope = (int)$_POST['scope'];
    }

    $scopeQuery = $conn->prepare("SELECT *, (6371 * ACOS( COS(RADIANS(:userLat)) * COS(RADIANS(area_lat)) * COS(RADIANS(area_long) - RADIANS(:userLon)) + SIN(RADIANS(:userLat)) * SIN(RADIANS(area_lat)))) 
        AS distance
        FROM tbl_location
        WHERE is_active = '1' AND is_deleted != '1' AND user_type != '0'
        AND user_id != :userId
        HAVING distance <= :scope
        ORDER BY distance ASC
    ");

    $scopeQuery->bindParam(':userLat', $user_lat);
    $scopeQuery->bindParam(':userLon', $user_lon);
    $scopeQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
    $scopeQuery->bindParam(':scope', $standardScope, PDO::PARAM_INT);
    $scopeQuery->execute();

    $locationsWithinScope = $scopeQuery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($locationsWithinScope as $location) {
        $user_id = $location['user_id'];

        $subcatQuery = $conn->prepare("SELECT * FROM ind_subcat WHERE user_id = :userId");
        $subcatQuery->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $subcatQuery->execute();

        if ($subcatQuery->rowCount() > 0) {
            echo '<div class="row">';
            while ($subcatData = $subcatQuery->fetch(PDO::FETCH_ASSOC)) {
                $sub_categor = $subcatData['sub_categor'];

                echo '
                <div class="col-lg-4">                
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="card card-1">
                            <div class="card-img"></div>
                            <a href="<?php echo WEB_ROOT; ?>client/quote/index.php?view=quote&user_id=<?php echo $user_id; ?>&sub_categor=<?php echo urlencode($sub_categor); ?>" class="card-link">
                                <div class="card-img-hovered"></div>
                            </a>
                            <div class="card-info">
                                <div class="card-about">
                                    <a class="card-tag tag-news">' . htmlspecialchars($sub_categor) . '</a>
                                    <div class="card-time">6/11/2018</div>
                                </div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                                    <h1 class="card-title">Company Name</h1>
                                <button 
                                        type="button" 
                                        class="btn btn-primary bookNowBtn" 
                                        data-sub-categor=" ' . htmlspecialchars($sub_categor) . ' " 
                                        data-address=" ' . htmlspecialchars($address) . ' "
                                        data-location-id="' . $location_id . '"
                                        >
                                        Book Now
                                    </button>
                                </div>
                                <div class="card-creator">Company Address <a href=""></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            echo '</div>';
        } else {
            echo '<div>No subcategories found for this user.</div>';
        }
    }
} else {
    echo "No location data found for the given location ID.";
}

?>
<!-- dropdown -->
<!-- Dropdown with form -->
<div style="float: right; margin-top: 10px; margin-right: 10px;">
    <form id="scopeForm" method="POST" style="background-color: grey; border-radius: 10px; padding: 10px;">
        <input type="hidden" name="location_id" value="<?php echo htmlspecialchars($location_id); ?>">
        <label for="scopeSelect">Select Area Range:</label>
        <select id="scopeSelect" name="scope" onchange="document.getElementById('scopeForm').submit();" style="background-color: grey; border:none;">
            <option value="10" <?php echo $standardScope == 10 ? 'selected' : ''; ?>>10km</option>
            <option value="15" <?php echo $standardScope == 15 ? 'selected' : ''; ?>>15km</option>
            <option value="20" <?php echo $standardScope == 20 ? 'selected' : ''; ?>>20km</option>
            <option value="10000" <?php echo $standardScope == 10000 ? 'selected' : ''; ?>>10000km</option>
        </select>
    </form>
</div>

<!-- dropdown end -->

<!-- Modal -->

<div class="modal" id="bookNowModal" tabindex="-1" role="dialog" aria-labelledby="bookNowModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookNowModalLabel">Please Confirm your information</h5>
                <button style="border:none" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#bookNowModal').modal('hide');">
                    <span aria-hidden="true">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="process.php?action=bookService" id="bookServiceForm">
                    <input type="hidden" name="location_id" id="location-id-hidden">
                    <input type="text" name="requested_service" id="requested-service-input"
                        style="background-color: #e4e8eb; border-radius: 10px; padding: 10px;" value="" required>
                    <textarea name="booking_address" id="address-input"
                        style="background-color: #e4e8eb; border-radius: 10px; padding: 10px; margin-top: 10px; width:100%;" required></textarea>
                    <label style="margin-top: 10px;">Contact Person</label>
                    <input type="text" placeholder="Contact Number" name="contact_num" id="contact-num-input"
                        style="background-color: #e4e8eb; border-radius: 10px; padding: 10px;" required>
                    <input type="hidden" name="service_id" id="service-id-hidden">
                    <div style="display: flex; justify-content: center; margin-top: 10px;">
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".bookNowBtn").forEach(button => {
        button.addEventListener("click", function() {
            const subCategor = this.getAttribute("data-sub-categor");
            const address = this.getAttribute("data-address");
            const locationId = this.getAttribute("data-location-id");
            const contactNum = this.getAttribute("data-contact-num");

            document.getElementById("requested-service-input").value = subCategor;
            document.getElementById("address-input").value = address;
            document.getElementById("contact-num-input").value = contactNum;
            document.getElementById("service-id-hidden").value = subCategor;
            document.getElementById("location-id-hidden").value = locationId;

            $("#bookNowModal").modal("show");
        });
    });
</script>