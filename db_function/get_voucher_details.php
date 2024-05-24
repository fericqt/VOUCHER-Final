<?php
// Include database connection or configuration file
include_once "connection.php";

// Check if voucher ID is provided in the POST request
if(isset($_POST['id'])) {
    $voucherId = $_POST['id'];

    // Fetch voucher details from the database
    $query = "SELECT * FROM details WHERE id = $voucherId";
    $result = mysqli_query($db_connection, $query);

    // Check if voucher exists
    if($result && mysqli_num_rows($result) > 0) {
        $voucher = mysqli_fetch_assoc($result);
        echo json_encode($voucher);
    } else {
        echo json_encode(['error' => 'Voucher does not exist']);
    }

} else {
    echo "Invalid request!";
}
?>
