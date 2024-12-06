<?php
if (!defined('WEB_ROOT')) {
	header('Location: index.php');
	exit;
}
    $sql = $conn->prepare("SELECT * FROM bs_page");
    $sql->execute();
    $sql_data = $sql->fetch();

    $page = $sql_data['page'];

	if ($user_data['thumbnail']) {
		$user_img = WEB_ROOT . 'assets/images/employee/' . $user_data['thumbnail'];
	} else {
		$user_img = WEB_ROOT . 'assets/images/user/noimage.png';
	}

?>	
	<div class="left-side-menu">

    <div class="h-100" data-simplebar>

         <!-- User box -->
        <div class="user-box text-center">

            <img src="<?php echo $user_img; ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?php echo $user_data['firstname']; ?> <?php echo $user_data['lastname']; ?></a>
                    <div class="dropdown-menu user-pro-dropdown">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>My Account</span>
                        </a>
        
                        <!-- item-->
                        <a href="<?php echo $self; ?>?logout" class="dropdown-item notify-item">
                            <i class="fe-log-out me-1"></i>
                            <span>Logout</span>
                        </a>
        
                    </div>
                </div>

            <p class="text-muted left-user-info">Admin Head</p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-account"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="<?php echo $self; ?>?logout">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
<!-- CONDITIONS -->



<?php
$userId = $_SESSION['user_id'];

$sql = $conn->prepare("SELECT * FROM bs_user WHERE user_id = '$userId' AND is_deleted != '1'");
$sql->execute();
while($sql_data = $sql->fetch()){

if ($sql_data['is_user'] == 0) {
    $disabled12 = "hidden";
} else {
    $disabled12 = "";
}

if ($sql_data['is_staff'] == 0) {
    $disabled = "hidden";
} else {
    $disabled = "";
}

if ($sql_data['is_department'] == 0) {
    $disabled2 = "hidden";
} else {
    $disabled2 = "";
}


if ($sql_data['is_position'] == 0) {
    $disabled3 = "hidden";
} else {
    $disabled3 = "";
}


if ($sql_data['is_ranking'] == 0) {
    $disabled4 = "hidden";
} else {
    $disabled4 = "";
}

if ($sql_data['is_onboard'] == 0) {
    $disabled5 = "hidden";
} else {
    $disabled5 = "";
}

if ($sql_data['is_staff_temp'] == 0) {
    $disabled6 = "hidden";
} else {
    $disabled6 = "";
}

if ($sql_data['is_staff_eval'] == 0) {
    $disabled7 = "hidden";
} else {
    $disabled7 = "";
}

if ($sql_data['is_staff_response'] == 0) {
    $disabled8 = "hidden";
} else {
    $disabled8 = "";
}

if ($sql_data['is_attendance'] == 0) {
    $disabled9 = "hidden";
} else {
    $disabled9 = "";
}

if ($sql_data['is_loan'] == 0) {
    $disabled10 = "hidden";
} else {
    $disabled10 = "";
}

if ($sql_data['is_loantype'] == 0) {
    $disabled11 = "hidden";
} else {
    $disabled11 = "";
}

if ($sql_data['is_report'] == 0) {
    $disabled12 = "hidden";
} else {
    $disabled12 = "";
}
}


