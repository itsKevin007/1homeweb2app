<?php
require_once '../global-library/config.php';
require_once '../include/functions.php';
include '../global-library/database.php';

$Apnt = $conn->prepare("SELECT * FROM bs_checkout WHERE user_id = '$userId' AND is_approved != '0' AND is_deleted != '1' ORDER BY created_at DESC");
$Apnt->execute();

while ($row = $Apnt->fetch(PDO::FETCH_ASSOC)):
?>
<ul>
    <li>
        <a href="product-detail-1.html">
            <figure><img src="<?php echo WEB_ROOT;?>img/calendar-check.png" class="appointment-active" alt="" width="30" height="30" class="lazy"></figure>
            <strong><span><b>Great news!</b> Your appointment has been successfully approved!</span></strong>
        </a>
    </li>
</ul>
<?php endwhile; ?>