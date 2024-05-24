<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <style>
        /* Sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            /* Dark color */
            padding-top: 20px;
            color: #fff;
            /* Text color */
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
            /* Darker color on hover */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            /* Primary color */
            border-color: #007bff;
            /* Border color */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Darker color on hover */
            border-color: #0056b3;
            /* Darker border color on hover */
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="voucher_management.php">Voucher Management</a></li>
            <li class="nav-item"><a class="nav-link" href="user_management.php">User Management</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="col-md-9 col-sm-12">
        <div class="content text-center">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>This is the main content area.</p>


        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        window.location.href = 'login.php';
    </script>
</body>

</html>