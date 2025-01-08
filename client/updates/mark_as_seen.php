<?php
$data = json_decode(file_get_contents('php://input'), true);
$notificationId = $data['notificationId'];

$conn = new mysqli('localhost', 'username', 'password', 'database');
$stmt = $conn->prepare("UPDATE notifications SET status = 'seen' WHERE id = ?");
$stmt->bind_param('i', $notificationId);
$stmt->execute();

echo json_encode(['message' => 'Notification marked as seen!']);
?>