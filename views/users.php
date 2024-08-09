<?php

    if(!isset($current_user)){die('Unauthorized Error');}
    if($current_user['usertype'] == 'Student'){die('You have no permission to access this page.');}

    // Include Supplier API
    include 'api/users.php';
?>

<div class="row">
	<div class="col-md-12 mx-auto">
		<button class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" data-toggle="modal" data-target="#add_modal"> + Add New</button>
		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">Users List</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;">
					<thead>
						<tr>
							<th class="text-center">SL No</th>
							<th class="text-center">Name</th>
                            <?php if($current_user['usertype'] == 'Teacher'){ ?>
                                <th class="text-center">Current CPP</th>
                            <?php  }else{   ?>
							    <th class="text-center">Type</th>
                            <?php } ?>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="dataTable">
                        <?php
                            if(isset($usersData) && (count($usersData) > 0)){
                                foreach ($usersData as $key => $value) {
                        ?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $value['name']; ?></td>
                            <?php if ($current_user['usertype'] == 'Teacher') { ?>
                                <td class="text-center"><?php echo htmlspecialchars($value['num_of_cpp'] ?? 'N/A'); ?></td>
                            <?php } else { ?>
                                <td><?php echo htmlspecialchars($value['usertype']); ?></td>
                            <?php } ?>
							<td><?php echo $value['status']; ?></td>
							<td>
								<a href="#view_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-primary">View</a>
								<a href="#edit_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-success">Edit</a>
							</td>
						</tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="view_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div style=" float: left;" class="pr-2 bg-white">
                                            <img src="<?php echo "images/". $current_user['image'] ?? null; ?>" onerror="this.src='assets/images/logo.png'" style="max-height: 120px; max-width: 120px; border-radius: 5px;">
                                        </div>
                                        <p class="m-0">Username/StudentID: <b><?php echo $value['username']; ?></b></p>
                                        <hr>
                                        <p class="m-0">Name: <b><?php echo $value['name']; ?></b></p>
                                        <hr>
                                        <p class="m-0">Phone: <b><?php echo $value['phone']; ?></b></p>
                                        <hr>
                                        <p class="m-0">Usertype: <b><?php echo $value['usertype']; ?></b></p>
                                        <hr>
                                        <p>Status: <b><?php echo $value['status']; ?></b></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update User Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="core/user-edit.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="hidden" name="user_edit_id" value="<?php echo $value['id']; ?>" required readonly>
                                                    <div class="form-group">
                                                        <label for="Name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo $value['name']; ?>" placeholder="Enter username" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username" class="col-form-label">Username/Student ID:</label>
                                                        <input type="text" class="form-control" name="username" value="<?php echo $value['username']; ?>" placeholder="Enter username(Must be Student ID if student)" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Phone" class="col-form-label">Phone:</label>
                                                        <input type="text" class="form-control" name="phone" value="<?php echo $value['phone']; ?>" placeholder="Enter username" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="col-form-label">Password:</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usertype" class="col-form-label">Usertype:</label>
                                                        <select name="usertype" id="usertype" class="form-control">
                                                            <option value="Student" <?php $value['usertype']=='Student' ? 'selected' : null; ?> >Student</option>
                                                            <?php 
                                                                if($current_user['usertype'] == 'Developer'){
                                                            ?>
                                                                <option value="Teacher" <?php $value['usertype']=='Teacher' ? 'selected' : null; ?> >Teacher</option>
                                                                <option value="Developer" <?php $value['usertype']=='Developer' ? 'selected' : null; ?> >Developer</option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status" class="col-form-label">Status:</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="active" <?php if($value['status']=='active'){echo 'selected';} ?> >active</option>
                                                            <option value="inactive" <?php if($value['status']=='inactive'){echo 'selected';} ?> >inactive</option>
                                                            <option value="pending" <?php if($value['status']=='pending'){echo 'selected';} ?> >pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row justify-content-center w-100">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                                }
                            }else{
                                echo "<tr><td colspan='5' class='text-center text-danger'><h5>No Record Found..!</h5></td></tr>";
                            } 
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<!-- Add Model -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="userForm" method="post" action="core/user-add.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Enter name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone" class="col-form-label">Phone:</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username" class="col-form-label">Username/Student ID:</label>
                            <input type="text" class="form-control" name="username" value="" placeholder="Enter username(Must be Student ID if student)" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="text" class="form-control" name="password" value="" placeholder="Enter password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usertype" class="col-form-label">Usertype:</label>
                            <select name="usertype" id="usertype" class="form-control">
                                <option value="Student">Student</option>
                                <?php 
                                    if($current_user['usertype'] == 'Developer'){
                                ?>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Developer">Developer</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                                <option value="pending">pending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row justify-content-center w-100">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Model -->