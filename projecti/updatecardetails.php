<?php
include("dbconnect.php");
$id = $_GET['id'];
$selectcars = "SELECT * FROM cars WHERE cid= '$id'";
$data = mysqli_query($conn, $selectcars);
$row = mysqli_fetch_assoc($data);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['carName'];
    $carPhoto = $_POST['carPhoto'];
    $carDescription = $_POST['carDescription'];
    $carPrice = $_POST['carPrice'];

    $sql = "UPDATE cars SET carName='$name', carPhoto='$carPhoto', carDescription='$carDescription' ,carPrice='$carPrice' WHERE cid='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: admin.php?message=Update successful!');
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
    <link rel="stylesheet" href="driveeasy.css">
    <title>update car details</title>
    <style>
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
    </style>
</head>


<body>

    <form id="carForm"method="post">
        <label for="carId">ID:</label>
        <input type="text" id="carId" name="carId" value="<?php echo $id?>" readonly required>

        <label for="carName">Car Name:</label>
        <input type="text" id="carName" name="carName" value="<?php echo $row['carName'] ?>" required>

        <label for="carPhoto">Car Photo:</label>
        <input type="file" id="carPhoto" name="carPhoto" required><br>
        <img src="<?php echo $row['carPhoto'] ?>" alt="" height="100" width="100">

        <label for="carDescription">Car Description:</label>
        <input type="text" id="carDescription" name="carDescription" value="<?php echo $row['carDescription'] ?>" required></input>

        <label for="carPrice">Car Price:</label>
        <input type="text" id="carPrice" name="carPrice" value="<?php echo $row['carPrice'] ?>" required><br>
        <button name="submit" type="submit" >Update</button>
    </form>
</body>

</html>