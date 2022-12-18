<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["OrderID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $orderid = mysqli_real_escape_string($conn, $_POST["OrderID"]);
    $sql = "DELETE FROM orders WHERE OrderID = '$orderid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: orders.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>