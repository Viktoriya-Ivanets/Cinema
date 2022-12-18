<?php
			session_start();
			if(!isset($_SESSION["session_username"])):
				header("location:login.php");
			else:
		?>
<!DOCTYPE html>
<html>
	<head>
	<?php include("font.php"); ?>
		<title>Cinema</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/base.css">
	</head>
	<body>
		<div class="divbg">
		<h2>Welcome, <?php echo $_SESSION['session_username'];?>!</h2>
  		<table>
			<th><a href="logout.php">Logout from system</a></th>
		</table>
		<h3 class="hehe">Choose table to work with:</h3>
  		<table>
  			<th><a href="index.php">Customers </a></th>
  			<th><a href="films.php">Films </a></th>
  			<th><a href="food.php">Food </a></th>
			  <th><a href="employees.php">Our employees</a></th>
			  <th><a href="orders.php">Order </a></th>
  		</table>
		</div>
		<div><h3 class="hehe">If you returned here after choosing table - you don't have enough rules</h3></div>
	</body>
</html>
<?php
	endif;
?>