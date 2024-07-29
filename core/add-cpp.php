<?php

include 'session.php'; 

// Check if the user is authorized
if (!isset($current_user)) {
    die('Unauthorized Error');
}

// Check if the user is a Developer
if ($current_user['usertype'] != 'Developer') {
    die('You have no permission to access this page.');
}

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify that all necessary form fields are present
    if (isset($_POST['student_ids']) && isset($_POST['reason']) && isset($_POST['witness']) && isset($_POST['info_date']) && isset($_POST['num_of_cpp'])) {

        // Sanitize and validate inputs
        $student_ids = $_POST['student_ids']; // Array of selected student IDs
        $reason = trim(htmlspecialchars($_POST['reason']));
        $witness = trim(htmlspecialchars($_POST['witness']));
        $info_date = trim(htmlspecialchars($_POST['info_date']));
        $num_of_cpp = intval($_POST['num_of_cpp']);

        // Ensure no empty fields
        if (!empty($student_ids) && !empty($reason) && !empty($witness) && !empty($info_date) && is_numeric($num_of_cpp)) {

            // Determine the next submission_id
            $result = $conn->query("SELECT MAX(submission_id) AS max_submission_id FROM cpp_infos");
            if ($result) {
                $row = $result->fetch_assoc();
                $next_submission_id = $row['max_submission_id'] + 1;
            } else {
                die('Error retrieving submission_id: ' . $conn->error);
            }
            
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO cpp_infos (user_id, num_of_cpp, reason, witness, info_date, submission_id) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die('Prepare failed: ' . $conn->error);
            }

            // Loop over each student ID and execute the prepared statement
            foreach ($student_ids as $student_id) {
                $stmt->bind_param("iisssi", $student_id, $num_of_cpp, $reason, $witness, $info_date, $next_submission_id);
                $execute = $stmt->execute();
                if (!$execute) {
                    die('Execute failed: ' . $stmt->error);
                }
            }

            // Close the statement
            $stmt->close();

            // Redirect upon success
            header('Location: ../manage_cpp.php?action=cpp_record_added');
        } else {
            header('Location: ../manage_cpp.php?action=null_fields');
        }
    } else {
        echo "Incomplete form submission.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection if this script is the last use
$conn->close();

?>
