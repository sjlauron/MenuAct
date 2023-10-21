<?php
    include 'crud.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Act 3 Lauron</title>
</head>
<body>
    <br>
	<!-- <div>
		<a href="view.php" class="d-flex justify-content-center">View Data in JSON format</button></a>
		<br>
	</div> -->
	<div class="container mx-auto p-2 border" style="width: 500px;">
		<h4>
			<center>Add Menu</center>
		</h4>
		<hr />
		<form method="post" action="crud.php" enctype="multipart/form-data">
			<div class="col-md-4">
				<div class="form-group" style="width: 200px; margin-left: 120px;">
					<label>Menu name: </label>
					<input class="form-control" type="text" name="menuName" required />
				</div>
				<div class="form-group" style="width: 200px; margin-left: 120px;">
					<label>Menu description: </label>
					<textarea class="form-control" name="menuDesc" rows="3" required></textarea>
				</div>
				<!-- <div class="form-group" style="width: 200px; margin-left: 120px;">
					<label>Price: </label>
					<input class="form-control" type="text" name="price" value="<?php echo htmlspecialchars($edit_price); ?>" />
				</div> -->
				<button type="submit" name="submit" style="margin-left: 190px; margin-top: 15px;">Save</button>
				<br>
				<br>
			</div>
		</form>
	</div>
	<br>
	<div>
		<table class="table table-bordered table-hover mx-auto p-2" style="width:auto;">
			<tr>
				<td style="text-align: center;"><b>ID</b></td>
				<td style="text-align: center;"><b>MENU NAME</b></td>
				<td style="text-align: center;"><b>MENU DESCRIPTION</b></td>
				<!-- <td style="text-align: center;"><b>PRICE</b></td> -->
				<td style="text-align: center;"><b>ACTION</b></td>
			</tr>
			<?php
			$rows = view_data();
			foreach ($rows as $row) {
				echo "<tr>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['menu_name'] . "</td>";
				echo "<td>" . $row['menu_desc'] . "</td>";
				//echo "<td>" . $row['price'] . "</td>";
			?>
				<td>
					<form method="post" enctype="multipart/form-data" action="?edit_id=<?php echo $row['id']; ?>" style="display: inline;">
						<input type="hidden" name="edit" value="<?php echo $row['id']; ?>">
						<button type="button" data-toggle="modal" data-target="#editMenuModal" data-menu-id="<?php echo $row['id']; ?>" data-menu-name="<?php echo $row['menu_name']; ?>" data-menu-desc="<?php echo $row['menu_desc']; ?>">EDIT</button>&nbsp;
					</form>

					<form method="post" style="display: inline;">
						<input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
						<button type="button" data-toggle="modal" data-target="#deleteMenuModal" data-menu-id="<?php echo $row['id']; ?>">DELETE</button>
					</form>
				</td>
			<?php echo "</tr>";
			}
			?>
		</div>
	<!-- Edit Menu Modal -->
	<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editMenuModalLabel">Edit Menu Item</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" action="crud.php">
							<input type="hidden" name="id" id="edit-menu-id">
							<div class="form-group">
								<label for="edit-menuName">Menu name</label>
								<input type="text" class="form-control" id="edit-menuName" name="menuName" required />
							</div>
							<div class="form-group">
								<label for="edit-menuDesc">Menu description</label>
								<textarea class="form-control" id="edit-menuDesc" name="menuDesc" rows="3" required></textarea>
							</div>
							<!-- <div class="form-group">
								<label for="edit-price">Price</label>
								<input type="text" class="form-control" id="edit-price" name="price" required />
							</div> -->
							<button class="btn btn-primary" type="submit" name="edit" style="margin-left: 190px; margin-top: 15px;">Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    <!-- End Edit Menu Modal -->

    <!-- Delete Menu Modal -->
	<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteMenuModalLabel">Confirm Deletion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this menu item?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<form method="post" style="display: inline;">
						<input type="hidden" name="delete" id="delete-menu-id">
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Delete Menu Modal -->

		<script>
		 $('#editMenuModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var menuId = button.data('menu-id');
            var menuName = button.data('menu-name');
            var menuDesc = button.data('menu-desc');
            //var price = button.data('price');

            
            $('#edit-menu-id').val(menuId);
            $('#edit-menuName').val(menuName);
            $('#edit-menuDesc').val(menuDesc);
            //$('#edit-price').val(price);
        });

		$('#deleteMenuModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var menuId = button.data('menu-id');

        $('#delete-menu-id').val(menuId);
		});
		</script>
</body>
</html>