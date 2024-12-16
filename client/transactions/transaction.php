<?php

$trans = $conn->prepare("SELECT * FROM tr_log WHERE action_by = :userId");
$trans->bindParam(':userId', $userId, PDO::PARAM_INT);
$trans->execute();


if ($trans->rowCount() > 0) {
    while($trans_data = $trans->fetch()) {
        $module = $trans_data['module'];
        $action = $trans_data['action'];
        $description = $trans_data['description'];
        $by = $trans_data['action_by'];
        $date = $trans_data['log_action_date'];
    }
    
} else {
    $action = "No history found";
    $description = "No history found";
    $by = "No history found";
    $date = "No history found";
}
?>

<div class="homepage-second-sec">
    <div style="width: 100%;">
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(87deg, rgba(2, 44, 92, 1) 1%, rgba(4,69,117,1) 100%); height: 60px;">
            <h2 style="color: #d7d7df; font-weight: 600;">Transactions</h2>
        </div>
    </div>

    <div style="width: 100%; margin-bottom: 15px;">
        <div class="mt-16">
            <h3 style="margin-left: 5%;">As of <?php echo date('F j, Y'); ?></h3>
        </div>
    </div>

    <div style="background-color: #fff;">
        <div style="justify-content: center; align-items: center; display: flex;">
            <table style="width: 90%; text-align: left; border-collapse: collapse;">
                <thead style="background-color: #ccc;">
                    <tr>
                        <th scope="col">Action</th>
                        <th scope="col">Description</th>
                        <th scope="col">By</th>
                        <th scope="col">Date of Transactions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Action"><?php echo $action; ?></td>
                        <td data-label="Descripti   on"><?php echo $description; ?></td>
                        <td data-label="By"><?php echo $by; ?></td>
                        <td data-label="Date of Transactions"><?php echo $date; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="padding:3%; justify-content: center; align-items: center; display: flex;">
        <form id="dateRangeForm" style="width: 90%;">
            <div style="flex-direction: column;">
                <div class="col">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="col">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <div class="flex mt-3">
                    <button type="button" class="btn btn-primary w-100" id="filterButton">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>