?>
<!-- END CONDITIONS -->
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Masterlist</li>

             <!--   <li>
                    <a href="<?php echo WEB_ROOT; ?>">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li> -->

                <li <?php echo $disabled12; ?>>
                    <a href="<?php echo WEB_ROOT; ?>test/">
                        <i class="mdi mdi-account"></i>
                        <span> Test </span>
                    </a>
                </li>
				
				<li <?php echo $disabled12; ?>>
                    <a href="<?php echo WEB_ROOT; ?>user/">
                        <i class="mdi mdi-account"></i>
                        <span> User </span>
                    </a>
                </li>

                <li <?php echo $disabled; ?>>
                    <a href="<?php echo WEB_ROOT; ?>employee/">
                        <i class="mdi mdi-account-group"></i>
                        <span> Staff </span>
                    </a>
                </li>

                <li <?php echo $disabled2; ?>>
                    <a href="<?php echo WEB_ROOT; ?>department/">
                        <i class="mdi mdi-human-queue"></i>
                        <span> Department </span>
                    </a>
                </li>

                <li <?php echo $disabled3; ?>>
                    <a href="<?php echo WEB_ROOT; ?>position/">
                        <i class="mdi mdi-badge-account"></i>
                        <span> Position </span>
                    </a>
                </li>

                <li <?php echo $disabled4; ?>>
                    <a href="<?php echo WEB_ROOT; ?>ranking/">
                        <i class="mdi mdi-family-tree"></i>
                        <span> Ranking </span>
                    </a>
                </li>

                <li <?php echo $disabled5; ?>>
                    <a href="<?php echo WEB_ROOT; ?>onboarding/">
                        <i class="mdi mdi-account-plus"></i>
                        <span> On Boarding </span>
                    </a>
                </li>

                <li <?php echo $disabled6; ?>>
                    <a href="<?php echo WEB_ROOT; ?>kpi/">
                    <i class="mdi mdi-account-question"></i>
                    <span> Staff Evaluation Templates </span>
                    </a>
                </li>

                <li <?php echo $disabled7; ?>>
                    <a href="<?php echo WEB_ROOT; ?>question/">
                        <i class="mdi mdi-account-question"></i>
                    <span> Staff Evaluation Form </span>
                    </a>
                </li>

                <li <?php echo $disabled8; ?>>
                    <a href="<?php echo WEB_ROOT; ?>response/">
                        <i class="mdi mdi-message-reply-text"></i>
                        <span> Staff Response. </span>
                    </a>
                </li>

                <li <?php echo $disabled9; ?>>
                    <a href="<?php echo WEB_ROOT; ?>attendance/">
                        <i class="fe-calendar"></i>
                        <span> Attendance </span>
                    </a>
                </li>

                <li <?php echo $disabled10; ?>>
                    <a href="<?php echo WEB_ROOT; ?>client/">
                        <i class="mdi mdi-account-cash"></i>
                        <span> Loan </span>
                    </a>
                </li>

                <li <?php echo $disabled11; ?>>
                    <a href="<?php echo WEB_ROOT; ?>loan-type/">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span> Loan Type </span>
                    </a>
                </li>
                    <li>
                    <a href="<?php echo WEB_ROOT; ?>answer/">
                        <i class="mdi mdi-list-status"></i>
                        <span> Evaluation </span>
                    </a>
                </li>
                <?php
							if($user_data['is_report'] == '1')
							{
						
								$rep = $conn->prepare("SELECT * FROM bs_report WHERE is_deleted != '1' ORDER BY name ASC");
								$rep->execute();
						?>
								<div class="menu-title">Report</div>
									<?php
										if($rep->rowCount() > 0)
										{
											$activeR = '5';
											while($rep_data = $rep->fetch())
											{
													if($page == $activeR){ $activeRp = "active"; }else{ $activeRp = ""; }
													
													$activeR++
									?>
												<li <?php echo $disabled12; ?> class="sidebar-menu-item <?php echo $activeRp; ?>">
													<a class="sidebar-menu-button"
													   href="<?php echo WEB_ROOT; ?>report/index.php?view=search&id=<?php echo $rep_data['report_id']; ?>">
                                                       <i class="mdi mdi-table-account"></i>
														<span class="material-icons sidebar-menu-icon sidebar-menu-icon--left"><?php echo $rep_data['name']; ?></span>
												
													</a>
												</li>
									<?php
											} // End While
										}else{}
									?>		
						<?php
							} else {}
						?>


                        


          
				
				<!-- 
                <li class="menu-title mt-2">Apps</li>

                <li>
                    <a href="<?php echo WEB_ROOT; ?>kanban/">
                        <i class="mdi mdi-book-settings"></i>
                        <span> Tasks </span>
                    </a>
                </li>
				-->
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>