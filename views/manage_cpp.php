<?php 
    
    if(!isset($current_user)){die('Unauthorized Error');}
    if($current_user['usertype'] == 'Student'){die('You have no permission to access this page.');}


    // Include Supplier API
    include 'api/cpp_infos.php';
?>


<div class="row">
    <div class="col-md-12 mx-auto">
        <form action="core/add-cpp.php" method="post">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h6 mb-4">Add New CPP Info</h3>
                        <div class="mb-3">
                            <label class="form-label">Student IDs</label>
                            <select id="mySelect" name="student_ids[]" multiple="multiple">
                                <?php
                                // Fetch student usernames for selection
                                $getStudentIDSql = "SELECT id, username FROM users WHERE usertype='Student' AND status='active' ORDER BY id DESC";
                                $runGetStudentIDSql = mysqli_query($conn, $getStudentIDSql);

                                if ($runGetStudentIDSql) {
                                    while ($getStudentIDRow = mysqli_fetch_assoc($runGetStudentIDSql)) {
                                        echo '<option value="' . $getStudentIDRow['id'] . '">' . $getStudentIDRow['username'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No active students available</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason</label>
                            <input type="text" name="reason" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Witness</label>
                            <input type="text" name="witness" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="info_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">CPP (+/-)</label>
                                    <input type="number" name="num_of_cpp" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>


		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">CPP Info</h4>
			<div class="px-2" style="overflow: auto;">
                <table class="table table-striped table-hover text-center" style="min-width: 400px;">
                    <thead>
                        <tr>
                            <th class="text-center">SL No</th>
                            <th class="text-center" v-b-tooltip.hover title="Number Of Student">NOS</th>
                            <th class="text-center">Reason</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <?php
                        if (isset($CPPData) && (count($CPPData) > 0)) {
                            foreach ($CPPData as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo $value['num_of_students']; ?></td>
                                    <td><?php echo htmlspecialchars($value['reason']); ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($value['info_date'])); ?></td>
                                    <td>
                                        <a href="#view_modal<?php echo $value['submission_id']; ?>" data-toggle="modal" class="btn btn-sm bg-primary">Details</a>
                                    </td>
                                </tr>

                                <!-- Modal for displaying submission details -->
                                <div class="modal fade" id="view_modal<?php echo $value['submission_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Submission Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Fetch and display details for each submission -->
                                                <?php
                                                    $submissionId = $value['submission_id'];
                                                    $studentQuery = "SELECT users.username FROM cpp_infos JOIN users ON cpp_infos.user_id = users.id WHERE cpp_infos.submission_id = $submissionId";
                                                    $runStudentQuery = mysqli_query($conn, $studentQuery);
                                                    
                                                    if ($runStudentQuery && mysqli_num_rows($runStudentQuery) > 0) {
                                                        echo "<p class='m-0'>Student List:</p><ul>";
                                                        while ($studentRow = mysqli_fetch_assoc($runStudentQuery)) {
                                                            echo "<li><b>" . htmlspecialchars($studentRow['username']) . "</b></li>";
                                                        }
                                                        echo "</ul>";
                                                    } else {
                                                        echo "<p>No students found for this submission.</p>";
                                                    }
                                                ?>
                                                <hr>
                                                <p class="m-0">Reason: <b><?php echo htmlspecialchars($value['reason']); ?></b></p>
                                                <hr>
                                                <p class="m-0">Witness: <b><?php echo htmlspecialchars($value['witness']); ?></b></p>
                                                <hr>
                                                <p class="m-0">Date: <b><?php echo date("Y-m-d", strtotime($value['info_date'])); ?></b></p>
                                                <hr>
                                                <p>Number Of CPP: <b><?php echo $value['num_of_cpp']; ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-danger'><h5>No Record Found..!</h5></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
