<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <footer>
            <img src="../images/logo-removebg-preview.png" alt="User Icon" class="user-icon">
        </footer>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class='bx bx-home-alt nav_icon'></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link active" href="voucher_management.php"><i class='bx bx-grid-alt nav_icon'></i> Voucher Management</a></li>
            <li class="nav-item"><a class="nav-link" href="../inc/logout.php"><i class='bx bx-log-out nav_icon'></i> Logout</a></li>
        </ul>
    </div>

    <!-- Topbar -->
    <?php include "../inc/topbar.php"; ?>

    <!-- Page Content -->
    <div class="content">
        <h1>Voucher Management</h1>

        <!-- Add New Voucher Button -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoucherModal">Add New Voucher</button>
        </div>

        <!-- Voucher Table -->
        <div class="table-responsive">
            <table id="voucherTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tracking Number</th>
                        <th>Voucher Code</th>
                        <th>Date Forwarded</th>
                        <th>Carried By</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table body content -->
                    <?php
                    // Include database connection or configuration file
                    include_once "../db_function/connection.php";

                    // Fetch the maximum ID value from the database
                    $query_max_id = "SELECT MAX(id) as max_id FROM details";
                    $result_max_id = mysqli_query($db_connection, $query_max_id);
                    $row_max_id = mysqli_fetch_assoc($result_max_id);
                    $max_id = $row_max_id['max_id'];

                    // Set the starting ID value
                    $starting_id = $max_id + 1;

                    // Fetch vouchers from the database
                    $query = "SELECT * FROM details";
                    $result = mysqli_query($db_connection, $query);

                    // Display vouchers in table rows
                    $auto_incremented_id = 1; // Initialize auto-incremented ID starting from 1
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $auto_incremented_id . "</td>"; // Display auto-incremented ID
                        echo "<td>" . $row['tracking_no'] . "</td>";
                        echo "<td>" . $row['voucher_code'] . "</td>";
                        echo "<td>" . $row['date_forwarded'] . "</td>";
                        echo "<td>" . $row['carried_by'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>";
                        echo '<button type="button" class="btn btn-info info-btn" data-toggle="modal" data-target="#viewVoucherModal" data-id="' . $row['id'] . '">View</button>';
                        echo '<button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editVoucherModal" data-id="' . $row['id'] . '">Edit</button>';
                        echo '<button type="button" class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Delete</button>';
                        echo "</td>";
                        echo "</tr>";
                        $auto_incremented_id++; // Increment auto-incremented ID for the next row
                    }
                    ?>




                </tbody>
            </table>
        </div>
    </div>


    <!-- View Voucher Modal -->
    <div class="modal fade" id="viewVoucherModal" tabindex="-1" role="dialog" aria-labelledby="viewVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewVoucherModalLabel">Voucher Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="viewVoucherForm">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <svg id="barcode"></svg>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tracking_no">Tracking Number:</label>
                            <input disabled type="text" class="form-control" id="view_tracking_no" name="tracking_no" required>
                        </div>
                        <div class="form-group">
                            <label for="voucher_code">Voucher Code:</label>
                            <input disabled type="text" class="form-control" id="view_voucher_code" name="voucher_code" required>
                        </div>
                        <div class="form-group">
                            <label for="date_forwarded">Date Forwarded:</label>
                            <input disabled type="text" class="form-control" id="view_date_forwarded" name="date_forwarded" required>
                        </div>
                        <div class="form-group">
                            <label for="carried_by">Carried By:</label>
                            <input disabled type="text" class="form-control" id="view_carried_by" name="carried_by" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input disabled type="text" class="form-control" id="view_voucher_status" name="status" required>
                        </div>
                    </form>
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="printToPDF()">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Voucher Modal -->
    <div class="modal fade" id="addVoucherModal" tabindex="-1" role="dialog" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVoucherModalLabel">Add New Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../db_function/process_voucher.php" method="post">
                        <div class="form-group">
                            <label for="tracking_no">Tracking Number:</label>
                            <input readonly type="text" class="form-control" id="tracking_no" name="tracking_no" required>
                        </div>
                        <div class="form-group">
                            <label for="voucher_code">Voucher Code:</label>
                            <input type="text" class="form-control" id="voucher_code" name="voucher_code" required>
                        </div>
                        <div class="form-group">
                            <label for="date_forwarded">Date Forwarded:</label>
                            <input type="date" class="form-control" id="date_forwarded" name="date_forwarded" required>
                        </div>
                        <div class="form-group">
                            <label for="carried_by">Carried By:</label>
                            <input type="text" class="form-control" id="carried_by" name="carried_by" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected hidden>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Received">Received</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Voucher Modal -->
    <div class="modal fade" id="editVoucherModal" tabindex="-1" role="dialog" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVoucherModalLabel">Edit Voucher Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editVoucherForm">
                        <input type="hidden" id="editVoucherId" name="editVoucherId">
                        <div class="form-group">
                            <label for="editTrackingNo">Tracking Number:</label>
                            <input type="text" class="form-control" id="editTrackingNo" name="editTrackingNo" required>
                        </div>
                        <div class="form-group">
                            <label for="editVoucherCode">Voucher Code:</label>
                            <input type="text" class="form-control" id="editVoucherCode" name="editVoucherCode" required>
                        </div>
                        <div class="form-group">
                            <label for="date_forwarded">Date Forwarded:</label>
                            <input type="date" class="form-control" id="editDateForwarded" name="editDateForwarded" required>
                        </div>
                        <div class="form-group">
                            <label for="carried_by">Carried By:</label>
                            <input type="text" class="form-control" id="editCarriedBy" name="editCarriedBy" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status:</label>
                            <select class="form-control" id="editStatus" name="editStatus" required>
                                <option value="Pending">Pending</option>
                                <option value="Received">Received</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

    <!-- Custom script for DataTable initialization and delete button action -->
    <script>
        function printToPDF() {
            window.print();
        }

        $(document).ready(function() {
            // Initialize DataTable with Buttons extension
            $('#voucherTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });

            $.ajax({
                url: '../db_function/get_tracking_no.php',
                type: 'GET',
                success: function(response) {
                    var res = JSON.parse(response);
                    $('#tracking_no').val(res);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


            // View button click event
            $('#voucherTable').on('click', '.info-btn', function() {
                var voucherId = $(this).data('id');
                $.ajax({
                    url: '../db_function/get_voucher_details.php',
                    type: 'POST',
                    data: {
                        id: voucherId
                    },
                    success: function(response) {
                        var voucher = JSON.parse(response);
                        $('#view_tracking_no').val(voucher.tracking_no);
                        $('#view_voucher_code').val(voucher.voucher_code);
                        $('#view_voucher_status').val(voucher.status);
                        $('#view_date_forwarded').val(voucher.date_forwarded);
                        $('#view_carried_by').val(voucher.carried_by);
                        GenerateCode(voucher.voucher_code);
                        $('#viewVoucherModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            function GenerateCode(sequence) {
                // Generate the barcode and render it in the SVG element
                JsBarcode("#barcode", sequence, {
                    format: "CODE128", // You can choose other formats like "EAN13", "UPC", etc.
                    lineColor: "#000000",
                    width: 2,
                    height: 100,
                    displayValue: false
                });
            }

            // Edit button click event
            $('#voucherTable').on('click', '.edit-btn', function() {
                var voucherId = $(this).data('id');
                $.ajax({
                    url: '../db_function/get_voucher_details.php',
                    type: 'POST',
                    data: {
                        id: voucherId
                    },
                    success: function(response) {
                        var voucher = JSON.parse(response);
                        $('#editVoucherId').val(voucher.id);
                        $('#editTrackingNo').val(voucher.tracking_no);
                        $('#editVoucherCode').val(voucher.voucher_code);
                        $('#editStatus').val(voucher.status);
                        $('#editDateForwarded').val(voucher.date_forwarded);
                        $('#editCarriedBy').val(voucher.carried_by);
                        $('#editVoucherModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Form submission for editing user
            $('#editVoucherForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '../db_function/update_voucher.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        if (response.status === 'success') {
                            // Show success notification
                            alert(response.message);
                            // Reload the page to reflect changes
                            window.location.href = 'voucher_management.php';
                        } else {
                            // Show error notification
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });


            // Delete button click event
            $('#voucherTable').on('click', '.delete-btn', function() {
                var voucherId = $(this).data('id');
                var confirmDelete = confirm('Are you sure you want to delete this voucher?');
                if (confirmDelete) {
                    $.ajax({
                        url: '../db_function/delete_voucher.php',
                        type: 'POST',
                        data: {
                            id: voucherId
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data.success) {
                                // Remove the row from the table
                                $('#voucherTable').DataTable().row($(this).parents('tr')).remove().draw();
                                // Redirect to voucher management page
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            } else {
                                alert('Failed to delete voucher: ' + data.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Failed to delete voucher.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>