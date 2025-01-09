<!-- Modify Profile Section Start -->
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/location.css">

<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/add-location.css" />
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>libraries/leaflet/leaflet.css" />
<script src="<?php echo WEB_ROOT; ?>libraries/leaflet/leaflet.js"></script>

<style>
    #map1,
    #map {
        width: 100%;
        border-radius: 10px;
    }

    #swipeableHeader {
        touch-action: none;
        cursor: grab;
        position: relative;
    }

    .swipe-indicator {
        width: 50px;
        height: 5px;
        background-color: #ccc;
        border-radius: 2.5px;
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
    }
</style>

<?php
if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';

if ($errorMessage == 'Success') {
?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: '',
            icon: 'success', // Use 'info', 'warning', or 'error' for other types
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
            background: '#fefefe', // Customize background
            customClass: {
                popup: 'animate__animated animate__fadeInDown' // Add smooth animation
            }
        });
    </script>

<?php
} elseif ($errorMessage == 'eandc') {
?>

    <script>
        Swal.fire({
            title: 'Warning!',
            text: 'Email or Contact Number Exist',
            icon: 'warning', // Use 'info', 'warning', or 'error' for other types
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#FA113D',
            background: '#fefefe', // Customize background
            customClass: {
                popup: 'animate__animated animate__fadeInDown' // Add smooth animation
            }
        });
    </script>

<?php
} else {
}

?>
<section id="profile-page-sec">

   
    <div class="wrapper">
        <?php
        $prop = $conn->prepare("SELECT * FROM tbl_location WHERE user_id = '$userId' AND is_deleted != '1'");
        $prop->execute();

        $prop_data = [];
        if ($prop->rowCount() > 0) {
            $prop_data = $prop->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($prop_data)) {
            foreach ($prop_data as $row) {
                $id = $row['l_id'];
                $address = $row['name'];
                $is_active = $row['is_active'];
                $long = $row['area_long'];
                $lat = $row['area_lat'];

                $active_status = $is_active == 1 ? 'Active' : 'Inactive';
                $status_class = $is_active == 1 ? 'text-success' : 'text-danger';

                // Placeholder image (use real image or dynamic content here)
                $placeholder_image = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD///Z";
        ?>
               
                    <div class="card">
                        <img src="<?php echo $placeholder_image; ?>" alt="Location Image">
                        <div class="descriptions">
                            <h4><?php echo htmlspecialchars($address); ?></h4>
                            <p><strong>Status:</strong> <span class="<?php echo $status_class; ?>"><?php echo $active_status; ?></span></p>
                            <p style="margin-top: -100px;"><strong>Coordinates:</strong> <?php echo htmlspecialchars($long); ?>, <?php echo htmlspecialchars($lat); ?></p>
                            <button class="btn btn-primary btn-sm"
                                data-name="<?php echo htmlspecialchars($address); ?>"
                                data-long="<?php echo htmlspecialchars($long); ?>"
                                data-lat="<?php echo htmlspecialchars($lat); ?>"
                                data-address="<?php echo htmlspecialchars($address); ?>"
                                data-areaId="<?php echo $id; ?>"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#editArea" style="margin-top: -200px;">
                                Edit Location
                            </button>
                            <button href="process.php?action=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm" style="margin-top: -200px;">
                                Delete Location
                            </button>
                        </div>
                    </div>
                
            <?php
            }
        } else {
            ?>
            <p>No properties found.</p>
        <?php
        }
        ?>
    </div>




</section>



