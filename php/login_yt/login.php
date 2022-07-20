<?php 

session_start();

	include("DatabaseHelper.php");
	$database = new DatabaseHelper();

	if($_SERVER['REQUEST_METHOD'] === "POST")
	{
		//something was posted
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];

		//read from database
		if($database->exist_user($nickname,$password))
		{
			var_dump($_SESSION);
			$user_data = $database->get_user($nickname,$password);
			var_dump($user_data['userID']);
			$_SESSION['userID'] = $user_data['userID'];
			//header("Location: index.php");
			//die;
		}
		else{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>

<body>
<h1>My COOKING DAIRY</h1><br><hr>

<!-- Login -->
<h2>Login: </h2>
<form method="post" action="login.php">
    <!-- Nickname textbox -->
    <div>
        <label for="new_nickname">Nickname:</label>
        <input id="new_nickname" name="nickname" type="text" placeholder="nickname" maxlength="30" required>
    </div>
    <br>

    <!-- password textbox -->
    <div>
        <label for="new_password">Password:</label>
        <input id="new_password" name="password" type="text" placeholder="at least 6 characters" maxlength="20" required>
    </div>
    <br>
    <!-- Submit button -->
    <div>
        <button type="submit">
            Log in
        </button>
    </div>
</form><br><hr>

<!-- Sign up -->
<h2>Sign up: </h2>
<form method="post" action="addUser.php">
    <!-- Nickname textbox -->
    <div>
        <label for="new_nickname">Nickname:</label>
        <input id="new_nickname" name="nickname" type="text" placeholder="nickname" maxlength="30" required>
    </div>
    <br>

    <!-- password textbox -->
    <div>
        <label for="new_password">Password:</label>
        <input id="new_password" name="password" type="text" placeholder="at least 6 characters" maxlength="20" required>
    </div>
    <br>

    <!-- email textbox -->
    <div>
        <label for="new_email">Email:</label>
        <input id="new_email" name="email" type="email" placeholder="email" maxlength="50" required>
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add User
        </button>
    </div>
</form>

</body>
</html>