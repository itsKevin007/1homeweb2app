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
?>

<div class="site_content">
    <!-- Preloader Start -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader End -->
    <!-- Header Section Start -->
    <!-- Header Section End -->
    <!-- Wallet Page Details Start -->
    <section id="wallet-page-sec">
        <div class="container">
            <form>
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
                    <div class="wallet-amount-sec">
                        <div class="serachbar-homepage2 mt-24">
                            <div class="input-group ">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-peso" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 19v-14h3.5a4.5 4.5 0 1 1 0 9h-3.5" />
                                        <path d="M18 8h-12" />
                                        <path d="M18 11h-12" />
                                    </svg>
                                </span>
                                <input type="number" placeholder="Enter Amount" class="form-control search-text" id="amount" onchange="checkBalanceWithAlert()">
                                <script>
                                    function checkBalanceWithAlert() {
                                        var amount = document.getElementById("amount").value;
                                        if (<?php echo $balance; ?> < amount) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: "You don't have enough balance"
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: "You have enough balance"
                                            });
                                        }
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