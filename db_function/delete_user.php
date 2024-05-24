<?php
// Include database connection or configuration file
include_once "connection.php";

// Delete user logic (replace this with your actual delete logic)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Delete the user from the database
    $query_delete_user = "DELETE FROM users WHERE id = '$userId'";
    $result_delete_user = mysqli_query($db_connection, $query_delete_user);
    
    // Check if the user is deleted successfully
    if ($result_delete_user) {
        // Select all users from the database and order them by ID
        $query_select_users = "SELECT id FROM users ORDER BY id ASC";
        $result_select_users = mysqli_query($db_connection, $query_select_users);
        
        // Initialize a variable to store the adjusted user ID
        $adjustedUserId = 1;
        
        // Update the user IDs in the database
        while ($row = mysqli_fetch_assoc($result_select_users)) {
            $currentUserId = $row['id'];
            
            // Update the user ID if it's not already adjusted
            if ($currentUserId != $adjustedUserId) {
                $query_update_user_id = "UPDATE users SET id = '$adjustedUserId' WHERE id = '$currentUserId'";
                mysqli_query($db_connection, $query_update_user_id);
            }
            
            // Increment the adjusted user ID for the next iteration
            $adjustedUserId++;
        }
        
        // Redirect to user management page or any other page after successful deletion
        header("Location: ../administrator/user_management.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "Invalid user ID.";
}
?>
