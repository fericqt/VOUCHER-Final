<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
      font-family: "Open Sans", sans-serif;
      height: 100vh;
      background: url("images/bg2.jpg") 50% fixed;
      background-size: cover;
    }

    @keyframes spinner {
      0% {
        transform: rotateZ(0deg);
      }

      100% {
        transform: rotateZ(359deg);
      }
    }

    * {
      box-sizing: border-box;
    }

    .wrapper {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      width: 100%;
      min-height: 100%;
      padding: 20px;
      background-color: rgba(225, 225, 225, 0.5);
      backdrop-filter: blur(1px);
    }

    .login {
      border-radius: 25px 25px 15px 15px;
      padding: 10px 20px 20px 20px;
      width: 100%;
      height: 450px;
      max-width: 420px;
      background: #ffffff;
      position: relative;
      padding-bottom: 80px;
      box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
    }

    .login.loading button {
      max-height: 100%;
      padding-top: 50px;
    }

    .login.loading .spinner {
      opacity: 1;
      top: 40%;
    }

    .login.ok button {
      background-color: #8bc34a;
    }

    .login.ok .spinner {
      border-radius: 0;
      border-top-color: transparent;
      border-right-color: transparent;
      height: 20px;
      animation: none;
      transform: rotateZ(-45deg);
    }

    .login input {
      display: block;
      padding: 25px 20px;
      margin-bottom: 30px;
      width: 100%;
      border: 1px solid #ddd;
      transition: border-width 0.2s ease;
      border-radius: 2px;
      color: #ccc;
    }

    .login input+i.fa {
      color: #fff;
      font-size: 1em;
      position: absolute;
      margin-top: -47px;
      opacity: 0;
      left: 0;
      transition: all 0.1s ease-in;
    }

    .login input:focus+i.fa {
      opacity: 1;
      left: 30px;
      transition: all 0.25s ease-out;
    }

    .login input:focus {
      outline: none;
      color: #444;
      border-color: #007bff;
      border-left-width: 35px;
    }

    .login a {
      font-size: 0.8em;
      color: #007bff;
      text-decoration: none;
    }

    .login .input-container {
      position: relative;
    }

    .login .input-container label {
      padding-bottom: 20px;
    }

    .login .input-container input {
      padding-right: 30px;
    }

    .login .input-container i {
      position: absolute;
      top: 50%;
      right: 10px;
      font-size: 25px;
      transform: translateY(-50%);
    }

    .login .title {
      color: #444;
      font-size: 1.6em;
      font-weight: bold;
      margin: 10px 0 30px 0;
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
      text-align: center;
      text-transform: capitalize;
    }

    .login button {
      width: 100%;
      height: 100%;
      padding: 10px 10px;
      background: #728FCE;
      color: #fff;
      display: block;
      border: none;
      margin-top: 20px;
      position: absolute;
      left: 0;
      bottom: 0;
      max-height: 60px;
      border: 0px solid rgba(0, 0, 0, 0.1);
      border-radius: 0 0 2px 2px;
      transform: rotateZ(0deg);
      transition: all 0.1s ease-out;
      border-bottom-width: 7px;
    }

    .login button .spinner {
      display: block;
      width: 40px;
      height: 40px;
      position: absolute;
      border: 4px solid #ffffff;
      border-top-color: rgba(255, 255, 255, 0.3);
      border-radius: 100%;
      left: 50%;
      top: 0;
      opacity: 0;
      margin-left: -20px;
      margin-top: -20px;
      animation: spinner 0.6s infinite linear;
      transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
      box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
    }

    .login:not(.loading) button:hover {
      box-shadow: 0px 1px 3px #007bff;
    }

    .login:not(.loading) button:focus {
      border-bottom-width: 4px;
    }

    .error-msg {
      color: red;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <form class="login" action="db_function/login_process.php" method="post">
      <p class="title">LOG IN</p>
      <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
        echo '<p class="error-msg">Invalid username or password</p>';
      } ?>
      <div class="input-container">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" autofocus />
        <i class='bx bx-user nav_icon'></i>
      </div>

      <div class="input-container">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" autofocus />
        <i class='bx bx-lock nav_icon'></i>
      </div>

      <a href="#">Forgot your password?</a>
      <button>
        <i class="spinner"></i>
        <span class="state">Log in</span>
      </button>
    </form>
    <p>Don't have an account? <a href="create_account.php">Create one</a></p>
</body>

</html>