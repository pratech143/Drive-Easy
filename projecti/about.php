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
    <title>About - Drive Easy</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="stylesheet" href="about.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap"
        rel="stylesheet">

</head>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <nav>
                    <a href="carrent.html"><img src="logo.png" width="200px" title="Drive easy"
                            alt="Drive easy"></a>
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
         <!-- login -->
         <div id="LoginForm" class="contain_login">
            <h1>Login</h1>
            <form>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button id="login_button" type="submit">Login</button>
            </form>
            <div class="form-footer">
                Don't have an account? <a href="register.html" style="color: #ff5f1f;">Sign up</a>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>

        <div class="section">
            <div class="about">
                <h1>About Drive Easy</h1>
                <p>Welcome to Drive Easy, your trusted partner for convenient and reliable car rentals. We believe that
                    transportation should be hassle-free and enjoyable, and that's why we provide a seamless rental
                    experience for all our customers.</p>
                <p>At Drive Easy, we offer a wide range of vehicles to suit your needs and preferences. Whether you're
                    planning a road trip, attending a business meeting, or simply need a temporary replacement vehicle,
                    we've got you covered.</p>
                <p>Our dedicated team is committed to ensuring your satisfaction. We prioritize customer service and aim
                    to exceed your expectations at every step. From the moment you book a car to the time you return it,
                    we're here to assist you and make your journey as smooth as possible.</p>
                <p>With Drive Easy, you can expect:</p>
                <ul>
                    <li>High-quality, well-maintained vehicles</li>
                    <li>Flexible rental options</li>
                    <li>Competitive prices and transparent pricing</li>
                    <li>Convenient pickup and drop-off locations</li>
                    <li>24/7 customer support</li>
                </ul>
                <p>Experience the freedom of driving on your terms with Drive Easy. We take pride in offering
                    exceptional service and ensuring that every journey you take with us is a memorable one.</p>
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