<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["EmployeID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $employeid = mysqli_real_escape_string($conn, $_POST["EmployeID"]);
    $sql = "DELETE FROM employees WHERE EmployeID = '$employeid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: employees.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>