<?php require_once('PresentationLayer/FunctionController.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<script>
		$(document).ready(function() {
			// Activate tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Select/Deselect checkboxes
			var checkbox = $('table tbody input[type="checkbox"]');
			$("#selectAll").click(function() {
				if (this.checked) {
					checkbox.each(function() {
						this.checked = true;
					});
				} else {
					checkbox.each(function() {
						this.checked = false;
					});
				}
			});
			checkbox.click(function() {
				if (!this.checked) {
					$("#selectAll").prop("checked", false);
				}
			});
			
			

		});
		function linkEdit(id,userId){
			var item = $(id).parent("td").siblings("td").toArray();
				$('#editName').val(item[1].innerText);
				$('#editEmail').val(item[2].innerText);
				$('#editAddress').val(item[3].innerText);
				$('#editPhone').val(item[4].innerText);
				$('#editId').val(userId);
			}

			function linkDelete(id){
				
				$('#idDelete').attr("href","server.php?deleteUser="+id);
			}
	</script>


</head>

<body>
	<div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row" >
						<div class="col-xs-6">
							<h2>Manage <b>users</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
							<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Phone</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?= FunctionController::getUsers(); ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="server.php" method="POST">
					<div class="modal-header">
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input name="name" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="email" type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name="address" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input name="phone" type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="addUser" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="server.php" method="POST">
					<div class="modal-header">
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<input type="hidden" name="userId" id="editId">
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input id="editName" name="name" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input id="editEmail" name="email" type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea id="editAddress" name="address" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input id="editPhone" name="phone" type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" name="editUser" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<a id="idDelete" href="" class="btn btn-danger" >Delete</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	
</body>

</html>