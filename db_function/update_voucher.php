<?php
// Include database connection or configuration file
include_once "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['editVoucherId'];
    $trackingNo = $_POST['editTrackingNo'];
    $voucherCode = $_POST['editVoucherCode'];
    $voucherStatus = $_POST['editStatus'];

    $query_update_voucher = "UPDATE details SET tracking_no = '$trackingNo', voucher_code = '$voucherCode', status = '$voucherStatus' WHERE id = '$id'";
    $result_update_voucher = mysqli_query($db_connection, $query_update_voucher);

    if ($result_update_voucher) {
        // Output success message
        $response = [
            'status' => 'success',
            'message' => 'Voucher updated successfully.'
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
