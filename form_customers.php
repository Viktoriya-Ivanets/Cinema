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
            <h2>Add customer</h2>
            <form action="insert_customers.php" method="post">
                <p>Last name:</p>
                <p><input type="text" name="LastName" /></p>
                <p>First name:</p>
                <p><input type="text" name="FirstName" /></p>
                <p>Age:</p>
                <p><input type="number" name="Age" /></p>
                <p><input type="submit" class="button" value="Add"></p>
            </form>
        </div>
    </div>
</body>
</html>