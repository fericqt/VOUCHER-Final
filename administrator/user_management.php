<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
            <li class="nav-item"><a class="nav-link" href="index.php"><i class='bx bx-home-alt nav_icon'></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="voucher_management.php"><i class='bx bx-grid-alt nav_icon'></i> Voucher Management</a></li>
            <li class="nav-item"><a class="nav-link active" href="user_management.php"><i class='bx bx-user nav_icon'></i> User Management</a></li>
            <li class="nav-item"><a class="nav-link" href="../inc/logout.php"><i class='bx bx-log-out nav_icon'></i> Logout</a></li>
        </ul>
    </div>

    <?php include "../inc/topbar.php"; ?>

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <h1>User Management</h1>
            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="../db_function/add_user.php">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="userType">User Type</label>
                                    <select id="userType" name="usertype">
                                        <option value="Admin">Admin</option>
                                        <option value="Client">Client</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <!-- Add User Button -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add User</button>
            </div>
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include database connection or configuration file
                        include_once "../db_function/connection.php";

                        // Fetch users from the database
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($db_connection, $query);

                        // Display users in table rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['user_type'] . "</td>";
                            echo "<td>";
                            echo '<a href="#" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editUserModal" data-id="' . $row['id'] . '">Edit</a>';
                            echo '<a href="../db_function/delete_user.php?id=' . $row['id'] . '" class="btn btn-danger ml-1" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId" name="editUserId">
                        <div class="form-group">
                            <label for="editUsername">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="editUsername" required>
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="editPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <select id="userType" id="editUsertype" name="editUsertype">
                                <option value="Admin">Admin</option>
                                <option value="Client">Client</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // DataTable initialization
            $('#userTable').DataTable();

            // Edit button click event
            $('#userTable').on('click', '.edit-btn', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '../db_function/get_user_details.php',
                    type: 'POST',
                    data: {
                        id: userId
                    },
                    success: function(response) {
                        var user = JSON.parse(response);
                        $('#editUserId').val(user.id);
                        $('#editUsername').val(user.username);
                        $('#editPassword').val(user.password);
                        $('#editUsertype').val(user.user_type);
                        $('#editUserModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Form submission for editing user
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '../db_function/update_user.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        if (response.status === 'success') {
                            // Show success notification
                            alert(response.message);
                            // Reload the page to reflect changes
                            window.location.href = 'user_management.php';
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
        });
    </script>

</body>

</html>