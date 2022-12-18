<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/base.css">
<?php include("font.php"); ?>
<title>Inserting...</title>
<meta charset="utf-8" />
</head>
<body>
    <div class="divbg">
        <div class="regform">
            <h2>Add order</h2>
            <form action="insert_orders.php" method="post">
                <p>Customer ID:</p>
                <p><input type="number" name="CustomerID" /></p>
                <p>Food ID:</p>
                <p><input type="number" name="FoodID" /></p>
                <p>Film ID:</p>
                <p><input type="number" name="FilmID" /></p>
                <p>Place:</p>
                <p><input type="number" name="Place" /></p>
                <p>Date of session(yyyy-mm-dd):</p>
                <p><input type="date" name="Session" /></p>
                <p>Time of session(hh-mm-ss):</p>
                <p><input type="time" name="Time" /></p>
                <p>Employe ID:</p>
                <p><input type="number" name="EmployeID" /></p>
                <p><input type="submit" class="button" value="Add"></p>
            </form>
        </div>
    </div>
</body>
</html>