

				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<a href="client/">
						<div class="col">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
									
										<div>
											<p class="mb-0">Total Subscriber</p>
												<?php
													$sql = $conn->prepare("SELECT * FROM bs_client WHERE is_deleted != '1' AND c_id != '1'");
													$sql->execute();
													$rowcount = $sql->rowCount();
												?>
											<h5 class="mb-0"><?php echo $rowcount; ?></h5>
											
										</div>
										<div id="chart1"></div><h4><i class="lni lni-users"></i></h4>
									</div>
								</div>
							</div>
						</div>
					</a>
					<a href="service-provider/">
						<div class="col">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
									
										<div>
											<p class="mb-0">Total Service Provider</p>
												<?php
													$sql = $conn->prepare("SELECT * FROM tbl_independent WHERE is_deleted != '1' ");
													$sql->execute();
													$rowcount = $sql->rowCount();

													$sql1 = $conn->prepare("SELECT * FROM tbl_company WHERE is_deleted != '1'");
													$sql1->execute();
													$rowcount1 = $sql1->rowCount();

													$rowqual = $rowcount + $rowcount1;
												?>
											<h5 class="mb-0"><?php echo $rowqual; ?></h5>
											
										</div>
										<div id="chart1"></div><h4><i class="lni lni-construction-hammer"></i></h4>
									</div>
								</div>
							</div>
						</div>
					</a>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<p class="mb-0">Website visitors</p>
											<?php
												$sql1 = $conn->prepare("SELECT * FROM tbl_counter");
												$sql1->execute();
												$sql1data = $sql1->fetch();
												$counter = $sql1data['counter'];
											?>
										<h5 class="mb-0"><?php echo $counter; ?></h5>
									</div>
									<div id="chart2"></div><h4><i class="lni lni-eye"></i></h4>
								</div>
							</div>
						</div>
					</div>
				</div>