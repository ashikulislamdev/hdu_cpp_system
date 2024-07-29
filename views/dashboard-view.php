<?php 

if (!isset($current_user)) {
    die('Unauthorized Error');
}

// Student CPP data
include 'api/student_cpp.php';

?>

<div class="row">

    <?php if ($current_user_type == 'Student'): ?>
        <!-- Message for Students -->
        <div class="col-md-12">
            <div class="alert alert-info text-center">
                <h4 class="alert-heading">Welcome <?php echo $current_user['name']; ?>!</h4>
                <p>Your current cpp: <?php  echo $totalCPP  ?> </p>
            </div>
            <h4 class="bg-primary p-3">Your CPP Info</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;">
                    <thead>
                        <tr>
                            <th class="text-center">SL No</th>
                            <th class="text-center">Reason</th>
                            <th class="text-center">Witness</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">N.O. CPP</th>
                        </tr>
                    </thead>
					<tbody id="dataTable">
                        <?php
                            if(isset($studentCPPData) && (count($studentCPPData) > 0)){
                                foreach ($studentCPPData as $key => $value) {
                        ?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $value['reason']; ?></td>
							<td><?php echo $value['witness']; ?></td>
							<td><?php echo $value['info_date']; ?></td>
							<td><?php echo $value['num_of_cpp']; ?></td>
						</tr>
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
    <?php else: ?>

        <!-- Teacher card visible only for Developer -->
        <?php if ($current_user_type == 'Developer'): ?>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Teacher</h6>
                        <h2 class="text-right"><i class="bx bx-line-chart f-left"></i><span><?php echo $totalTeacherCount; ?></span></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Student card visible only for Developer and Teacher -->
        <?php if ($current_user_type == 'Developer' || $current_user_type == 'Teacher'): ?>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Student</h6>
                        <h2 class="text-right"><i class="bx bx-line-chart f-left"></i><span><?php echo $totalStudentCount; ?></span></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>
