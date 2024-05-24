<?php
session_start();

// Check if $_SESSION['username'] is set before accessing it
if (isset($_SESSION['username'])) {
    $userName = $_SESSION['username'];
    $userType = $_SESSION["user_type"];
    $userId = $_SESSION["user_id"];
} else {
    // Handle case where $_SESSION['username'] is not set
    $userName = "Guest";
}

// Now $userName contains the username or "Guest" if $_SESSION['username'] is not set
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- Add your CSS stylesheets or link to external stylesheets here -->
    <style>
        /* Add your CSS styles for the top bar and user profile here */
        .topbar {
            margin-top: -20px;
            background-color: #1a4d80;
            /* Dark color */
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 120px;
            border: 1px solid gray;
            /* Adds a border with gray color */
            border-radius: 15px;
            /* Sets the border-radius to 15px */
            box-shadow: 0 0 75px gray;
        }

        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            /* Change cursor to pointer to indicate clickability */
        }

        .user-profile span {
            margin-right: 10px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-profile .user-icon {
            font-size: 24px;
        }

        .logout-menu {
            position: absolute;
            background-color: #333;
            color: #fff;
            top: 50px;
            /* Adjust top position as needed */
            right: 10px;
            /* Adjust right position as needed */
            width: 150px;
            padding: 10px;
            border-radius: 5px;
            display: none;
            /* Initially hide the logout menu */
        }

        .logout-menu a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 5px 0;
        }

        .logout-menu a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div><!-- Empty div for left alignment --></div>
        <div class="user-profile" onclick="toggleLogoutMenu()">
            <!-- Display the user's name or a default value -->
            <span hidden id="userName" data-value="<?php echo $userName ?>"></span>
            <span hidden id="userType" data-value="<?php echo $userType ?>"></span>
            <span hidden id="userId" data-value="<?php echo $userId ?>"></span>
            <span>Welcome, <?php echo $userName; ?>!</span>
            <!-- Replace 'Your Avatar' with actual user avatar image -->
            <img src="../images/user-icon.png" alt="User Avatar"> <!-- Replace with user icon -->
            <!-- Font Awesome user icon -->
            <!-- Logout Submenu -->
            <div class="logout-menu" id="logoutMenu">
                <a type="button" id="btnProfile" data-toggle="modal" data-target="#viewProfileModal">Profile</a>
                <a href="../inc/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- View Profile Modal -->
    <div class="modal fade" id="viewProfileModal" tabindex="-1" role="dialog" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProfileModalLabel">Profile Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="viewProfileForm">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input disabled type="text" class="form-control" id="username" name="username" required>
                            <input hidden type="text" class="form-control" id="userid" name="userid" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Add any other content or scripts you need here -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btnProfile').on('click', function() {
            var uid = document.getElementById("userId").getAttribute("data-value");
            $.ajax({
                url: '../db_function/get_user_details.php',
                type: 'POST',
                data: {
                    id: uid
                },
                success: function(response) {
                    var user = JSON.parse(response);
                    $('#userid').val(user.id);
                    $('#username').val(user.username);
                    $('#password').val(user.password);
                    $('#viewProfileModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Form submission for editing user
        $('#viewProfileForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '../db_function/update_password.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    if (response.status === 'success') {
                        // Show success notification
                        alert(response.message);
                        // Reload the page to reflect changes
                        window.location.reload();
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
<script>
    function toggleLogoutMenu() {
        var logoutMenu = document.getElementById("logoutMenu");
        logoutMenu.style.display = (logoutMenu.style.display === "block") ? "none" : "block";
    }

    const url = window.location.pathname;
    const parts = url.split('/').filter(part => part);
    const currentuser = parts.filter(part => part === 'client' || part === 'administrator');
    //
    var uname = document.getElementById("userName").getAttribute("data-value");
    var utype = document.getElementById("userType").getAttribute("data-value");

    //
    if (currentuser[0] === 'client') {
        if (utype != 'Client') {
            window.location.href = '../administrator/' + parts[parts.length - 1];
        }
    } else {
        if (utype != 'Admin') {
            window.location.href = '../client/' + parts[parts.length - 1];
        }
    }
</script>


</html>