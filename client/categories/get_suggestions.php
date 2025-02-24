<?php
header('Content-Type: application/json');

require_once '../../global-library/database.php';

// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare SQL query
$sql = "SELECT sub_categor FROM ind_subcat WHERE sub_categor LIKE :searchTerm ORDER BY sub_categor ASC";

// Prepare statement
$stmt = $conn->prepare($sql);

// Add wildcards to search term
$searchTerm = "%$search%";
$stmt->bindParam(':searchTerm', $searchTerm);

// Execute query
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$suggestions = $result;

echo json_encode($suggestions);

$stmt->closeCursor();
$conn = null;
?>