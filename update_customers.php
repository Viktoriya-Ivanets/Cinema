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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["CustomerID"]))
{
    $customerid = mysqli_real_escape_string($conn, $_GET["CustomerID"]);
    $sql = "SELECT * FROM customers WHERE CustomerID = '$customerid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $lastname = $row["LastName"];
                $firstname = $row["FirstName"];
                $age = $row["Age"];
            }
            echo "<h2>Updating data for customers</h2>
                <form method='post'>
                    <input type='hidden' name='CustomerID' value='$customerid' />
                    <p>Last name:</p>
                    <p><input type='text' name='LastName' value='$lastname' /></p>
                    <p>First name:</p>
                    <p><input type='text' name='FirstName' value='$firstname' /></p>
                    <p>Age:</p>
                    <p><input type='number' name='Age' value='$age' /></p>
                    <p><input type='submit' class='button' value='Save'></p>
            </form>";
        }
        else{
            echo "<div>Customer not found</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["CustomerID"]) && isset($_POST["LastName"]) && isset($_POST["FirstName"]) && isset($_POST["Age"])) {
      
    $customerid = mysqli_real_escape_string($conn, $_POST["CustomerID"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["LastName"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["FirstName"]);
    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
      
    $sql = "UPDATE Customers SET LastName = '$lastname', FirstName = '$firstname', Age = '$age' WHERE CustomerID = '$customerid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: index.php");
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