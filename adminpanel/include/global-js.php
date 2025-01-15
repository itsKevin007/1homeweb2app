<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}
?>




<!-- Bootstrap JS -->
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/js/bootstrap.bundle.min.js"></script>
		<!--plugins-->
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/js/jquery.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/chartjs/chart.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/jquery-knob/excanvas.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/jquery-knob/jquery.knob.js"></script>
		<script>
			$(function() {
				$(".knob").knob();
			});
		</script>

		
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/notifications/js/lobibox.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/notifications/js/notifications.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/notifications/js/notification-custom-script.js"></script>

		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/js/index.js"></script>
		<!--app JS-->
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/js/app.js"></script>

		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo WEB_ROOT; ?>adminpanel/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!-- Feather ICONS JS -->
		<script src="https://unpkg.com/feather-icons"></script>

		<script>
			// Example starter JavaScript for disabling form submissions if there are invalid fields
				(function () {
				'use strict';

				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.querySelectorAll('.needs-validation');

				// Loop over them and prevent submission
				Array.prototype.slice.call(forms)
					.forEach(function (form) {
					form.addEventListener('submit', function (event) {
						if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
						}

						form.classList.add('was-validated');
					}, false);
					});
				})();

		</script>

<script>
	  
	  $(document).ready(function() {
	  $('#example').DataTable()
	});
	  
</script>

<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>


	


