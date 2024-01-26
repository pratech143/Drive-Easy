<?php
include("dbconnect.php");
session_start();
include("dbconnect.php");
if (!isset($_SESSION['Email'])) {
    header('Location: login.php');
    exit();
}

$selectQuery = "SELECT * FROM register";
$result = mysqli_query($conn, $selectQuery);

$selectcars = "SELECT * FROM cars";
$result1 = mysqli_query($conn, $selectcars);

$reservation = "SELECT * FROM reservation";
$result2 = mysqli_query($conn, $reservation);

if (isset($_POST['deleteButton'])) {
    $idToDelete = $_POST['deleteButton'];
    $deleteQuery = "DELETE FROM register WHERE id = $idToDelete";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["carId"];
    $carName = $_POST['carName'];
    $carPhoto = $_POST['carPhoto'];
    $carDescription = $_POST['carDescription'];
    $carPrice = $_POST['carPrice'];
    $sql = "INSERT INTO cars (cid, carName, carPhoto,carDescription,carPrice) VALUES ('$id', '$carName', '$carPhoto', '$carDescription','$carPrice')";

    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php?message=update successful!');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin pannel</title>
    <link rel="stylesheet" href="driveeasy.css">
</head>
<style>
    .container {
        height: 100px;
    }

    .reservation-data {
        margin-top: 140px;
    }

    #carForm {
        border: black solid;
        margin-top: 30px;
    }

    #carForm input {
        width: 80%;
        margin-right: 20px;
        margin-left: 20px;
        background-color: #bfbfbf;
    }

    #carData {
        margin-top: 70px;
    }

    .admin {
        margin-top: 15px;
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

        display: block;
    }

    .hidden {
        display: none;
    }

    .options button {
        padding: 15px;
        width: 90px;
        background-color: #ff5f1f;
        color: black;
        margin-top: 50%;
    }

    body {
        display: flex;
    }

    .user-data {
        margin-top: 4%;
    }

    .options {
        width: 100px;
        display: inline;
        margin-top: 2.5%;
    }

    button {
        border-radius: 5px;
        background-color: grey;
        border: none;
        padding: 10px;
        color: aqua;
    }

    button:hover {
        background-color: rgba(255, 0, 0, 0.5);
        color: black;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f2f2f2;
    }

    table {
        margin-top: 5%;
        /* margin-left: 100px; */
        width: 100%;
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

<body>
    <div class="container">
        <div class="logo">
            <nav>
                <a style="background-color: white;" href="carrent.php"><img src="logo.png" width="200px" title="Drive Easy" alt="Drive Easy"></a>
            </nav>
        </div>

        <div class="user-dropdown">
            <div class="admin"><span class="username" onclick="toggleDropdown()">Admin pannel &#9662;</span></div>
            <div class="dropdown-content" id="userDropdown">
                <a href="logout.php">Logout</a>
            </div>
        </div>

    </div>
    <div class="options">
        <button onclick="showUserData()">users</button><br>
        <button onclick="showCarData()">cars</button>
        <button onclick="showreservationData()">reservation</button>
    </div>
    <?php 

    if (mysqli_num_rows($result) > 0) { ?>
        <div class="user-data" id="userData">
            <table border='1'>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>

                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td id="id"><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["Name"]; ?></td>
                        <td><?php echo $row["Email"]; ?></td>
                        <td><?php echo $row["Password"]; ?></td>
                        <td><?php echo $row["Phone"]; ?></td>
                        <td><button name="deleteButton" id="deleteButton" onclick="deleteRow()"><a href="admindelete.php?id=<?php echo $row['id']; ?>">Delete</a></button>
                            <button><a href="adminupdate.php?id=<?php echo $row['id']; ?>">update</a></button>
                        </td>

                    </tr>

                <?php } ?>

            </table>
        <?php
    } else {
        echo "No records found";
    }
        ?>
        </div>
        <div id="carData">
            <?php if (mysqli_num_rows($result1) >= 0) { ?>
                <div class="car-data" id="carData">
                    <table border='1'>
                        <tr>
                            <th>cid</th>
                            <th>carName</th>
                            <th>carPhoto</th>
                            <th>carDescription</th>
                            <th>carPrice</th>
                            <th>Actions</th>
                        </tr>

                        <?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                            <tr>
                                <td id="id"><?php echo $row1["cid"]; ?></td>
                                <td><?php echo $row1["carName"]; ?></td>
                                <td><img src="<?php echo $row1["carPhoto"] ?>" alt="car" height="50"></td>
                                <td><?php echo $row1["carDescription"]; ?></td>
                                <td><?php echo $row1["carPrice"]; ?></td>
                                <td><button name="deleteButton" id="deleteButton" onclick="deleteRow()"><a href="admindelete.php?id=<?php echo $row1['cid']; ?>">Delete</a></button>
                                    <button><a href="updatecardetails.php?id=<?php echo $row1['cid']; ?>">update</a></button>



                                </td>

                            </tr>

                        <?php } ?>
                    </table>
                    <button onclick="showForm()">Add</button>
                    <form id="carForm" action="admin.php" method="post">
                        <label for="carId">ID:</label>
                        <input type="text" id="carId" name="carId" required>

                        <label for="carName">Car Name:</label>
                        <input type="text" id="carName" name="carName" required>

                        <label for="carPhoto">Car Photo:</label>
                        <input type="file" id="carPhoto" name="carPhoto" required>

                        <label for="carDescription">Car Description:</label>
                        <input type="text" id="carDescription" name="carDescription" required></input>

                        <label for="carPrice">Car Price:</label>
                        <input type="text" id="carPrice" name="carPrice" required><br>

                        <button type="button" onclick="closeForm()">Close</button>
                        <button name="submit" type="submit" onclick="submitForm()">Submit</button>
                    </form>
                <?php
            } else {
                echo "No records found";
            }
                ?>
                </div>

        </div>
        <div id="reservation-data">
            <?php if (mysqli_num_rows($result2) >= 0) { ?>
                <div class="reservation-data" id="reservationData">
                    <table border='1'>
                        <tr>
                            <th>Name</th>
                            <th>car name</th>
                            <th>pickup date</th>
                            <th>drop date</th>
                            <th>reservation status</th>
                            <th>actions</th>
                        </tr>

                        <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                            <tr>
                                <td><?php echo $row2["Name"]; ?></td>
                                <td><?php echo $row2["carName"]; ?></td>
                                <td><?php echo $row2["pickupDate"]; ?></td>
                                <td><?php echo $row2["dropDate"]; ?></td>
                                <td><?php echo $row2["reservationStatus"]; ?></td>
                                <td><button name="approval" id="approval" onclick="approval()">approve</button>

                                </td>

                            </tr>

                        <?php } ?>

                    </table>
                <?php
            } else {
                echo "No records found";
            }
                ?>
                </div>
        </div>
