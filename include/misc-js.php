<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}
?>
	<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>global-library/common.js"></script>
	<!-- Confirm Submission of Form !-->
	<script LANGUAGE="JavaScript">
	<!--
		// Nannette Thacker http://www.shiningstar.net
		function confirmSubmit()
		{
			var agree=confirm("Make sure all informations are correct. Changes are not allowed once submitted. Please confirm to continue.");
			if (agree)
			return true ;
		else
			return false ;
		}

		function locationSubmit(location) {
			const form = document.createElement('form');
			form.method = 'POST';
			form.action = `<?php echo WEB_ROOT; ?>client/quote/index.php`;

			// Create a hidden input for location_id
			const input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'location_id';
			input.value = location;
			form.appendChild(input);

			// Append the form to the body and submit it
			document.body.appendChild(form);
			form.submit();
		}

		
		// Nannette Thacker http://www.shiningstar.net
		function confirmDelete()
		{
			var agree=confirm("Are you sure you want to permanently delete this item? Please confirm to continue.");
			if (agree)
			return true ;
		else
			return false ;
		}
	// -->
	</script>		