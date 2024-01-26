<?php
include("dbconnect.php");
$id = $_GET['id'];
$selectQuery = "SELECT * FROM register WHERE id= '$id'";
$data = mysqli_query($conn, $selectQuery);
$row = mysqli_fetch_assoc($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $newname = $_POST['name'];
  $newemail = $_POST['email'];
  $newphone = $_POST['phone'];
  $newPassword = $_POST['password'];
  $updateQuery = "UPDATE register SET Name = '$newname', Email = '$newemail', Phone = '$newphone' WHERE id = '$id'";
  if ($conn->query($updateQuery) === TRUE) {
      header("location: admin.php?message='updated successfully'");
  } else {
      echo "Error updating credentials: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update - Drive Easy</title>
  <link rel="stylesheet" href="driveeasy.css">
  <link rel="stylesheet" href="register.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
  <style>
    .hidden{
      display: none;
    }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <div class="logo">
        <nav>
          <a style="background-color: white;" href="carrent.php"><img src="logo.png" width="200px" title="Drive Easy" alt="Drive Easy"></a>
        </nav>
      </div>
    </div>
  </header>

  <section class="register-section">
    <div class="register-container">
      <h1>Update User Credentials</h1>

      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" value="<?php echo $row['Name'] ?>" id="name" name="Name" required>
          <p id="usererror"></p>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?php echo $row['Email'] ?>" id="email" name="Email" required>
          <p id="emailerror"></p>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" value="<?php echo $row['Password'] ?>" id="password" name="Password" readonly>
          <p id="passworderror"></p>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" value="<?php echo $row['Phone'] ?>" id="phone" name="Phone" pattern="[0-9]{10}" required>
          <p id="phoneerror"></p>
        </div>
        <div class="form-group">
          <label for="userType">User Type</label>
          <input type="text" id="userType" name="userType" value="user" readonly>
        </div>

        <div class="form-group">
          <input type="submit" name="update" value="Update">
        </div>
      </form>

    </div>
  </section>
  <footer>
    <div class="footer">
      <div class="de">
        <img src="logo.png" alt="Drive Easy Logo">
      </div>
      <div class="socials">
        <a href="https://www.facebook.com"><img src="fb.png" alt="Facebook" width="55px"></a>
        <a href="https://www.instagram.com"><img src="insta.png" alt="Instagram" width="35px"></a>
        <a href="https://www.twitter.com"><img src="twitter.png" alt="Twitter" width="35px"></a>
      </div>
    </div>
    <div class="copyright">
      <p>&copy; 2023 Drive Easy. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>