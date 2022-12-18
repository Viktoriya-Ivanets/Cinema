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
                if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["FilmID"]))
                {
                    $filmid = mysqli_real_escape_string($conn, $_GET["FilmID"]);
                    $sql = "SELECT * FROM films WHERE FilmID = '$filmid'";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            foreach($result as $row){
                                $filmname = $row["Name"];
                                $hallid = $row["HallID"];
                                $age = $row["Age"];
                            }
                            echo "<h2>Updating data for Films</h2>
                                <form method='post'>
                                    <input type='hidden' name='FilmID' value='$filmid' />
                                    <p>Name of film:</p>
                                    <p><input type='text' name='Name' value='$filmname' /></p>
                                    <p>Hall ID:</p>
                                    <p><input type='number' name='HallID' value='$hallid' /></p>
                                    <p>Age:</p>
                                    <p><input type='number' name='Age' value='$age' /></p>
                                    <p><input type='submit' class='button' value='Save'></p>
                            </form>";
                        }
                        else{
                            echo "<div>Film not found</div>";
                        }
                        mysqli_free_result($result);
                    } else{
                        echo "Error: " . mysqli_error($conn);
                    }
                }
                elseif (isset($_POST["FilmID"]) && isset($_POST["Name"]) && isset($_POST["HallID"]) && isset($_POST["Age"])) {
                    
                    $filmid = mysqli_real_escape_string($conn, $_POST["FilmID"]);
                    $filmname = mysqli_real_escape_string($conn, $_POST["Name"]);
                    $hallid = mysqli_real_escape_string($conn, $_POST["HallID"]);
                    $age = mysqli_real_escape_string($conn, $_POST["Age"]);
                    
                    $sql = "UPDATE films SET Name = '$filmname', HallID = '$hallid', Age = '$age' WHERE FilmID = '$filmid'";
                    if($result = mysqli_query($conn, $sql)){
                        header("Location: films.php");
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