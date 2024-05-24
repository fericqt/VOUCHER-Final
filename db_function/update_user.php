<?php
// Include database connection or configuration file
include_once "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userId = $_POST['editUserId'];
    $username = $_POST['editUsername'];
    $password = $_POST['editPassword'];
    $usertype = $_POST['editUsertype'];

    // Update user in the database
    $query_update_user = "UPDATE users SET username = '$username', password = '$password', user_type = '$usertype' WHERE id = '$userId'";
    $result_update_user = mysqli_query($db_connection, $query_update_user);

    // Check if user is updated successfully
    if ($result_update_user) {
        // Output success message
        $response = [
            'status' => 'success',
            'message' => 'User updated successfully.'
        ];
    } else {
        // Output error message if the query fails
        $response = [
            'status' => 'error',
            'message' => 'Error updating user: ' . mysqli_error($db_connection)
        ];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
