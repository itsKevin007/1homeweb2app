<?php
	require '../global-library/database.php'; // Make sure this file establishes the $conn PDO connection
	require '../global-library/config.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) 
	{
		if (!isset($user_data['user_id'])) {
			echo 'invalid'; // User ID not set in session
			exit;
		}

		$userId = $user_data['user_id']; // Get user ID from session
		$password = md5($_POST['password']); // Hash the input password

		$stmt = $conn->prepare("SELECT user_id, password FROM bs_user WHERE password = :password AND user_id = :user_id");
		$stmt->execute(['password' => $password, 'user_id' => $userId]);

		if ($stmt->fetch()) {
			echo 'valid'; // Password matches
		} else {
			echo 'invalid'; // No match found
		}

	}
?>
