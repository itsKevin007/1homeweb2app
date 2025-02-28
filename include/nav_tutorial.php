<?php
	include '../global-library/database.php';

// Set appropriate content type for JSON response
header('Content-Type: application/json');

// Retrieve the raw POST data and decode JSON
$rawData = file_get_contents('php://input');
error_log("Raw Data: " . $rawData);
$data = json_decode($rawData, true);

// Check for JSON decode errors
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON Decode Error: " . json_last_error_msg());
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data: ' . json_last_error_msg()]);
    exit;
}

// Validate required parameters
if (!isset($data['user_id']) || !isset($data['nav_tutorial'])) {
    echo json_encode(['success' => false, 'error' => 'Missing required parameters.']);
    exit;
}

// Validate user_id is numeric
if (!is_numeric($data['user_id']) || $data['user_id'] <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid user ID.']);
    exit;
}

// Validate nav_tutorial is 0 or 1
if ($data['nav_tutorial'] !== 0 && $data['nav_tutorial'] !== 1 && 
    $data['nav_tutorial'] !== '0' && $data['nav_tutorial'] !== '1') {
    echo json_encode(['success' => false, 'error' => 'Invalid nav_tutorial value. Must be 0 or 1.']);
    exit;
}

try {
    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE bs_user SET nav_tutorial = :nav_tutorial WHERE user_id = :user_id");
    $stmt->bindValue(':nav_tutorial', $data['nav_tutorial']);
    $stmt->bindValue(':user_id', $data['user_id']);
    $result = $stmt->execute();
    
    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found or no changes made.']);
    }
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error occurred.']);
}
?>