<?php
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $phone = $_POST['Phone'];
    $userType =$_POST['userType'];

    // Check if email already exists
    $checkExisting = "SELECT * FROM register WHERE Email = '$email'";
    $result = $conn->query($checkExisting);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists.";
    } else {
        // Email does not exist, proceed with registration
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO register (Name, Email, Password, Phone,userType) VALUES ('$name', '$email', '$password', '$phone','$userType')";

        if ($conn->query($sql) === TRUE) {
            header('Location: login.php?message=Registration successful!');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Drive Easy</title>
  <link rel="stylesheet" href="driveeasy.css">
  <link rel="stylesheet" href="register.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="container">
      <div class="logo">
        <nav>
          <a style="background-color: white;" href="carrent.php"><img src="logo.png" width="200px" title="Drive Easy" alt="Drive Easy"></a>
        </nav>
      </div>
      <div class="options">
        <b>Welcome To Drive Easy Registration</b>
      </div>
    </div>
  </header>

  <section class="register-section">
    <div class="register-container">
      <h1>Register</h1>

      <form action="register.php" method="post" onsubmit="return validate()">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="Name" required>
          <p id="usererror"></p>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="Email" required>
          <p id="emailerror"></p>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="Password" required>
          <p id="passworderror"></p>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" id="phone" name="Phone" pattern="[0-9]{10}" required>
          <p id="phoneerror"></p>
        </div>
        <div class="form-group">
        <label for="userType">User Type</label>
          <input type="text" id="userType" name="userType" value="user" readonly>
          <p id="phoneerror"></p></div>
        
        <div class="form-group">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
      <p>Already have an account? <a href="login.php">Sign in</a></p>
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
<!-- <script>
  flag=1;
     function validate()
     {
      //username
      let user=document.getElementById('name').value;
      let userreg=/[A-Z]/;
      if(user===''||user==null)
      {
          document.getElementById('usererror').innerHTML='username cant be empty';
         flag= 0;
      }
      else if(user.search(userreg)<0)
      {
          document.getElementById('usererror').innerHTML='username pattern is not matched';
         flag =0;
      }
      else{
          document.getElementById('usererror').innerHTML=''
          flag =1;
      }

      //email

      let email=document.getElementById('email').value;
      let emailreg=/[A-Z]{3}\.[0-9]{3}\@gmail\.com/;
      if(email===''||email==null)
      {
          document.getElementById('emailerror').innerHTML='email cant be empty';
         flag= 0;
      }
      else if(email.search(emailreg)<0)
      {
          document.getElementById('emailerror').innerHTML='email pattern is not matched';
         flag =0;
      }
      else{
          document.getElementById('emailerror').innerHTML='';
          flag =1;
         
      }
      //phone

      let phone=document.getElementById('phone').value;
      let phonereg=/[0-9]{3}\-[0-9]{3}\-[0-9]{4}/;
      if(phone===''||phone==null)
      {
          document.getElementById('phoneerror').innerHTML='phone cant be empty';
         flag =0;
      }
      else if(phone.search(phonereg)<0)
      {
          document.getElementById('phoneerror').innerHTML='phone pattern is not matched';
         flag =0;
      }
      else{
          document.getElementById('phoneerror').innerHTML=''
          flag =1;
      }

//password
      let password=document.getElementById('password').value;
      let passwordreg=/[0-9]{3}\-[0-9]{3}\-[0-9]{4}/;
      if(password===''||password==null)
      {
          document.getElementById('passworderror').innerHTML='password cant be empty';
         flag =0;
      }
      else if(password.search(passwordreg)<0)
      {
          document.getElementById('passworderror').innerHTML='password pattern is not matched';
         flag =0;
      }
      else{
          document.getElementById('passworderror').innerHTML=''
          flag =1;
      } --> 
<!-- //         //confirm password
//         let cpassword=document.getElementById('cpassword').value;
     
//         if(cpassword===''||cpassword==null)
//         {
//             document.getElementById('cpassworderror').innerHTML='cpassword cant be empty';
//            flag =0;
//         }
//         else if(password!=cpassword)
//         {
//             document.getElementById('cpassworderror').innerHTML='password  and confirm password doesnt matched';
//            flag =0;
//         }
//         else{
// document.getElementById('cpassworderror').innerHTML='';
//         flag=1;
//         } -->
  <!-- if(flag)
    // {
    //   return true
    // }
    // else{ return false}
     
     }
</script>
</html>
