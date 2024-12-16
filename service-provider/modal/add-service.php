<!-- Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addServiceModalLabel">Add Service Product</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="process.php?action=addService" method="POST">
					<div id="inputContainer">
						<div class="mb-3">
							<label for="serviceName" class="form-label">General Service Name</label>
								<select class="form-select" name="mainservice[]" id="serviceName" aria-label="Select service name">
								<?php
										$mod_select = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted != :is_deleted");
										$mod_select->bindValue(':is_deleted', '1', PDO::PARAM_INT);
										$mod_select->execute();
										if($mod_select->rowCount() > 0)
										{
			

											while($modal_data = $mod_select->fetch())
											{
			
												$sercatid1 = $modal_data['sercatid'];
												$main_name1 = $modal_data['main_cat'];
									?>
											<option value="<?php echo $sercatid1; ?>"><?php echo $main_name1; ?></option>
									<?php 
											}
										}else{}
									?>
								</select>
						</div>
						<div class="mb-3">
							<label for="serviceDescription" class="form-label">Sub Category</label>
							<input type="text" class="form-control" name="subcat[]" id="serviceDescription" placeholder="EX. Plumbing: Covers pipe repair and leak detection">
						</div>
						<hr>
					</div>
					<center>
						<button type="button" class="btn btn-primary" id="addButton">Add More</button>
					</center>
						<button type="submit" class="btn btn-primary" onClick="return confirmSubmit()">Add Service</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
    document.getElementById('addButton').addEventListener('click', function() {
        var container = document.getElementById('inputContainer');
        var newInputGroup = document.createElement('div');
        newInputGroup.classList.add('row', 'input-group', 'mb-3');

        newInputGroup.innerHTML = `

			<div class="mb-3">
				<label for="serviceName" class="form-label">General Service Name</label>
					<select class="form-select" name="mainservice[]" id="serviceName" aria-label="Select service name">
					<?php
							$mod_select = $conn->prepare("SELECT * FROM ind_maincat WHERE is_deleted != :is_deleted");
							$mod_select->bindValue(':is_deleted', '1', PDO::PARAM_INT);
							$mod_select->execute();
							if($mod_select->rowCount() > 0)
							{


								while($modal_data = $mod_select->fetch())
								{

									$sercatid1 = $modal_data['sercatid'];
									$main_name1 = $modal_data['main_cat'];
						?>
								<option value="<?php echo $sercatid1; ?>"><?php echo $main_name1; ?></option>
						<?php 
								}
							}else{}
						?>
					</select>
			</div>
			<div class="mb-3">
				<label for="serviceDescription" class="form-label">Sub Category</label>
				<input type="text" class="form-control" name="subcat[]" id="serviceDescription" placeholder="EX. Plumbing: Covers pipe repair and leak detection">
			</div>								

            <div class="col-lg-12 text-end">
                <button type="button" class="btn btn-danger btn-sm removeButton"><i class="mdi mdi-delete"></i> Remove</button>
            </div>
			<br><br><hr>
        `;

        // Append the new input group to the container
        container.appendChild(newInputGroup);

        // Add click event listener to the remove button
        newInputGroup.querySelector('.removeButton').addEventListener('click', function() {
            newInputGroup.remove();
        });
    });
</script>