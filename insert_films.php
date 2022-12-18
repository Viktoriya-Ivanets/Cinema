<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["Name"]) && isset($_POST["HallID"]) && isset($_POST["Age"])) {
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $filmname = mysqli_real_escape_string($conn, $_POST["Name"]);
    $hallid = mysqli_real_escape_string($conn, $_POST["HallID"]);
    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
    $sql = "INSERT INTO films (Name, HallID, Age) VALUES ('$filmname', $hallid, $age)";
        if(mysqli_query($conn, $sql)){
            header("Location: films.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>