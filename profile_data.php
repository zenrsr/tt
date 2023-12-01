<?php
include('connection.php');


function getUserDetailsFromDatabase($userId) {
    global $con; // Assuming $con is your database connection

    $sql = "SELECT * FROM resume WHERE u_id='$userId' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }

    $userDetails = mysqli_fetch_assoc($result);
    return $userDetails;
}


// Get user details based on the provided ID (dummy data for illustration)
$userId = $_POST['user_id'];
//var_dump($user_Id);
$userDetails = getUserDetailsFromDatabase($userId);

// Return user details as JSON
header('Content-Type: application/json');
echo json_encode($userDetails);



?>