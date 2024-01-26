<?php
session_start();
include("dbconnect.php");
if (!isset($_SESSION['Email'])) {
    header('Location: login.php');
    exit();
} else {

    $userEmail = $_SESSION['Email'];

    // Fetch the user's name from the database
    $sql = "SELECT Name FROM register WHERE Email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row['Name'];
    }
}
$reservation = "SELECT* FROM reservation WHERE Name='$userName'";
$data = $conn->query($reservation);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive Easy - Vehicle Models</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="stylesheet" href="model.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <style>
        .end {
            margin-top: 20%;
        }

        table {
            margin-top: 5%;
            margin-left: 100px;
            width: 90%;
            border-collapse: collapse;

        }

        th,
        td {
            border: 1px solid #ff5f1f;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ff5f1f;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #ffa07a;
        }
    </style>
</head>

<body>

    <a name="home"></a>
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
        <div><?php echo $userName  ?></div>
        <table border='1'>
            <tr>
                <th>Car Name</th>
                <th>Pickup Date</th>
                <th>Drop date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            if (mysqli_num_rows($data) > 0) {
                while ($row1 = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td><?php echo $row1['carName']; ?></td>
                        <td><?php echo $row1['pickupDate']; ?></td>
                        <td><?php echo $row1['dropDate']; ?></td>
                        <td><?php echo  $row1['reservationStatus']; ?></td>
                        <td><button><a href="cancel.php">cancel</a></button></td>
                    </tr>
            <?php }
            } ?>
        </table>

    </section>
    <div class="end">
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
<script src="/js/login.js"></script>

</html>