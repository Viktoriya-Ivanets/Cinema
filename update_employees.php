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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["EmployeID"]))
{
    $employeID = mysqli_real_escape_string($conn, $_GET["EmployeID"]);
    $sql = "SELECT * FROM employees WHERE EmployeID = '$employeID'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $lastname = $row["LastName"];
                $firstname = $row["FirstName"];
                $position = $row["Position"];
                $age = $row["Age"];
                $exp = $row["Experience"];
                $salary = $row["Salary"];
            }
            echo "<h2>Updating data for employees</h2>
                <form method='post'>
                    <input type='hidden' name='EmployeID' value='$employeID' />
                    <p>Last name:</p>
                    <p><input type='text' name='LastName' value='$lastname' /></p>
                    <p>First name:</p>
                    <p><input type='text' name='FirstName' value='$firstname' /></p>
                    <p>Position:</p>
                    <p><input type='text' name='Position' value='$position' /></p>
                    <p>Age:</p>
                    <p><input type='number' name='Age' value='$age' /></p>
                    <p>Experience:</p>
                    <p><input type='number' name='Experience' value='$exp' /></p>
                    <p>Salary:</p>
                    <p><input type='number' name='Salary' value='$salary' /></p>
                    <p><input type='submit' class='button' value='Save'></p>
            </form>";
        }
        else{
            echo "<div>Employe not found</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["EmployeID"]) && isset($_POST["LastName"]) && isset($_POST["FirstName"]) && isset($_POST["Position"]) && isset($_POST["Age"]) && isset($_POST["Experience"]) && isset($_POST["Salary"])) {
      
    $employeID = mysqli_real_escape_string($conn, $_POST["EmployeID"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["LastName"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["FirstName"]);
    $position = mysqli_real_escape_string($conn, $_POST["Position"]);
    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
    $exp = mysqli_real_escape_string($conn, $_POST["Experience"]);
    $salary = mysqli_real_escape_string($conn, $_POST["Salary"]);
    $empid = mysqli_real_escape_string($conn, $_POST["EmployeID"]);
      
    $sql = "UPDATE employees SET LastName = '$lastname', FirstName = '$firstname', Position = '$position', Age = '$age', Experience = '$exp', Salary = '$salary' WHERE EmployeID = '$employeID'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: employees.php");
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