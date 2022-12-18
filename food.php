<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Food</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>List of food</h2>
<table>
    <tr>
    <th><a href="index.php">Customers</a></th>
        <th><a href="films.php">Films</a></th>
        <th><a href="orders.php">Orders</a></th>
        <th><a href="employees.php">Our employees</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Log out</a></th>
    </tr>
</table>
<?php
include "connect.php";
if($conn->connect_error){
    die("Error: " . $conn->connect_error);
}
$sql = "SELECT * FROM food";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Rows: $rowsCount</p>";
    echo "<table><tr><th>Food ID</th><th>Name</th><th>Price</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["FoodID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_food.php?FoodID=" . $row["FoodID"] . "'>Change</a></td>";
            echo "<td><form action='delete_food.php' method='post'>
                        <input type='hidden' name='FoodID' value='" . $row["FoodID"] . "' />
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
        <th><a href='form_food.php'>Add new food</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>