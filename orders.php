<?php
if ('admin' != $_COOKIE["userlevelcookie"]) {
    header("Location: intropage.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("font.php"); ?>
    <title>Orders</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/base.css">
</head>

<body>
    <div class="divbgbd">
        <h2>List of orders</h2>
        <table>
            <tr>
                <th><a href="index.php">Customers</a></th>
                <th><a href="films.php">Films</a></th>
                <th><a href="food.php">Food</a></th>
                <th><a href="employees.php">Our employees</a></th>
                <th>
                    <?php echo $_COOKIE["usernamecookie"]; ?>
                </th>
                <th><a href="logout.php">Log out</a></th>
            </tr>
        </table>
        <?php
        include "connect.php";
        if ($conn->connect_error) {
            die("Error: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM orders";
        if ($result = $conn->query($sql)) {
            $rowsCount = $result->num_rows;
            echo "<p>Rows: $rowsCount</p>";
            echo "<table><tr><th>Order ID</th><th>Customer ID</th><th>Food ID</th><th>Film ID</th><th>Place</th><th>Date</th><th>Session</th><th>Employe ID</th><th></th><th></th></tr>";
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row["OrderID"] . "</td>";
                echo "<td>" . $row["CustomerID"] . "</td>";
                echo "<td>" . $row["FoodID"] . "</td>";
                echo "<td>" . $row["FilmID"] . "</td>";
                echo "<td>" . $row["Place"] . "</td>";
                echo "<td>" . $row["Session"] . "</td>";
                echo "<td>" . $row["Time"] . "</td>";
                echo "<td>" . $row["EmployeID"] . "</td>";
                echo "<td><a href='update_orders.php?OrderID=" . $row["OrderID"] . "'>Change</a></td>";
                echo "<td><form action='delete_orders.php' method='post'>
                        <input type='hidden' name='OrderID' value='" . $row["OrderID"] . "' />
                        <input type='submit' class='button' value='Delete'>
                   </form></td>";
                echo "</tr>";
            }
            echo "</table>";
            $result->free();
        } else {
            echo "Error: " . $conn->error;
        }
        $conn->close();
        if ('admin' == $_COOKIE["userlevelcookie"])
            echo "<table>
    <tr>
        <th><a href='form_orders.php'>Add new order</a></th>
    </tr>
</table>"
            ?>
    </div>
</body>

</html>