<?php
// Include the database connection file
include '../../global-library/database.php'; // Adjust the path as needed

// Fetch client data
$client = $conn->prepare("SELECT * FROM bs_client WHERE user_id = :userId");
$client->bindParam(':userId', $userId, PDO::PARAM_INT);
$client->execute();
$client_data = $client->fetch();

if ($client_data) {
    $uid = $client_data['uid'];
    $fname = $client_data['c_fname'];
    $accnum = $client_data['accnum'];
} else {
    $uid = $fname = $accnum = null; // Handle the case when no data is found
}

// Fetch balance data
$bal = $conn->prepare("SELECT * FROM tbl_balance WHERE bal_id = :balId");
$bal->bindParam(':balId', $userId, PDO::PARAM_INT);
$bal->execute();
$bal_data = $bal->fetch();

if ($bal_data) {
    $balance = $bal_data['balance'];
} else {
    $balance = "0.00";
}

// Function to handle the transfer
function transferMoney($senderId, $receiverId, $amount)
{
    global $conn;

    // Sanitize input
    $senderId = (int) $senderId;
    $receiverId = (int) $receiverId;
    $amount = (float) $amount;

    if ($amount <= 0) {
        return "Invalid amount.";
    }

    // Start transaction
    $conn->beginTransaction();

    try {
        // Check sender's balance
        $stmt = $conn->prepare("SELECT balance FROM tbl_balance WHERE bal_id = :balId");
        $stmt->bindParam(':balId', $senderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception("Sender not found.");
        }

        $senderBalance = $result['balance'];
        if ($senderBalance < $amount) {
            throw new Exception("Insufficient balance.");
        }

        // Deduct from sender
        $stmt = $conn->prepare("UPDATE tbl_balance SET balance = balance - :amount WHERE bal_id = :balId");
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':balId', $senderId, PDO::PARAM_INT);
        $stmt->execute();

        // Add to receiver
        $stmt = $conn->prepare("SELECT balance FROM tbl_balance WHERE bal_id = :receiverId");
        $stmt->bindParam(':receiverId', $receiverId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception("Receiver not found.");
        }

        $stmt = $conn->prepare("UPDATE tbl_balance SET balance = balance + :amount WHERE bal_id = :receiverId");
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':receiverId', $receiverId, PDO::PARAM_INT);
        $stmt->execute();

        // Commit transaction
        $conn->commit();
        return "Transaction successful.";
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        return "Transaction failed: " . $e->getMessage();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiverId = $_POST['receiver_id'] ?? null;
    $amount = $_POST['amount'] ?? null;

    if ($receiverId && $amount) {
        $message = transferMoney($userId, $receiverId, $amount);
        echo "<script>alert('$message');</script>";
    } else {
        echo "<script>alert('Invalid input.');</script>";
    }
}
?>

<div class="site_content">
    <!-- Header Section Start -->
    <!-- Header Section End -->
    <!-- Wallet Page Details Start -->
    <section id="wallet-page-sec">
        <div class="container">
            <form action="" method="POST" iaction="transferMoney">
                <div class="wallet-first mt-24">
                    <div class="Wallet-first-content">
                        <div class="Wallet">
                            <p class="wallet-title">My Balance</p>
                        </div>
                        <div class="wallet-price">
                            <p class="wallet-txt1">₱ <?php echo $balance ?></p>
                        </div>
                    </div>
                    <p class="wallet-txt2">Enter the exact amount of Payment</p>
                </div>
                <div class="wallet-second mt-24">
                    <input type="number" placeholder="Enter Receiver's ID" name="receiver_id" required />
                    <div class="wallet-amount-sec">
                        <div class="serachbar-homepage2 mt-24">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-peso" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 19v-14h3.5a4.5 4.5 0 1 1 0 9h-3.5" />
                                        <path d="M18 8h-12" />
                                        <path d="M18 11h-12" />
                                    </svg>
                                </span>
                                <input type="number" placeholder="Enter Amount" class="form-control search-text" name="amount" id="amount" onchange="checkBalanceWithAlert()">
                                <script>
                                    function checkBalanceWithAlert() {
                                        var amount = document.getElementById("amount").value;
                                        if (<?php echo $balance; ?> < amount) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: "You don't have enough balance"
                                            });
                                        } else {}
                                    }
                                </script>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center item-center mt-16">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Pay</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Wallet Page Details End -->
</div>