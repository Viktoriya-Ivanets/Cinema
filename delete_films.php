<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["FilmID"]))
{
    include "connect.php";
    if (!$conn) {
      die("Error: " . mysqli_connect_error());
    }
    $film = mysqli_real_escape_string($conn, $_POST["FilmID"]);
    $sql = "DELETE FROM films WHERE FilmID = '$film'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: films.php");
    } else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>
