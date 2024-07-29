<?php
    
    if (!isset($current_user)) {
        die('Unauthorized Error');
    }
    $current_user_id = $current_user['id'];
    $current_user_type = $current_user['usertype'];

    // Initialize variables
    $totalTeacherCount = 0;
    $totalStudentCount = 0;

    // Total teacher count (only for Developer)
    if ($current_user_type == 'Developer') {
        $totalTeacherQuery = "SELECT COUNT(id) AS totalTeacher FROM `users` WHERE `usertype` = 'Teacher'";
        $totalTeacherResult = mysqli_query($conn, $totalTeacherQuery);
        
        if ($totalTeacherResult) {
            $totalTeacherData = mysqli_fetch_assoc($totalTeacherResult);
            $totalTeacherCount = $totalTeacherData['totalTeacher'];
        }
    }

    // Total student count (only for Developer and Teacher)
    if ($current_user_type == 'Developer' || $current_user_type == 'Teacher') {
        $totalStudentQuery = "SELECT COUNT(id) AS totalStudent FROM `users` WHERE `usertype` = 'Student'";
        $totalStudentResult = mysqli_query($conn, $totalStudentQuery);
        
        if ($totalStudentResult) {
            $totalStudentData = mysqli_fetch_assoc($totalStudentResult);
            $totalStudentCount = $totalStudentData['totalStudent'];
        }
    }


    $studentCPPSql = "SELECT * FROM `cpp_infos` WHERE user_id=$current_user_id ORDER BY id DESC";

    $runStudentCPPSql = mysqli_query($conn, $studentCPPSql);
    $studentCPPCount = mysqli_num_rows($runStudentCPPSql);
    if($runStudentCPPSql && $studentCPPCount > 0){
        while ($studentCPPRow = mysqli_fetch_assoc($runStudentCPPSql)) {
            $studentCPPData[] = $studentCPPRow;
        }
    }

    //sum of all cpp for current user
    $totalCPPSql = "SELECT SUM(num_of_cpp) as total_cpp FROM `cpp_infos` WHERE user_id=$current_user_id";
    $runTotalCPPSql = mysqli_query($conn, $totalCPPSql);
    $totalCPPData = mysqli_fetch_assoc($runTotalCPPSql);
    $totalCPP = $totalCPPData['total_cpp'];


?>