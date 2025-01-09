<!-- Modal -->
<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>
<div class="modal fade" id="delServiceModal" tabindex="-1" aria-labelledby="delServiceModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addServiceModalLabel">Delete Service</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="process.php?action=delService" method="POST">
				
						<div class="mb-3">
							
							
							<?php
								$sql_del = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted != :is_deleted");
								$sql_del->bindValue(':is_deleted', '1', PDO::PARAM_INT);
								$sql_del->execute();
								if($sql_del->rowCount() > 0)
								{

									$ctr = 1;
									while($sqldel = $sql_del->fetch())
									{

										$increment = $ctr++;
										$main_name = $sqldel['main_cat'];
										$descript = $sqldel['descript'];
										$sercatid = $sqldel['sercatid'];

							?>								
									
											<h5 class="prile3-txt2"><?php echo $main_name; ?></h5><br>
					


																
											<?php

												$sql1 = $conn->prepare("SELECT * FROM ind_subcat WHERE main_id = :main_id AND user_id = :user_id");
												$sql1->bindParam(':main_id', $sercatid, PDO::PARAM_INT);
												$sql1->bindParam(':user_id', $userId, PDO::PARAM_INT);
												$sql1->execute();
												if($sql1->rowCount() > 0)
												{		
													$ctrr = 1;
													while($sql1_data = $sql1->fetch())
													{
														$incrementmented = $ctrr++;
														$sub_categor = $sql1_data['sub_categor'];
														$subcatids = $sql1_data['subcatid'];

											?>
												<div class="row">
													<div class="col-10">
														<p><?php echo $sub_categor; ?></p>
													</div>
													<div class="col-2">

														<input type="hidden" name="subcat[]" value="0">
														<input type="checkbox" name="subcat[]" value="<?php echo $subcatids; ?>">
																										
													</div>
												</div>

											<?php
													}
												}else{}
											?>
										<hr>
							<?php
									}
								}else{}
							?>
						</div>

						<button type="submit" class="btn btn-danger" onClick="return confirmDelete()">Delete Service</button>
				</form>
			</div>
		</div>
	</div>
</div>