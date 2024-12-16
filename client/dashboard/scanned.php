<?php
include '../../global-library/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['qrCode'])) {
        $qrCode = $input['qrCode'];

        $chk = $conn->prepare("SELECT * FROM bs_user WHERE uid = :qrCode AND is_deleted != '1'");
        $chk->bindParam(':qrCode', $qrCode, PDO::PARAM_STR);
        $chk->execute();

        if ($chk->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'QR Valid.', 'redirect' => 'index.php?view=payment']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid QR Code.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'QR Code not provided.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
