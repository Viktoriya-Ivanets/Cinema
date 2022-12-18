<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["FoodID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $food = mysqli_real_escape_string($conn, $_POST["FoodID"]);
    $sql = "DELETE FROM food WHERE FoodID = '$food'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: food.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>