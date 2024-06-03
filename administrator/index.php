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
    <!-- Sidebar -->
    <div class="sidebar">
        <footer>
            <img src="../images/logo-removebg-preview.png" alt="User Icon" class="user-icon">
        </footer>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="index.php"><i class='bx bx-home-alt nav_icon'></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="voucher_management.php"><i class='bx bx-grid-alt nav_icon'></i> Voucher Management</a></li>
            <li class="nav-item"><a class="nav-link" href="user_management.php"><i class='bx bx-user nav_icon'></i> User Management</a></li>
            <li class="nav-item"><a class="nav-link" href="../inc/logout.php"><i class='bx bx-log-out nav_icon'></i> Logout</a></li>
        </ul>
    </div>

    <?php include "../inc/topbar.php"; ?>
    <?php

    include_once "../db_function/connection.php";

    $squeryPending = "SELECT COUNT(*) as count FROM details WHERE status = 'Pending'";
    $squeryReceived = "SELECT COUNT(*) as count FROM details WHERE status = 'Received'";
    $squeryUsersAdmin = "SELECT COUNT(*) as count FROM users WHERE user_type = 'Admin'";
    $squeryUsersClient = "SELECT COUNT(*) as count FROM users WHERE user_type = 'Client'";
    //
    $resultPending = mysqli_query($db_connection, $squeryPending);
    $resultReceived = mysqli_query($db_connection, $squeryReceived);
    $resultAdmin = mysqli_query($db_connection, $squeryUsersAdmin);
    $resultClient = mysqli_query($db_connection, $squeryUsersClient);
    //
    $rowPending = mysqli_fetch_assoc($resultPending);
    $rowReceived = mysqli_fetch_assoc($resultReceived);
    $rowAdmin = mysqli_fetch_assoc($resultAdmin);
    $rowClient = mysqli_fetch_assoc($resultClient);
    //
    $pendingVoucher = $rowPending['count'];
    $receivedVoucher = $rowReceived['count'];
    $countAdmin = $rowAdmin['count'];
    $countClient = $rowClient['count'];

    ?>
    <div class="content">

        <h1 class="mb-4">Admin Dashboard</h1>

        <!-- Counters -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Total Admin</h5>
                        <p class="card-text"><?php echo $countAdmin ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Client</h5>
                        <p class="card-text"><?php echo $countClient ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Vouchers</h5>
                        <p class="card-text"><?php echo $pendingVoucher ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Received Vouchers</h5>
                        <p class="card-text"><?php echo $receivedVoucher ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tables -->
        <div class="row">
            <!-- User Table -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $squeryUsers = "SELECT * FROM users";
                                    $result = mysqli_query($db_connection, $squeryUsers);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "
                                            <tr>
                                                <td>" . $row['username'] . "</td>
                                                <td>" . $row['user_type'] . "</td>
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

            <!-- Voucher Table -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Vouchers
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tracking No</th>
                                        <th>Voucher Code</th>
                                        <th>Date Forwarded</th>
                                        <th>Carried By</th>
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
                                                <td>" . $row['date_forwarded'] . "</td>
                                                <td>" . $row['carried_by'] . "</td>
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
        </div>

        <!-- Additional Admin Details -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Additional Details
                    </div>
                    <div class="card-body">
                        <p>Here you can add more information</p>
                        <!-- Add additional content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>