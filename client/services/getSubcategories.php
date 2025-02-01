<?php
// Include database connection
include_once '../../global-library/database.php'; // Replace with your actual database connection file

// Debugging mode
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Get main_id from the request
    $main_id = isset($_GET['main_id']) ? intval($_GET['main_id']) : 0;

    if ($main_id === 0) {
        throw new Exception("Invalid main_id");
    }

    // Query to fetch subcategories
    $sql = "SELECT subcatid, sub_categor AS sub_category FROM ind_subcat WHERE main_id = :main_id AND is_deleted = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':main_id', $main_id, PDO::PARAM_INT);
    $stmt->execute();

    $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array

    // Return the subcategories as JSON
    header('Content-Type: application/json');
    echo json_encode($subcategories);
} catch (Exception $e) {
    // Return error response
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>