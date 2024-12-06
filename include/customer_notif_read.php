<?php
require_once '../../global-library/config.php';
require_once '../../include/functions.php';
include '../../global-library/database.php';

$s_id = $_GET['s_id'];

$Apnt = $conn->prepare("SELECT * FROM bs_checkout WHERE s_id = '$s_id' AND is_approved != '1' AND is_deleted != '1' ORDER BY created_at DESC");
$Apnt->execute();

while ($row = $Apnt->fetch(PDO::FETCH_ASSOC)):
    // Get the current timestamp
    $current_time = time();

    // Get the timestamp from $row["created_at"] (assuming it's in the format "24-04-2024 15:40:14")
    $created_at_timestamp = strtotime($row["created_at"]);

    // Calculate the difference in seconds
    $difference = $current_time - $created_at_timestamp;

    // Calculate the difference in minutes
    $minutes_difference = floor($difference / 60);
?>
<a class="dropdown-item notify-item<?php echo ($row['is_view_notif'] == 0) ? ' active' : ''; ?>" role="button" href="<?php echo WEB_ROOT; ?>adminpanel/include/read-notification.php?checkout_id=<?php echo $row["checkout_id"]; ?>&s_id=<?php echo $row["s_id"]; ?>">
    <div class="notify-icon bg-primary">
        <i class="mdi mdi-comment-account-outline"></i>
    </div>
    <?php if ($row['is_view_notif'] == 0): ?>
    <b>
    <?php endif; ?>
    <p class="notify-details"><?php echo $row["name"]; ?> booked a <?php echo $row["ser_name"]; ?> on <?php echo $row["s_description"]; ?></p>
    <p class="text-muted mb-0 user-msg">
        <small>
            <?php
            // Output different formats based on the difference
            if ($minutes_difference < 1) {
                echo "Just now";
            } elseif ($minutes_difference < 60) {
                echo $minutes_difference . " minute(s) ago";
            } elseif ($minutes_difference < 1440) {
                echo floor($minutes_difference / 60) . " hour(s) ago";
            } else {
                // Beyond 24 hours, show the actual timestamp
                echo date("d-m-Y H:i:s", $created_at_timestamp);
            }
            ?>
        </small>
    </p>
    <?php if ($row['is_view_notif'] == 0): ?>
    </b>
    <?php endif; ?>
</a>
<?php endwhile; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('a.dropdown-item').click(function() {
            // Remove 'active' class from all dropdown items
            $('a.dropdown-item').removeClass('active');
            // Remove <b> tags from all dropdown items
            $('a.dropdown-item b').remove();
            // Add 'active' class to the clicked dropdown item
            $(this).addClass('active');
        });
    });
</script>
