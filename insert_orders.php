<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["CustomerID"]) && isset($_POST["FoodID"]) && isset($_POST["FilmID"]) && isset($_POST["Place"]) && isset($_POST["Session"]) && isset($_POST["Time"]) && isset($_POST["EmployeID"])) {
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $cusid = mysqli_real_escape_string($conn, $_POST["CustomerID"]);
    $foodid = $_POST["FoodID"] == null ? 'NULL' : intval($_POST["FoodID"]);
    $filmid = mysqli_real_escape_string($conn, $_POST["FilmID"]);
    $place = mysqli_real_escape_string($conn, $_POST["Place"]);
    $session = mysqli_real_escape_string($conn, $_POST["Session"]);
    $time = mysqli_real_escape_string($conn, $_POST["Time"]);
    $empid = mysqli_real_escape_string($conn, $_POST["EmployeID"]);
    $sql = "INSERT INTO orders (CustomerID, FoodID, FilmID, Place, Session, Time, EmployeID) VALUES ($cusid, $foodid, $filmid, $place, '$session', '$time', '$empid')";
    if(mysqli_query($conn, $sql)){
            header("Location: orders.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>