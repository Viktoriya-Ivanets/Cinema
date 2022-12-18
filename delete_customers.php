<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["CustomerID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $customerid = mysqli_real_escape_string($conn, $_POST["CustomerID"]);
    $sql = "DELETE FROM customers WHERE CustomerID = '$customerid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: index.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>