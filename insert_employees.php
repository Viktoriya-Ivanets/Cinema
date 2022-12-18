<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["LastName"]) && isset($_POST["FirstName"]) && isset($_POST["Position"]) && isset($_POST["Age"]) && isset($_POST["Experience"]) && isset($_POST["Salary"])) {
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $lastname = mysqli_real_escape_string($conn, $_POST["LastName"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["FirstName"]);
    $position = mysqli_real_escape_string($conn, $_POST["Position"]);
    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
    $exp = mysqli_real_escape_string($conn, $_POST["Experience"]);
    $salary = mysqli_real_escape_string($conn, $_POST["Salary"]);
    $sql = "INSERT INTO employees (LastName, FirstName, Position, Age, Experience, Salary) VALUES ('$lastname', '$firstname', '$position', $age, $exp, $salary)";
        if(mysqli_query($conn, $sql)){
            header("Location: employees.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>