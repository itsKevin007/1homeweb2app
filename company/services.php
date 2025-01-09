<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>

<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/service-provider-list.css"> 
<?php

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
$existMessage = (isset($_GET['exist']) && $_GET['exist'] != '') ? $_GET['exist'] : '';

	if($errorMessage == 'Success')
	{
		?>
			<script>
				Swal.fire({
					title: 'Success!',
					text: '',
					icon: 'success', // Use 'info', 'warning', or 'error' for other types
					showConfirmButton: true,
					confirmButtonText: 'OK',
					confirmButtonColor: '#3085d6',
					background: '#fefefe', // Customize background
					customClass: {
						popup: 'animate__animated animate__fadeInDown' // Add smooth animation
					}
				});
			</script>
		<?php

    }else{}
    
	if($existMessage != '' || $existMessage != null){
		?>
			<script>
				 Swal.fire({
					title: 'Failed!',
					text: 'Sub Category Already Exist.',
					icon: 'warning', // Use 'info', 'warning', or 'error' for other types
					showConfirmButton: true,
					confirmButtonText: 'OK',
					confirmButtonColor: '#3085d6',
					background: '#fefefe', // Customize background
					customClass: {
						popup: 'animate__animated animate__fadeInDown' // Add smooth animation
					}
				});
			</script>
		<?php
	}else{}
?>
<section id="profile-page-sec">
	<div id="profile-third-sec">
		<div class="container">
			<div class="profile-third-sec-full mt-24">
				<div class="accordion custom-acc" id="accordionPanelsStayOpenExample">
					<div class="row">
						<div class="col-12 d-flex align-items-center justify-content-between">
							<h3 class="prile3-txt1" style="margin: 0;">Service Product Offered</h3>
							<div>
								<a href="#" class="add-icon-service main-color" data-bs-toggle="modal" data-bs-target="#addServiceModal">
									<img src="../assets/images/icon/task-list-add-white.svg" alt="Add" width="15px">
								</a>
								<a href="#"  class="del-icon-service delete-color" data-bs-toggle="modal" data-bs-target="#delServiceModal">
									<img class="del-icon-img" src="../assets/images/icon/delete-white.svg" alt="Add">
								</a>
							</div>
						</div>
					</div>

				<?php 
					include 'modal/add-service.php';
					include 'modal/delete-service.php';
				?>
				

					<form action="process.php?action=modify" method="POST">
						<?php
							$sql = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted != :is_deleted");
							$sql->bindValue(':is_deleted', '1', PDO::PARAM_INT);
							$sql->execute();
							if($sql->rowCount() > 0)
							{

								$ctr = 1;
								while($sql_data = $sql->fetch())
								{

									$increment = $ctr++;
									$main_name = $sql_data['main_cat'];
									$descript = $sql_data['descript'];
									$sercatid = $sql_data['sercatid'];
									$is_deleted = 1;

									$sql1 = $conn->prepare("SELECT * FROM ind_subcat WHERE main_id = :main_id AND user_id = :user_id AND is_deleted != :is_deleted");
									$sql1->bindParam(':main_id', $sercatid, PDO::PARAM_INT);
									$sql1->bindParam(':user_id', $userId, PDO::PARAM_INT);
									$sql1->bindParam(':is_deleted', $is_deleted, PDO::PARAM_INT);
									$sql1->execute();
									$sqlrow = $sql1->rowCount();

						?>
								<div class="accordion-item border-0 mt-24">
									<hr>
									<button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordian<?php echo $increment; ?>">
										<h5 class="prile3-txt2"><?php echo $main_name; ?> (<?php echo $sqlrow; ?>)</h5>
									</button>

										<div id="accordian<?php echo $increment; ?>" class="accordion-collapse collapse show">

												<div class="accordion-body faq-answer">
													<div class="row mt-16">

															<div class="row">
																<?php

																	if($sqlrow > 0)
																	{		
																		$ctrr = 1;
																		while($sql1_data = $sql1->fetch())
																		{
																			$incrementmented = $ctrr++;
																			$sub_categor = $sql1_data['sub_categor'];
																			$subcatid = $sql1_data['subcatid'];

																?>
																	<div class="col-6 mt-16">
																		<div class="row">
																			<div class="col-1">
																				<label><?php echo $incrementmented; ?>.</label>
																			</div>
																			<div class="col-11">
																				<input type="text" name="subcategory[]" class="form-control" value="<?php echo $sub_categor; ?>" placeholder="Sub Category Name">
																				<input type="hidden" name="id[]" value="<?php echo $subcatid; ?>">
																			</div>
																		</div>
																	</div>
																<?php
																		}
																	}else{}
																?>
															</div>
													</div>
												</div>

										</div>
									<div class="faq-bottom-border"></div>
								</div>
						<?php
								}
							}else{}
						?>
						<br>
							<div style="text-align: center;">
								<button type="submit" class="btn btn-primary btn-save"><img src="../assets/images/icon/save-white.svg" style="width: 30px;" alt=""> SAVE</button>
							</div>

					<div class="profile-boder mt-24"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Profile Details Section End -->