<?php



    if(!isset($current_user)){die('Unauthorized Error');}

    $CPPSql = "SELECT submission_id, COUNT(user_id) AS num_of_students, reason, info_date, witness, num_of_cpp FROM cpp_infos GROUP BY submission_id  ORDER BY submission_id DESC";

    $runCPPSql = mysqli_query($conn, $CPPSql);
    $CPPCount = mysqli_num_rows($runCPPSql);
    if($runCPPSql && $CPPCount > 0){
        while ($CPPRow = mysqli_fetch_assoc($runCPPSql)) {
            $CPPData[] = $CPPRow;
        }
    }



?>