<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Films</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>List of films</h2>
<table>
    <tr>
    <th><a href="index.php">Customers</a></th>
        <th><a href="food.php">Food</a></th>
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
$sql = "SELECT * FROM films";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Rows: $rowsCount</p>";
    echo "<table><tr><th>Film ID</th><th>Name</th><th>Hall ID</th><th>Age</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["FilmID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["HallID"] . "</td>";
            echo "<td>" . $row["Age"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_films.php?FilmID=" . $row["FilmID"] . "'>Change</a></td>";
            echo "<td><form action='delete_films.php' method='post'>
                        <input type='hidden' name='FilmID' value='" . $row["FilmID"] . "' />
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
        <th><a href='form_films.php'>Add new film</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>