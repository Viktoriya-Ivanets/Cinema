<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["LastName"]) && isset($_POST["FirstName"]) && isset($_POST["Age"])) {   
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $customername = mysqli_real_escape_string($conn, $_POST["LastName"]);
    $name = mysqli_real_escape_string($conn, $_POST["FirstName"]);
    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
    $sql = "INSERT INTO customers (LastName, FirstName, Age) VALUES ('$customername', '$name', $age)";
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>