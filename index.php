<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Customers</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
    <div class="container">
<h2>List of customers</h2>
    </div>
<table>
    <tr>
        <th><a href="films.php">Films</a></th>
        <th><a href="food.php">Food</a></th>
        <th><a href="orders.php">Orders</a></th>
        <th><a href="employees.php">Our employees</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Log out</a></th>
    </tr>
</table>

<?php
session_start();
if(!isset($_SESSION["session_username"])):
header("location:login.php");
endif;
include "connect.php";
if($conn->connect_error){
    die("Error: " . $conn->connect_error);
}
$sql = "SELECT * FROM customers";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Rows: $rowsCount</p>";
    echo "<table><tr><th>Customer ID</th><th>Last Name</th><th>First Name</th><th>Age</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["CustomerID"] . "</td>";
            echo "<td>" . $row["LastName"] . "</td>";
            echo "<td>" . $row["FirstName"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td>" . $row["Age"] . "</td>";
            } else echo "<td>Permision denided</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_customers.php?CustomerID=" . $row["CustomerID"] . "'>Change</a></td>";
            echo "<td><form action='delete_customers.php' method='post'>
                        <input type='hidden' name='CustomerID' value='" . $row["CustomerID"] . "' />
                        <input type='submit' class='button' value='Delete'>
                   </form></td>";
            } else {
                echo "<td></td>";
                echo "<td></td>";
            }
        echo "</tr>";
    }
    echo "</table>";
    $result->free();
} else{
    echo "Error: " . $conn->error;
}
$conn->close();
if('admin' == $_COOKIE["userlevelcookie"])
echo "<table>
    <tr>
        <th><a href='form_customers.php'>Add new customer</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>