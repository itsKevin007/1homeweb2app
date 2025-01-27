<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}
?>

<script src="<?php echo WEB_ROOT; ?>philippine-address/philippine-address-selector-main/ph-address-selector.js"></script>

<script src="<?php echo WEB_ROOT; ?>assets/js/jquery-min-3.6.0.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/slick.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/modal.js"></script>
<script src="<?php echo WEB_ROOT; ?>assets/js/custom.js"></script>

<script src="<?php echo WEB_ROOT; ?>assets/js/drawer.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

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

<script>
	if ("serviceWorker" in navigator) {
		navigator.serviceWorker.register("<?php echo WEB_ROOT; ?>service-worker.js")
			.then((registration) => {
				console.log("Service Worker registered with scope:", registration.scope);
			})
			.catch((error) => {
				console.log("Service Worker registration failed:", error);
			});
	}
</script>