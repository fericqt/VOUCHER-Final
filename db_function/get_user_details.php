<?php
// Include database connection
include_once "connection.php";

if(isset($_POST['id'])) {
    $userId = $_POST['id'];
    
    // Fetch user details from the database
    $query = "SELECT * FROM users WHERE id = $userId";
    $result = mysqli_query($db_connection, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
