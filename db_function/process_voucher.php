<?php
// Include database connection or configuration file
include_once "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $tracking_no = $_POST['tracking_no'];
    $voucher_code = $_POST['voucher_code'];
    $status = $_POST['status'];

    // Insert voucher data into database
    $query = "INSERT INTO details (tracking_no, voucher_code, status) VALUES ('$tracking_no', '$voucher_code', '$status')";
    $result = mysqli_query($db_connection, $query);

    // Check if insertion was successful
    if ($result) {
        // Redirect to the page where vouchers are managed
        header("Location: ../administrator/voucher_management.php");
        exit();
    } else {
        // Handle error
        echo "Error: " . $query . "<br>" . mysqli_error($db_connection);
    }
} else {
    // Redirect to home page if accessed directly without form submission
    header("Location: ../index.php");
    exit();
}
?>
