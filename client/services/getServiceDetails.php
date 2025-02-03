<?php
// Get the subcategory ID from the URL
$subcatId = $_GET['id'];

// Prepare the query to fetch the service details from ind_subcat and related data from ind_maincat
$query = $conn->prepare("SELECT sub.subcatid, sub.subcategor, main.main_cat 
    FROM ind_subcat sub
    JOIN ind_maincat main ON sub.main_id = main.id
    WHERE sub.subcatid = :subcatid
");
$query->execute(['subcatid' => $subcatId]);
$service = $query->fetch(PDO::FETCH_ASSOC);

// Prepare the response
$response = [
    'subCategory' => $service['subcategor'],
    'mainCategory' => $service['main_cat'],
];

// Return the response as JSON
echo json_encode($response);

?>