<?php

    if (!isset($current_user)) {
        die('Unauthorized Error');
    }

    $getStudentIDSql = "SELECT student_id FROM users WHERE usertype='Student' ORDER BY id DESC";
    $runGetStudentIDSql = mysqli_query($conn, $getStudentIDSql);

    if ($runGetStudentIDSql) {
        $student_ids = [];
        while ($getStudentIDRow = mysqli_fetch_assoc($runGetStudentIDSql)) {
            $student_ids[] = $getStudentIDRow['student_id'];
        }
        echo json_encode($student_ids);

    } else {
        echo json_encode(['error' => 'Database query failed']);
    }

?>
