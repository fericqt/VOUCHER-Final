<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="sidebar">
        <footer>
            <img src="../images/logo-removebg-preview.png" alt="User Icon" class="user-icon">
        </footer>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="index.php"><i class='bx bx-home-alt nav_icon'></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="voucher_management.php"><i class='bx bx-grid-alt nav_icon'></i> Voucher Management</a></li>
            <li class="nav-item"><a class="nav-link" href="../inc/logout.php"><i class='bx bx-log-out nav_icon'></i> Logout</a></li>
        </ul>
    </div>

    <?php include "../inc/topbar.php"; ?>
    <?php

    include_once "../db_function/connection.php";

    $squeryPending = "SELECT COUNT(*) as count FROM details WHERE status = 'Pending'";
    $squeryReceived = "SELECT COUNT(*) as count FROM details WHERE status = 'Received'";
    //
    $resultPending = mysqli_query($db_connection, $squeryPending);
    $resultReceived = mysqli_query($db_connection, $squeryReceived);
    //
    $rowPending = mysqli_fetch_assoc($resultPending);
    $rowReceived = mysqli_fetch_assoc($resultReceived);
    //
    $pendingVoucher = $rowPending['count'];
    $receivedVoucher = $rowReceived['count'];

    ?>


    <div class="content">
        <div class="container mt-5">
            <h1 class="mb-4">Client Dashboard</h1>

            <!-- Counters -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Total Pending Vouchers</h5>
                            <p class="card-text" id="voucherCount"><?php echo $pendingVoucher ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Received Vouchers</h5>
                            <p class="card-text" id="voucherCount"><?php echo $receivedVoucher ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tables -->
            <div class="row">
                <!-- Voucher Table -->
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Vouchers
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tracking No</th>
                                        <th>Voucher Code</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $squeryVoucher = "SELECT * FROM details";
                                    $result = mysqli_query($db_connection, $squeryVoucher);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "
                                            <tr>
                                                <td>" . $row['tracking_no'] . "</td>
                                                <td>" . $row['voucher_code'] . "</td>
                                                <td>" . $row['status'] . "</td>
                                            </tr>
                                        ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Client Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Additional Details
                        </div>
                        <div class="card-body">
                            <p>Here you can add more information</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>