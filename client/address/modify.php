<!-- Modify Profile Section Start -->

<link rel="stylesheet" href="<?php echo WEB_ROOT;?>style/add-location.css" />
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>libraries/leaflet/leaflet.css" />
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>style/toggle-button.css" />
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>style/section-location.css" />
<script src="<?php echo WEB_ROOT;?>libraries/leaflet/leaflet.js"></script>

<style>
  #map1, #map {
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

	if($errorMessage == 'Success')
	{
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
	}elseif($errorMessage == 'eandc'){
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
	}else{}

?>

<section id="profile-page-sec" class="section-location">

<div class="container  mt-24">
    <h4>PROPERTIES LOCATION</h4>
</div><br>
<div class="card" id="profile-third-sec">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">				
                <div class="profile-third-sec-full mt-24 ">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 add-button-loc">	
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addArea">
                                    <img src="../../assets/images/icon/add-location-alt-white.svg" alt="Add" width="20px">
                                </button>																																		
                            </div>
                        </div>
                    </div>
                <?php

                    $sql = $conn->prepare("SELECT * FROM tbl_location WHERE user_id = '$userId' AND is_deleted != '1'");
                    $sql->execute();
                    $count = $sql->rowCount();

                ?>
                
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Active</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($count > 0) {
                            $n = 1;
                            foreach ($sql as $row) 
                            {
                                    $id = $row['uid'];
                                    $areaId = $row['l_id'];
                                    $Address = $row['name'];
                                    $is_active = $row['is_active'];
                                    $Long = $row['area_long'];
                                    $Lat = $row['area_lat'];
                                    $landMark = $row['landMark'];


                                    if ($is_active == 1) {
                                        $active = 'checked'; // Set the checkbox to checked if active
                                    } else {
                                        $active = ''; // Leave it unchecked if not active
                                    }
                                ?>

                                <tr>                          
                                    <td>

                                    <div class="switch-container" data-id="<?php echo $id; ?>">
                                        <label class="switch">
                                            <input type="checkbox" class="switch-button" <?php echo $active; ?>>
                                            <span class="slider"></span>
                                        </label>
                                    </div>  

                                    </td>							
                                    <td>
                                        <b><?php echo $Address; ?></b><br>
                                        Landmark: <?php echo $landMark; ?>
                                    </td>
                                    <td>			
                                        <button type="button" data-long="<?php echo $Long?>" data-land="<?php echo $landMark; ?>" data-lat="<?php echo $Lat?>" data-address="<?php echo $Address?>" data-areaId="<?php echo $areaId?>" data-bs-toggle="offcanvas" data-bs-target="#editArea" class="btn btn-primary "><img src="../../assets/images/icon/edit-white.svg" width="15px" ></button>
                                    </td>
                                    <td>

                                        <a href="process.php?action=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-icon">
                                            <img src="<?php echo WEB_ROOT; ?>assets/images/icon/delete-white.svg" class="icon" />
                                        </a>					
                                    </td>
                                </tr>

                                <?php
                                $n++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No records found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>			
	</div>
</div>
<!-- script for switch and ajax -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
        $('.switch-button').on('change', function() {
            console.log('clicked');
            var checkbox = $(this);
            var id = checkbox.closest('.switch-container').data('id');
            var isActive = checkbox.is(':checked') ? 1 : 0;

            $.ajax({
                url: 'address-active.php', 
                type: 'POST',
                data: {
                    id: id,
                    is_active: isActive
                },
                success: function(response) {
                    console.log(response); // Log the server response
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
});
</script>



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
				<textarea type="text" rows="2" class="form-control" id="address" name="address" placeholder="Area Address" autocomplete="off" readonly required></textarea><br>
                <textarea type="text" rows="2" class="form-control" id="landMark" name="landMark" placeholder="Add Landmark (optional)" autocomplete="off"></textarea>
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
        $('#addArea').on('shown.bs.offcanvas', function () {
            map1.invalidateSize(); // Force map to recalculate size
            // Update marker position and popup content
            marker1.setLatLng([lat, lng]).bindPopup(empName).openPopup();
            map1.setView([lat, lng], 17); // Set view to marker position with zoom level 17
        });

        // Remove the event listener after the modal is hidden to prevent multiple bindings
        $('#addArea').on('hidden.bs.offcanvas', function () {
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
                <textarea type="text" rows="2" class="form-control form-control-sm" id="aaddress" name="address" placeholder="Area Address" autocomplete="off" required></textarea><br>
                <textarea type="text" rows="2" class="form-control" id="mod-landMark" name="landMark" placeholder="Add Landmark (optional)" autocomplete="off"></textarea>
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
    // Check if map already exists and remove it
    if (map2) {
        map2.remove(); // Remove existing map instance
    }

    map2 = L.map('map2').setView([lat, lng], 16);

    // Initialize map with OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map2);

    marker2 = L.marker([lat, lng]).addTo(map2)
        .bindPopup('<center>Current <br> Location</center>')
        .openPopup();

    // Add click event handler to the map
    map2.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Update marker position and popup content
        marker2.setLatLng([lat, lng])
            .bindPopup('<center>Selected <br> Location</center>')
            .openPopup();

        // Update the latitude and longitude input fields
        document.getElementById('lati').value = lat;
        document.getElementById('longi').value = lng;

        // Fetch address for the selected location
        fetchAddress1(lat, lng);
    });
}

function fetchAddress1(lat, lng) {
    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json())
        .then(data => {
            if (data && data.address) {
                document.getElementById('aaddress').value = data.display_name;
            } else {
                document.getElementById('aaddress').value = 'Address not found';
            }
        })
        .catch(error => {

            document.getElementById('aaddress').value = 'Error fetching address';
        });
}

document.addEventListener('DOMContentLoaded', function() {
    var offcanvasElement = document.getElementById('editArea');

    // When opening the offcanvas
    offcanvasElement.addEventListener('show.bs.offcanvas', function(event) {
        
        var button = event.relatedTarget;
        var long = button.getAttribute('data-long');
        var lat = button.getAttribute('data-lat');
        var areaId = button.getAttribute('data-areaId');
        var address = button.getAttribute('data-address');
        var landmark = button.getAttribute('data-land');

        var offcanvaslong = offcanvasElement.querySelector('#longi');
        var offcanvasclat = offcanvasElement.querySelector('#lati');
        var offcanvasareaId = offcanvasElement.querySelector('#areaId');
        var offcanvasaddress = offcanvasElement.querySelector('#aaddress');
        var offcanvaslandmark = offcanvasElement.querySelector('#mod-landMark');

        offcanvaslong.value = long;
        offcanvasclat.value = lat;
        offcanvasareaId.value = areaId;
        offcanvasaddress.value = address;
        offcanvaslandmark.value = landmark;

        // Initialize the map with the given lat and long
        initEditMap(parseFloat(lat), parseFloat(long));
    });

    // When closing the offcanvas, clear input fields and remove the map
    offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {

        // Clear input fields
        offcanvasElement.querySelector('#longi').value = '';
        offcanvasElement.querySelector('#lati').value = '';
        offcanvasElement.querySelector('#areaId').value = '';
        offcanvasElement.querySelector('#aaddress').value = '';
        offcanvasElement.querySelector('#mod-landMark').value = '';

        // Remove the map instance
        if (map2) {
            map2.remove();
            map2 = null; // Reset the map instance
        }
    });
});
</script>