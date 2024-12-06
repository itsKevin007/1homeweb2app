<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}

// if (preg_match('/(android|iphone|ipad|ipod|blackberry|iemobile|opera mini)/i', $_SERVER['HTTP_USER_AGENT'])) {
//     // If mobile, execute this
//     $icon = '<a href="' . WEB_ROOT . '" class="brand logo-dark"><img src="' . WEB_ROOT . 'img/icons/silverlogoh.png" style="width: clamp(150px, 15%, 100px);"></a>';
//     $icons = '';
// } else {
//     // If not mobile, execute this
//     $icon = '';
//     $icons = '<a href="' . WEB_ROOT . '" class="brand logo-dark"><img src="' . WEB_ROOT . 'img/icons/silverlogoh.png" style="width: clamp(150px, 15%, 100px);"></a>';
// }


?>

<header id="header" class="header_section">
	<nav class="navbar">
		<div class="container">
			<div class="col-12">
				<div class="row">
					<div class="col-lg-6">
						<div class="navbar-header">
							<button type="button" class="nav-btn navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="<?php echo WEB_ROOT;  ?>" class="brand logo-dark"><img src="<?php echo WEB_ROOT;  ?>img/icons/silverlogoh.png" style="width: clamp(150px, 15%, 100px);"></a>
						</div>
					</div>
					<?php if($userId != ""){ ?>
						<div class="col-lg-3">
							<div id="navbar" class="collapse navbar-collapse navbar-right">
								<ul class="nav navbar-nav nav-menu">
									<li class="active" style="color: #fff !important;"><a data-scroll href="#"><?php echo $user_data['lastname']; ?>, <?php echo $user_data['firstname']; ?><span class="sr-only">(current)</span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3">
							<div id="navbar" class="collapse navbar-collapse navbar-right">
								<ul class="nav navbar-nav nav-menu">
									<li class="active" style="color: #fff !important;"><a href="<?php echo $self; ?>?logout">Log Out<span class="sr-only">(current)</span></a></li>
								</ul>
							</div>
						</div>
					<?php }else{ ?>
						<div class="col-lg-6">
							<div id="navbar" class="collapse navbar-collapse navbar-right">
								<ul class="nav navbar-nav nav-menu">
									<li class="active" style="color: #fff !important;"><a data-scroll href="<?php echo WEB_ROOT; ?>login.php">Log In<span class="sr-only">(current)</span></a></li>
								</ul>
							</div>
						</div>
					<?php } ?>
				
				</div>
			</div> <!--/.navbar-collapse -->					
		</div>
	</nav><!-- Navigation Bar -->
</header> <!-- Header -->


<!-- <div id="myHeader" class="modal">
		<div class="modal-content">
			<span class="close-btn-header" id="closeHeader">&times;</span>
			<h2>Log in</h2>

				<form id="loginform" name="frmLogin" method="post">
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="form-label" for="username">Username:</label>
								<input type="text" id="txtUserName" name="txtUserName" placeholder="Enter Your Username" required>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="passsword">Password:</label>
								<input type="password" id="txtPassword" name="txtPassword" placeholder="Enter Your password" >
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12">
						<button type="submit" class="btn btn-lg btn-primary" style="width:100%;height:40px;background-color:#022C5C;border:1px #022C5C solid;color:white;border-radius:15px;">Submit Form</button>
					</div>
					
				</form>
		</div>
</div> -->

<!-- <script>
        // JavaScript for Modal
        const openHeader = document.getElementById('openHeader');
        const header = document.getElementById('myHeader');
        const closeHeader = document.getElementById('closeHeader');
        const closeBtnHeader = document.getElementById('closeBtnHeader');

        // Open modal when button is clicked
        openHeader.addEventListener('click', () => {
            header.style.display = 'flex';
        });

        // Close modal when 'x' is clicked
        closeHeader.addEventListener('click', () => {
            header.style.display = 'none';
        });

        // Close modal when close button is clicked
        closeBtnHeader.addEventListener('click', () => {
            header.style.display = 'none';
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                header.style.display = 'none';
            }
        });
    </script> -->