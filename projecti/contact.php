<?php
session_start();
include("dbconnect.php");
if (!isset($_SESSION['Email'])) {
    header('Location: login.php');
    exit();
}
else{
    
        $userEmail = $_SESSION['Email'];
    
        // Fetch the user's name from the database
        $sql = "SELECT Name FROM register WHERE Email = '$userEmail'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userName = $row['Name'];
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive Easy - Contact Us</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <nav>
                    <a style="background-color: white;" href="carrent.php"><img src="logo.png" width="200px"
                            title="Drive easy" alt="Drive easy"></a>
                </nav>
            </div>
            <div class="options">
                <nav>
                    <a href="carrent.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="model.php">Vehicle models</a>
                    <a href="testimonials.php">Testimonials</a>
                    <a href="contact.php" class="active">Contact us</a>
                </nav>
            </div>
            <?php
            if (isset($userName)) {
                echo '<div class="register">' . $userName . '</div>';
            }
            ?>
        </div>
    </header>

    <section>
        <div class="contact-section">
            <h1>Contact Us</h1>
            <div class="contact-form">
                <form action="#" method="POST">
                    <p style="color: red; font-size: small; margin: 2px;" id="nameerror"></p>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" onkeyup="valid()" required>
                    

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div class="de">
                <img src="logo.png" alt="Drive Easy Logo">
            </div>
            <div class="socials">
                <a href="https://www.facebook.com"><img src="fb.png" alt="Facebook" width="55px"></a></li>
                <a href="https://www.instagram.com"><img src="insta.png" alt="instragram" width="35px"></a></>
                <a href="https://www.twitter.com"><img src="twitter.png" alt="twitter" width="35px"></a></li>
            </div>

        </div>
        
    </footer>
    <div class="copyright">
            <p>&copy; 2023 Drive Easy. All rights reserved.</p>
        </div>
    </div>
</body>
<script>
function valid() {
    let user = document.getElementById('name').value;
    let nameError = document.getElementById('nameerror');
  
    if (user === '' || user === null) {
        nameError.textContent = 'Name is required';
        return false;
    } else if (user.length < 8) {
        nameError.textContent = 'Name is too short';
        return false;
    } else {
        nameError.textContent = ''; 
        return true;
    }
}
</script>
         
      
</script>
</html>