<!-- Offcanvas -->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="addArea"
    style="border-top-left-radius: 20px; border-top-right-radius: 20px; height: auto; max-height: 80vh;"
    aria-labelledby="addAreaBottomLabel">
    <div class="offcanvas-header d-flex justify-content-center align-items-center" id="swipeableHeader" style="height: 60px;">
        <div class="swipe-indicator"></div>
        <h5 class="offcanvas-title" id="addAreaBottomLabel">Add Address</h5>
    </div>

    <div class="offcanvas-body d-flex flex-column">
        <form class="needs-validation flex-grow-1" novalidate method="post" action="process.php?action=add" enctype="multipart/form-data" name="form" id="form">
            <!-- <div class="mb-3 flex-grow-1">
                <input type="text" class="form-control form-control-sm mt-2" id="search" name="search" placeholder="Search box" autocomplete="off" required />
            </div> -->

            <div class="row mt-16">
                <div id="map1" style="height: 300px; width: 100%;"></div> <!-- Adjust height as needed -->
                <input type="hidden" class="form-control form-control-sm" id="long" name="long" placeholder="Long" autocomplete="off" required />
                <input type="hidden" class="form-control form-control-sm" id="lat" name="lat" placeholder="Lat" autocomplete="off" required />
            </div>

            <div class="mt-16">
                <center><label class="mt-16"><b>Address</b></label></center>
                <textarea type="text" rows="2" class="form-control" id="address" name="address" placeholder="Area Address" autocomplete="off" readonly required></textarea>
            </div>

            <br>
            <!-- for image of property upload -->
            <div class="card">
                <center><label class="mt-16"><b>Property's Image</b></label></center>
                <div class="card-body">
                    <input id="fancy-file-upload" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png" multiple>
                </div>
            </div>

            <hr>

            <div class="col-12 col-sm-12 mb-2">
                <button type="submit" style="width:100%;border-radius:15px;background-color:#073782;color:white;" class="btn btn waves-effect waves-light">Add</button>
            </div>
            <div class="col-12 col-sm-12">
                <button type="button" style="width:100%;border-radius:15px;background-color:#070302;" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!-- /.offcanvas -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const offcanvas = document.getElementById('addArea');
        const swipeableHeader = document.getElementById('swipeableHeader');
        let startY;

        swipeableHeader.addEventListener('touchstart', (e) => {
            startY = e.touches[0].clientY;
        });

        swipeableHeader.addEventListener('touchmove', (e) => {
            let currentY = e.touches[0].clientY;
            let diffY = currentY - startY;

            if (diffY > 50) { // You can adjust the threshold as needed
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                bsOffcanvas.hide();
            }
        });

        swipeableHeader.addEventListener('mousedown', (e) => {
            startY = e.clientY;
            swipeableHeader.style.cursor = 'grabbing';
        });

        swipeableHeader.addEventListener('mousemove', (e) => {
            if (e.buttons === 1) { // Only track if the mouse button is held down
                let currentY = e.clientY;
                let diffY = currentY - startY;

                if (diffY > 50) { // You can adjust the threshold as needed
                    let bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                    bsOffcanvas.hide();
                    swipeableHeader.style.cursor = 'grab';
                }
            }
        });

        swipeableHeader.addEventListener('mouseup', () => {
            swipeableHeader.style.cursor = 'grab';
        });
    });
</script>


<script>
    var map1;
    var marker1;

    function initMap() {
        // Initialize map centered at [0, 0] with zoom level 16
        map1 = L.map('map1').setView([0, 0], 16);

        // Initialize map with OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map1);

        marker1 = L.marker([0, 0]).addTo(map1);

        // Use navigator.geolocation to get current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                // Set map view to current location
                map1.setView([lat, lng], 13); // Adjust zoom level as needed

                // Update marker position and popup content
                marker1.setLatLng([lat, lng]).bindPopup('<center>Current <br> Location</center>').openPopup();

                // Update the latitude and longitude input fields
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = lng;

                // Fetch address for the current location
                fetchAddress(lat, lng);
            }, function(error) {
                console.error('Error getting location:', error);
                // Optional: Add fallback behavior if geolocation fails
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
            // Optional: Add fallback behavior if geolocation is not supported
        }

        // Add click event handler to the map
        map1.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Update marker position and popup content
            marker1.setLatLng([lat, lng]).bindPopup('<center>Selected <br> Location</center>').openPopup();

            // Update the latitude and longitude input fields
            document.getElementById('lat').value = lat;
            document.getElementById('long').value = lng;

            // Fetch address for the selected location
            fetchAddress(lat, lng);
        });
    }

    function fetchAddress(lat, lng) {
        // Use the Nominatim API to get the address from latitude and longitude
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data && data.address) {
                    // Update the address field
                    document.getElementById('address').value = data.display_name;
                } else {
                    document.getElementById('address').value = 'Address not found';
                }
            })
            .catch(error => {
                console.error('Error fetching address:', error);
                document.getElementById('address').value = 'Error fetching address';
            });
    }

    function showLocation(empName, lat, lng) {
        $('#addArea').on('shown.bs.offcanvas', function() {
            map1.invalidateSize(); // Force map to recalculate size
            // Update marker position and popup content
            marker1.setLatLng([lat, lng]).bindPopup(empName).openPopup();
            map1.setView([lat, lng], 17); // Set view to marker position with zoom level 17
        });

        // Remove the event listener after the modal is hidden to prevent multiple bindings
        $('#addArea').on('hidden.bs.offcanvas', function() {
            $('#addArea').off('shown.bs.offcanvas');
        });
    }

    // Initialize the map when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>




