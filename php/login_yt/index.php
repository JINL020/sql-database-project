<?php 
session_start();

	include("DatabaseHelper.php");

	$database = new DatabaseHelper();

	$user_data = $database->check_login();

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Cooking Dairy</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>
	<br>
	Hello, <?php echo $user_data['user_name']; ?>
</body>
</html>