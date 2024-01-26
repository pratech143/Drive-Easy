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
    <title>Drive Easy - Testimonials</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="stylesheet" href="testi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <nav>
                    <a style="background-color: white;" href="carrent.php"><img src="logo.png" width="200px" title="Drive easy" alt="Drive easy"></a> 
                </nav>
            </div>
            <div class="options">
                <nav>
                    <a href="carrent.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="model.php">Vehicle models</a>
                    <a href="testimonials.php">Testimonials</a>
                    <a href="contact.php">Contact us</a>
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
        <div class="testimonial-section">
            <h1>Testimonials</h1>
            <div class="testimonial-container">
                <div class="testimonial-item">
                    <img src="suman.jpg" alt="User 1">
                    <p>"I had a great experience with Drive Easy. The car I rented was in excellent condition, and the whole rental process was smooth and hassle-free. Highly recommended!"</p>
                    <h3>Suman Paneru</h3>
                </div>
                <div class="testimonial-item">
                    <img src="pratik.jpg" alt="User 2">
                    <p>"Drive Easy is my go-to car rental service. The selection of cars is fantastic, and the prices are competitive. The staff is friendly and always ready to assist. I've never been disappointed!"</p>
                    <h3>Pratik Chapagain</h3>
                </div>
                <div class="testimonial-item">
                    <img src="ashish.jpg" alt="User 3">
                    <p>"The experience I had with Drive Easy was outstanding. The customer service was exceptional, and the car I rented exceeded my expectations. I will definitely be renting from them again in the future!"</p>
                    <h3>Aashish Sharma</h3>
                </div>
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
    <div class="copyright">
     <p>&copy; 2023 Drive Easy. All rights reserved.</p>
    </div>
    </footer>
</body>
<script src="/js/login.js"></script>
</html>
