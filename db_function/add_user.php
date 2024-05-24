<?php
// Include database connection or configuration file
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert new user into the database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($db_connection, $query);

    if ($result) {
        // Redirect back to user management page
        header("Location: ../administrator/user_management.php");
        exit;
    } else {
        // Handle error
        echo "Error: " . mysqli_error($db_connection);
    }
}
?>
