<?php
session_start();
include("dbconnect.php");
if (!isset($_SESSION['Email'])) {
    header('Location: login.php');
    exit();
} else {

    $userEmail = $_SESSION['Email'];
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
    <title>Drive Easy</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <style>
        .username {
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .show {
            margin-right: 30px;
            margin-top: 50px;
            display: block;
        }
    </style>
</head>

<body>

    <a name="home"></a>
    <header>
        <div class="container">
            <div class="logo">
                <nav>
                    <a style="background-color: white;" href="#home"><img src="logo.png" width="200px" title="Drive easy" alt="Drive easy"></a>
                </nav>
            </div>
            <div style="z-index: 1000;" class="options">
                <nav>
                    <a href="#home">Home</a>
                    <a href="about.php">About</a>
                    <a href="model.php">Vehicle models</a>
                    <a href="testimonials.php">Testimonials</a>
                    <a href="contact.php">Contact us</a>
                </nav>
            </div>
            <?php
            if (isset($userName)) {
                echo '<div class="user-dropdown">
                              <div class="register"><span class="username" onclick="toggleDropdown()">' . $userName . ' &#9662;</span></div>
                              <div class="dropdown-content" id="userDropdown">
                                  <a href="edit_credentials.php">Edit Credentials</a>
                                  <a href="logout.php">Logout</a>
                              </div>
                         </div>';
            }


            ?>
        </div>
    </header>

    <section>
        <div class="section">
            <div class="description">
                <marquee style="z-index: 0;" behavior="slide" direction="left" scrollmount="10">Drive the Experience
                </marquee>
                <p style="font-size: 0.9rem; line-height: 230%;">Plan your trip now <br> <span style="font-size: 2.5rem;">Rent the <span style="color: #ff5f1f;">car</span> and drive
                        easy</span></p>
                <p style="font-weight: normal;">No Bus No cabs Rent cars and enjoy as you want</p>
                <div>
                    <button style="margin-right: 5px; background-color: #ff5f1f; width: 150px;"><a href="book.php">Book
                            ride</a></button>
                    <button style="width: 150px;"><a style="color: white; " href="about.html">Learn More</a></button>
                </div>
            </div>
            <div class="image">
                <img src="carrent.png" alt="car in rent" title="Rent the car">
            </div>
        </div>
        <div class="card">
            <div class="cars">
                <br><br>
                <center>
                    <h1 style="color: #ff5f1f;">Select car</h1>
                </center>
                <p>Upgrade your ride with our varieties of cars. Experience luxury and enjoy a smooth, comfortable drive
                    like never before.</p>
            </div>
            <div class="care">
                <br><br>
                <center>
                    <h1 style="color: #ff5f1f;">Contact Operator</h1>
                </center>
                <p>Reach out to our friendly operator for personalized assistance. Our dedicated team is here to help,
                    providing reliable support and answering your queries.</p>
            </div>
            <div class="service">
                <br><br>
                <center>
                    <h1 style="color: #ff5f1f;">Drive Easy</h1>
                </center>
                <p>Simplify your journey with Drive Easy. Enjoy a seamless rental experience, hassle-free pickups, and
                    effortless returns.</p>
            </div>
        </div>

        <div class="bottom-section">
            <div class="car">
                <img src="Che.png" alt="Car 1">
                <div class="car-details">
                    <div class="car-title">Chevrolet Cruze</div>
                    <div class="car-price">$70/day</div>
                    <div class="car-description">Stylish and fuel-efficient sedan</div>
                    <button class="rent-button"><a href="book.php">Rent Now</a></button>
                </div>
            </div>

            <div class="car">
                <img src="lam.png" alt="Car 2">
                <div class="car-details">
                    <div class="car-title">Lamborghini Aventador</div>
                    <div class="car-price">$1000/day</div>
                    <div class="car-description">Iconic and eye-catching supercar</div>
                    <button class="rent-button"><a href="book.php">Rent Now</a></button>
                </div>
            </div>

            <div class="car">
                <img src="Jeep.png" alt="Car 3">
                <div class="car-details">
                    <div class="car-title">Jeep Wrangler</div>
                    <div class="car-price">$120/day</div>
                    <div class="car-description">Adventure-ready off-road SUV</div>
                    <button class="rent-button"><a href="book.php">Rent Now</a></button>
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
    </div>
</body>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("userDropdown");
        dropdown.classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.username') && !event.target.matches('.dropdown-content a')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>


</html>