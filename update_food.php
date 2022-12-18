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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["FoodID"]))
{
    $foodid = mysqli_real_escape_string($conn, $_GET["FoodID"]);
    $sql = "SELECT * FROM food WHERE FoodID = '$foodid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $foodname = $row["Name"];
                $price = $row["Price"];
            }
            echo "<h2>Updating data for Food</h2>
                <form method='post'>
                    <input type='hidden' name='FoodID' value='$foodid' />
                    <p>Name:</p>
                    <p><input type='text' name='Name' value='$foodname' /></p>
                    <p>Price:</p>
                    <p><input type='number' name='Price' value='$price' /></p>
                    <p><input type='submit' class='button' value='Save'></p>
            </form>";
        }
        else{
            echo "<div>Food not found</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["FoodID"]) && isset($_POST["Name"]) && isset($_POST["Price"])) {
      
    $foodid = mysqli_real_escape_string($conn, $_POST["FoodID"]);
    $foodname = mysqli_real_escape_string($conn, $_POST["Name"]);
    $price = mysqli_real_escape_string($conn, $_POST["Price"]);
      
    $sql = "UPDATE food SET Name = '$foodname', Price = '$price' WHERE FoodID = '$foodid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: food.php");
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