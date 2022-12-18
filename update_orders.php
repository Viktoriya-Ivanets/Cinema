<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
include "connect.php";
if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/base.css">
<?php include("font.php"); ?>
<title>Updating...</title>
<meta charset="utf-8" />
</head>
<body>
<div class="divbg">
        <div class="regform">
<?php
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["OrderID"]))
{
    $orderid = mysqli_real_escape_string($conn, $_GET["OrderID"]);
    $sql = "SELECT * FROM orders WHERE OrderID = '$orderid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $cusid = $row["CustomerID"];
                $foodid = $row["FoodID"];
                $filmid = $row["FilmID"];
                $place = $row["Place"];
                $date = $row["Session"];
                $time = $row["Time"];
                $empid = $row["EmployeID"];
            }
            echo "<h2>Updating data for orders</h2>
                <form method='post'>
                    <input type='hidden' name='OrderID' value='$orderid' />
                    <p>Customer ID:</p>
                    <p><input type='text' name='CustomerID' value='$cusid' /></p>
                    <p>Food ID:</p>
                    <p><input type='text' name='FoodID' value='$foodid' /></p>
                    <p>Film ID:</p>
                    <p><input type='number' name='FilmID' value='$filmid' /></p>
                    <p>Place in hall:</p>
                    <p><input type='number' name='Place' value='$place' /></p>
                    <p>Date of session(yyyy-mm-dd):</p>
                    <p><input type='text' name='Session' value='$date' /></p>
                    <p>Time of session(hh:mm:ss):</p>
                    <p><input type='text' name='Time' value='$time' /></p>
                    <p>Cashier ID:</p>
                    <p><input type='text' name='EmployeID' value='$empid' /></p>
                    <p><input type='submit' class='button' value='Save'></p>
            </form>";
        }
        else{
            echo "<div>Order not found</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["OrderID"]) && isset($_POST["CustomerID"]) && isset($_POST["FoodID"]) && isset($_POST["FilmID"]) && isset($_POST["Place"]) && isset($_POST["Session"]) && isset($_POST["Time"]) && isset($_POST["EmployeID"])) {
      
    $orderid = mysqli_real_escape_string($conn, $_POST["OrderID"]);
    $cusid = mysqli_real_escape_string($conn, $_POST["CustomerID"]);
    $foodid = mysqli_real_escape_string($conn, $_POST["FoodID"]);
    $filmid = mysqli_real_escape_string($conn, $_POST["FilmID"]);
    $place = mysqli_real_escape_string($conn, $_POST["Place"]);
    $date = mysqli_real_escape_string($conn, $_POST["Session"]);
    $time = mysqli_real_escape_string($conn, $_POST["Time"]);
    $empid = mysqli_real_escape_string($conn, $_POST["EmployeID"]);
      
    $sql = "UPDATE orders SET CustomerID = '$cusid', FoodID = '$foodid', FilmID = '$filmid', Place = '$place', Session = '$date', Time = '$time', EmployeID = '$empid' WHERE OrderID = '$orderid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: orders.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
}
else{
    echo "Incorrect data";
}
mysqli_close($conn);
?>
        </div>
    </div>
</body>
</html>