<?php
session_start();

include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    if ($userType === 'admin' && $Email === 'admin' && $password === 'admin') {
        $_SESSION['Email'] = 'admin';
        header('Location: admin.php');
        exit();
    } else {
        $sql = "SELECT * FROM register WHERE Email = '$Email' AND UserType = '$userType'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $passwordi = $row['Password'];

            if ($password==$passwordi) {
                $_SESSION['Email'] = $Email;
                $_SESSION['UserType'] = $userType;
                header('Location: carrent.php');
                exit();
            } else {
               ?><div class="invalidPassword"><?php echo "Invalid password";?></div> <?php
            }
        } else {?>
          <div class="typeError"><?php echo "user type not matched";?></div><?php
        }
    }
}
?>



<!DOCTYPE html>
<html>

<head>
  <title>Car Rental - Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;


    }
    .typeError ,.invalidPassword{
      background-color: #FF9999;
      display: flex;
      justify-content: center;
      width: 400px;
      padding: 15px;
      margin-left: 37%;
      position: absolute;
      top: 6%;
    }
  

    .container {
      border: solid #ff5f1f;
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    h1 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 30px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 99%;
      padding: 12px;
      border-radius: 5px;
      border: none;
      margin-bottom: 20px;
      background-color: #f5f5f5;
      color: #333;
      font-size: 16px;
    }

    button {
      background-color: #ff5f1f;
      color: #fff;
      border: none;
      padding: 14px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      font-size: 18px;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: #555;
    }

    .form-footer {
      text-align: center;
      margin-top: 20px;
      color: #777;
    }

    .form-footer a {
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .form-footer a:hover {
      color: #555;
    }

    select {
      width: 100%;
      border: none;
      padding: 10px;
      margin-bottom: 30px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Login</h1>
    <p style="color: red;" id="error-message"></p>
    <form action="login.php" method="post" onsubmit="return validateLogin()">
      <label for="Email">Email</label>
      <input type="text" id="Email" name="Email" placeholder="Enter your email" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      <b>User Type:</b><br>
      <input type="text" placeholder="Are you user or Admin?" name="userType" id="userType" required>
      <button type="submit">Login</button>
    </form>
    <div class="form-footer">
      Don't have an account? <a href="register.php" style="color: #ff5f1f;">Sign up</a>
    </div>
  </div>

  <script>
    function validateLogin() {
      // Clear previous error message
      document.getElementById('error-message').textContent = '';

      // Validate email and password (you can add more validation if needed)
      var email = document.getElementById('Email').value;
      var password = document.getElementById('password').value;

      if (email === '' || password === '') {
        // Display error message
        document.getElementById('error-message').textContent = 'Email and password are required';
        return false; // Prevent form submission
      }

      return true; // Allow form submission
    }
  </script>
</body>

</html>