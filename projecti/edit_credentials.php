<!-- credentials.php -->
<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['Email'])) {
    header('Location: login.php');
    exit();
} else {
    $userEmail = $_SESSION['Email'];

    // Fetch user data from the database
    $sql = "SELECT * FROM register WHERE Email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row['Name'];
        $userEmail = $row['Email'];
        $userPhone = $row['Phone'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Credentials</title>
    <link rel="stylesheet" href="driveeasy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<style>
    .edit-form{
        margin-top: 50px;
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
        margin-bottom: 55px;
    }
</style>

<body>

    <header>
        <div class="container">
            <div class="logo">
                <nav>
                    <a style="background-color: white;" href="#home"><img src="logo.png" width="200px" title="Drive easy" alt="Drive easy"></a>
                </nav>
            </div>
<b>update your credentials</b>
        </div>';



        ?>
        </div>
    </header>

    <section>
        <div class="section">
            <!-- Other content, you can customize this part as needed -->

            <div class="edit-form">
                <h2>Edit Your Credentials</h2>
                <form action="update_credentials.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $userName; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $userEmail; ?>" required>

                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $userPhone; ?>" required>

                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter new password">

                    <button type="submit">Save Changes</button>
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
        <div class="copyright">
            <p>&copy; 2023 Drive Easy. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>