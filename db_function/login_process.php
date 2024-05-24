<?php

session_start();

 include 'connection.php';

// Assuming your database connection is established and stored in a variable called $db_connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION["username"] = $username;

    // Perform any necessary sanitization/validation of input data here

    // Query to check if the username and password match a record in the database
    // You need to adjust this query according to your database schema
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db_connection, $query);



    // Check if query was successful and if it returned any rows
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION["user_type"] = $row["user_type"];
            $_SESSION["user_id"] = $row["id"];
            if($row["user_type"] == "Admin"){
                // Authentication successful, redirect to index.php
                header("Location: ../administrator/");
                exit;
            }else if($row["user_type"] == "Client"){
                // Authentication successful, redirect to index_client.php
                header("Location: ../client/");
                exit;
            }
        }
    } else {
        // Authentication failed, redirect back to the login page with an error message
        header("Location: ../login.php?error=invalid_credentials");
        exit;
    }
} else {
    // Redirect back to the login page if the form was not submitted
    header("Location: ../login.php");
    exit;
}
?>
