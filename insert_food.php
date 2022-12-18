<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["Name"]) && isset($_POST["Price"])) {
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $foodname = mysqli_real_escape_string($conn, $_POST["Name"]);
    $price = mysqli_real_escape_string($conn, $_POST["Price"]);
    $sql = "INSERT INTO food (Name, Price) VALUES ('$foodname', $price)";
        if(mysqli_query($conn, $sql)){
            header("Location: food.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>