<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}
?>

	<script src="<?php echo WEB_ROOT; ?>ph-address-selector.js"></script>

<script src="<?php echo WEB_ROOT; ?>assets/js/jquery-min-3.6.0.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/slick.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/modal.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/custom.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/multi-select.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/dateFilter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/drawer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/qrReader.js"></script> <!--might remove this one -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<script>
	// When page loads, it will trigger the circle menu
	window.onload = function() {
		var menuButton = document.getElementById("open-menu");
		menuButton.click();
	};
</script>

<script>
	$('.card').click(function() {
		$(this).toggleClass('flipped');
	});
</script>