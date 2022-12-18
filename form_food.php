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
            <h2>Add food</h2>
            <form action="insert_food.php" method="post">
                <p>Name:</p>
                <p><input type="text" name="Name" /></p>
                <p>Price:</p>
                <p><input type="number" name="Price" /></p>
                <p><input type="submit" class="button" value="Add"></p>
            </form>
        </div>
    </div>
</body>
</html>