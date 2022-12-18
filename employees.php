<?php
if ('admin' != $_COOKIE["userlevelcookie"]) {
    header("Location: intropage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Employees</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>List of employees</h2>
<table>
    <tr>
    <th><a href="index.php">Customers</a></th>
        <th><a href="films.php">Films</a></th>
        <th><a href="food.php">Food</a></th>
        <th><a href="orders.php">Orders</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Log out</a></th>
    </tr>
</table>
<?php
include "connect.php";
if($conn->connect_error){
    die("Error: " . $conn->connect_error);
}
$sql = "SELECT * FROM employees";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Rows: $rowsCount</p>";
    echo "<table><tr><th>Employe ID</th><th>Last Name</th><th>First Name</th><th>Position</th><th>Age</th><th>Experience</th><th>salary</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["EmployeID"] . "</td>";
            echo "<td>" . $row["LastName"] . "</td>";
            echo "<td>" . $row["FirstName"] . "</td>";
            echo "<td>" . $row["Position"] . "</td>";
            echo "<td>" . $row["Age"] . "</td>";
            echo "<td>" . $row["Experience"] . "</td>";
            echo "<td>" . $row["Salary"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_employees.php?EmployeID=" . $row["EmployeID"] . "'>Change</a></td>";
            echo "<td><form action='delete_employees.php' method='post'>
                        <input type='hidden' name='EmployeID' value='" . $row["EmployeID"] . "' />
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
        <th><a href='form_employees.php'>Add new employe</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>