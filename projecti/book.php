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
$selectcars = "SELECT * FROM cars";
$result1 = mysqli_query($conn, $selectcars);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $row['Name'];
    $carName = $_POST['CarName'];
    $pickupDate = $_POST['PickupDate'];
    $dropDate = $_POST['DropDate'];
        $sql = "INSERT INTO reservation (Name, carName, pickupDate,dropDate,reservationStatus) VALUES ('$name', '$carName', '$pickupDate', '$dropDate','pending')";

        if ($conn->query($sql) === TRUE) {
            header('Location: book.php?message=Reservation successful!');
            echo "Reservation Successful";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

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
       #submit {
            width: 100%;
            background-color: #ff5f1f;
            border: none;
            border-radius: 5px;
            padding: 10px;
        }

         #submit:hover {
            background-color: grey;
        }

        select {
            background-color: rgb(245, 245, 245);
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }

        .car-options {
            padding: 10px;
            margin: 10px;
        }

        #message {
            color: green;
            font-size: 15px;
            margin: 0px;
            margin-bottom: 0px;
            padding: 0px;
        }

        .copyright {
            margin-bottom: -20px;
        }

        .footer {
            margin-bottom: 20px;
        }

        .model-card button {
            background-color: #ff5f1f;
            border: solid #ff5f1f;
            height: 30px;
            border-radius: 10px;
            color: white;

        }

        .reserveacar {
            display: flex;
            justify-content: space-around;
        }

        .vehicles button {
            background-color: #ff5f1f;
            border: solid #ff5f1f;
            margin: 10px;
            font-size: 25px;
            width: 300px;
            color: white;
            cursor: pointer;
        }

        .detail tr {
            font-size: larger;
            height: 30px;
            color: black;
            border-left: 5px dashed #ff5f1f;
            border-right: 5px dashed #ff5f1f;
        }

        .vehicles {
            height: 400px;
        }

        .details table {
            background: #ffb347;
            background: -webkit-linear-gradient(to right, #ffcc33, #ffb347);
            background: linear-gradient(to right, #ffcc33, #ffb347);
        }

        #customerDetails {
            background-color: blue;
            display: none;
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
        <h1 style="text-align: center; padding-top: 100px;">Vehicle Pricings</h1>



       <?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
        <div class="model-card">
            <img src="<?php echo $row1["carPhoto"] ?>" alt="car Photo">
            <h2><?php echo $row1["carName"]; ?></h2>
            <p><?php echo $row1["carDescription"]; ?></p>
            <button><?php echo $row1["carPrice"]; ?>$/day</button>
        </div>
        <?php }?>
        <br><br>

        <center>Our Rental Fleet <br><br>
            choose the variety of car and enjoy your adventure.
        </center><br><br><br>

        <div class="reserveacar">

            <div class="vehicles">
                <button id="button1" data-model="model1" class="car-options">toyota Corolla</button><br>
                <button id="button2" data-model="model2" class="car-options">Chevrolet Cruise</button><br>
                <button id="button3" data-model="model3" class="car-options">Toyota Camry</button><br>
                <button id="button4" data-model="model4" class="car-options">Nissan Versa </button><br>
                <button id="button5" data-model="model5" class="car-options">Jeep Wrangler</button>

            </div>
            <div>
                <center><img id="myImage" src="" alt="" width="500px"></center>
            </div>
            <div class="details">

                <table style="height: 400px; width: 450px; color: #ff5f1f;">
                    <tr>
                        <th id="price" colspan="2" style="height: 50px; color: white; width: 300px; background-color: #ff5f1f; font-size: 30px;">
                        </th>

                    </tr>
                    <tr>
                        <td>model</td>
                        <td id="model"></td>
                    </tr>
                    <tr>
                        <td>AC</td>
                        <td id="ac"></td>
                    </tr>
                    <tr>
                        <td>Doors</td>
                        <td id="doors"></td>
                    </tr>
                    <tr>
                        <td>capacity</td>
                        <td id="capacity"></td>
                    </tr>
                    <tr>
                        <td>fuel</td>
                        <td id="fuel"></td>
                    </tr>
                </table>

                <button id="mybutton" style="width: 308px; background-color: #ff5f1f; color: white; height: 50px; font-size: 25px; margin-top: 20px;" onclick="showMessage()">
                    Reserve a car
                </button>
                <div id="reservationForm" style="display: none;">
                
                <form action="book.php" method="post">
                    <label for="pickupAddress">Pickup Address:</label>
                    <select name="PickupAddress" id="">
                        <option value="">koteshwor</option>
                        <option value="">Chabahil</option>
                        <option value="">kalanki</option>
                    </select>
                    <label for="pDate">Pickup Date:</label>
                    <input type="date" id="PickupDate" name="PickupDate" required>

                    <label for="dropAddress">Drop Address:</label>
                    <select name="DropAddress" id="">
                        <option value="">koteshwor</option>
                        <option value="">Chabahil</option>
                        <option value="">kalanki</option>
                    </select>
                    <label for="dDate">Drop Date:</label>
                    <input type="date" id="DropDate" name="DropDate" required>

                    <label for="carName">Car Name:</label>
                    <input type="text" id="carName" name="CarName" required>

                    <label for="Cost">TransactionID:</label>
                    <input type="text" id="Cost" name="Cost" required>

                    <input id="submit" type="submit" value="Submit Reservation" onclick="reserveCar()">
                </form>
            </div>



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

<script>
    const carData = {
        model1: {
            model: 'Toyota Corolla',
            price: 50,
            Doors: 4,
            Capacity: 4,
            Fuel: "Petrol",
            ac: "NO",


        },
        model2: {
            model: 'Chevrolet Cruise',
            price: 70,
            Doors: 4,
            Capacity: 5,
            Fuel: "Petrol",
            ac: "YES",


        },
        model3: {
            model: 'Toyota Camry',
            price: 100,
            Doors: 4,
            Capacity: 6,
            Fuel: "Petrol",
            ac: "YES",


        },
        model4: {
            model: ' Nissan Versa',
            price: 56.9,
            Doors: 4,
            Capacity: 4,
            Fuel: "Petrol",
            ac: "NO",


        },
        model5: {
            model: 'jeep Wrangler',
            price: 120,
            Doors: 4,
            Capacity: 8 + " and luggage",
            Fuel: "Petrol",
            ac: "YES",


        },

    };


    function displayCarDetails(selectedModel) {
        const carDetails = carData[selectedModel];

        if (carDetails) {
            const rentalPrice = document.getElementById('price');
            const carModel = document.getElementById('model');
            const carDoors = document.getElementById('doors');
            const carCapacity = document.getElementById('capacity');
            const carFuel = document.getElementById('fuel');
            const carAc = document.getElementById('ac');



            rentalPrice.innerHTML = `$${carDetails.price}/per day`;
            carModel.innerHTML = `${carDetails.model}`;
            carDoors.innerHTML = `${carDetails.Doors}`;
            carCapacity.innerHTML = `${carDetails.Capacity}`;
            carFuel.innerHTML = `${carDetails.Fuel}`;
            carAc.innerHTML = `${carDetails.ac}`;



        }
    }

    function handleCarOptionClick(event) {
        const selectedModel = event.target.dataset.model;
        displayCarDetails(selectedModel);
    }


    const carOptions = document.getElementsByClassName('car-options');
    for (const carOption of carOptions) {
        carOption.addEventListener('click', handleCarOptionClick);
    }


    if (carOptions.length > 0) {
        const defaultModel = carOptions[0].dataset.model;
        displayCarDetails(defaultModel);
    }
    const myImage = document.getElementById("myImage");
    const button1 = document.getElementById("button1");
    const button2 = document.getElementById("button2");
    const button3 = document.getElementById("button3");
    const button4 = document.getElementById("button4");
    const button5 = document.getElementById("button5");

    // Set default image URL
    const defaultImageUrl = "toyo.png";

    // Set the default image on page load
    myImage.src = defaultImageUrl;

    // Define click event handlers for each button
    button1.addEventListener("click", function() {
        myImage.src = "toyo.png";
    });

    button2.addEventListener("click", function() {
        myImage.src = "che.png";
    });

    button3.addEventListener("click", function() {
        myImage.src = "Camry.png";
    });
    button4.addEventListener("click", function() {
        myImage.src = "nissan.png";
    });
    button5.addEventListener("click", function() {
        myImage.src = "jeep.png";
    });
    var isFormVisible = false;

    function showMessage() {
        var reservationForm = document.getElementById('reservationForm');
        isFormVisible = !isFormVisible;

        if (isFormVisible) {
            reservationForm.style.display = 'block';
            var price= document.getElementById("price")
            var Cost=document.getElementById("Cost")
            cost.innerHTML=price.innerHTML
        } else {
            reservationForm.style.display = 'none';
        }
    }

    function reserveCar() {
        var pickupAddress = document.getElementById('pickupAddress').value;
        var dropAddress = document.getElementById('dropAddress').value;

        // Add more fields as needed

        console.log('Reservation submitted! Pickup Address:', pickupAddress, 'Drop Address:', dropAddress);

        // Optionally, hide the form after submission
        showm();
    }
</script>

</html>