<?php

if (!defined('WEB_ROOT')) {
    header('Location: ../index.php');
    exit;
}

$location_id = $_POST['location_id'];

// Get the current location of the user
$nowLocation = $conn->prepare("SELECT * FROM tbl_location WHERE l_id = :locId");
$nowLocation->bindParam(':locId', $location_id, PDO::PARAM_INT);
$nowLocation->execute();
$rowLocation = $nowLocation->rowCount();

if ($rowLocation > 0) {
    $nowLocationData = $nowLocation->fetch();

    $address = $nowLocationData['name'];
    $user_lon = $nowLocationData['area_long'];
    $user_lat = $nowLocationData['area_lat'];

    // Query to find nearby locations within the standard scope
    $scopeQuery = $conn->prepare("
        SELECT *, 
        (6371 * ACOS(
            COS(RADIANS(:userLat)) * COS(RADIANS(area_lat)) * COS(RADIANS(area_long) - RADIANS(:userLon)) +
            SIN(RADIANS(:userLat)) * SIN(RADIANS(area_lat))
        )) AS distance
        FROM tbl_location
        WHERE is_active = '1' AND is_deleted != '1'
        AND user_id != :userId
        HAVING distance <= :scope
        ORDER BY distance ASC
    ");

    // Define a standard scope (e.g., 10 km radius)
    $standardScope = 10;

    $scopeQuery->bindParam(':userLat', $user_lat);
    $scopeQuery->bindParam(':userLon', $user_lon);
    $scopeQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
    $scopeQuery->bindParam(':scope', $standardScope, PDO::PARAM_INT);
    $scopeQuery->execute();

    $locationsWithinScope = $scopeQuery->fetchAll();

    foreach ($locationsWithinScope as $location) {

        $user_id = $location['user_id'];

        $subcatQuery = $conn->prepare("SELECT * FROM ind_subcat WHERE user_id = :userId");
        $subcatQuery->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $subcatQuery->execute();
        $rowSubcat = $subcatQuery->rowCount();
        if ($rowSubcat > 0) {
            while($subcatData = $subcatQuery->fetch()){           
                $sub_categor = $subcatData['sub_categor'];
            }
        } else {
            $sub_categor = '';
        }

        echo 'category: ' . $sub_categor. '<br>';

    }

} else {
    echo "No location data found for the given location ID.";
}

?>