</body>
<script>
    document.getElementById("carForm").classList.add("hidden");
    document.getElementById("carData").classList.add("hidden");
    document.getElementById("reservationData").classList.add("hidden");

    function showUserData() {
        document.getElementById("userData").classList.remove("hidden");
        document.getElementById("carData").classList.add("hidden");
        document.getElementById("reservationData").classList.add("hidden");
    }

    function showCarData() {
        document.getElementById("userData").classList.add("hidden");
        document.getElementById("carData").classList.remove("hidden");
        document.getElementById("reservationData").classList.add("hidden");
    }

    function showreservationData() {
        document.getElementById("userData").classList.add("hidden");
        document.getElementById("carData").classList.add("hidden");
        document.getElementById("reservationData").classList.remove("hidden");
    }

    function deleteRow() {
        var confirmation = confirm("Do you really want to delete data?")
        if (confirmation) {
            window.location.href = "admindelete.php?id=" + id;
        }
    }

    function toggleDropdown() {
        var dropdown = document.getElementById("userDropdown");
        dropdown.classList.toggle("show");
    }
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


    function showForm() {
        document.getElementById("carForm").classList.remove("hidden");
    }

    function closeForm() {
        document.getElementById("carForm").classList.add("hidden");
    }

    function submitForm() {
        // Add your code here to handle form submission
        // You can use JavaScript or send an AJAX request to handle the form data
        // After submission, you may want to close the form, e.g., closeForm();
    }
</script>

</html>