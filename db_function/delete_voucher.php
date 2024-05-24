<?php

include_once "connection.php";

// Check if voucher ID is provided in the request
if (isset($_POST['id'])) {
    $voucherId = $_POST['id'];
    
    // Connect to your database (replace with your actual database connection)
    $connection = $db_connection;
    
    // Check connection
    if (mysqli_connect_errno()) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array('success' => false, 'error' => "Failed to connect to MySQL: " . mysqli_connect_error()));
        exit();
    }
    
    // Prepare a delete statement
    $stmt = $connection->prepare("DELETE FROM details WHERE id = ?");
    if (!$stmt) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array('success' => false, 'error' => "Error preparing delete statement: " . $connection->error));
        exit();
    }
    
    // Bind parameters
    $stmt->bind_param("i", $voucherId);
    
    // Execute the delete statement
    if ($stmt->execute()) {
        $message = "Voucher with ID $voucherId has been deleted.";
        echo json_encode(array('success' => true, 'message' => $message, 'redirect' => 'voucher_management.php'));
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array('success' => false, 'error' => "Error executing delete statement: " . $stmt->error));
    }
    
    // Close statement and connection
    $stmt->close();
    $connection->close();
} else {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array('success' => false, 'error' => 'Voucher ID not provided.'));
}

?>