<!-- Offcanvas -->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="editArea"
    style="border-top-left-radius: 20px; border-top-right-radius: 20px; height: auto; max-height: 80vh;"
    aria-labelledby="editAreaBottomLabel">
    <div class="offcanvas-header d-flex justify-content-center align-items-center" id="swipeableHeader1" style="height: 60px;">
        <div class="swipe-indicator"></div>
        <h5 class="offcanvas-title" id="editAreaBottomLabel">Modify Address</h5>
    </div>

    <div class="offcanvas-body d-flex flex-column">
        <form class="needs-validation flex-grow-1" novalidate method="post" action="process.php?action=modify" enctype="multipart/form-data" name="form" id="form">
            <!-- <div class="mb-3 flex-grow-1">
                <input type="text" class="form-control form-control-sm mt-2" id="search" name="search" placeholder="Search box" autocomplete="off" required />
            </div> -->
            <div class="mb-3 flex-grow-1">
                <div id="map2" style="height: 300px; width: 100%;"></div> <!-- Adjust height as needed -->
                <input type="hidden" class="form-control form-control-sm" id="areaId" name="areaId" />
                <input type="hidden" class="form-control form-control-sm" id="longi" name="long" />
                <input type="hidden" class="form-control form-control-sm" id="lati" name="lat" />
            </div>
            <div class="mb-1">
                <center><b>Address</b></center>
                <textarea type="text" rows="2" class="form-control form-control-sm" id="aaddress" name="address" placeholder="Area Address" autocomplete="off" required></textarea>
            </div>
            <hr>
            <div class="col-12 col-sm-12 mb-2">
                <button type="submit" style="width:100%;border-radius:15px;background-color:#073782;color:white;" class="btn btn waves-effect waves-light">Modify</button>
            </div>
            <div class="col-12 col-sm-12">
                <button type="button" style="width:100%;border-radius:15px;background-color:#070302;" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!-- /.offcanvas -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const offcanvas = document.getElementById('editArea');
        const swipeableHeader = document.getElementById('swipeableHeader1');
        let startY;

        swipeableHeader.addEventListener('touchstart', (e) => {
            startY = e.touches[0].clientY;
        });

        swipeableHeader.addEventListener('touchmove', (e) => {
            let currentY = e.touches[0].clientY;
            let diffY = currentY - startY;

            if (diffY > 50) { // You can adjust the threshold as needed
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                bsOffcanvas.hide();
            }
        });

        swipeableHeader.addEventListener('mousedown', (e) => {
            startY = e.clientY;
            swipeableHeader.style.cursor = 'grabbing';
        });

        swipeableHeader.addEventListener('mousemove', (e) => {
            if (e.buttons === 1) { // Only track if the mouse button is held down
                let currentY = e.clientY;
                let diffY = currentY - startY;

                if (diffY > 50) { // You can adjust the threshold as needed
                    let bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                    bsOffcanvas.hide();
                    swipeableHeader.style.cursor = 'grab';
                }
            }
        });

        swipeableHeader.addEventListener('mouseup', () => {
            swipeableHeader.style.cursor = 'grab';
        });
    });
</script>

<script>
    var map2;
    var marker2;

    function initEditMap(lat, lng) {
        var map2 = L.map('map2').setView([lat, lng], 16);


        // Initialize map with OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map2);

        var marker2 = L.marker([lat, lng]).addTo(map2).bindPopup('<center>Current <br> Location</center>').openPopup();

        // Add click event handler to the map
        map2.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Update marker position and popup content
            marker2.setLatLng([lat, lng]).bindPopup('<center>Selected <br> Location</center>').openPopup();

            // Update the latitude and longitude input fields
            document.getElementById('lati').value = lat;
            document.getElementById('longi').value = lng;

            // Fetch address for the selected location
            fetchAddress1(lat, lng);
        });
    }

    function fetchAddress1(lat, lng) {
        // Use the Nominatim API to get the address from latitude and longitude
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data && data.address) {
                    // Update the address field
                    document.getElementById('aaddress').value = data.display_name;
                } else {
                    document.getElementById('aaddress').value = 'Address not found';
                }
            })
            .catch(error => {
                console.error('Error fetching address:', error);
                document.getElementById('address').value = 'Error fetching address';
            });
    }

    function showLocation1(empName, lat, lng) {
        $('#editArea').on('shown.bs.offcanvas', function() {
            map2.invalidateSize(); // Force map to recalculate size
            // Update marker position and popup content
            marker2.setLatLng([lat, lng]).bindPopup(empName).openPopup();
            map2.setView([lat, lng], 17); // Set view to marker position with zoom level 17
        });

        // Remove the event listener after the modal is  hidden to prevent multiple bindings
        $('#editArea').on('hidden.bs.offcanvas', function() {
            $('#editArea').off('shown.bs.offcanvas');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var offcanvasElement = document.getElementById('editArea');
        offcanvasElement.addEventListener('show.bs.offcanvas', function(event) {
            console.log('Edit area canvas activated');

            var button = event.relatedTarget;
            var long = button.getAttribute('data-long');
            var lat = button.getAttribute('data-lat');
            var areaId = button.getAttribute('data-areaId');
            var address = button.getAttribute('data-address');

            var offcanvaslong = offcanvasElement.querySelector('#longi');
            var offcanvasclat = offcanvasElement.querySelector('#lati');
            var offcanvasareaId = offcanvasElement.querySelector('#areaId');
            var offcanvasaddress = offcanvasElement.querySelector('#aaddress');

            offcanvaslong.value = long;
            offcanvasclat.value = lat;
            offcanvasareaId.value = areaId;
            offcanvasaddress.value = address;

            // Initialize the map with the given lat and long
            initEditMap(lat, long);
        });
    });
</script>