<?php
// test_db.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); // Start output buffering
require_once '../../global-library/database.php';
$output = ob_get_clean(); // Capture any output from included file

header('Content-Type: application/json');

if (!empty($output)) {
    echo json_encode(['error' => 'Output detected before headers', 'output' => $output]);
    exit;
}

if (isset($conn)) {
    $dbConnection = 'conn';
} elseif (isset($pdo)) {
    $dbConnection = 'pdo';
} else {
    echo json_encode(['error' => 'No database connection found']);
    exit;
}

echo json_encode(['success' => true, 'connection' => $dbConnection]);
?>